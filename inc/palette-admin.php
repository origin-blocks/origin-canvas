<?php
/**
 * The palette rename (#116): Update colours, under Appearance.
 *
 * A one-click action, offered through a dismissible notice, that moves posts, pages, templates,
 * template parts, synced patterns and navigation menus to the new colour names, in small batches,
 * skipping anything open in an editor. Each pass first applies the twin rule to the user's own
 * stylesheets (Additional CSS and the Global Styles css), so no window opens while content moves.
 *
 * @package Origin_Canvas
 */

if ( ! function_exists( 'origin_canvas_palette_unique_ids' ) ) {
	/**
	 * A list of unique integer IDs.
	 *
	 * @param array $ids IDs.
	 * @return int[]
	 */
	function origin_canvas_palette_unique_ids( $ids ) {
		return array_values( array_unique( array_map( 'intval', (array) $ids ) ) );
	}
}

if ( ! function_exists( 'origin_canvas_palette_user_css_step' ) ) {
	/**
	 * Apply the twin rule to each user stylesheet, in place, kept once before its first write.
	 *
	 * @param array $journal The journal; css_moved gains each store written.
	 * @return string 'none', 'updated' or 'failed'.
	 */
	function origin_canvas_palette_user_css_step( &$journal ) {
		$failed  = false;
		$written = false;
		foreach ( origin_canvas_palette_user_css_stores() as $store ) {
			$next = origin_canvas_palette_user_css_next( $store );
			if ( $next === $store['content'] ) {
				continue;
			}
			if ( ! origin_canvas_palette_keep_original( $store['id'], $store['content'] ) ) {
				$failed = true;
				continue;
			}
			$result = origin_canvas_palette_write_post( $store['id'], $store['content'], $next );
			if ( 'updated' !== $result ) {
				$failed = true;
				continue;
			}
			$written                = true;
			$journal['css_moved'][] = (int) $store['id'];
			$journal['css_moved']   = origin_canvas_palette_unique_ids( $journal['css_moved'] );
			if ( 'global_styles' === $store['kind'] ) {
				wp_clean_theme_json_cache();
			}
		}
		if ( $failed ) {
			return 'failed';
		}
		return $written ? 'updated' : 'none';
	}
}

if ( ! function_exists( 'origin_canvas_palette_update_batch' ) ) {
	/**
	 * One batch of Update colours.
	 *
	 * A pass starts when the last one is done: Global Styles are rewritten again when old codes
	 * came back, then the user's stylesheets get the twin rule. A pass whose stylesheet step fails
	 * moves no content and ends at once; the next call retries both. Then the walk goes through
	 * the candidates and the snapshot posts by ID, from the journal's cursor.
	 *
	 * @param int $size At most this many posts handled (written, locked, changed or failed).
	 * @return array
	 */
	function origin_canvas_palette_update_batch( $size = 25 ) {
		$size     = max( 1, (int) $size );
		$journal  = origin_canvas_palette_journal();
		$response = array(
			'updated'       => 0,
			'skipped'       => array(),
			'locked'        => array(),
			'changed'       => array(),
			'failed'        => array(),
			'global_styles' => 'none',
			'css'           => 'none',
			'remaining'     => 0,
			'done'          => false,
		);

		if ( ! empty( $journal['done'] ) ) {
			$d = origin_canvas_palette_detect( true );
			if ( $d['global_styles'] > 0 ) {
				$r                         = origin_canvas_palette_rewrite_global_styles_report();
				$response['global_styles'] = ( $r['changed'] + $r['failed'] > 0 ) ? 'failed' : 'updated';
			}
			$response['css'] = origin_canvas_palette_user_css_step( $journal );
			if ( 'failed' === $response['css'] ) {
				$journal['done'] = true;
				origin_canvas_palette_save_journal( $journal );
				$response['remaining'] = (int) $d['content'];
				$response['done']      = true;
				return $response;
			}
			$journal = array_merge(
				$journal,
				array(
					'cursor'  => 0,
					'skipped' => array(),
					'failed'  => array(),
					'done'    => false,
					'start'   => time(),
					'content' => (int) $d['content'],
					'written' => 0,
				)
			);
			origin_canvas_palette_save_journal( $journal );
		}

		$record   = origin_canvas_palette_collision_record();
		$snapshot = array_map( 'intval', array_keys( $record['posts'] ) );
		$cursor   = (int) $journal['cursor'];
		$ask      = $size * 4;
		$ids      = origin_canvas_palette_candidates( $cursor, $ask );
		$merged   = $ids;
		$done_ids = array_map( 'intval', (array) $journal['collision_done'] );
		foreach ( $snapshot as $id ) {
			if ( $id > $cursor && ! in_array( $id, $done_ids, true ) ) {
				$merged[] = $id;
			}
		}
		$merged = origin_canvas_palette_unique_ids( $merged );
		sort( $merged, SORT_NUMERIC );
		if ( count( $ids ) === $ask ) {
			// A later chunk brings the snapshot posts above this one.
			$last   = (int) end( $ids );
			$merged = array_values(
				array_filter(
					$merged,
					static function ( $id ) use ( $last ) {
						return $id <= $last;
					}
				)
			);
		}

		$handled  = 0;
		$finished = true;
		foreach ( $merged as $id ) {
			if ( $handled >= $size ) {
				$finished = false;
				break;
			}
			$post = get_post( $id );
			if ( ! $post instanceof WP_Post ) {
				$journal['cursor'] = $id;
				continue;
			}
			$content = (string) $post->post_content;
			$extra   = origin_canvas_palette_collision_extra( $id, $content );
			if ( ! $extra && in_array( $id, $snapshot, true ) && ! in_array( $id, $done_ids, true ) ) {
				$journal['collision_done'][] = $id;
				$done_ids[]                  = $id;
			}
			$next = origin_canvas_palette_post_in_scope( $post ) ? origin_canvas_palette_rewrite_content( $content, $extra ) : $content;
			if ( $next === $content ) {
				$journal['cursor'] = $id;
				continue;
			}
			++$handled;
			if ( '' !== origin_canvas_palette_open_reason( $post ) ) {
				$response['locked'][] = $id;
				$journal['skipped'][] = $id;
			} else {
				$result = origin_canvas_palette_write_post( $id, $content, $next );
				if ( 'updated' === $result ) {
					++$response['updated'];
					++$journal['written'];
					if ( $extra ) {
						$journal['collision_done'][] = $id;
						$done_ids[]                  = $id;
					}
				} elseif ( 'changed' === $result ) {
					$response['changed'][] = $id;
					$journal['skipped'][]  = $id;
				} else {
					$response['failed'][] = $id;
					$journal['failed'][]  = $id;
				}
			}
			$journal['cursor'] = $id;
		}
		$journal['skipped']        = origin_canvas_palette_unique_ids( $journal['skipped'] );
		$journal['failed']         = origin_canvas_palette_unique_ids( $journal['failed'] );
		$journal['collision_done'] = origin_canvas_palette_unique_ids( $journal['collision_done'] );
		$response['skipped']       = origin_canvas_palette_unique_ids( array_merge( $response['locked'], $response['changed'] ) );

		if ( $finished && count( $ids ) < $ask ) {
			// The walk ends: count what is left (locked, changed and failed posts still count).
			$journal['done'] = true;
			origin_canvas_palette_save_journal( $journal );
			$d                     = origin_canvas_palette_detect( true );
			$response['remaining'] = (int) $d['content'];
			$response['done']      = true;
			origin_canvas_palette_update_state( array( 'palette_notice_dismissed' => false ) );
			return $response;
		}
		origin_canvas_palette_save_journal( $journal );
		$response['remaining'] = max( 0, (int) $journal['content'] - (int) $journal['written'] );
		return $response;
	}
}

if ( ! function_exists( 'origin_canvas_palette_child_css_texts' ) ) {
	/**
	 * The child theme's CSS texts the page describes: its stylesheets, and the styles.css and
	 * styles.blocks.*.css strings of its theme.json.
	 *
	 * @return array<string, string[]> Relative path => CSS texts.
	 */
	function origin_canvas_palette_child_css_texts() {
		$out = array();
		if ( ! is_child_theme() ) {
			return $out;
		}
		$dir   = trailingslashit( get_stylesheet_directory() );
		$files = origin_canvas_palette_child_files();
		foreach ( $files['css'] as $f ) {
			$out[ substr( $f, strlen( $dir ) ) ][] = (string) file_get_contents( $f ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- a local theme file.
		}
		if ( is_file( $dir . 'theme.json' ) ) {
			$data = json_decode( (string) file_get_contents( $dir . 'theme.json' ), true ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- a local theme file.
			if ( isset( $data['styles']['css'] ) && is_string( $data['styles']['css'] ) ) {
				$out['theme.json'][] = $data['styles']['css'];
			}
			if ( isset( $data['styles']['blocks'] ) && is_array( $data['styles']['blocks'] ) ) {
				foreach ( $data['styles']['blocks'] as $block ) {
					if ( isset( $block['css'] ) && is_string( $block['css'] ) ) {
						$out['theme.json'][] = $block['css'];
					}
				}
			}
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_child_class_hits' ) ) {
	/**
	 * Old colour class names the child theme's CSS uses, per file.
	 *
	 * @return array<string, array<string, string>> Relative path => old class => new class.
	 */
	function origin_canvas_palette_child_class_hits() {
		$classes = origin_canvas_palette_old_classes();
		$out     = array();
		foreach ( origin_canvas_palette_child_css_texts() as $path => $texts ) {
			foreach ( $texts as $css ) {
				origin_canvas_palette_css_scan(
					$css,
					static function ( $prelude ) use ( $classes, $path, &$out ) {
						foreach ( origin_canvas_palette_css_tokens( $prelude, $classes ) as $t ) {
							$out[ $path ][ $t['cls'] ] = $classes[ $t['cls'] ];
						}
						return null;
					},
					true
				);
			}
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_child_negations' ) ) {
	/**
	 * Child theme selector items that exclude elements by an old class only (every old class
	 * inside :not()). Twins only add matches, so they cannot keep such a rule as it was in a file
	 * the theme does not write; the page lists each, as information.
	 *
	 * @return array<string, array<string, array<string, string>>> Relative path => item => old => new.
	 */
	function origin_canvas_palette_child_negations() {
		$classes = origin_canvas_palette_old_classes();
		$out     = array();
		foreach ( origin_canvas_palette_child_css_texts() as $path => $texts ) {
			foreach ( $texts as $css ) {
				origin_canvas_palette_css_scan(
					$css,
					static function ( $prelude ) use ( $classes, $path, &$out ) {
						foreach ( origin_canvas_palette_css_split_items( $prelude ) as $item ) {
							$tokens = origin_canvas_palette_css_tokens( $item, $classes );
							if ( ! $tokens ) {
								continue;
							}
							$pairs = array();
							foreach ( $tokens as $t ) {
								if ( ! $t['negated'] ) {
									continue 2;
								}
								$pairs[ $t['cls'] ] = $classes[ $t['cls'] ];
							}
							$out[ $path ][ trim( $item ) ] = $pairs;
						}
						return null;
					},
					true
				);
			}
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_page_hook' ) ) {
	/**
	 * The Update colours page's hook suffix, once registered.
	 *
	 * @param string|null $set Set it.
	 * @return string
	 */
	function origin_canvas_palette_page_hook( $set = null ) {
		static $hook = '';
		if ( null !== $set ) {
			$hook = (string) $set;
		}
		return $hook;
	}
}

if ( ! function_exists( 'origin_canvas_palette_admin_menu' ) ) {
	/**
	 * Register Appearance → Update colours, only on a site detected as upgraded.
	 *
	 * @return void
	 */
	function origin_canvas_palette_admin_menu() {
		if ( ! origin_canvas_palette_state()['palette_detected'] ) {
			return;
		}
		$hook = add_theme_page(
			__( 'Update colours', 'origin-canvas' ),
			__( 'Update colours', 'origin-canvas' ),
			'edit_theme_options',
			'origin-canvas-update-colours',
			'origin_canvas_palette_render_page'
		);
		origin_canvas_palette_page_hook( $hook ? $hook : '' );
	}
}
add_action( 'admin_menu', 'origin_canvas_palette_admin_menu' );

if ( ! function_exists( 'origin_canvas_palette_render_page' ) ) {
	/**
	 * The Update colours page.
	 *
	 * @return void
	 */
	function origin_canvas_palette_render_page() {
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}
		$d = origin_canvas_palette_detect( true );
		echo '<div class="wrap"><h1>' . esc_html__( 'Update colours', 'origin-canvas' ) . '</h1>';
		echo '<p>' . esc_html__( 'Origin Canvas renamed its colours. Your site looks the same. This moves your posts, pages, templates, template parts, synced patterns and navigation menus to the new colour names, a few at a time, and adds the new colour names beside the old ones in Additional CSS. Anything open in an editor is skipped. Run this again after you close it.', 'origin-canvas' ) . '</p>';

		$hits      = origin_canvas_palette_child_class_hits();
		$negations = origin_canvas_palette_child_negations();
		if ( $hits || $negations ) {
			echo '<div id="origin-canvas-update-colours-child" class="notice notice-info inline">';
			if ( $hits ) {
				echo '<p>' . esc_html__( "Your child theme's CSS uses old colour class names. Origin Canvas adds matching rules for the new names, so these styles keep working. You can change the names in your child theme at any time.", 'origin-canvas' ) . '</p><ul>';
				foreach ( $hits as $path => $pairs ) {
					foreach ( $pairs as $old => $new ) {
						echo '<li><code>' . esc_html( $path ) . '</code>: <code>' . esc_html( $old ) . '</code> → <code>' . esc_html( $new ) . '</code></li>';
					}
				}
				echo '</ul>';
			}
			if ( $negations ) {
				echo '<p>' . wp_kses( __( 'These rules skip elements by an old colour class only. Elements that move to the new name no longer skip them. To keep each rule as it is, add the new class inside its <code>:not()</code>.', 'origin-canvas' ), array( 'code' => array() ) ) . '</p>';
				echo '<ul id="origin-canvas-update-colours-child-negations">';
				foreach ( $negations as $path => $items ) {
					foreach ( $items as $item => $pairs ) {
						$add = array();
						foreach ( $pairs as $new ) {
							$add[] = '<code>.' . esc_html( $new ) . '</code>';
						}
						echo '<li><code>' . esc_html( $path ) . '</code>: <code>' . esc_html( $item ) . '</code>, ' . esc_html__( 'add', 'origin-canvas' ) . ' ' . implode( ', ', $add ) . '</li>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- each part escaped above.
					}
				}
				echo '</ul>';
			}
			echo '</div>';
		}

		echo '<p><button type="button" class="button button-primary" id="origin-canvas-update-colours-run">' . esc_html__( 'Update colours', 'origin-canvas' ) . '</button></p>';
		echo '<p id="origin-canvas-update-colours-status" data-remaining="' . esc_attr( (string) (int) $d['content'] ) . '" data-done="0" aria-live="polite"></p>';
		echo '<ul id="origin-canvas-update-colours-report"></ul></div>';
	}
}

if ( ! function_exists( 'origin_canvas_palette_notice_shows' ) ) {
	/**
	 * Whether the Update colours notice shows on this admin screen.
	 *
	 * @return bool
	 */
	function origin_canvas_palette_notice_shows() {
		if ( ! current_user_can( 'edit_theme_options' ) || origin_canvas_palette_state()['palette_notice_dismissed'] ) {
			return false;
		}
		$screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;
		if ( $screen && '' !== origin_canvas_palette_page_hook() && origin_canvas_palette_page_hook() === $screen->id ) {
			return false;
		}
		return (bool) origin_canvas_palette_detect()['offered'];
	}
}

if ( ! function_exists( 'origin_canvas_palette_notice' ) ) {
	/**
	 * The dismissible notice that offers Update colours.
	 *
	 * @return void
	 */
	function origin_canvas_palette_notice() {
		if ( ! origin_canvas_palette_notice_shows() ) {
			return;
		}
		printf(
			'<div id="origin-canvas-update-colours-notice" class="notice notice-info is-dismissible"><p>%1$s <a href="%2$s">%3$s</a> %4$s</p></div>',
			esc_html__( 'Origin Canvas has new colour names. Your site looks the same.', 'origin-canvas' ),
			esc_url( admin_url( 'themes.php?page=origin-canvas-update-colours' ) ),
			esc_html__( 'Update colours', 'origin-canvas' ),
			esc_html__( 'to move your content to the new names.', 'origin-canvas' )
		);
	}
}
add_action( 'admin_notices', 'origin_canvas_palette_notice' );

if ( ! function_exists( 'origin_canvas_palette_admin_assets' ) ) {
	/**
	 * The page loop and the notice dismiss, on the page and wherever the notice prints.
	 *
	 * @param string $hook_suffix Admin page.
	 * @return void
	 */
	function origin_canvas_palette_admin_assets( $hook_suffix ) {
		$on_page = '' !== origin_canvas_palette_page_hook() && origin_canvas_palette_page_hook() === $hook_suffix;
		if ( ! $on_page && ! origin_canvas_palette_notice_shows() ) {
			return;
		}
		$path  = get_theme_file_path( 'assets/js/update-colours.js' );
		$mtime = file_exists( $path ) ? filemtime( $path ) : false;
		wp_enqueue_script( 'origin-canvas-update-colours', get_theme_file_uri( 'assets/js/update-colours.js' ), array(), $mtime ? $mtime : ORIGIN_CANVAS_VERSION, true );
		wp_localize_script(
			'origin-canvas-update-colours',
			'originCanvasUpdateColours',
			array(
				'ajaxUrl'      => admin_url( 'admin-ajax.php' ),
				'nonce'        => wp_create_nonce( 'origin_canvas_update_colours' ),
				'dismissNonce' => wp_create_nonce( 'origin_canvas_dismiss_update_colours_notice' ),
				'strings'      => array(
					/* translators: %d: number of items. */
					'updated'   => __( 'Updated %d items.', 'origin-canvas' ),
					/* translators: %d: number of items. */
					'locked'    => __( '%d items were open in an editor. Close them and run this again.', 'origin-canvas' ),
					/* translators: %d: number of items. */
					'changed'   => __( '%d items changed while this ran. Run this again.', 'origin-canvas' ),
					/* translators: %d: number of items. */
					'failed'    => __( '%d items could not be saved. Run this again.', 'origin-canvas' ),
					'gsFailed'  => __( 'Your saved styles could not be updated. Run this again.', 'origin-canvas' ),
					'cssFailed' => __( 'Your Additional CSS could not be updated. Run this again.', 'origin-canvas' ),
					'nothing'   => __( 'Nothing left to update.', 'origin-canvas' ),
					'stopped'   => __( 'The update stopped. Run it again to continue.', 'origin-canvas' ),
				),
			)
		);
	}
}
add_action( 'admin_enqueue_scripts', 'origin_canvas_palette_admin_assets' );

if ( ! function_exists( 'origin_canvas_palette_ajax_update' ) ) {
	/**
	 * One batch, for the page's loop.
	 *
	 * @return void
	 */
	function origin_canvas_palette_ajax_update() {
		check_ajax_referer( 'origin_canvas_update_colours' );
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			wp_send_json( array( 'error' => 'forbidden' ), 403 );
		}
		wp_send_json( origin_canvas_palette_update_batch( 25 ) );
	}
}
add_action( 'wp_ajax_origin_canvas_update_colours', 'origin_canvas_palette_ajax_update' );

if ( ! function_exists( 'origin_canvas_palette_ajax_dismiss' ) ) {
	/**
	 * Dismiss the notice. The page still works; a finished run offers it again later.
	 *
	 * @return void
	 */
	function origin_canvas_palette_ajax_dismiss() {
		check_ajax_referer( 'origin_canvas_dismiss_update_colours_notice' );
		if ( ! current_user_can( 'edit_theme_options' ) ) {
			wp_send_json( array( 'error' => 'forbidden' ), 403 );
		}
		origin_canvas_palette_update_state( array( 'palette_notice_dismissed' => true ) );
		wp_send_json_success();
	}
}
add_action( 'wp_ajax_origin_canvas_dismiss_update_colours_notice', 'origin_canvas_palette_ajax_dismiss' );
