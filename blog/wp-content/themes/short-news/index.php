<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Short News
 * @since Short News 1.0
 */

get_header(); ?>
	
<?php
// Home Options
$site_sidebar_position = get_theme_mod('site_sidebar_position', 'content-sidebar');
$home_post = short_news_home_post();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		
		<?php
		if ( have_posts() ) : ?>
		
			<section class="posts-loop <?php echo esc_attr( get_theme_mod( 'home_layout', 'standard-grid') . '-style' ); ?>">
				<?php /* Start the Loop */
				while ( have_posts() ) : the_post();
				
					get_template_part( 'template-parts/post/content', $home_post );
					
				endwhile;
				?>
			</section>
			
			<?php
			the_posts_pagination( array(
				'mid_size' => 2,
				'prev_text' => '&lsaquo;',
				'next_text' => '&rsaquo;',
			) ); 
			?>
		
		<?php
		else :

			get_template_part( 'template-parts/post/content', 'none' );

		endif;
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

