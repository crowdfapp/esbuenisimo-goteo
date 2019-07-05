<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Short News
 * @since Short News 1.0
 */

get_header(); ?>

<?php
// Page Options
$site_sidebar_position = get_theme_mod('site_sidebar_position', 'content-sidebar');
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/page/content', 'page' );

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
if ( 'content-sidebar' == $site_sidebar_position || 'sidebar-content' == $site_sidebar_position ) {
	get_sidebar();	
}
?>

<?php
get_footer();
?>
