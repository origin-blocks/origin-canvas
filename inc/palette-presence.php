<?php
/**
 * The palette rename (#116): editor presence, so Update colours skips anything open in an editor.
 *
 * The post editor holds _edit_lock; the Site Editor holds nothing. Heartbeat and post meta are
 * core's own channel and store for this signal (misc.php wp_refresh_post_lock(), post.php
 * _edit_lock). One meta row per tab, `<user ID>:<tab ID>:<expiry>`, so two tabs and two users
 * never overwrite or release each other.
 *
 * @package Origin_Canvas
 */

if ( ! function_exists( 'origin_canvas_palette_presence_window' ) ) {
	/**
	 * How long a report holds, in seconds: core's post lock window.
	 *
	 * @return int
	 */
	function origin_canvas_palette_presence_window() {
		return (int) apply_filters( 'wp_check_post_lock_window', 150 ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- core's filter.
	}
}

if ( ! function_exists( 'origin_canvas_palette_enqueue_presence' ) ) {
	/**
	 * Load the presence script in the post editor and the Site Editor only. The widgets editor
	 * and the Customizer fire the same hook without the editor store.
	 *
	 * @return void
	 */
	function origin_canvas_palette_enqueue_presence() {
		global $pagenow;
		if ( ! in_array( $pagenow, origin_canvas_palette_rules()['editor_screens'], true ) ) {
			return;
		}
		$path  = get_theme_file_path( 'assets/js/editor-presence.js' );
		$mtime = file_exists( $path ) ? filemtime( $path ) : false;
		wp_enqueue_script(
			'origin-canvas-editor-presence',
			get_theme_file_uri( 'assets/js/editor-presence.js' ),
			array( 'heartbeat', 'wp-data', 'wp-block-editor', 'jquery' ),
			$mtime ? $mtime : ORIGIN_CANVAS_VERSION,
			true
		);
		wp_localize_script(
			'origin-canvas-editor-presence',
			'originCanvasPresence',
			array(
				'ajaxUrl' => admin_url( 'admin-ajax.php' ),
				'nonce'   => wp_create_nonce( 'origin_canvas_editor_left' ),
				'types'   => origin_canvas_palette_rules()['types'],
			)
		);
	}
}
add_action( 'enqueue_block_editor_assets', 'origin_canvas_palette_enqueue_presence' );

if ( ! function_exists( 'origin_canvas_palette_valid_tab' ) ) {
	/**
	 * Whether a tab ID has the shape of a UUID.
	 *
	 * @param mixed $tab Tab ID.
	 * @return bool
	 */
	function origin_canvas_palette_valid_tab( $tab ) {
		return is_string( $tab ) && 1 === preg_match( '/^[a-f0-9-]{36}$/D', $tab );
	}
}

if ( ! function_exists( 'origin_canvas_palette_presence_touch' ) ) {
	/**
	 * Refresh this user's and tab's row on a post, pruning expired rows. Every open tab keeps its
	 * row, however many there are: a tab without one would leave its post unprotected.
	 *
	 * @param int    $post_id Post ID.
	 * @param int    $user_id User ID.
	 * @param string $tab     Tab ID.
	 * @param int    $expiry  Unix time the row holds until.
	 * @return void
	 */
	function origin_canvas_palette_presence_touch( $post_id, $user_id, $tab, $expiry ) {
		$key    = '_origin_canvas_editing';
		$now    = time();
		$prefix = $user_id . ':' . $tab . ':';
		$new    = $prefix . (int) $expiry;
		$mine   = null;
		foreach ( (array) get_post_meta( $post_id, $key ) as $row ) {
			$row   = (string) $row;
			$parts = explode( ':', $row );
			if ( 0 === strpos( $row, $prefix ) && null === $mine ) {
				$mine = $row;
				continue;
			}
			if ( ! isset( $parts[2] ) || (int) $parts[2] <= $now ) {
				delete_post_meta( $post_id, $key, $row );
			}
		}
		if ( null !== $mine ) {
			update_post_meta( $post_id, $key, $new, $mine );
		} else {
			add_post_meta( $post_id, $key, $new );
		}
	}
}

if ( ! function_exists( 'origin_canvas_palette_heartbeat_received' ) ) {
	/**
	 * Store what an editor tab reported open. Entities that fail a check are ignored.
	 *
	 * @param array $response Heartbeat response.
	 * @param array $data     Heartbeat data.
	 * @return array The response, unchanged.
	 */
	function origin_canvas_palette_heartbeat_received( $response, $data ) {
		if ( empty( $data['origin_canvas_editing'] ) || ! is_array( $data['origin_canvas_editing'] ) ) {
			return $response;
		}
		$report = $data['origin_canvas_editing'];
		$tab    = isset( $report['tab'] ) ? $report['tab'] : '';
		if ( ! origin_canvas_palette_valid_tab( $tab ) || empty( $report['entities'] ) || ! is_array( $report['entities'] ) ) {
			return $response;
		}
		$types   = origin_canvas_palette_rules()['types'];
		$user_id = get_current_user_id();
		$expiry  = time() + origin_canvas_palette_presence_window();
		$done    = array();
		foreach ( $report['entities'] as $entity ) {
			if ( ! is_array( $entity ) || ! isset( $entity['type'], $entity['id'] ) || ! is_string( $entity['type'] ) || ! in_array( $entity['type'], $types, true ) ) {
				continue;
			}
			$type = $entity['type'];
			if ( 'wp_template' === $type || 'wp_template_part' === $type ) {
				if ( ! is_string( $entity['id'] ) || false === strpos( $entity['id'], '//' ) ) {
					continue;
				}
				$template = get_block_template( $entity['id'], $type );
				$post_id  = ( $template && ! empty( $template->wp_id ) ) ? (int) $template->wp_id : 0;
			} else {
				$post_id = absint( $entity['id'] );
			}
			if ( ! $post_id || isset( $done[ $post_id ] ) ) {
				continue;
			}
			$done[ $post_id ] = true;
			$post             = get_post( $post_id );
			if ( ! $post instanceof WP_Post || $post->post_type !== $type || ! current_user_can( 'edit_post', $post_id ) ) {
				continue;
			}
			origin_canvas_palette_presence_touch( $post_id, $user_id, $tab, $expiry );
		}
		return $response;
	}
}
add_filter( 'heartbeat_received', 'origin_canvas_palette_heartbeat_received', 10, 2 );

if ( ! function_exists( 'origin_canvas_palette_editor_left' ) ) {
	/**
	 * A tab left the editor: drop only this user's rows for this tab.
	 *
	 * @return void
	 */
	function origin_canvas_palette_editor_left() {
		check_ajax_referer( 'origin_canvas_editor_left' );
		$tab = isset( $_POST['tab'] ) ? sanitize_text_field( wp_unslash( $_POST['tab'] ) ) : '';
		if ( ! origin_canvas_palette_valid_tab( $tab ) ) {
			wp_send_json_error( null, 400 );
		}
		$prefix = get_current_user_id() . ':' . $tab . ':';
		$ids    = get_posts(
			array(
				'post_type'    => origin_canvas_palette_rules()['types'],
				'post_status'  => 'any',
				'meta_key'     => '_origin_canvas_editing', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key -- the rows are found by their key.
				'meta_value'   => $prefix, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value -- as above.
				'meta_compare' => 'LIKE',
				'fields'       => 'ids',
				'numberposts'  => 60,
			)
		);
		foreach ( $ids as $id ) {
			foreach ( (array) get_post_meta( $id, '_origin_canvas_editing' ) as $row ) {
				if ( 0 === strpos( (string) $row, $prefix ) ) {
					delete_post_meta( $id, '_origin_canvas_editing', $row );
				}
			}
		}
		wp_send_json_success();
	}
}
add_action( 'wp_ajax_origin_canvas_editor_left', 'origin_canvas_palette_editor_left' );

if ( ! function_exists( 'origin_canvas_palette_heartbeat_settings' ) ) {
	/**
	 * Keep the Site Editor's heartbeat running while the tab is idle, as core does for post.php.
	 *
	 * @param array $settings Heartbeat settings.
	 * @return array
	 */
	function origin_canvas_palette_heartbeat_settings( $settings ) {
		global $pagenow;
		if ( 'site-editor.php' === $pagenow ) {
			$settings['suspension'] = 'disable';
		}
		return $settings;
	}
}
add_filter( 'heartbeat_settings', 'origin_canvas_palette_heartbeat_settings' );

if ( ! function_exists( 'origin_canvas_palette_open_reason' ) ) {
	/**
	 * Why a post counts as open in an editor: '' (not open), 'presence' (an editor tab of any user
	 * reported it), 'lock' (core's post lock, the current user's included) or 'recent' (a
	 * template, template part or menu saved within the window: the backstop for a Site Editor
	 * tab that reports nothing).
	 *
	 * @param WP_Post $post Post.
	 * @return string
	 */
	function origin_canvas_palette_open_reason( $post ) {
		$now    = time();
		$window = origin_canvas_palette_presence_window();
		foreach ( (array) get_post_meta( $post->ID, '_origin_canvas_editing' ) as $row ) {
			$parts = explode( ':', (string) $row );
			if ( isset( $parts[2] ) && (int) $parts[2] > $now ) {
				return 'presence';
			}
		}
		$lock = get_post_meta( $post->ID, '_edit_lock', true );
		if ( $lock ) {
			$parts = explode( ':', (string) $lock );
			if ( isset( $parts[0] ) && (int) $parts[0] > $now - $window ) {
				return 'lock';
			}
		}
		if ( in_array( $post->post_type, origin_canvas_palette_rules()['recent_save_types'], true ) ) {
			$modified = strtotime( $post->post_modified_gmt . ' UTC' );
			if ( $modified && $modified > $now - $window ) {
				return 'recent';
			}
		}
		return '';
	}
}
