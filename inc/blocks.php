<?php
/**
 * Origin Blocks integration and block customizations.
 *
 * @package Origin
 */

if ( ! function_exists( 'origin_customize_tabs_block' ) ) {
	/**
	 * Override Origin Blocks Tabs defaults to use the theme's primary accent color.
	 *
	 * @param array $config Block configuration array.
	 * @return array Modified block configuration.
	 */
	function origin_customize_tabs_block( $config ) {
		return $config;
	}
}
add_filter( 'origin_blocks_block_config-origin-blocks/tabs-minimal', 'origin_customize_tabs_block' );

if ( ! function_exists( 'origin_customize_tabs_default_block' ) ) {
	/**
	 * Override Origin Blocks Tabs (default) settings from the theme.
	 *
	 * @param array $config Block configuration array.
	 * @return array Modified block configuration.
	 */
	function origin_customize_tabs_default_block( $config ) {
		return $config;
	}
}
add_filter( 'origin_blocks_block_config-origin-blocks/tabs', 'origin_customize_tabs_default_block' );
