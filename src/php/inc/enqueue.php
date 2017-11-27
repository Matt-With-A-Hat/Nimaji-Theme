<?php
/**
 * Understrap enqueue scripts and fonts
 *
 * @package understrap
 */

if ( ! function_exists( 'nimaji_scripts' ) ) {
	/**
	 * Load theme's JavaScript sources.
	 */
	function nimaji_scripts() {
		/**
		 * =CSS
		 */
		// Get the theme data.
		$the_theme = wp_get_theme();
		if ( ! NIMAJI_DEBUG ) {
			//use CDN
			wp_register_style( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css', array(), $the_theme->get( 'Version' ), true );
//			wp_register_style( 'fontawesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), $the_theme->get( 'Version' ), true );
			wp_enqueue_style( 'bootstrap' );
//			wp_enqueue_style( 'fontawesome' );
		} else {
			//use local files
			wp_register_style( 'nimaji-local', get_template_directory_uri() . '/src-local/css/nimaji-local.min.css', array(), $the_theme->get( 'Version' ) );
			wp_enqueue_style( 'nimaji-local' );
		}
//		wp_register_style( 'utilities', get_template_directory_uri() . '/css/utilities.min.css', array(), $the_theme->get( 'Version' ) );
		wp_register_style( 'nimaji', get_template_directory_uri() . '/css/nimaji.min.css', array(), $the_theme->get( 'Version' ) );
//		wp_enqueue_style( 'utilities' );
		wp_enqueue_style( 'nimaji' );

		/**
		 * =JavaScript
		 */
		if ( ! NIMAJI_DEBUG ) {
			//use CDN
			wp_register_script( 'jquery', 'https://code.jquery.com/jquery-3.2.1.min.js', array(), $the_theme->get( 'Version' ), false );
			wp_register_script( 'bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array( 'jquery' ), $the_theme->get( 'Version' ), true );
			wp_register_script( 'fontawesome', 'https://use.fontawesome.com/ae93a4dcda.js', array( 'jquery' ), $the_theme->get( 'Version' ), true );
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'bootstrap' );
			wp_enqueue_script( 'fontawesome' );
		} else {
			//use local files
			wp_register_script( 'nimaji-local', get_template_directory_uri() . '/src-local/js/nimaji-local.min.js', array(), $the_theme->get( 'Version' ), true );
			wp_enqueue_script( 'nimaji-local' );
		}
		wp_register_script( 'nimaji', get_template_directory_uri() . '/js/nimaji.min.js', array(), $the_theme->get( 'Version' ), true );
		wp_register_script( 'hyphenator', get_template_directory_uri() . '/js/hyphenator.min.js', array(), $the_theme->get( 'Version' ), true );
		wp_enqueue_script( 'nimaji' );
		wp_enqueue_script( 'hyphenator' );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
} // endif function_exists( 'nimaji_scripts' ).

add_action( 'wp_enqueue_scripts', 'nimaji_scripts' );

if ( ! function_exists( 'nimaji_load_fonts' ) ) {
	function nimaji_load_fonts() {
		$the_theme = wp_get_theme();
		if ( ! NIMAJI_DEBUG ) {
			wp_register_style( 'googleFonts', 'https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Droid+Sans:400,700|Roboto:400,400i,700,700i' );
			wp_enqueue_style( 'googleFonts' );
		} else {
//		wp_register_style( 'googleFonts', get_template_directory_uri() . '/src-local/scss/fonts.min.css', array(), $the_theme->get( 'Version' ) );
		}
	}
}

add_action( 'wp_enqueue_scripts', 'nimaji_load_fonts' );


if ( ! function_exists( 'nimaji_dequeue_scripts' ) ) {

	/**
	 * Dequeue any unnecessary scripts for page performance
	 *
	 * @param $scripts
	 */
	function nimaji_dequeue_scripts( &$scripts ) {
		if ( ! is_admin() ) {
			$scripts->remove( 'jquery' );
			remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
			remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );
			remove_action( 'admin_print_styles', 'print_emoji_styles' );
		}
	}

	add_filter( 'wp_default_scripts', 'nimaji_dequeue_scripts' );
}