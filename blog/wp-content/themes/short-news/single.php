<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Short News
 * @since Short News 1.0
 */

get_header(); ?>

<?php
// Single Post Options
$site_sidebar_position = get_theme_mod('site_sidebar_position', 'content-sidebar');
$post_sidebar_position = get_theme_mod('post_sidebar_position');
if ( empty( $post_sidebar_position ) ) {
	$post_sidebar_position  = $site_sidebar_position;
}
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php 
		/* Start the Loop */
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/post/content', 'single' );
					
			the_post_navigation(
				array(
					'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'short-news' ) . '</span><br>' .
						'<span class="screen-reader-text">' . __( 'Next post:', 'short-news' ) . '</span> ' .
						'<span class="post-title">%title</span>',
					'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'short-news' ) . '</span><br>' .
						'<span class="screen-reader-text">' . __( 'Previous post:', 'short-news' ) . '</span> ' .
						'<span class="post-title">%title</span>',
				)
			);
	
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
			
		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php 
// Sidebar
if ( 'content-sidebar' == $post_sidebar_position || 'sidebar-content' == $post_sidebar_position ) {
	get_sidebar();
}
?>

<?php
get_footer();
?>
