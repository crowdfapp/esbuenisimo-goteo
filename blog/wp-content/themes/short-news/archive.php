<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Short News
 * @since Short News 1.0
 */

get_header(); ?>
	
<?php
// Archive Options
$site_sidebar_position = get_theme_mod('site_sidebar_position', 'content-sidebar');
$archive_sidebar_position = get_theme_mod('archive_sidebar_position');
if ( empty( $archive_sidebar_position ) ) {
	$archive_sidebar_position = $site_sidebar_position;
}
$archive_post = short_news_archive_post();
?>
	
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
	
		<?php
		if ( have_posts() ) : ?>
		
			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header>
			
			<section class="posts-loop <?php echo esc_attr( get_theme_mod( 'archive_layout', 'grid') . '-style' ); ?>">
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
				
					get_template_part( 'template-parts/post/content', $archive_post );
					
				endwhile;
				?>
			</section>
			
			<?php
			the_posts_pagination( array(
				'mid_size' => 2,
				'prev_text' => '&lsaquo;',
				'next_text' => '&lsaquo;',
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
if ( 'content-sidebar' == $archive_sidebar_position || 'sidebar-content' == $archive_sidebar_position ) {
	get_sidebar();	
}
?>

<?php
get_footer(); 
?>
