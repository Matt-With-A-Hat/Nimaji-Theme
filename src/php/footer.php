<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

$the_theme = wp_get_theme();
$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_sidebar( 'footerfull' ); ?>

<footer class="wrapper" id="wrapper-footer">

	<div class="<?php echo esc_html( $container ); ?>">

		<div class="row">

			<div class="col-md-12">

				<div class="site-footer" id="colophon">


					<div class="wrap">

						<div class="text-center">
							<span>Maehroboter-Guru.de - Copyright &copy; maehroboter-guru.de</span>
							<br><br>

							<?php
							if ( has_nav_menu( 'footer' ) ) {
								wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false, 'menu_class' => 'footer-nav-menu', 'menu_id' => 'footernav' ) );
							}
							?>

							<br><br>
							<p class="footer--hint">* Einige Links können Amazon Affiliate Links sein. Dies können auch Bilder sein, welche auf Amazon verlinken. Wenn Sie diese Links benutzen, bekommen wir unter Umständen eine Provision. Für Sie entstehen dadurch keinerlei Zusatzkosten. Preise inkl. MwSt. ggf. zzgl. Versand. Zwischenzeitliche Änderung der Preise, Lieferzeit und -kosten möglich. Alle Angaben ohne Gewähr</p>
						</div>

					</div><!-- .wrap -->


				</div><!-- #colophon -->

			</div><!--col end -->

		</div><!-- row end -->

	</div><!-- container end -->

</footer><!-- wrapper end -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>

</html>
