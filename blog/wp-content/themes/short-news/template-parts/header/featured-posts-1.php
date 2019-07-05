<?php
/**
 * The template for displaying Featured Posts Area 1
 *
 * @package Short News
 * @since Short News 1.0
 */

?>

<?php
// Featured Posts Settings
$fp_layout_1 = esc_attr( get_theme_mod('featured_posts_layout_1', 'featured-style-1') );
$fp_cat_1 = esc_attr( get_theme_mod('featured_posts_cat_1', 'all') );

$query_args = array (
    'post_type'			=> 'post',
    'posts_per_page'	=> 3,
    'orderby'			=> 'date',
    'order'				=> 'DESC',
);

if( is_numeric( $fp_cat_1 ) ) {
	$query_args['cat'] = $fp_cat_1;
}

$fp_query_1 = new WP_Query ($query_args);	
?>

<section class="featured-posts <?php echo $fp_layout_1; ?>">
	<div class="container">
	
		<div class="featured-posts-row clear">
	
		<?php
		if ( $fp_query_1->have_posts() ) :
	    
			while ( $fp_query_1->have_posts() ) : $fp_query_1->the_post();
			?>
								
				<div class="featured-cover-post">
					<figure class="featured-post-thumbnail">
						<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
							<?php
							if ( has_post_thumbnail() ) {		
								the_post_thumbnail('short-news-large');
							} ?>
						</a>
					</figure>
					<div class="featured-post-content">
						<div class="featured-post-header">
							<span class="cat-links"><?php the_category( ' ' ); ?></span>
							<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						</div>
						<div class="featured-post-meta">
							<?php short_news_time_link(); ?>
						</div>
					</div>
				</div>
							
			<?php 
			endwhile;
			wp_reset_postdata();
			
		endif; ?>
		
		</div>
	</div>
</section>
