<?php
/**
 * Add inline CSS for styles handled by the Theme customizer
 *
 * @package Short News
 * @since Short News 1.0
 */


if ( ! function_exists( 'short_news_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 */
function short_news_header_style() {
	$header_text_color = get_header_textcolor();

	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
	 */
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a, .site-title a:hover {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;


/**
 * Get Contrast
 */
function short_news_get_brightness($hex) {
	// returns brightness value from 0 to 255
	// strip off any leading #
	$hex = str_replace('#', '', $hex);
	
	$c_r = hexdec(substr($hex, 0, 2));
	$c_g = hexdec(substr($hex, 2, 2));
	$c_b = hexdec(substr($hex, 4, 2));
	
	return (($c_r * 299) + ($c_g * 587) + ($c_b * 114)) / 1000;
}


/**
 * Hex 2 rgba
 *
 * Convert hexadecimal color to rgba
 */

if ( !function_exists( 'short_news_hex2rgba' ) ):
	function short_news_hex2rgba( $color, $opacity = false ) {
		$default = 'rgb(0,0,0)';

		//Return default if no color provided
		if ( empty( $color ) )
			return $default;

		//Sanitize $color if "#" is provided
		if ( $color[0] == '#' ) {
			$color = substr( $color, 1 );
		}

		//Check if color has 6 or 3 characters and get values
		if ( strlen( $color ) == 6 ) {
			$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
			$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
			return $default;
		}

		//Convert hexadec to rgb
		$rgb =  array_map( 'hexdec', $hex );

		//Check if opacity is set(rgba or rgb)
		if ( $opacity ) {
			if ( abs( $opacity ) > 1 ) { $opacity = 1.0; }
			$output = 'rgba('.implode( ",", $rgb ).','.$opacity.')';
		} else {
			$output = 'rgb('.implode( ",", $rgb ).')';
		}

		//Return rgb(a) color string
		return $output;
	}
endif;


/**
 * Add Custom Styles handled by the Theme customizer
 */
function short_news_custom_styles() {
	$logo_size = esc_attr( get_theme_mod('logo_size', 'resize') );
	$logo_width = esc_attr( get_theme_mod('logo_width') );
	
	$header_image_padding = esc_attr(get_theme_mod('header_image_padding') );
	$header_image_dark_overlay = esc_attr( get_theme_mod('header_image_dark_overlay') );
	$header_image_v_align = esc_attr( get_theme_mod('header_image_v_align') );
	
	$accent_color = esc_attr( get_theme_mod('accent_color') );
	$site_tagline_color = esc_attr( get_theme_mod('site_tagline_color') );
			
	$custom_styles = "";

	// Custom Logo
	if ( 'fullwidth' == $logo_size ) {
		$custom_styles .= ".site-logo {max-width: 100%;}";
	} else {
		if ( ! empty($logo_width) ) {
			$custom_styles .= "
			@media screen and (min-width: 600px) {
			.site-logo {max-width: {$logo_width}px;}
			}";
		}
	}
	
	// Header Image
	if( get_header_image() ) {
		$header_image_url = esc_url( get_header_image() );
		$custom_styles .= ".custom-header {background-image: url({$header_image_url});}";
		
		if ( ! empty($header_image_padding) ) {
			$custom_styles .= ".custom-header {padding-top: {$header_image_padding}px;padding-bottom: {$header_image_padding}px;}";
		}
		
		if ( ! empty($header_image_v_align) ) {
			$custom_styles .= ".custom-header {background-position: center {$header_image_v_align};}";
		}
		
		if ( ! empty($header_image_dark_overlay) ) {
			$custom_styles .= "
			.custom-header:before {
			content: '';
			position: absolute;
			left: 0;
			top: 0;
			width: 100%;
			height: 100%;
			background-color: #000;
			opacity: 0.{$header_image_dark_overlay};
			}";
		}
	}
		
	// Site Tagline Color
	if ( ! empty($site_tagline_color) ) {
		$custom_styles .= ".site-description {color: {$site_tagline_color};}";
	}
	
	// Accent Color
	if ( ! empty($accent_color) ) {
		$custom_styles .= "
		a, .site-title a:hover, .entry-title a:hover, .main-navigation ul ul li:hover > a, .widget a:hover, .widget_recent_comments a,
		blockquote:before, .cat-links a, .comment-metadata .comment-edit-link, .standard-post .read-more:hover,
		.posts-navigation a:hover, .post-navigation a:hover .meta-nav, .post-navigation a:hover .post-title, .author-link a:hover {
		color: {$accent_color};
		}
		button, input[type='button'], input[type='reset'], input[type='submit'], .main-navigation > ul > li.current-menu-item:after,
		.sidebar .widget_tag_cloud a:hover, .single .cat-links a, .entry-meta-top .comments-link > span:hover, .entry-meta-top .comments-link > a:hover,
		.standard-post .read-more:after, .newsticker .news-dot, .pagination .current, .pagination .page-numbers:hover, .featured-post-header .cat-links a:hover,
		.post-edit-link, .reply a, #sb_instagram .sbi_follow_btn a {
		background-color: {$accent_color};
		}
		.entry-meta-top .comments-link > a:hover:after, .entry-meta-top .comments-link > span:hover:after {border-top-color: {$accent_color};}";
		if ( short_news_get_brightness($accent_color) > 160 ) {
			$custom_styles .= "
			button, input[type='button'], input[type='reset'], input[type='submit'], .sidebar .widget_tag_cloud a:hover, .post-edit-link, .reply a, .single .cat-links a, #sb_instagram .sbi_follow_btn a {
			color: rgba(0,0,0,.7);
			}";
		}
	}
				
	if ( ! empty($custom_styles) ) { 
		wp_add_inline_style( 'short-news-style', $custom_styles );
	}

}
add_action( 'wp_enqueue_scripts', 'short_news_custom_styles' );
