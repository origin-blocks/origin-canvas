<?php
/**
 * The palette rename (#116): detection, the candidate query, its cache, the collision snapshot
 * and the save hooks.
 *
 * A site counts as upgraded when its data holds an old code in a recognised field. Neither the
 * theme version nor a text match decides it.
 *
 * This file and inc/palette-migrate.php are the only theme files that query the database
 * directly (bin/check-palette-names.sh holds that boundary).
 *
 * @package Origin_Canvas
 */

if ( ! function_exists( 'origin_canvas_palette_tokens' ) ) {
	/**
	 * The prefilter tokens of the candidate query: every form an old code takes in stored
	 * markup. Over-inclusive on purpose; the walk decides.
	 *
	 * @return string[]
	 */
	function origin_canvas_palette_tokens() {
		static $tokens = null;
		if ( null !== $tokens ) {
			return $tokens;
		}
		$tokens = array();
		foreach ( array_keys( origin_canvas_palette_map()['color'] ) as $old ) {
			if ( 'border' === $old ) {
				// "border" with its quotes: a border style key also matches, and the walk counts
				// none of those. has-border-color alone is core's generic class.
				array_push( $tokens, '"border"', 'color|border', 'color--border', 'has-border-background-color', 'has-border-border-color' );
				continue;
			}
			array_push( $tokens, 'has-' . $old . '-', '"' . $old . '"', 'color|' . $old, 'color--' . $old );
		}
		array_push( $tokens, 'spacing|compact', 'spacing--compact', 'line-height|body', 'line-height--body' );
		// Core encodes "--" in attribute strings (blocks.php:1712); the encoder builds each form.
		foreach ( array( 'color--', 'spacing--compact', 'line-height--body' ) as $raw ) {
			$tokens[] = substr( origin_canvas_palette_encode_attr_string( $raw ), 1, -1 );
		}
		$tokens[] = origin_canvas_palette_escape_token();
		return $tokens;
	}
}

if ( ! function_exists( 'origin_canvas_palette_escape_token' ) ) {
	/**
	 * The prefilter token for a slug written with JSON escapes in block attributes:
	 * "textColor":"text\u002dheading" is valid JSON for the slug text-heading, and any character of
	 * a slug may be escaped so. Every slug character is ASCII, so each escaped form holds "\u00".
	 * Over-inclusive (core itself writes "--", "<", ">", "&" and quotes in attribute strings so);
	 * the walk decodes the attributes and decides.
	 *
	 * @return string
	 */
	function origin_canvas_palette_escape_token() {
		return '\\u00';
	}
}

if ( ! function_exists( 'origin_canvas_palette_destination_tokens' ) ) {
	/**
	 * The tokens of the collided destinations of a collision map. Only the snapshot query uses them.
	 *
	 * @param array $map Collision map (kind => dest => legacy).
	 * @return string[]
	 */
	function origin_canvas_palette_destination_tokens( $map ) {
		$tokens = array();
		foreach ( array_keys( isset( $map['color'] ) ? (array) $map['color'] : array() ) as $d ) {
			array_push( $tokens, 'has-' . $d . '-', '"' . $d . '"', 'color|' . $d, 'color--' . $d, substr( origin_canvas_palette_encode_attr_string( 'color--' . $d ), 1, -1 ) );
		}
		foreach ( array_keys( isset( $map['spacing'] ) ? (array) $map['spacing'] : array() ) as $d ) {
			array_push( $tokens, 'spacing|' . $d, 'spacing--' . $d, substr( origin_canvas_palette_encode_attr_string( 'spacing--' . $d ), 1, -1 ) );
		}
		foreach ( array_keys( isset( $map['lineHeight'] ) ? (array) $map['lineHeight'] : array() ) as $d ) {
			array_push( $tokens, 'line-height|' . $d, 'line-height--' . $d, substr( origin_canvas_palette_encode_attr_string( 'line-height--' . $d ), 1, -1 ) );
		}
		if ( $tokens ) {
			$tokens[] = origin_canvas_palette_escape_token();
		}
		return $tokens;
	}
}

if ( ! function_exists( 'origin_canvas_palette_statuses' ) ) {
	/**
	 * Every status a post of the six types can hold content in: the public and private ones,
	 * and trash (a post restored from the trash must not bring old codes back).
	 *
	 * @return string[]
	 */
	function origin_canvas_palette_statuses() {
		$statuses   = array_values( get_post_stati( array( 'internal' => false ) ) );
		$statuses[] = 'trash';
		return array_values( array_unique( $statuses ) );
	}
}

if ( ! function_exists( 'origin_canvas_palette_candidates' ) ) {
	/**
	 * IDs of posts of the six types, in every status, whose content holds a token. One prepared
	 * query, no user context and no query filters, so a password-protected or trashed post counts.
	 *
	 * @param int        $after  Only IDs above this.
	 * @param int        $limit  At most this many (0: all).
	 * @param array|null $tokens The tokens (null: origin_canvas_palette_tokens()).
	 * @return int[]
	 */
	function origin_canvas_palette_candidates( $after = 0, $limit = 0, $tokens = null ) {
		global $wpdb;
		$tokens = null === $tokens ? origin_canvas_palette_tokens() : array_values( (array) $tokens );
		if ( ! $tokens ) {
			return array();
		}
		$types    = origin_canvas_palette_rules()['types'];
		$statuses = origin_canvas_palette_statuses();
		$likes    = array();
		foreach ( $tokens as $token ) {
			$likes[] = '%' . $wpdb->esc_like( $token ) . '%';
		}
		$sql  = "SELECT /* origin_canvas_palette_candidates */ ID FROM {$wpdb->posts} WHERE post_type IN (" . implode( ', ', array_fill( 0, count( $types ), '%s' ) ) . ')';
		$sql .= ' AND post_status IN (' . implode( ', ', array_fill( 0, count( $statuses ), '%s' ) ) . ')';
		$sql .= ' AND ID > %d AND ( ' . implode( ' OR ', array_fill( 0, count( $likes ), 'post_content LIKE %s' ) ) . ' ) ORDER BY ID ASC';
		$args = array_merge( $types, $statuses, array( (int) $after ), $likes );
		if ( $limit > 0 ) {
			$sql   .= ' LIMIT %d';
			$args[] = (int) $limit;
		}
		// phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared, WordPress.DB.DirectDatabaseQuery -- prepared here; a LIKE prefilter core has no API for.
		$ids = $wpdb->get_col( $wpdb->prepare( $sql, $args ) );
		return array_map( 'intval', (array) $ids );
	}
}

if ( ! function_exists( 'origin_canvas_palette_post_in_scope' ) ) {
	/**
	 * Whether Update colours covers a post: templates and template parts of this theme (or its
	 * parent) only; every post of the other four types.
	 *
	 * @param WP_Post $post Post.
	 * @return bool
	 */
	function origin_canvas_palette_post_in_scope( $post ) {
		if ( ! $post instanceof WP_Post ) {
			return false;
		}
		if ( ! in_array( $post->post_type, origin_canvas_palette_rules()['types'], true ) ) {
			return false;
		}
		if ( in_array( $post->post_type, array( 'wp_template', 'wp_template_part' ), true ) ) {
			return has_term( array_unique( array( get_stylesheet(), get_template() ) ), 'wp_theme', $post );
		}
		return true;
	}
}

if ( ! function_exists( 'origin_canvas_palette_global_styles_posts' ) ) {
	/**
	 * Every Global Styles post of this theme (any status, drafts and trash included) and the
	 * resolver's active record, each followed by its revisions (oldest first, whether revisions
	 * are on or not). Never creates a record.
	 *
	 * @return WP_Post[]
	 */
	function origin_canvas_palette_global_styles_posts() {
		$query  = new WP_Query(
			array(
				'post_type'           => 'wp_global_styles',
				'post_status'         => array( 'any', 'trash' ),
				'posts_per_page'      => -1,
				'orderby'             => 'ID',
				'order'               => 'ASC',
				'no_found_rows'       => true,
				'suppress_filters'    => false,
				'ignore_sticky_posts' => true,
				'tax_query'           => array( // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query -- core's own lookup.
					array(
						'taxonomy' => 'wp_theme',
						'field'    => 'name',
						'terms'    => array_values( array_unique( array( get_stylesheet(), get_template() ) ) ),
					),
				),
			)
		);
		$posts  = array();
		$seen   = array();
		foreach ( $query->posts as $p ) {
			if ( $p instanceof WP_Post && ! isset( $seen[ $p->ID ] ) ) {
				$seen[ $p->ID ] = true;
				$posts[]        = $p;
			}
		}
		$active = WP_Theme_JSON_Resolver::get_user_data_from_wp_global_styles( wp_get_theme() );
		if ( is_array( $active ) && ! empty( $active['ID'] ) && ! isset( $seen[ (int) $active['ID'] ] ) ) {
			$p = get_post( (int) $active['ID'] );
			if ( $p instanceof WP_Post ) {
				$seen[ $p->ID ] = true;
				$posts[]        = $p;
			}
		}
		$out = array();
		foreach ( $posts as $p ) {
			$out[] = $p;
			foreach ( wp_get_post_revisions(
				$p->ID,
				array(
					'check_enabled' => false,
					'order'         => 'ASC',
				)
			) as $rev ) {
				$out[] = $rev;
			}
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_active_global_styles_id' ) ) {
	/**
	 * The active Global Styles record's ID, or 0. Never creates one.
	 *
	 * @return int
	 */
	function origin_canvas_palette_active_global_styles_id() {
		$active = WP_Theme_JSON_Resolver::get_user_data_from_wp_global_styles( wp_get_theme() );
		return ( is_array( $active ) && ! empty( $active['ID'] ) ) ? (int) $active['ID'] : 0;
	}
}

if ( ! function_exists( 'origin_canvas_palette_collided_slugs' ) ) {
	/**
	 * The collided destination slugs of a collision map, per kind.
	 *
	 * @param array $map Collision map.
	 * @return array
	 */
	function origin_canvas_palette_collided_slugs( $map ) {
		$out = array();
		foreach ( array( 'color', 'spacing', 'lineHeight' ) as $kind ) {
			$out[ $kind ] = array_map( 'strval', array_keys( isset( $map[ $kind ] ) ? (array) $map[ $kind ] : array() ) );
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_refs_empty' ) ) {
	/**
	 * Whether a refs array (kind => slugs) is empty.
	 *
	 * @param array $refs Refs.
	 * @return bool
	 */
	function origin_canvas_palette_refs_empty( $refs ) {
		foreach ( (array) $refs as $list ) {
			if ( ! empty( $list ) ) {
				return false;
			}
		}
		return true;
	}
}

if ( ! function_exists( 'origin_canvas_palette_collision_extra' ) ) {
	/**
	 * The collision map one post takes in Update colours.
	 *
	 * The snapshot was taken at the first admin load, before any content moved, when every
	 * reference to a collided destination was the user's swatch. The legacy check makes a retry
	 * after an interrupted write map nothing; collision_done keeps a later edit from being mapped
	 * again.
	 *
	 * @param int    $id      Post ID.
	 * @param string $content Its content now.
	 * @return array Collision map (kind => dest => legacy), empty when none applies.
	 */
	function origin_canvas_palette_collision_extra( $id, $content ) {
		$record = origin_canvas_palette_collision_record();
		$snap   = isset( $record['posts'][ $id ] ) ? $record['posts'][ $id ] : null;
		if ( ! is_array( $snap ) ) {
			return array();
		}
		if ( in_array( (int) $id, array_map( 'intval', (array) origin_canvas_palette_journal()['collision_done'] ), true ) ) {
			return array();
		}
		$out = array();
		foreach ( array( 'color', 'spacing', 'lineHeight' ) as $kind ) {
			foreach ( isset( $snap[ $kind ] ) ? (array) $snap[ $kind ] : array() as $d ) {
				if ( ! isset( $record['map'][ $kind ][ $d ] ) ) {
					continue;
				}
				$legacy = $record['map'][ $kind ][ $d ];
				$found  = origin_canvas_palette_content_slug_refs( $content, array( $kind => array( $legacy ) ) );
				if ( ! $found[ $kind ] ) {
					$out[ $kind ][ $d ] = $legacy;
				}
			}
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_each_candidate' ) ) {
	/**
	 * Call $fn( WP_Post ) for each candidate in scope, read in chunks of 200, until it returns false.
	 *
	 * @param callable   $fn     Callback.
	 * @param array|null $tokens Tokens.
	 * @return void
	 */
	function origin_canvas_palette_each_candidate( $fn, $tokens = null ) {
		$after = 0;
		do {
			$ids = origin_canvas_palette_candidates( $after, 200, $tokens );
			if ( $ids ) {
				_prime_post_caches( $ids, false, false );
			}
			foreach ( $ids as $id ) {
				$after = $id;
				$post  = get_post( $id );
				if ( ! origin_canvas_palette_post_in_scope( $post ) ) {
					continue;
				}
				if ( false === $fn( $post ) ) {
					return;
				}
			}
		} while ( count( $ids ) === 200 );
	}
}

if ( ! function_exists( 'origin_canvas_palette_collision_snapshot' ) ) {
	/**
	 * The posts (and the Additional CSS post) that reference a collided destination, with what
	 * they reference. Called once, at the first admin load, before any content moves.
	 *
	 * @param array $map Collision map.
	 * @return array{posts: array, css: array}
	 */
	function origin_canvas_palette_collision_snapshot( $map ) {
		$slugs = origin_canvas_palette_collided_slugs( $map );
		$out   = array(
			'posts' => array(),
			'css'   => array(),
		);
		if ( origin_canvas_palette_refs_empty( $slugs ) ) {
			return $out;
		}
		origin_canvas_palette_each_candidate(
			static function ( $post ) use ( $slugs, &$out ) {
				$refs = origin_canvas_palette_content_slug_refs( $post->post_content, $slugs );
				if ( ! origin_canvas_palette_refs_empty( $refs ) ) {
					$out['posts'][ $post->ID ] = $refs;
				}
				return true;
			},
			origin_canvas_palette_destination_tokens( $map )
		);
		$css_post = wp_get_custom_css_post();
		if ( $css_post instanceof WP_Post ) {
			$refs = origin_canvas_palette_css_refs( $css_post->post_content, $slugs );
			if ( ! origin_canvas_palette_refs_empty( $refs ) ) {
				$out['css'] = array(
					'id'   => (int) $css_post->ID,
					'refs' => $refs,
				);
			}
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_user_css_stores' ) ) {
	/**
	 * The user's own stylesheets: the Additional CSS post and the active Global Styles record.
	 *
	 * @return array List of array( 'id' => int, 'kind' => 'custom_css'|'global_styles', 'content' => string ).
	 */
	function origin_canvas_palette_user_css_stores() {
		$stores   = array();
		$css_post = wp_get_custom_css_post();
		if ( $css_post instanceof WP_Post ) {
			$stores[] = array(
				'id'      => (int) $css_post->ID,
				'kind'    => 'custom_css',
				'content' => (string) $css_post->post_content,
			);
		}
		$gs_id = origin_canvas_palette_active_global_styles_id();
		if ( $gs_id ) {
			$gs = get_post( $gs_id );
			if ( $gs instanceof WP_Post ) {
				$stores[] = array(
					'id'      => $gs_id,
					'kind'    => 'global_styles',
					'content' => (string) $gs->post_content,
				);
			}
		}
		return $stores;
	}
}

if ( ! function_exists( 'origin_canvas_palette_rewrite_css_strings' ) ) {
	/**
	 * Apply $fn to every string under a key named css in a decoded node.
	 *
	 * @param mixed    $v   Node.
	 * @param callable $fn  string => string.
	 * @param string   $key The node's key.
	 * @return mixed
	 */
	function origin_canvas_palette_rewrite_css_strings( $v, $fn, $key = '' ) {
		if ( is_string( $v ) ) {
			return 'css' === $key ? $fn( $v ) : $v;
		}
		if ( is_array( $v ) ) {
			foreach ( $v as $i => $x ) {
				$v[ $i ] = origin_canvas_palette_rewrite_css_strings( $x, $fn );
			}
			return $v;
		}
		if ( is_object( $v ) ) {
			foreach ( get_object_vars( $v ) as $k => $x ) {
				$v->$k = origin_canvas_palette_rewrite_css_strings( $x, $fn, (string) $k );
			}
		}
		return $v;
	}
}

if ( ! function_exists( 'origin_canvas_palette_user_css_next' ) ) {
	/**
	 * A user stylesheet store after the user-CSS step of Update colours (the twin rule, in place).
	 * The derived-item rule and the skipped present variants make a second run change nothing.
	 *
	 * @param array $store A store from origin_canvas_palette_user_css_stores().
	 * @return string
	 */
	function origin_canvas_palette_user_css_next( $store ) {
		$record     = origin_canvas_palette_collision_record();
		$collisions = $record['map'];
		$content    = (string) $store['content'];
		if ( 'custom_css' === $store['kind'] ) {
			// The snapshot gate for variables: only a stylesheet the snapshot lists, and only until
			// it holds the legacy name.
			$refs = ( isset( $record['css']['id'], $record['css']['refs'] ) && (int) $record['css']['id'] === (int) $store['id'] ) ? $record['css']['refs'] : null;
			return origin_canvas_palette_rewrite_user_css( $content, $collisions, true, origin_canvas_palette_css_collision_extra( $content, $collisions, $refs ) );
		}
		$data = json_decode( $content );
		if ( ! is_object( $data ) || ! isset( $data->styles ) ) {
			return $content;
		}
		$before = wp_json_encode( $data->styles );
		// Variables in the record's css were renamed at the first admin load, hence false.
		$data->styles = origin_canvas_palette_rewrite_css_strings(
			$data->styles,
			static function ( $css ) use ( $collisions ) {
				return origin_canvas_palette_rewrite_user_css( $css, $collisions, false );
			},
			'styles'
		);
		if ( wp_json_encode( $data->styles ) === $before ) {
			return $content;
		}
		return wp_json_encode( $data, JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP );
	}
}

if ( ! function_exists( 'origin_canvas_palette_post_hits' ) ) {
	/**
	 * Whether a post is in scope with reachable old codes, and whether it holds any old code.
	 *
	 * @param WP_Post|null $post Post.
	 * @return array{reachable: bool, any: bool}
	 */
	function origin_canvas_palette_post_hits( $post ) {
		if ( ! $post instanceof WP_Post || '' === (string) $post->post_content ) {
			return array(
				'reachable' => false,
				'any'       => false,
			);
		}
		$hits = origin_canvas_palette_content_hits( $post->post_content );
		return array(
			'reachable' => $hits['reachable'] && origin_canvas_palette_post_in_scope( $post ),
			'any'       => $hits['reachable'] || $hits['alias'],
		);
	}
}

if ( ! function_exists( 'origin_canvas_palette_child_files' ) ) {
	/**
	 * The child theme's stylesheets (style.css and every *.css under assets/, two levels deep,
	 * up to 1 MB each) and JSON files (theme.json, styles/*.json, styles/*\/*.json).
	 *
	 * @return array{css: string[], json: string[]} Absolute paths.
	 */
	function origin_canvas_palette_child_files() {
		$out = array(
			'css'  => array(),
			'json' => array(),
		);
		if ( ! is_child_theme() ) {
			return $out;
		}
		$dir = get_stylesheet_directory();
		$css = array_merge( array( $dir . '/style.css' ), (array) glob( $dir . '/assets/*.css' ), (array) glob( $dir . '/assets/*/*.css' ) );
		foreach ( $css as $f ) {
			if ( is_string( $f ) && is_file( $f ) && filesize( $f ) <= MB_IN_BYTES ) {
				$out['css'][] = $f;
			}
		}
		$json = array_merge( array( $dir . '/theme.json' ), (array) glob( $dir . '/styles/*.json' ), (array) glob( $dir . '/styles/*/*.json' ) );
		foreach ( $json as $f ) {
			if ( is_string( $f ) && is_file( $f ) && filesize( $f ) <= MB_IN_BYTES ) {
				$out['json'][] = $f;
			}
		}
		return $out;
	}
}

if ( ! function_exists( 'origin_canvas_palette_found_elsewhere' ) ) {
	/**
	 * Whether a store other than posts and Global Styles holds an old code: Additional CSS,
	 * widgets, theme mods, Customizer changesets and the child theme.
	 *
	 * @return bool
	 */
	function origin_canvas_palette_found_elsewhere() {
		$css_post = wp_get_custom_css_post();
		if ( $css_post instanceof WP_Post && origin_canvas_palette_css_code_hits( $css_post->post_content ) ) {
			return true;
		}
		foreach ( (array) get_option( 'widget_block', array() ) as $w ) {
			if ( is_array( $w ) && isset( $w['content'] ) && is_string( $w['content'] ) ) {
				$h = origin_canvas_palette_content_hits( $w['content'] );
				if ( $h['reachable'] || $h['alias'] ) {
					return true;
				}
			}
		}
		foreach ( array( 'widget_text' => 'text', 'widget_custom_html' => 'content' ) as $option => $key ) {
			foreach ( (array) get_option( $option, array() ) as $w ) {
				if ( is_array( $w ) && isset( $w[ $key ] ) && is_string( $w[ $key ] ) && origin_canvas_palette_markup_hits( $w[ $key ] ) ) {
					return true;
				}
			}
		}
		foreach ( (array) get_theme_mods() as $v ) {
			if ( is_string( $v ) && ( origin_canvas_palette_markup_hits( $v ) || origin_canvas_palette_css_hits( $v ) ) ) {
				return true;
			}
		}
		$changesets = get_posts(
			array(
				'post_type'        => 'customize_changeset',
				'post_status'      => array( 'auto-draft', 'draft', 'future', 'publish', 'trash' ),
				'numberposts'      => -1,
				'suppress_filters' => false,
			)
		);
		foreach ( $changesets as $cs ) {
			if ( origin_canvas_palette_json_hits( json_decode( (string) $cs->post_content ) ) ) {
				return true;
			}
		}
		$files = origin_canvas_palette_child_files();
		foreach ( $files['css'] as $f ) {
			if ( origin_canvas_palette_css_code_hits( (string) file_get_contents( $f ) ) ) { // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- a local theme file.
				return true;
			}
		}
		foreach ( $files['json'] as $f ) {
			$data = json_decode( (string) file_get_contents( $f ) ); // phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- a local theme file.
			// A palette on old slugs is a settings entry, not a CSS reference: read it as JSON.
			if ( origin_canvas_palette_settings_hits( $data ) || origin_canvas_palette_json_hits( $data ) ) {
				return true;
			}
		}
		return false;
	}
}

if ( ! function_exists( 'origin_canvas_palette_evaluate' ) ) {
	/**
	 * Count what Update colours would change, and whether any store holds any old code.
	 *
	 * @param bool $exact Count every post; when false, stop at the first and report 1.
	 * @return array{content: int, global_styles: int, css: int, found: bool}
	 */
	function origin_canvas_palette_evaluate( $exact ) {
		$content = 0;
		$found   = false;
		$counted = array();
		origin_canvas_palette_each_candidate(
			static function ( $post ) use ( &$content, &$found, &$counted, $exact ) {
				$hits = origin_canvas_palette_content_hits( $post->post_content );
				if ( $hits['reachable'] || $hits['alias'] ) {
					$found = true;
				}
				if ( $hits['reachable'] ) {
					++$content;
					$counted[ $post->ID ] = true;
					if ( ! $exact ) {
						return false;
					}
				}
				return true;
			}
		);
		// A snapshot post that still takes the collision map counts, though it may hold no old code.
		if ( $exact || 0 === $content ) {
			foreach ( array_keys( origin_canvas_palette_collision_record()['posts'] ) as $id ) {
				if ( isset( $counted[ $id ] ) ) {
					continue;
				}
				$post = get_post( (int) $id );
				if ( origin_canvas_palette_post_in_scope( $post ) && origin_canvas_palette_collision_extra( (int) $id, $post->post_content ) ) {
					++$content;
					if ( ! $exact ) {
						break;
					}
				}
			}
		}

		$global_styles = 0;
		foreach ( origin_canvas_palette_global_styles_posts() as $p ) {
			$h = origin_canvas_palette_global_styles_hits( $p->post_content );
			if ( $h['fixable'] ) {
				++$global_styles;
			}
			if ( $h['fixable'] || $h['alias'] ) {
				$found = true;
			}
		}

		$css = 0;
		foreach ( origin_canvas_palette_user_css_stores() as $store ) {
			if ( origin_canvas_palette_user_css_next( $store ) !== $store['content'] ) {
				++$css;
			}
		}

		if ( ! $found ) {
			$found = origin_canvas_palette_found_elsewhere();
		}
		if ( $found && ! origin_canvas_palette_state()['palette_detected'] ) {
			origin_canvas_palette_update_state( array( 'palette_detected' => true ) );
		}
		return array(
			'content'       => $content,
			'global_styles' => $global_styles,
			'css'           => $css,
			'found'         => $found,
		);
	}
}

if ( ! function_exists( 'origin_canvas_palette_scan_key' ) ) {
	/**
	 * The detection cache's key: the theme version and the active stylesheet.
	 *
	 * @return string
	 */
	function origin_canvas_palette_scan_key() {
		return ORIGIN_CANVAS_VERSION . '|' . get_stylesheet();
	}
}

if ( ! function_exists( 'origin_canvas_palette_scan_cache' ) ) {
	/**
	 * The current detection cache, or null.
	 *
	 * @return array|null
	 */
	function origin_canvas_palette_scan_cache() {
		$cache = get_transient( 'origin_canvas_palette_scan' );
		if ( ! is_array( $cache ) || ! isset( $cache['key'] ) || origin_canvas_palette_scan_key() !== $cache['key'] ) {
			return null;
		}
		return array_merge(
			array(
				'exact'         => false,
				'content'       => 0,
				'global_styles' => 0,
				'css'           => 0,
			),
			$cache
		);
	}
}

if ( ! function_exists( 'origin_canvas_palette_detect' ) ) {
	/**
	 * Detection: what Update colours would change, and whether the aliases load.
	 *
	 * @param bool $refresh Count exactly now, instead of reading the cache.
	 * @return array{content: int, global_styles: int, aliases: bool, offered: bool}
	 */
	function origin_canvas_palette_detect( $refresh = false ) {
		$cache = $refresh ? null : origin_canvas_palette_scan_cache();
		if ( null === $cache ) {
			$r     = origin_canvas_palette_evaluate( (bool) $refresh );
			$cache = array(
				'key'           => origin_canvas_palette_scan_key(),
				'exact'         => (bool) $refresh,
				'content'       => $r['content'],
				'global_styles' => $r['global_styles'],
				'css'           => $r['css'],
			);
			set_transient( 'origin_canvas_palette_scan', $cache );
		}
		return array(
			'content'       => (int) $cache['content'],
			'global_styles' => (int) $cache['global_styles'],
			'aliases'       => (bool) origin_canvas_palette_state()['palette_detected'],
			'offered'       => $cache['content'] > 0 || $cache['global_styles'] > 0 || $cache['css'] > 0,
		);
	}
}

if ( ! function_exists( 'origin_canvas_palette_detect_on_init' ) ) {
	/**
	 * Detect on the first request of any kind, when no current cache exists.
	 *
	 * @return void
	 */
	function origin_canvas_palette_detect_on_init() {
		if ( wp_installing() || is_network_admin() ) {
			return;
		}
		if ( null === origin_canvas_palette_scan_cache() ) {
			origin_canvas_palette_detect();
		}
	}
}
add_action( 'init', 'origin_canvas_palette_detect_on_init', 100 );

if ( ! function_exists( 'origin_canvas_palette_adjust_scan' ) ) {
	/**
	 * Adjust the cached content count by $delta. A cache that only knew "at least one" never
	 * drops from 1 to 0; detect( true ) on the page and at each pass corrects it.
	 *
	 * Two saves at once can each read the old count, so a count can be off by one until the next
	 * detect( true ); the notice is its only reader.
	 *
	 * @param int $delta Change.
	 * @return void
	 */
	function origin_canvas_palette_adjust_scan( $delta ) {
		$cache = origin_canvas_palette_scan_cache();
		if ( null === $cache || 0 === $delta ) {
			return;
		}
		$next = max( 0, (int) $cache['content'] + $delta );
		if ( ! $cache['exact'] && 0 === $next && (int) $cache['content'] > 0 ) {
			$next = (int) $cache['content'];
		}
		$cache['content'] = $next;
		set_transient( 'origin_canvas_palette_scan', $cache );
	}
}

if ( ! function_exists( 'origin_canvas_palette_recount_styles' ) ) {
	/**
	 * Recount the Global Styles and user CSS stores in the cache after a save to one of them.
	 *
	 * One Global Styles save fires this twice, for the revision and for the record, over the same
	 * saved stores; the second call finds the stores as the first counted them and returns, so a
	 * request counts each state of the stores once.
	 *
	 * @return void
	 */
	function origin_canvas_palette_recount_styles() {
		static $counted = null;
		$posts          = origin_canvas_palette_global_styles_posts();
		$stores         = origin_canvas_palette_user_css_stores();
		$key            = array();
		foreach ( $posts as $p ) {
			$key[] = array( (int) $p->ID, (string) $p->post_content );
		}
		$key = md5( serialize( array( $key, $stores ) ) ); // phpcs:ignore WordPress.PHP.DiscouragedPHPFunctions.serialize_serialize -- a fingerprint, never stored.
		if ( $key === $counted ) {
			return;
		}
		$counted = $key;

		$found         = false;
		$global_styles = 0;
		foreach ( $posts as $p ) {
			$h = origin_canvas_palette_global_styles_hits( $p->post_content );
			if ( $h['fixable'] ) {
				++$global_styles;
			}
			if ( $h['fixable'] || $h['alias'] ) {
				$found = true;
			}
		}
		$css = 0;
		foreach ( $stores as $store ) {
			if ( origin_canvas_palette_user_css_next( $store ) !== $store['content'] ) {
				++$css;
			}
			if ( 'custom_css' === $store['kind'] && origin_canvas_palette_css_code_hits( $store['content'] ) ) {
				$found = true;
			}
		}
		if ( $found && ! origin_canvas_palette_state()['palette_detected'] ) {
			origin_canvas_palette_update_state( array( 'palette_detected' => true ) );
		}
		$cache = origin_canvas_palette_scan_cache();
		if ( null !== $cache ) {
			$cache['global_styles'] = $global_styles;
			$cache['css']           = $css;
			set_transient( 'origin_canvas_palette_scan', $cache );
		}
	}
}

if ( ! function_exists( 'origin_canvas_palette_on_save' ) ) {
	/**
	 * After a post is saved: adjust the cached counts from the saved post alone (core passes the
	 * content before and after), never by a candidates query.
	 *
	 * @param int          $post_id     Post ID.
	 * @param WP_Post      $post        The post now.
	 * @param bool         $update      Whether an update.
	 * @param WP_Post|null $post_before The post before.
	 * @return void
	 */
	function origin_canvas_palette_on_save( $post_id, $post, $update, $post_before ) {
		if ( ! $post instanceof WP_Post ) {
			return;
		}
		$type = $post->post_type;
		if ( 'revision' === $type ) {
			$parent = get_post( $post->post_parent );
			if ( $parent instanceof WP_Post && in_array( $parent->post_type, array( 'wp_global_styles', 'custom_css' ), true ) ) {
				origin_canvas_palette_recount_styles();
			}
			return;
		}
		if ( 'wp_global_styles' === $type || 'custom_css' === $type ) {
			origin_canvas_palette_recount_styles();
			return;
		}
		if ( ! in_array( $type, origin_canvas_palette_rules()['types'], true ) ) {
			return;
		}
		$was = origin_canvas_palette_post_hits( $post_before instanceof WP_Post ? $post_before : null );
		$now = origin_canvas_palette_post_hits( $post );
		if ( $now['any'] && ! origin_canvas_palette_state()['palette_detected'] ) {
			origin_canvas_palette_update_state( array( 'palette_detected' => true ) );
		}
		origin_canvas_palette_adjust_scan( (int) $now['reachable'] - (int) $was['reachable'] );
	}
}
add_action( 'wp_after_insert_post', 'origin_canvas_palette_on_save', 10, 4 );

if ( ! function_exists( 'origin_canvas_palette_on_delete' ) ) {
	/**
	 * Before a post is deleted: one fewer post to update when it held reachable old codes.
	 *
	 * @param int     $post_id Post ID.
	 * @param WP_Post $post    Post.
	 * @return void
	 */
	function origin_canvas_palette_on_delete( $post_id, $post = null ) {
		if ( ! $post instanceof WP_Post ) {
			$post = get_post( $post_id );
		}
		if ( ! $post instanceof WP_Post || ! in_array( $post->post_type, origin_canvas_palette_rules()['types'], true ) ) {
			return;
		}
		if ( origin_canvas_palette_post_hits( $post )['reachable'] ) {
			origin_canvas_palette_adjust_scan( -1 );
		}
	}
}
add_action( 'before_delete_post', 'origin_canvas_palette_on_delete', 10, 2 );

if ( ! function_exists( 'origin_canvas_palette_on_option' ) ) {
	/**
	 * Widgets and theme mods: an old code in the new value turns the aliases on. No count changes.
	 *
	 * @param mixed $a The old value (update) or the option name (add).
	 * @param mixed $b The new value (update) or the value (add).
	 * @return void
	 */
	function origin_canvas_palette_on_option( $a, $b ) {
		if ( origin_canvas_palette_state()['palette_detected'] ) {
			return;
		}
		$found = false;
		$walk  = static function ( $v ) use ( &$walk, &$found ) {
			if ( $found ) {
				return;
			}
			if ( is_string( $v ) ) {
				$h     = origin_canvas_palette_content_hits( $v );
				$found = $h['reachable'] || $h['alias'] || origin_canvas_palette_markup_hits( $v ) || origin_canvas_palette_css_hits( $v );
				return;
			}
			if ( is_array( $v ) ) {
				foreach ( $v as $x ) {
					$walk( $x );
				}
			}
		};
		$walk( $b );
		if ( $found ) {
			origin_canvas_palette_update_state( array( 'palette_detected' => true ) );
		}
	}
}
foreach ( array( 'widget_block', 'widget_text', 'widget_custom_html' ) as $origin_canvas_palette_option ) {
	add_action( 'update_option_' . $origin_canvas_palette_option, 'origin_canvas_palette_on_option', 10, 2 );
	add_action( 'add_option_' . $origin_canvas_palette_option, 'origin_canvas_palette_on_option', 10, 2 );
}
unset( $origin_canvas_palette_option );
add_action( 'update_option_theme_mods_' . get_stylesheet(), 'origin_canvas_palette_on_option', 10, 2 );
add_action( 'add_option_theme_mods_' . get_stylesheet(), 'origin_canvas_palette_on_option', 10, 2 );

if ( ! function_exists( 'origin_canvas_palette_on_switch_theme' ) ) {
	/**
	 * A theme switch drops the detection cache.
	 *
	 * @return void
	 */
	function origin_canvas_palette_on_switch_theme() {
		delete_transient( 'origin_canvas_palette_scan' );
	}
}
add_action( 'after_switch_theme', 'origin_canvas_palette_on_switch_theme' );
