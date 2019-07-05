<?php
/**
 * Displays Social Menu
 *
 * @package Short News
 * @since Short News 1.0
 */

?>
	
	<nav class="social-links" role="navigation" aria-label="<?php esc_attr_e( 'Social Menu', 'short-news' ); ?>">
		<?php
			wp_nav_menu( array(
				'theme_location'  => 'social_menu',
				'container'       => false,
				'menu_id'         => 'social-menu',
				'menu_class'      => 'social-menu',
				'depth'           => 1,
				'link_before'     => '<span class="screen-reader-text">',
				'link_after'      => '</span>',
				'fallback_cb'     => '',
			) );
		// Social Links ?>
	</nav>
