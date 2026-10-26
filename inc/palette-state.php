<?php
/**
 * The palette rename (#116): the three options, one writer each.
 *
 * - origin_canvas: settings and flags only (palette_rewrite, palette_rewrite_failed,
 *   palette_detected, palette_notice_dismissed), always written through update_state().
 * - origin_canvas_palette_journal: the Update colours batch journal, written by the batch only.
 * - origin_canvas_palette_collisions: the collision record, written once at the first admin load
 *   with add_option() and read-only after.
 *
 * The detection cache is the transient origin_canvas_palette_scan, never an option.
 *
 * @package Origin_Canvas
 */

if ( ! function_exists( 'origin_canvas_palette_state' ) ) {
	/**
	 * Option origin_canvas, with a default for every key.
	 *
	 * @return array
	 */
	function origin_canvas_palette_state() {
		$state = get_option( 'origin_canvas', array() );
		if ( ! is_array( $state ) ) {
			$state = array();
		}
		return array_merge(
			array(
				'palette_rewrite'          => 0,
				'palette_rewrite_failed'   => 0,
				'palette_detected'         => false,
				'palette_notice_dismissed' => false,
			),
			$state
		);
	}
}

if ( ! function_exists( 'origin_canvas_palette_update_state' ) ) {
	/**
	 * Write only the given keys of option origin_canvas.
	 *
	 * The option is re-read from the database right before the write, so a request that changes
	 * one key no longer writes back a stale copy of the keys another request changed.
	 *
	 * @param array $changes Key => value.
	 * @return void
	 */
	function origin_canvas_palette_update_state( $changes ) {
		wp_cache_delete( 'alloptions', 'options' );
		wp_cache_delete( 'notoptions', 'options' );
		wp_cache_delete( 'origin_canvas', 'options' );
		$fresh = get_option( 'origin_canvas', array() );
		if ( ! is_array( $fresh ) ) {
			$fresh = array();
		}
		foreach ( (array) $changes as $key => $value ) {
			$fresh[ $key ] = $value;
		}
		update_option( 'origin_canvas', $fresh, true );
	}
}

if ( ! function_exists( 'origin_canvas_palette_journal' ) ) {
	/**
	 * Option origin_canvas_palette_journal, with a default for every key. With no journal, the
	 * last pass counts as done, so the next batch starts one.
	 *
	 * @return array
	 */
	function origin_canvas_palette_journal() {
		$journal = get_option( 'origin_canvas_palette_journal', array() );
		if ( ! is_array( $journal ) ) {
			$journal = array();
		}
		return array_merge(
			array(
				'cursor'         => 0,
				'skipped'        => array(),
				'locked'         => array(),
				'changed'        => array(),
				'failed'         => array(),
				'done'           => true,
				'start'          => 0,
				'content'        => 0,
				'written'        => 0,
				'collision_done' => array(),
				'css_moved'      => array(),
			),
			$journal
		);
	}
}

if ( ! function_exists( 'origin_canvas_palette_save_journal' ) ) {
	/**
	 * Write the batch journal. Only the Update colours batch calls this.
	 *
	 * @param array $journal Journal.
	 * @return void
	 */
	function origin_canvas_palette_save_journal( $journal ) {
		update_option( 'origin_canvas_palette_journal', $journal, false );
	}
}

if ( ! function_exists( 'origin_canvas_palette_collision_record' ) ) {
	/**
	 * Option origin_canvas_palette_collisions: the root collisions of the active Global Styles
	 * record and the snapshot taken with them at the first admin load. Read-only.
	 *
	 * @return array{map: array, posts: array, css: array}
	 */
	function origin_canvas_palette_collision_record() {
		$record = get_option( 'origin_canvas_palette_collisions', array() );
		if ( ! is_array( $record ) ) {
			$record = array();
		}
		$record = array_merge(
			array(
				'map'   => array(),
				'posts' => array(),
				'css'   => array(),
			),
			$record
		);
		$record['map'] = array_merge(
			array(
				'color'      => array(),
				'spacing'    => array(),
				'lineHeight' => array(),
			),
			is_array( $record['map'] ) ? $record['map'] : array()
		);
		return $record;
	}
}
