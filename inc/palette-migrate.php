<?php
/**
 * The palette rename (#116): the conditional write, the backup, the export filter, the read
 * filter and the Global Styles rewrite on the first admin page load.
 *
 * This file and inc/palette-detect.php are the only theme files that query the database
 * directly (bin/check-palette-names.sh holds that boundary).
 *
 * @package Origin_Canvas
 */

if ( ! function_exists( 'origin_canvas_palette_write_post' ) ) {
	/**
	 * Writes one post's rewritten content.
	 *
	 * The palette rewrite changes colour codes only and renders the same, so it is not a user
	 * edit: no revision, no new modified date, no kses or content filters, no save hooks. It must
	 * also lose no concurrent edit, so the byte compare sits inside the UPDATE itself (CAST AS
	 * BINARY, because the posts table collation ignores case and trailing spaces); a separate read
	 * then write could overwrite an edit saved between them. wp_update_post() would add a
	 * revision, change the modified date (which the recent-save skip reads), run kses on content
	 * the user wrote, and fire save hooks plugins treat as a user edit. After a write:
	 * clean_post_cache() and the theme's own action, for plugins that cache rendered output.
	 * Returns 'changed' when the content no longer matches (skip and retry later), 'failed' when
	 * the query errors.
	 *
	 * @param int    $id   Post ID.
	 * @param string $from The content the rewrite started from.
	 * @param string $to   The rewritten content.
	 * @return string 'updated', 'changed' or 'failed'.
	 */
	function origin_canvas_palette_write_post( $id, $from, $to ) {
		global $wpdb;
		// phpcs:ignore WordPress.DB.DirectDatabaseQuery -- a conditional write core has no API for; see above.
		$r = $wpdb->query( $wpdb->prepare( "UPDATE {$wpdb->posts} SET post_content = %s WHERE ID = %d AND CAST( post_content AS BINARY ) = CAST( %s AS BINARY )", $to, $id, $from ) );
		if ( false === $r ) {
			return 'failed';
		}
		if ( 0 === (int) $r ) {
			return 'changed';
		}
		clean_post_cache( $id );
		/**
		 * Fires after Origin Canvas moved one post to the new colour names.
		 *
		 * @param int    $id        Post ID.
		 * @param string $post_type Post type.
		 */
		do_action( 'origin_canvas_palette_post_rewritten', (int) $id, (string) get_post_type( $id ) );
		return 'updated';
	}
}

if ( ! function_exists( 'origin_canvas_palette_keep_original' ) ) {
	/**
	 * The 1.3.1 content of this post, kept once before the palette rewrite. The theme never reads
	 * it. To restore a record: copy this meta value back into post_content.
	 *
	 * add_metadata(), not add_post_meta(), which would move a revision's meta to its parent.
	 *
	 * @param int    $id      Post ID.
	 * @param string $content The content before the rewrite.
	 * @return bool False when the meta could not be added; the caller then leaves the post.
	 */
	function origin_canvas_palette_keep_original( $id, $content ) {
		if ( metadata_exists( 'post', $id, '_origin_canvas_palette_131' ) ) {
			return true;
		}
		return (bool) add_metadata( 'post', $id, '_origin_canvas_palette_131', wp_slash( $content ), true );
	}
}

if ( ! function_exists( 'origin_canvas_palette_export_skip' ) ) {
	/**
	 * Leave the theme's post meta out of a WXR export: a copied backup would stop keep_original()
	 * from recording the importing site's own content, and a presence row means nothing on
	 * another site.
	 *
	 * @param bool   $skip     Whether to skip the row.
	 * @param string $meta_key Meta key.
	 * @return bool
	 */
	function origin_canvas_palette_export_skip( $skip, $meta_key ) {
		if ( '_origin_canvas_palette_131' === $meta_key || '_origin_canvas_editing' === $meta_key ) {
			return true;
		}
		return $skip;
	}
}
add_filter( 'wxr_export_skip_postmeta', 'origin_canvas_palette_export_skip', 10, 2 );

if ( ! function_exists( 'origin_canvas_palette_filter_user_data' ) ) {
	/**
	 * Until the first admin load rewrites the saved Global Styles, read them with the new codes,
	 * so the site renders and plugins filtering later see the new slugs.
	 *
	 * In this path {} and [] are both array() already on the way in, so the round trip changes no
	 * shape; the database path (rewrite_global_styles_json()) never converts to arrays. The
	 * transform is called directly: core strips isGlobalStylesUserThemeJSON before it applies
	 * this filter (class-wp-theme-json-resolver.php:587).
	 *
	 * @param WP_Theme_JSON_Data $theme_json User data.
	 * @return WP_Theme_JSON_Data
	 */
	function origin_canvas_palette_filter_user_data( $theme_json ) {
		static $memo = array();
		if ( ! $theme_json instanceof WP_Theme_JSON_Data || origin_canvas_palette_state()['palette_rewrite'] ) {
			return $theme_json;
		}
		$array = $theme_json->get_data();
		if ( ! is_array( $array ) ) {
			return $theme_json;
		}
		$key = md5( (string) wp_json_encode( $array ) );
		if ( ! array_key_exists( $key, $memo ) ) {
			$memo[ $key ] = null;
			$obj          = json_decode( (string) wp_json_encode( $array ) );
			if ( is_object( $obj ) && origin_canvas_palette_transform_global_styles( $obj ) ) {
				$memo[ $key ] = json_decode( (string) wp_json_encode( $obj ), true );
			}
		}
		if ( null === $memo[ $key ] ) {
			return $theme_json;
		}
		return new WP_Theme_JSON_Data( $memo[ $key ], 'custom' );
	}
}
add_filter( 'wp_theme_json_data_user', 'origin_canvas_palette_filter_user_data', 5 );

if ( ! function_exists( 'origin_canvas_palette_ensure_snapshot' ) ) {
	/**
	 * Until the first admin load completes: record the active record's collisions and the
	 * snapshot of the content that references them, once, while no content has moved.
	 *
	 * @return bool False when a snapshot is needed and could not be saved; the caller then writes
	 *              nothing.
	 */
	function origin_canvas_palette_ensure_snapshot() {
		if ( origin_canvas_palette_state()['palette_rewrite'] || false !== get_option( 'origin_canvas_palette_collisions', false ) ) {
			return true;
		}
		$active = origin_canvas_palette_active_global_styles_id();
		$post   = $active ? get_post( $active ) : null;
		$data   = $post instanceof WP_Post ? json_decode( (string) $post->post_content ) : null;
		if ( ! is_object( $data ) || empty( $data->isGlobalStylesUserThemeJSON ) ) { // phpcs:ignore WordPress.NamingConventions.ValidVariableName.UsedPropertyNotSnakeCase -- core's key.
			return true;
		}
		$root = origin_canvas_palette_collisions( $data )['root'];
		if ( ! $root['color'] && ! $root['spacing'] && ! $root['lineHeight'] ) {
			return true;
		}
		if ( add_option( 'origin_canvas_palette_collisions', array( 'map' => $root ) + origin_canvas_palette_collision_snapshot( $root ), '', false ) ) {
			return true;
		}
		// add_option() also returns false when another request added the record first.
		wp_cache_delete( 'origin_canvas_palette_collisions', 'options' );
		wp_cache_delete( 'notoptions', 'options' );
		return false !== get_option( 'origin_canvas_palette_collisions', false );
	}
}

if ( ! function_exists( 'origin_canvas_palette_rewrite_global_styles_report' ) ) {
	/**
	 * Rewrite every Global Styles post of this theme, revisions before their record, each kept
	 * once in _origin_canvas_palette_131 before its first write. Idempotent.
	 *
	 * Before the first admin load completes, the active record's collisions and the snapshot of
	 * the content that references them are recorded once: no content has moved yet.
	 *
	 * @return array{updated: int, changed: int, failed: int}
	 */
	function origin_canvas_palette_rewrite_global_styles_report() {
		$report = array(
			'updated'        => 0,
			'changed'        => 0,
			'failed'         => 0,
			'on_dark_merged' => null, // Null when no post was read.
		);
		if ( ! origin_canvas_palette_ensure_snapshot() ) {
			// Without the snapshot, content that uses the user's own destination swatch could not
			// follow it to the legacy slug: write nothing, so the next admin page retries.
			$report['failed'] = 1;
			return $report;
		}
		$posts                    = origin_canvas_palette_global_styles_posts();
		$report['on_dark_merged'] = false;

		// Revisions first, then their record.
		$groups = array();
		foreach ( $posts as $p ) {
			$parent              = 'revision' === $p->post_type ? (int) $p->post_parent : (int) $p->ID;
			$groups[ $parent ][] = $p;
		}
		foreach ( $groups as $parent => $group ) {
			usort(
				$group,
				static function ( $a, $b ) use ( $parent ) {
					$ra = (int) $a->ID === (int) $parent ? 1 : 0;
					$rb = (int) $b->ID === (int) $parent ? 1 : 0;
					return $ra - $rb;
				}
			);
			foreach ( $group as $p ) {
				$content = (string) $p->post_content;
				origin_canvas_palette_merge_changed( false );
				$next = origin_canvas_palette_rewrite_global_styles_json( $content );
				// A published record whose saved On Dark differed from the Base 2 it merges into:
				// the site no longer looks quite the same, and the page and the notice say so.
				if ( 'revision' !== $p->post_type && 'publish' === $p->post_status && origin_canvas_palette_merge_changed() ) {
					$report['on_dark_merged'] = true;
				}
				if ( null === $next || $next === $content ) {
					continue;
				}
				if ( ! origin_canvas_palette_keep_original( (int) $p->ID, $content ) ) {
					++$report['failed'];
					continue;
				}
				++$report[ origin_canvas_palette_write_post( (int) $p->ID, $content, $next ) ];
			}
		}
		wp_clean_theme_json_cache();
		return $report;
	}
}

if ( ! function_exists( 'origin_canvas_palette_rewrite_global_styles' ) ) {
	/**
	 * The first-admin-load rewrite. Idempotent.
	 *
	 * @return int The number of posts (records and revisions) changed.
	 */
	function origin_canvas_palette_rewrite_global_styles() {
		return origin_canvas_palette_rewrite_global_styles_report()['updated'];
	}
}

if ( ! function_exists( 'origin_canvas_palette_first_admin_load' ) ) {
	/**
	 * On the first admin page load after the update, rewrite the saved Global Styles and all their
	 * revisions to the new codes. It takes no input, so it runs for any user's first admin page.
	 * When a post could not be written, the read filter keeps the site rendering and the next
	 * admin page load retries. There is no hook on later saves.
	 *
	 * @return void
	 */
	function origin_canvas_palette_first_admin_load() {
		if ( is_network_admin() || wp_doing_ajax() || wp_doing_cron() || origin_canvas_palette_state()['palette_rewrite'] ) {
			return;
		}
		$r = origin_canvas_palette_rewrite_global_styles_report();
		if ( 0 === $r['changed'] + $r['failed'] ) {
			$changes = array(
				'palette_rewrite'        => time(),
				'palette_rewrite_failed' => 0,
			);
		} else {
			$changes = array( 'palette_rewrite_failed' => $r['changed'] + $r['failed'] );
		}
		// Set once, from the first load that read the saved styles: a retry reads posts the first
		// try already rewrote, where the On Dark entry is gone.
		if ( null !== $r['on_dark_merged'] && ! array_key_exists( 'on_dark_merged', origin_canvas_palette_state() ) ) {
			$changes['on_dark_merged'] = $r['on_dark_merged'];
		}
		origin_canvas_palette_update_state( $changes );
		delete_transient( 'origin_canvas_palette_scan' );
	}
}
add_action( 'admin_init', 'origin_canvas_palette_first_admin_load' );

if ( ! function_exists( 'origin_canvas_palette_failed_rewrite_notice' ) ) {
	/**
	 * Say so when the first-load rewrite could not write every post.
	 *
	 * @return void
	 */
	function origin_canvas_palette_failed_rewrite_notice() {
		$state = origin_canvas_palette_state();
		if ( ! current_user_can( 'edit_theme_options' ) || $state['palette_rewrite'] || (int) $state['palette_rewrite_failed'] <= 0 ) {
			return;
		}
		$text = __( 'Some saved styles have not moved to the new colour names yet. Origin Canvas tries again on your next admin page.', 'origin-canvas' );
		// A merged customised On Dark changed how the site looks (owner ruling, Oct 26).
		if ( empty( $state['on_dark_merged'] ) ) {
			$text .= ' ' . __( 'Your site looks the same meanwhile.', 'origin-canvas' );
		}
		echo '<div class="notice notice-warning"><p>' . esc_html( $text ) . '</p></div>';
	}
}
add_action( 'admin_notices', 'origin_canvas_palette_failed_rewrite_notice' );
