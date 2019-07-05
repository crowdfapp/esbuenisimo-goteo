<?php
/**
 * The template part for displaying an Author biography
 *
 * @package Short News
 * @since Short News 1.0
 */
 
?>

<div class="author-info">
	<div class="author-avatar clear">
		<?php echo get_avatar( get_the_author_meta( 'user_email' ), 60 ); ?>
		<h3 class="author-title"><?php echo get_the_author(); ?></h3>
		<p class="author-link">
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php printf( __( 'View all posts by %s', 'short-news' ), get_the_author() ); ?>
			</a>
		</p>
	</div><!-- .author-avatar -->
	<div class="author-description">
		<p class="author-bio">
			<?php the_author_meta( 'description' ); ?>
		</p><!-- .author-bio -->
	</div><!-- .author-description -->
</div><!-- .author-info -->
