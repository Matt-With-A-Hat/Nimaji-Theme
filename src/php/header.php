<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package understrap
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-capable" content="yes">
	<meta name="apple-mobile-web-app-title" content="<?php bloginfo( 'name' ); ?> - <?php bloginfo( 'description' ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php include( 'inc/analyticstracking.php' ); ?>
<?php
//echo "<br><br><br><br><br><br>";
//krumo(get_header_image());
?>
<div class="site-container" id="page">

	<!-- ******************* The Navbar Area ******************* -->
	<div class="wrapper-fluid wrapper-navbar" id="wrapper-navbar">

		<a class="skip-link screen-reader-text sr-only" href="#content"><?php esc_html_e( 'Skip to content',
				'understrap' ); ?></a>

		<header>
			<div class="header--image">
				<div class="header--title-area">
					<div class="header--title-box">
						<div class="header--title">
							<?php bloginfo( 'name' ); ?><br>
						</div>
						<div class="header--subtitle">
							<?php bloginfo( 'description' ); ?>
						</div>
					</div>
				</div>
				<?php
				if ( has_header_image() ) { ?>
					<img src="<?= get_header_image(); ?>" alt="<?= get_the_title(); ?>Header Image">
					<?php
				}; ?>
			</div>
			<div class="container-fluid">

				<div class="row">
					<div id="small-devices-spacer"></div>
					<nav class="menu-navbar">
						<div class="container">
							<div class="col-md-1 col-sm-12">
								<div class="menu-logo">
									<!--								--><?php //the_custom_logo(); ?>
									<a href="<?= get_home_url(); ?>" class="navbar-brand custom-logo-link" rel="home" itemprop="url"><img width="77" height="40" src="<?= get_template_directory_uri(); ?>/img/maehroboter-logo.svg" class="img-responsive" alt="Mähroboter Guru" itemprop="logo"></a>
								</div>
								<button class="hamburger hamburger--spin" type="button">
									<span class="hamburger-box">
										<span class="hamburger-inner"></span>
									</span>
								</button>
							</div>
							<div class="col-md-11 col-sm-12">
								<div class="row">
									<?= nimaji_menu( 'primary' ); ?>
									<div class="nav-layer"></div>
								</div>
							</div>
						</div>
					</nav><!-- .site-navigation -->
				</div>
			</div><!-- .container -->
		</header>
	</div><!-- .wrapper-navbar end -->