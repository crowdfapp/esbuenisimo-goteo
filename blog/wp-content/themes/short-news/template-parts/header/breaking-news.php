<?php
/**
 * Template part for displaying Breaking News.
 *
 * @package Short News
 * @since Short News 1.0
 */

?>

<?php
// Breaking News Settings
$query_args = array (
    'post_type'				=> 'post',
    'posts_per_page'		=> 10,
    'orderby'				=> 'date',
    'order'					=> 'DESC',
    'ignore_sticky_posts'	=> 1,
);
$news_query = new WP_Query ($query_args);
?>

<div class="breaking-news">
	<strong><?php _e( 'Latest:', 'short-news' ); ?></strong>
	<ul class="newsticker">
		<?php 
			if ( $news_query->have_posts() ) :
			/* Start the Loop */
			while ( $news_query->have_posts() ) : $news_query->the_post();
			?>		
	                   
				<li id="post-<?php the_ID(); ?>">
					<span class="news-dot"></span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</li>
													
			<?php endwhile;
				
		endif; wp_reset_postdata();
		?>
	</ul>
</div>
