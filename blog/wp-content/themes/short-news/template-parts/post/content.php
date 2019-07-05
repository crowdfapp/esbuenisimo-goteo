<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Short News
 * @since Short News 1.0
 */

?>

<?php
// Sidebar Options
$site_sidebar_position = get_theme_mod('site_sidebar_position', 'content-sidebar');
$archive_sidebar_position = get_theme_mod('archive_sidebar_position', 'content-sidebar');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('standard-post'); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="entry-thumbnail">
			<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">				
				<?php
				if ( ! is_active_sidebar( 'sidebar-1' || $site_sidebar_position == 'content-fullwidth' || $archive_sidebar_position == 'content-fullwidth' ) ) {
					the_post_thumbnail('short-news-fullwidth');
				} else {
					the_post_thumbnail('short-news-large');	
				} 
				?>
			</a>
		</figure>
	<?php endif; ?>
	
	<div class="entry-header">
		<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<span class="cat-links"><?php the_category( ', ' ); ?></span>
			</div>
		<?php endif; ?>
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	</div><!-- .entry-header -->
	
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->
	
	<?php
	if ( 'post' === get_post_type() ) :
	?>
		<div class="entry-footer">
			<div class="row">
				<div class="col-sm-6 col-6">
					<?php short_news_author(); ?>
				</div>
				<div class="col-sm-6 col-6">
					<?php short_news_time_link(); ?>
				</div>
			</div>
		</div>
	<?php
	endif;
	?>
	
</article><!-- #post-## -->
