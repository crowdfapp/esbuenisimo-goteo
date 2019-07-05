<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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
	
<section id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		
		<header class="page-header">
			<?php if ( have_posts() ) : ?>
				<h1 class="page-title">
					<?php printf( __( 'Search Results for: %s', 'short-news' ), '<strong>' . get_search_query() . '</strong>' ); ?>
				</h1>
			<?php else : ?>
				<h1 class="page-title">
					<?php _e( 'Nothing Found', 'short-news' ); ?>
				</h1>
			<?php endif; ?>
		</header><!-- .page-header -->
		
		<?php
		if ( have_posts() ) : ?>
	
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
				'prev_text' => esc_html( '&lsaquo;' ),
				'next_text' => esc_html( '&rsaquo;' ),
			) ); 
			?>
				
		<?php
		else :
		?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'short-news' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
	
	</main><!-- #main -->
</section><!-- #primary -->

<?php 
// Sidebar
if ( 'content-sidebar' == $archive_sidebar_position || 'sidebar-content' == $archive_sidebar_position ) {
	get_sidebar();	
}
?>

<?php
get_footer();
?>
