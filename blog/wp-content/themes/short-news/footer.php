<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-template-parts
 *
 * @package Short News
 * @since Short News 1.0
 */

?>
			</div><!-- .site-inner -->
		</div><!-- .container -->
	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		
		<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
			<div class="widget-area" role="complementary">
				<div class="container">
					<div class="row">
						<div class="col-4 col-md-4" id="footer-area-1">
							<?php if ( is_active_sidebar( 'footer-1' ) ) {
								dynamic_sidebar( 'footer-1' );
							} // end footer widget area 1 ?>
						</div>	
						<div class="col-4 col-md-4" id="footer-area-2">
							<?php if ( is_active_sidebar( 'footer-2' ) ) {
								dynamic_sidebar( 'footer-2' );
							} // end footer widget area 2 ?>
						</div>
						<div class="col-4 col-md-4" id="footer-area-3">
							<?php if ( is_active_sidebar( 'footer-3' ) ) {
								dynamic_sidebar( 'footer-3' );
							} // end footer widget area 3 ?>
						</div>
					</div>
				</div>
			</div><!-- .widget-area -->
		<?php endif; ?>
				
		<div class="footer-copy">
			<div class="container">
				<div class="row">
					<div class="col-12 col-sm-12">
						<div class="site-credits">
							<?php short_news_credits(); ?>
							<?php
							if ( function_exists( 'the_privacy_policy_link' ) ) {
								the_privacy_policy_link( '<span>', '</span>' );
							}
							?>
							<span>
								<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'short-news' ) ); ?>">
									<?php printf( __( 'Powered by %s', 'short-news' ), 'WordPress' ); ?>
								</a>
							</span>
							<span>
								<a href="<?php echo esc_url( __( 'https://www.designlabthemes.com/', 'short-news' ) ); ?>" rel="nofollow">
									<?php printf( __( 'Theme by %s', 'short-news' ), 'Design Lab' ); ?>
								</a>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div><!-- .footer-copy -->
		
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
