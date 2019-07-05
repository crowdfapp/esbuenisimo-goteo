<?php
/**
 * Template loop for 1st standard then grid.
 *
 * @package Short News
 * @since Short News 1.0
 */

?>
	
<?php

if ( $wp_query->current_post == 0 ) {
	get_template_part( 'template-parts/post/content' );
} else {
	get_template_part( 'template-parts/post/content', 'grid' );
}

?>
