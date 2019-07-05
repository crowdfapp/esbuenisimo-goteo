<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Short News
 * @since Short News 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
	<header class="entry-header">
		<div class="entry-meta entry-meta-top">
			<?php 
				short_news_category_link();
				short_news_comments_count();
			?>
		</div>
		<?php the_title( '<h1 class="entry-title"><span>', '</span></h1>' ); ?>
		<div class="entry-meta">
			<?php 
				short_news_posted_on();
				short_news_reading_time();
			?>
		</div>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() && get_theme_mod('post_has_featured_image', 1) ) : ?>
		<figure class="entry-thumbnail">
			<?php the_post_thumbnail('short-news-fullwidth'); ?>
		</figure>
	<?php endif; // Featured Image ?>
	
	<div class="entry-content">
		<?php
			the_content();
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'short-news' ),
				'after'  => '</div>',
				'link_before' => '<span class="page-link">',
				'link_after' => '</span>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php short_news_entry_footer(); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->

<?php
// Author bio.
if ( get_theme_mod('show_author_bio') && is_single() && get_the_author_meta( 'description' ) ) {
	get_template_part( 'template-parts/post/author', 'biography' );
}
?>
