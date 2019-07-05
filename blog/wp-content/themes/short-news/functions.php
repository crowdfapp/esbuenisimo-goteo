<?php
/**
 * Short News functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Short News
 * @since Short News 1.0
 */


if ( ! function_exists( 'short_news_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function short_news_setup() {
	
	// Make theme available for translation.
	load_theme_textdomain( 'short-news' );
	
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title
	add_theme_support( 'title-tag' );
	
	// Enable support for Post Thumbnail
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'short-news-medium', 600, 400, true );
	add_image_size( 'short-news-large', 820, 460, true );
	add_image_size( 'short-news-fullwidth', 1260, 710, true );
	
	// Set the default content width.
	$GLOBALS['content_width'] = 1260;
	
	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'main_menu' => esc_html__( 'Main Menu', 'short-news' ),
		'social_menu' => esc_html__( 'Social Menu', 'short-news' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array( 'comment-form', 'comment-list', 'gallery', 'caption' ) );

	// Enable support for Post Formats
	add_theme_support('post-formats', array( 'image', 'video', 'audio', 'gallery', 'quote' ) );

	// Set up the WordPress Custom Background Feature.
	add_theme_support( 'custom-background', apply_filters( 'short_news_custom_background_args', array(
		'default-color' => 'eeeeee',
		'default-image' => '',
	) ) );
	
	// Set up the WordPress Custom Header Feature.
	add_theme_support( 'custom-header', apply_filters( 'short_news_custom_header_args', array(
		'height'				=> 900,
		'width'					=> 1600,
		'flex-width'			=> true,
		'flex-height'			=> true,
		'default-text-color'	=> '111111',
		'default-image'			=> '',
		'wp-head-callback'		=> 'short_news_header_style',
	) ) );

	// Set up the WordPress Custom Logo Feature.
	add_theme_support( 'custom-logo', array(
		'height'      => 400,
		'width'       => 400,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// This theme styles the visual editor to resemble the theme style,
	add_editor_style( array( 'assets/css/editor-style.css', short_news_fonts_url() ) );
	
	// Custom template tags for this theme
	require get_template_directory() . '/inc/template-tags.php';
	
	// Theme Customizer
	require get_template_directory() . '/inc/customizer.php';
	
	// Custom styles handled by the Theme customizer
	require get_template_directory() . '/inc/custom-styles.php';
	
	// Load Jetpack compatibility file
	require get_template_directory() . '/inc/jetpack.php';

}
endif;
add_action( 'after_setup_theme', 'short_news_setup' );


if ( ! function_exists( 'short_news_fonts_url' ) ) :
/**
 * Register Google fonts.
 *
 * @return string Google fonts URL for the theme.
 */
function short_news_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Work Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Work Sans: on or off', 'short-news' ) ) {
		$fonts[] = 'Work Sans:400,700,900,400italic';
	}
	
	/* translators: If there are characters in your language that are not supported by Rubik, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Rubik: on or off', 'short-news' ) ) {
		$fonts[] = 'Rubik:400,700,400italic,700italic';
	}
		
	/* translators: To add an additional character subset specific to your language, translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language. */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'short-news' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;


/**
 * Enqueue scripts and styles.
 */
function short_news_scripts() {
	
	// Add Google Fonts, used in the main stylesheet.
	wp_enqueue_style( 'short-news-fonts', short_news_fonts_url(), array(), null );
	
	// Add Social Icons.
	wp_enqueue_style( 'short-news-social-icons', get_template_directory_uri() . '/assets/css/socicon.css', array(), '3.6.2' );
	
	// Theme stylesheet.
	wp_enqueue_style( 'short-news-style', get_stylesheet_uri(), array(), '1.0.5' );
	
	wp_enqueue_script( 'short-news-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20180901', true );

	wp_enqueue_script( 'short-news-script', get_template_directory_uri() . '/assets/js/main.js', array( 'jquery' ), '20180928', true );
	
	// Add Reading Time.
	if ( is_single() ) {
		wp_enqueue_script( 'short-news-reading-time', get_template_directory_uri() . '/assets/js/readingtime.js', array( 'jquery' ), '20180901', true );
		wp_add_inline_script(
		'short-news-reading-time',
		'jQuery(document).ready(function($) {
		$(".entry-content").readingTime( {
		readingTimeTarget: ".reading-eta",
		wordCountTarget: ".word-count",
		wordsPerMinute: 180,
		round: true });
		});' );
	}
	
	// Add Breaking News.
	if ( get_theme_mod( 'show_header_top_bar', 1) && get_theme_mod('show_breaking_news', 1) ) {
		wp_enqueue_script( 'short-news-ticker', get_template_directory_uri() . '/assets/js/jquery.newsTicker.js', array( 'jquery' ), '1.0.11', true );
		wp_add_inline_script(
		'short-news-ticker',
		'jQuery(document).ready(function(){
		jQuery(".newsticker").newsTicker({
		row_height: 30,
		max_rows: 1,
		speed: 600,
		direction: "down",
		duration: 2500,
		autostart: 1,
		pauseOnHover: 1 });
		});' );
	}
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	
}
add_action( 'wp_enqueue_scripts', 'short_news_scripts' );


/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function short_news_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'short-news' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Add widgets here to appear in your sidebar.', 'short-news' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Header Right', 'short-news' ),
		'id'            => 'header-right',
		'description'   => __( 'Add widgets here to appear in your Header, when Header Layout is set to Style 1 or Style 2. Suitable for 728x90 Banner ad.', 'short-news' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area 1', 'short-news' ),
		'id'            => 'footer-1',
		'description'   => __( 'Add widgets here to appear in your footer.', 'short-news' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area 2', 'short-news' ),
		'id'            => 'footer-2',
		'description'   => __( 'Add widgets here to appear in your footer.', 'short-news' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
	register_sidebar( array(
		'name'          => __( 'Footer Widget Area 3', 'short-news' ),
		'id'            => 'footer-3',
		'description'   => __( 'Add widgets here to appear in your footer.', 'short-news' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
}
add_action( 'widgets_init', 'short_news_widgets_init' );


/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function short_news_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	$header_style = esc_attr( 'header-' . get_theme_mod('header_layout', 'style-1') );
	$site_style = esc_attr( 'site-' . get_theme_mod( 'site_style', 'fullwidth' ) );
	$site_sidebar_position = esc_attr( get_theme_mod('site_sidebar_position', 'content-sidebar') );
	$archive_sidebar_position = esc_attr( get_theme_mod('archive_sidebar_position', 'content-sidebar') );
	$post_sidebar_position = esc_attr( get_theme_mod('post_sidebar_position') );
	
	// Adds a class of Header Style.
	$classes[] = $header_style;
	$classes[] = $site_style;
	
	// Check if there is no Sidebar.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'has-no-sidebar';
	} else {
		if ( is_home() || is_page() ) {
			$classes[] = $site_sidebar_position;
		}
		if ( is_archive() || is_search() ) {
			if ( ! empty( $archive_sidebar_position ) ) {
				$classes[] = $archive_sidebar_position;	
			} else {
				$classes[] = $site_sidebar_position;
			}
		}
		if ( is_single() ) {
			if ( ! empty( $post_sidebar_position ) ) {
				$classes[] = $post_sidebar_position;	
			} else {
				$classes[] = $site_sidebar_position;
			}
		}
	}
	
	return $classes;
}
add_filter( 'body_class', 'short_news_body_classes' );


/**
 * Menu Fallback
 *
 */
function short_news_fallback_menu() {
	$home_url = esc_url( home_url( '/' ) );
	echo '<ul class="main-menu"><li><a href="' . $home_url . '" rel="home">' . __( 'Home', 'short-news' ) . '</a></li></ul>';
}


/**
 * Display Custom Logo/Site Title and Tagline.
 *
 */
function short_news_custom_logo() { 
	if ( is_front_page() && is_home() ) {
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			echo '<h1 class="site-title site-logo">';
			the_custom_logo();
			echo '</h1>';
		} else {
			echo '<h1 class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . get_bloginfo( 'name' ) . '</a></h1>';
		}
	} else {
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			echo '<p class="site-title site-logo">';
			the_custom_logo();
			echo '</p>';
		} else {
			echo '<p class="site-title"><a href="' . esc_url( home_url( '/' ) ) . '" rel="home">' . get_bloginfo( 'name' ) . '</a></p>';
		}
	}
	$description = get_bloginfo( 'description', 'display' );
	if ( $description || is_customize_preview() ) :
		echo '<p class="site-description">' . $description . '</p>';
	endif; 
}


/**
 * Filter the except length.
 *
 */
function short_news_excerpt_length( $excerpt_length ) {
	
	if ( is_admin() ) {
		return $excerpt_length;
	}
	
	if ( is_home() ) {
		$excerpt_length = get_theme_mod( 'home_excerpt_length', 25 );
	} elseif ( is_archive() || is_search() ) {
		$excerpt_length = get_theme_mod( 'archive_excerpt_length', 25 );
	} else {
		$excerpt_length = 25;
	}
	return intval($excerpt_length);
}
add_filter( 'excerpt_length', 'short_news_excerpt_length', 999 );


/**
 * Filter the "read more" excerpt string link to the post.
 *
 * @param string $more "Read more" excerpt string.
 */
function short_news_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}
	
	$home_layout = get_theme_mod('home_layout', 'standard-grid');
	$archive_layout = get_theme_mod( 'archive_layout', 'grid' );
	
	if ( ( is_home() && 'standard' == $home_layout ) || ( ( is_archive() || is_search() ) && 'standard' == $archive_layout ) ) {
		$more = sprintf( '<p class="read-more-link "><a href="%1$s" class="read-more">%2$s <span class="meta-nav">&rarr;</span></a></p>',
		esc_url( get_permalink( get_the_ID() ) ),
		esc_html__( 'Continue reading', 'short-news' )
		);
	} else {
		$more = ' &hellip; ';
	}
	return $more;
}
add_filter( 'excerpt_more', 'short_news_excerpt_more' );


/**
 * Home: Post Style
 *
 */
function short_news_home_post() {
	$home_layout = get_theme_mod('home_layout', 'standard-grid');
	
	if ('grid' == $home_layout) { 
		return sanitize_file_name('grid');
	} elseif ('standard-grid' == $home_layout) {
		return sanitize_file_name('standard-grid');
	} else {
		return;
	}
} 


/**
 * Archive: Post Style
 *
 */
function short_news_archive_post() {
	$archive_layout = get_theme_mod('archive_layout', 'grid');
	
	if ('grid' == $archive_layout) { 
		return sanitize_file_name('grid');
	} elseif ('standard-grid' == $archive_layout) {
		return sanitize_file_name('standard-grid');
	} else {
		return;
	}
}


/**
 * Display Header Template
 *
 */
function short_news_header() {
	$header_template = sanitize_file_name( get_theme_mod('header_layout', 'style-1') );
	get_template_part( 'template-parts/header/header', $header_template );
}


/**
 * Display the Header Top Bar
 *
 */
function short_news_header_top() {
	if ( get_theme_mod( 'show_header_top_bar' ) ) :
		echo '<div class="header-top"><div class="container"><div class="row"><div class="col-12">';
		if ( get_theme_mod( 'show_header_top_date', 1 ) ) {
			echo '<div class="date"><i class="material-icons">access_time</i><span>' . date_i18n( get_option( 'date_format' ) ) . '</span></div>';
		}
		if ( get_theme_mod( 'show_breaking_news', 1 ) ) {
			get_template_part( 'template-parts/header/breaking-news' ); // Breaking News
		}
		if ( get_theme_mod( 'show_header_top_social_menu' ) ) {
			get_template_part( 'template-parts/navigation/navigation', 'social' ); // Social Menu
		}
		echo '</div></div></div></div>';
	endif;
}


/**
 * Display the Search Icon
 *
 */
function short_news_search_popup() {
	if ( get_theme_mod( 'show_search_icon', 1 ) ) :
		echo '<div class="search-popup">';
		echo '<span id="search-popup-button" class="search-popup-button"><i class="search-icon"></i></span>';
		get_search_form();
		echo '</div>';
	endif;
}


/**
 * Display the Home Icon
 *
 */
function short_news_home_icon() {
	if ( get_theme_mod( 'show_home_icon', 1 ) ) {
		echo '<div class="home-icon"><a href="' . esc_url( home_url( '/' ) ) .'" rel="home"><i class="material-icons">home</i></a></div>';
	}
}


/**
 * Display Social Icons
 *
 */
function short_news_social_menu() {
	if ( get_theme_mod( 'show_social_menu' ) ) {
		get_template_part( 'template-parts/navigation/navigation', 'social' );
	}
}


/**
 * Display Featured Posts Area 1
 *
 */
function short_news_featured_posts_area_1() {
	if ( get_theme_mod( 'featured_posts_area_1', 1 ) && ( is_home() || is_front_page() ) ) {
		get_template_part( 'template-parts/header/featured-posts-1' );
	}
}


/**
 * Display Featured Posts Area 2
 *
 */
function short_news_featured_posts_area_2() {
	if ( get_theme_mod( 'featured_posts_area_2' ) && ( is_home() || is_front_page() ) ) {
		get_template_part( 'template-parts/header/featured-posts-2' );
	}
}


/**
 * Display Post Reading Time
 *
 */
function short_news_reading_time() {
	echo '<div class="reading-time">';
	echo esc_html_e( 'Time to Read:', 'short-news' ) . '<span class="reading-eta"></span><span class="sep">-</span><span class="word-count"></span>' . esc_html_e( 'words', 'short-news');
	echo '</div>';
}


/**
 * Exclude Featured Posts from the Main Loop to avoid duplicate posts
 */
function short_news_get_duplicate_post_ids() {
		
	$duplicate_post_ids = array();
	$featured_post_array_1 = array();
	$featured_post_array_2 = array();
	
	if ( get_theme_mod( 'featured_posts_area_1', 1 ) && get_theme_mod( 'exclude_featured_posts_1', 1 ) ) {
		
		$fp_cat_1 = get_theme_mod('featured_posts_cat_1', 'all');

		$args = array(
		'post_type'			=> 'post',
		'posts_per_page'	=> 3,
		'orderby'			=> 'date',
		'order'				=> 'DESC',
		);
	
		if( is_numeric( $fp_cat_1 ) ) {
		$args['cat'] = $fp_cat_1;
		}
	
		$featured_posts_1 = get_posts( $args );

		if ( $featured_posts_1 ) {
			foreach ( $featured_posts_1 as $post ) :
			$featured_post_array_1[] = $post->ID;
			endforeach; 
			wp_reset_postdata();
		}
	}
	
	if ( get_theme_mod( 'featured_posts_area_2' ) && get_theme_mod( 'exclude_featured_posts_2' ) ) {
		
		$fp_cat_2 = get_theme_mod('featured_posts_cat_2', 'all');
		
		$args = array(
		'post_type'			=> 'post',
		'posts_per_page'	=> 4,
		'orderby'			=> 'date',
		'order'				=> 'DESC',
		);
	
		if( is_numeric( $fp_cat_2 ) ) {
		$args['cat'] = $fp_cat_2;
		}
	
		$featured_posts_2 = get_posts( $args );

		if ( $featured_posts_2 ) {
			foreach ( $featured_posts_2 as $post ) :
			$featured_post_array_2[] = $post->ID;
			endforeach; 
			wp_reset_postdata();
		}
	}
	
	$duplicate_post_ids = array_merge($featured_post_array_1, $featured_post_array_2);
	return $duplicate_post_ids;
}

// Retrieve list of duplicate posts
$duplicate_posts = short_news_get_duplicate_post_ids();

if ( ! empty( $duplicate_posts ) ) {
	
function short_news_exclude_duplicate_posts( $query ) {
	if ( $query->is_main_query() && $query->is_home() ) {
	$query->set( 'post__not_in', short_news_get_duplicate_post_ids() );
	}
}
add_action( 'pre_get_posts', 'short_news_exclude_duplicate_posts' );

}


/**
 * Prints Credits in the Footer
 */
function short_news_credits() {
	$website_credits = '';
	$website_author = get_bloginfo('name');
	$website_date = date_i18n(__( 'Y', 'short-news' ) );
	$website_credits = '&copy; ' . $website_date . ' ' . $website_author;	
	echo '<span>' . esc_html($website_credits) . '</span>';
}


/**
 * Add Upsell "pro" link to the customizer
 *
 */
require_once( trailingslashit( get_template_directory() ) . '/inc/customize-pro/class-customize.php' );
