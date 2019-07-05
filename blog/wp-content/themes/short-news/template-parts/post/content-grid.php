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

<div class="grid-post">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<?php if ( has_post_thumbnail() ) { ?>
			<figure class="entry-thumbnail">
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">				
					<?php the_post_thumbnail('short-news-medium'); ?>
				</a>
			</figure>
		<?php } ?>
		
		<div class="entry-header">
			<?php if ( 'post' === get_post_type() ) { ?>
				<div class="entry-meta entry-meta-top">
					<span class="cat-links"><?php the_category( ', ' ); ?></span>
				</div>
			<?php } ?>
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php if ( 'post' === get_post_type() ) { ?>
				<div class="entry-meta">
					<?php short_news_time_link(); ?>
				</div>
			<?php } ?>
		</div><!-- .entry-header -->
		
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->

	</article><!-- #post-## -->
</div>