<?php
/**
 * Understrap functions and definitions
 *
 * @package understrap
 */

/**
 * Theme functions
 */
require get_template_directory() . '/inc/theme-functions.php';

/**
 * Debug functions
 */
if ( is_local() OR $domain_name == 'wp-apd.refugeek.net' ) {
	define( 'NIMAJI_DEBUG', true );
} else {
	define( 'NIMAJI_DEBUG', false );
}
if ( NIMAJI_DEBUG ) {
	if ( ! class_exists( 'Krumo' ) ) {
		require_once dirname( __FILE__ ) . '/vendor/mmucklo/krumo/class.krumo.php';
	}
}

/**
 * Theme setup and custom theme supports.
 */
require get_template_directory() . '/inc/setup.php';

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Register widgets
 */
require get_template_directory() . '/widgets/LatestPostsWidget.php';

/**
 * Load functions to secure your WP install.
 */
require get_template_directory() . '/inc/security.php';

/**
 * Enqueue scripts and styles.
 */
require get_template_directory() . '/inc/enqueue.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/pagination.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Customizer additions.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/custom-comments.php';

/**
 * Load Jetpack compatibility file.
 */
//require get_template_directory() . '/inc/jetpack.php';

/**
 * Load custom WordPress nav walker.
 */
//require get_template_directory() . '/inc/bootstrap-wp-navwalker.php';

/**
 * Load WooCommerce functions.
 */
//require get_template_directory() . '/inc/woocommerce.php';

/**
 * Load Editor functions.
 */
require get_template_directory() . '/inc/editor.php';
