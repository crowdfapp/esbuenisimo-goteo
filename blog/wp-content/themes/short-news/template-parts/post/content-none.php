<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Short News
 * @since Short News 1.0
 */

?>
	
<section class="no-results not-found">
	<header class="entry-header">
		<h1 class="page-title"><?php _e( 'Nothing Found', 'short-news' ); ?></h1>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'short-news' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
			
		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'short-news' ); ?></p>
			<?php
				get_search_form();
				
		endif; ?>
	</div><!-- .entry-content -->
</section><!-- .no-results -->