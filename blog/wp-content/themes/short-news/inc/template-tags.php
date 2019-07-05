<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Short News
 * @since Short News 1.0
 */


if ( ! function_exists( 'short_news_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function short_news_posted_on() {
	short_news_author();
	short_news_time_link();
}
endif;


if ( ! function_exists( 'short_news_author' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function short_news_author() {
	$byline = sprintf(
		/* translators: %s: post author */
		__( 'By %s', 'short-news' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . get_the_author() . '</a></span>'
	);
	echo '<span class="byline">' . $byline . '</span>';
}
endif;


if ( ! function_exists( 'short_news_time_link' ) ) :
/**
 * Gets a nicely formatted string for the published date.
 */
function short_news_time_link() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		get_the_date( DATE_W3C ),
		get_the_date(),
		get_the_modified_date( DATE_W3C ),
		get_the_modified_date()
	);

	// Wrap the time string in a link, and preface it with 'Posted on'.
	printf( '<span class="posted-on"><span class="screen-reader-text">%1$s</span><a href="%2$s" rel="bookmark">%3$s</a></span>',
		_x( 'Posted on', 'Used before publish date.', 'short-news' ),
		esc_url( get_permalink() ),
		$time_string
	);
}
endif;


if ( ! function_exists( 'short_news_category_link' ) ) :
/**
 * Prints HTML with meta information for categories.
 */
function short_news_category_link() {
	if ( 'post' === get_post_type() ) {
		// Get Categories for posts.
		$categories_list = get_the_category_list( ' ', esc_html__( ' ', 'short-news' ) );
		echo '<span class="cat-links">' . $categories_list . '</span>';		
	}
}
endif;


if ( ! function_exists( 'short_news_comments_count' ) ) :
/**
 * Prints HTML with meta information for comments.
 */
function short_news_comments_count() {
	if ( is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		$comment_count	= get_comments_number();
		$comment_link	= '<a href="' . esc_url( get_comments_link() ) .'">';
		$comment_link	.= absint( $comment_count );
		$comment_link	.= '</a>';
		echo $comment_link;
		echo '</span>';
	}
}
endif;


if ( ! function_exists( 'short_news_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories and tags.
 */
function short_news_entry_footer() {
	// Show edit link for logged in user
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'short-news' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<span class="edit-link">',
		'</span>'
	);
	
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		// Get Tags for posts.
		$tags_list = get_the_tag_list( '', esc_html__( ' ', 'short-news' ) );
		if ( $tags_list ) {
			printf( '<div class="entry-tags"><span class="tags-links"><strong>%1$s</strong> %2$s</span></div>',
			__( 'Tag:', 'short-news' ),
			$tags_list
			);
		}
	}
}
endif;
