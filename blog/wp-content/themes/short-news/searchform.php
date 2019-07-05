<?php
/**
 * Displays the searchform of the theme.
 *
 * @package Short News
 * @since Short News 1.0
 */
?>

<form role="search" method="get" class="search-form clear" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<span class="screen-reader-text"><?php _ex( 'Search for:', 'label', 'short-news' ); ?></span>
		<input type="search" id="s" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'short-news' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	</label>
	<button type="submit" class="search-submit">
		<i class="material-icons md-20 md-middle">search</i>
		<span class="screen-reader-text"><?php _ex( 'Search', 'submit button', 'short-news' ); ?></span>
	</button>
</form>
