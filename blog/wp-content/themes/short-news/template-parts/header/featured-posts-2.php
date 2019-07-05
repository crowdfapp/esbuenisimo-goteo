<?php
/**
 * The template for displaying Featured Posts Area 2
 *
 * @package Short News
 * @since Short News 1.0
 */

?>

<?php
// Featured Posts Settings
$fp_title = esc_html( get_theme_mod( 'featured_posts_title_2' ) );
$fp_text = wp_kses_post( get_theme_mod( 'featured_posts_text_2' ) );
$fp_cat_1 = esc_attr( get_theme_mod('featured_posts_cat_2', 'all' ) );

$query_args = array (
    'post_type'			=> 'post',
    'posts_per_page'	=> 4,
    'orderby'			=> 'date',
    'order'				=> 'DESC',
);

if( is_numeric( $fp_cat_1 ) ) {
	$query_args['cat'] = $fp_cat_1;
}

$fp_query_2 = new WP_Query ($query_args);	
?>

<section class="top-news">
	<div class="container">
		
		<div class="top-news-intro">
		<?php
		if( !empty( $fp_title ) ) {
			echo '<h2>' . $fp_title . '</h2>';
		}
		if( !empty( $fp_text ) ) {
			echo '<p>' . $fp_text . '</p>';
		}
		?>
		</div>
		
		<div class="row">
							
		<?php
		if ( $fp_query_2->have_posts() ) :
	    
			while ( $fp_query_2->have_posts() ) : $fp_query_2->the_post();
			?>
						
				<div class="col-xs-6 col-sm-6 col-3">
					<figure class="entry-thumbnail">
						<?php if ( has_post_thumbnail() ) { ?>
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">				
								<?php the_post_thumbnail('short-news-medium'); ?>
							</a>
						<?php } ?>
					</figure>
					<div class="entry-header">
						<h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php if ( 'post' === get_post_type() ) { ?>
						<div class="entry-meta">
							<?php short_news_time_link(); ?>
							<span class="cat-links"><?php the_category( ', ' ); ?></span>
						</div>
						<?php } ?>
					</div>
				</div>
							
			<?php 
			endwhile;
			wp_reset_postdata();
			
		endif;
		?>
		
		</div>
	</div>
</section>
