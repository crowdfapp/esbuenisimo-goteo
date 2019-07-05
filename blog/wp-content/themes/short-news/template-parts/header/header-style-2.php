<?php
/**
 * Template part for displaying Header, style 2.
 *
 * @package Short News
 * @since Short News 1.0
 */

?>
	
	<?php short_news_header_top(); ?>
	
	<div class="header-middle header-title-left">
		<div class="container flex-container">
			<div class="site-branding">
				<?php short_news_custom_logo(); ?>
			</div>
			<?php if ( is_active_sidebar( 'header-right' ) ) { ?>
			<div class="widget-area">
				<?php dynamic_sidebar( 'header-right' ); ?>
			</div>
			<?php } ?>
		</div>
	</div>
	
	<?php if ( get_header_image() ) { ?>
		<div class="custom-header header-image"></div>
	<?php } ?>
	
	<div class="header-bottom menu-left">
		<div class="container">
			<div class="row">
				<div class="col-12">
				<?php 
					short_news_home_icon();
					get_template_part( 'template-parts/navigation/navigation', 'main' );
					short_news_search_popup();
					short_news_social_menu();
				?>
				</div>
			</div>
		</div>
	</div>
