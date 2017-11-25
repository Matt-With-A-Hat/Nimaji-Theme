<?php
/**
 * Check and setup theme's default settings
 *
 * @package understrap
 *
 */

/**
 * =Theme setting constants
 */
$domain_name = $_SERVER['HTTP_HOST'];
//if ( is_local() OR $domain_name == 'wp-apd.refugeek.net' ) {
if ( is_local() ) {
	define( 'NIMAJI_DEBUG', true );
} else {
	define( 'NIMAJI_DEBUG', false );
}

/**
 * =Setup theme default settings
 */
if ( ! function_exists( 'setup_theme_default_settings' ) ) {
	function setup_theme_default_settings() {

		// check if settings are set, if not set defaults.
		// Caution: DO NOT check existence using === always check with == .
		// Latest blog posts style.
		$understrap_posts_index_style = get_theme_mod( 'understrap_posts_index_style' );
		if ( '' == $understrap_posts_index_style ) {
			set_theme_mod( 'understrap_posts_index_style', 'default' );
		}

		// Sidebar position.
		$understrap_sidebar_position = get_theme_mod( 'understrap_sidebar_position' );
		if ( '' == $understrap_sidebar_position ) {
			set_theme_mod( 'understrap_sidebar_position', 'right' );
		}

		// Container width.
		$understrap_container_type = get_theme_mod( 'understrap_container_type' );
		if ( '' == $understrap_container_type ) {
			set_theme_mod( 'understrap_container_type', 'container' );
		}
	}
}

/**
 * =Allow files in media uploaded that are permitted by default
 *
 * @param $mimes
 *
 * @return mixed
 */
//function cc_mime_types( $mimes ) {
//	$mimes['svg'] = 'image/svg+xml';
//
//	return $mimes;
//}
//
//add_filter( 'upload_mimes', 'cc_mime_types' );

/**
 * remove CSS from header
 */
if ( ! function_exists( 'my_filter_head' ) ) {
	function my_filter_head() {
		remove_action( 'wp_head', '_admin_bar_bump_cb' );
	}

	add_action( 'get_header', 'my_filter_head' );
}


/**
 * =Remove unwanted post formatting
 */
//function filter_ptags( $content ) {
//	return preg_replace('/<p(.)*(anchor)(.)*<\/p>/', '<ul', $content);
//	return preg_replace('/<p(.)*(anchor)(.)*<\/p>/', '<ul', $content);
//	if ( preg_match( '/<img(.)*[\s\S](.)*<\/p>/', $content, $match ) ) {
//		krumo("true");
//		return true;
//		preg_replace( '/<p>[\s\S]*<\/p>/', '', $match );
//	}else{
//		return false;
//	}
//}

//add_filter( 'the_content', 'filter_ptags' );

function nimaji_output_footer() {
//$bar_style = get_option('clb_bar_pos') . ':0;background:' . get_option('clb_bar_color') . ';color:' . get_option('clb_bar_text_color') . ';';
//$btn_style = 'background:' . get_option('clb_btn_color') . ';color:' . get_option('clb_btn_text_color') . ';';

$barMessage = "This website uses cookies. By continuing to browse the site, you are agreeing to our <a href=\"http://www.maehroboter-guru.de/impressum#cookies\" target=\"_blank\">use of cookies</a>";
$buttonMessage = "Agree";

?><!-- Cookie Bar -->
<div id="cookie-law-bar"><?= $barMessage; ?><button id="cookie-law-btn" onclick="clb_accept();"><?= $buttonMessage; ?></button></div>
<!-- End Cookie Bar --><?php

}
add_action('wp_footer', 'nimaji_output_footer');