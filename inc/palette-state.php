<?php
/**
 * The palette rename (#116): the pre-rename mark, option origin_canvas_palette_legacy, per blog.
 *
 * 1: the site existed before the rename and loads the aliases. 0: it did not. Core runs
 * after_switch_theme on the next load after an activation, at init 99, before any enqueue hook, so
 * an activation writes 0 first. A site updated in place never activates: the loader finds the
 * option unset, writes 1 and loads. Network enabling only permits a theme and writes nothing.
 *
 * Known limits:
 * - A site that ran 1.3.1, switched away and returns after the rename is marked 0.
 * - A site activated on 1.3.1 whose first load comes only after the update is marked 0, a false 0
 *   if content with old names was imported during the activation request itself.
 * - A site whose theme is set without an activation, or that previews the theme before activating
 *   it, is marked 1 and loads a file it never uses.
 *
 * The content update plugin is the remedy for a site marked 0 that holds old names.
 *
 * @package Origin_Canvas
 */

if ( ! function_exists( 'origin_canvas_palette_mark_new' ) ) {
	/**
	 * An activation: with the option unset, the site is marked as new. A set mark stays.
	 *
	 * @return void
	 */
	function origin_canvas_palette_mark_new() {
		add_option( 'origin_canvas_palette_legacy', 0, '', true );
	}
}
add_action( 'after_switch_theme', 'origin_canvas_palette_mark_new' );

if ( ! function_exists( 'origin_canvas_palette_mark_legacy' ) ) {
	/**
	 * The loader: with the option unset, no activation ran, so the site predates the rename.
	 *
	 * @return void
	 */
	function origin_canvas_palette_mark_legacy() {
		if ( false === get_option( 'origin_canvas_palette_legacy' ) ) {
			add_option( 'origin_canvas_palette_legacy', 1, '', true );
		}
	}
}
