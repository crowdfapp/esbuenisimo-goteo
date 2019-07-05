<?php
/**
 * Theme Customizer.
 *
 * @package Short News
 * @since Short News 1.0
 */


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function short_news_customize_preview_js() {
	wp_enqueue_script( 'short-news-customizer-js', get_template_directory_uri() . '/assets/js/customize-preview.js', array( 'customize-preview' ), '20171005', true );
}
add_action( 'customize_preview_init', 'short_news_customize_preview_js' );


/**
 * Loads custom stylesheet
 */
function short_news_customizer_style() {
	wp_enqueue_style('short-news-customizer-styles', get_template_directory_uri() . '/assets/css/customize-style.css', array(), '1.0.0' );
}
add_action( 'customize_controls_enqueue_scripts', 'short_news_customizer_style' );


/**
 * Custom Classes
 */
if ( class_exists( 'WP_Customize_Control' ) ) {

	class Short_News_Important_Links extends WP_Customize_Control {

		public $type = "short-news-important-links";

		public function render_content() {
			$important_links = array(
			'upgrade' => array(
			'link' => esc_url('https://www.designlabthemes.com/short-news-pro-wordpress-theme/?utm_source=customizer_link&utm_medium=wordpress_dashboard&utm_campaign=short_news_upsell'),
			'text' => __('Try Short News Pro', 'short-news'),
			),
			'theme' => array(
			'link' => esc_url('https://www.designlabthemes.com/short-news-wordpress-theme/'),
			'text' => __('Theme Homepage', 'short-news'),
			),
			'documentation' => array(
			'link' => esc_url('https://www.designlabthemes.com/short-news-documentation/'),
			'text' => __('Theme Documentation', 'short-news'),
			),
			'rating' => array(
			'link' => esc_url('https://wordpress.org/support/theme/short-news/reviews/#new-post'),
			'text' => __('Rate This Theme', 'short-news'),
			),
			'instagram' => array(
			'link' => esc_url('https://www.instagram.com/designlabthemes/'),
			'text' => __('Follow on Instagram', 'short-news'),
			),
			'twitter' => array(
			'link' => esc_url('https://twitter.com/designlabthemes'),
			'text' => __('Follow on Twitter', 'short-news'),
			)
			);
			foreach ($important_links as $important_link) {
				echo '<p><a class="button" target="_blank" href="' . esc_url( $important_link['link'] ). '" >' . esc_html($important_link['text']) . ' </a></p>';
			}
		}
	}

	class Short_News_Customize_Radio_Image_Control extends WP_Customize_Control {
		public $type = 'short-news-radio-image';
		function render_content() {
			if ( empty( $this->choices ) )
			return;

			$name = '_customize-radio-' . $this->id;

			if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif;

			if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo $this->description ; ?></span>
			<?php endif; ?>

			<div class="radio-choices">
				<?php foreach ( $this->choices as $value => $item ) {
				$label = isset( $item['label'] ) ? $item['label'] : '';
				?>
					<div class="radio-item">
						<label title="<?php echo esc_attr( $label ); ?>" class="choice-item">
							<input type="radio" value="<?php echo esc_attr($value); ?>" name="<?php echo esc_attr($name); ?>" <?php $this->link(); checked($this->value(), $value); ?> />
							<div class="radio-img"><img src="<?php echo esc_attr($item['img']); ?>" alt=""></div>
							<span class="radio-label"><?php echo esc_attr( $label ); ?></span>
						</label>
					</div>
				<?php
				} ?>
			</div>

		<?php
		}
	}

	class Short_News_Custom_Content extends WP_Customize_Control {
		public $type = 'short-news-custom-content';

		function render_content() {
		if ( ! empty( $this->label ) ) {
			echo '<span class="customize-control-title short-news-custom-title">' . esc_html( $this->label ) . '</span>';
			}
		if ( ! empty( $this->description ) ) {
			echo '<div class="description customize-control-description short-news-custom-description">' . esc_html( $this->description ) . '</div>';
			}
		}
	}
	
	class Short_News_Pro_Version extends WP_Customize_Control {
		public $type = 'short-news-pro-version';
		
		function render_content() {
		$pro_version_text = esc_html( 'Try Short News Pro', 'short-news' );
		$pro_version_link = esc_url( 'https://www.designlabthemes.com/short-news-pro-wordpress-theme/?utm_source=customizer_link&utm_medium=wordpress_dashboard&utm_campaign=short_news_upsell' );
		
		if ( ! empty( $this->label ) ) {
			echo '<div class="description customize-control-description short-news-custom-description">';
			echo '<strong>' . esc_html( $this->label ) . '</strong> ';
			echo '<a target="_blank" href="' . esc_url( $pro_version_link ). '" >' . esc_html( $pro_version_text ) . '</a>';
			echo '</div>';
			}
		}
	}
}


/**
 * Theme Settings
 */
function short_news_theme_customizer( $wp_customize ) {

	// Add postMessage support for site title and description for the Theme Customizer.
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	// Change default WordPress customizer settings
	$wp_customize->get_section( 'title_tagline' )->priority  = 4;
	$wp_customize->get_control( 'background_color' )->section	= 'colors_general';
	$wp_customize->get_control( 'background_color' )->priority  = 1;
	$wp_customize->get_control( 'background_color' )->description = __( 'Only applies to Site Boxed layout.', 'short-news' );
	$wp_customize->get_control( 'background_image' )->description = __( 'Only applies to Site Boxed layout.', 'short-news' );
	$wp_customize->get_control( 'header_textcolor' )->section	= 'colors_general';
	$wp_customize->get_control( 'header_textcolor' )->priority  = 2;
	$wp_customize->get_control( 'header_textcolor' )->label = __( 'Site Title Color', 'short-news' );
	$wp_customize->get_section( 'header_image' )->panel  = 'theme_panel';
	$wp_customize->get_section( 'header_image' )->priority  = 3;
	$wp_customize->get_control( 'custom_logo' )->section	= 'logo_settings';
	$wp_customize->get_control( 'custom_logo' )->priority  = 1;
	$wp_customize->get_section( 'background_image' )->priority  = 10;
	$wp_customize->remove_section('colors');

	$wp_customize->selective_refresh->add_partial(
		'blogname', array(
			'selector'			=> '.site-title a',
			'render_callback'	=> 'short_news_customize_partial_blogname',
		)
	);
	$wp_customize->selective_refresh->add_partial(
		'blogdescription', array(
			'selector'			=> '.site-description',
			'render_callback' 	=> 'short_news_customize_partial_blogdescription',
		)
	);

	// Retrieve list of Categories
	$blog_categories = array();
	$blog_categories_obj = get_categories();
	foreach ($blog_categories_obj as $category) {
		$blog_categories[$category->cat_ID] = $category->cat_name;
	}
	$blog_categories['all'] = __( 'All categories', 'short-news' );

	/* Panels */
	$wp_customize->add_panel( 'theme_panel', array(
		'title'			=> __( 'Short News Settings', 'short-news' ),
		'priority'		=> 2,
	) );

	/* Sections */
	$wp_customize->add_section( 'site_settings', array(
		'title'			=> __( 'Site Options', 'short-news' ),
		'priority'		=> 1,
		'panel'			=> 'theme_panel',
	) );

	$wp_customize->add_section( 'header_settings', array(
		'title'			=> __( 'Header Options', 'short-news' ),
		'description'	=> __( 'Settings for Header.', 'short-news' ),
		'priority'		=> 2,
		'panel'			=> 'theme_panel',
	) );

	$wp_customize->add_section( 'logo_settings', array(
		'title'			=> __( 'Header Logo', 'short-news' ),
		'description'	=> __( 'Settings for Site Logo.', 'short-news' ),
		'priority'		=> 4,
		'panel'			=> 'theme_panel',
	) );

	$wp_customize->add_section( 'header_top', array(
		'title'			=> __( 'Header Top Bar', 'short-news' ),
		'description'	=> __( 'Settings for Header Top Bar.', 'short-news' ),
		'priority'		=> 5,
		'panel'			=> 'theme_panel',
	) );

	$wp_customize->add_section( 'featured_posts_1', array(
		'title'			=> __( 'Featured Posts Area 1', 'short-news' ),
		'priority'		=> 6,
		'panel'			=> 'theme_panel',
	) );

	$wp_customize->add_section( 'featured_posts_2', array(
		'title'			=> __( 'Featured Posts Area 2', 'short-news' ),
		'priority'		=> 7,
		'panel'			=> 'theme_panel',
	) );

	$wp_customize->add_section( 'home_settings', array(
		'title'			=> __( 'Homepage', 'short-news' ),
		'description'	=> __( 'Settings for Blog Homepage.', 'short-news' ),
		'priority'		=> 8,
		'panel'			=> 'theme_panel',
	) );

	$wp_customize->add_section( 'archive_settings', array(
		'title'			=> __( 'Categories & Archives', 'short-news' ),
		'description'	=> __( 'Settings for Category, Tag, Search and Archive Pages.', 'short-news' ),
		'priority'		=> 9,
		'panel'			=> 'theme_panel',
	) );

	$wp_customize->add_section( 'post_settings', array(
		'title'			=> __( 'Post', 'short-news' ),
		'description'	=> __( 'Settings for Single Posts.', 'short-news' ),
		'priority'		=> 10,
		'panel'			=> 'theme_panel',
	) );

	$wp_customize->add_section( 'page_settings', array(
		'title'			=> __( 'Page', 'short-news' ),
		'description'	=> __( 'Settings for Static Pages.', 'short-news' ),
		'priority'		=> 11,
		'panel'			=> 'theme_panel',
	) );

	$wp_customize->add_section( 'colors_general', array(
		'title'			=> __( 'Colors: General', 'short-news' ),
		'priority'		=> 12,
		'panel'			=> 'theme_panel',
	) );
	
	$wp_customize->add_section('custom_links', array(
		'priority'		=> 3,
		'title'			=> __('Short News Links', 'short-news'),
	) );
	
	/* Controls */

	// Site - Sidebar Position
	$wp_customize->add_setting( 'site_sidebar_position', array(
		'default' => 'content-sidebar',
		'sanitize_callback' => 'short_news_sanitize_choices',
	) );

	$wp_customize->add_control( 'site_sidebar_position', array(
		'label'    => __( 'Sidebar Position', 'short-news' ),
		'section'  => 'site_settings',
		'type'     => 'select',
		'choices'  => array(
			'content-sidebar' => __('Right Sidebar', 'short-news'),
			'sidebar-content' => __('Left Sidebar', 'short-news'),
			'content-fullwidth' => __('No Sidebar Full width', 'short-news'),
	) ) );

	// Site - Style
	$wp_customize->add_setting( 'site_style', array(
		'default' => 'fullwidth',
		'sanitize_callback' => 'short_news_sanitize_choices',
	) );

	$wp_customize->add_control( 'site_style', array(
		'label'    => __( 'Site Style', 'short-news' ),
		'section'  => 'site_settings',
		'type'     => 'radio',
		'choices'  => array(
			'fullwidth'	=> __( 'Full width', 'short-news' ),
			'boxed'	=> __( 'Boxed', 'short-news' ),
	) ) );
	
	// Site - Pro Link
	$wp_customize->add_setting( 'site_pro_link', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new Short_News_Pro_Version( $wp_customize, 'site_pro_link', array(
		'label'      => __( 'Need more options?', 'short-news' ),
		'section' => 'site_settings',
	) ) );
	
	// Header Layout
	$wp_customize->add_setting( 'header_layout', array(
		'default' => 'style-1',
		'sanitize_callback' => 'short_news_sanitize_choices',
	) );

	$wp_customize->add_control( 'header_layout', array(
		'label'    => __( 'Header Layout', 'short-news' ),
		'section'  => 'header_settings',
		'type'     => 'radio',
		'choices'  => array(
			'style-1' => __( 'Style 1: Logo left and Widget Area right over Header Image, Nav below', 'short-news' ),
			'style-2' => __( 'Style 2: Logo left and Widget Area right above Header Image, Nav below', 'short-news' ),
	) ) );

	// Menu Options
	$wp_customize->add_setting( 'main_menu', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new Short_News_Custom_Content( $wp_customize, 'main_menu', array(
		'label'      => __( 'Menu Options', 'short-news' ),
		'section'  => 'header_settings',
	) ) );

	$wp_customize->add_setting( 'show_social_menu', array(
		'default' => '',
		'sanitize_callback' => 'short_news_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'show_social_menu', array(
		'label'    => __( 'Display Social Icons', 'short-news' ),
		'description' => __( 'To add Social Icons create a new menu and assign to Social Menu location.', 'short-news' ),
		'section'  => 'header_settings',
		'type'     => 'checkbox',
	) );

	$wp_customize->add_setting( 'show_home_icon', array(
		'default' => 1,
		'sanitize_callback' => 'short_news_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'show_home_icon', array(
		'label'    => __( 'Display Home Icon', 'short-news' ),
		'section'  => 'header_settings',
		'type'     => 'checkbox',
	) );

	$wp_customize->add_setting( 'show_search_icon', array(
		'default' => 1,
		'sanitize_callback' => 'short_news_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'show_search_icon', array(
		'label'    => __( 'Display Search Icon', 'short-news' ),
		'section'  => 'header_settings',
		'type'     => 'checkbox',
	) );

	// Header Top Bar
	$wp_customize->add_setting( 'show_header_top_bar', array(
		'default' => 1,
		'sanitize_callback' => 'short_news_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'show_header_top_bar', array(
		'label'    => __( 'Display Header Top Bar', 'short-news' ),
		'section'  => 'header_top',
		'type'     => 'checkbox',
	) );

	$wp_customize->add_setting( 'show_header_top_date', array(
		'default' => 1,
		'sanitize_callback' => 'short_news_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'show_header_top_date', array(
		'label'    => __( 'Display Date', 'short-news' ),
		'section'  => 'header_top',
		'active_callback' => 'short_news_has_header_top',
		'type'     => 'checkbox',
	) );

	$wp_customize->add_setting( 'show_breaking_news', array(
		'default' => 1,
		'sanitize_callback' => 'short_news_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'show_breaking_news', array(
		'label'    => __( 'Display Breaking News', 'short-news' ),
		'section'  => 'header_top',
		'active_callback' => 'short_news_has_header_top',
		'type'     => 'checkbox',
	) );

	$wp_customize->add_setting( 'show_header_top_social_menu', array(
		'default' => '',
		'sanitize_callback' => 'short_news_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'show_header_top_social_menu', array(
		'label'    => __( 'Display Social Icons', 'short-news' ),
		'description' => __( 'To add Social Icons create a new menu and assign to Social Menu location.', 'short-news' ),
		'section'  => 'header_top',
		'active_callback' => 'short_news_has_header_top',
		'type'     => 'checkbox',
	) );

	// Header Image Padding
	$wp_customize->add_setting( 'header_image_padding', array(
		'default' => 0,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'header_image_padding', array(
		'label' => __( 'Header Image: Padding', 'short-news' ),
		'description' => __( 'Add padding above and below Header Image.', 'short-news' ),
		'section'  => 'header_image',
		'priority' => 2,
		'type'     => 'number',
		'active_callback' => 'short_news_has_header_image',
	) );

	// Header Image Vertical Alignment
	$wp_customize->add_setting( 'header_image_v_align', array(
		'default' => 'top',
		'sanitize_callback' => 'short_news_sanitize_choices',
	) );

	$wp_customize->add_control( 'header_image_v_align', array(
		'label'    => __( 'Header Image: Vertical Alignment', 'short-news' ),
		'section'  => 'header_image',
		'priority' => 3,
		'type'     => 'select',
		'active_callback' => 'short_news_has_header_image',
		'choices'  => array(
			'top' => __( 'Top', 'short-news' ),
			'center' => __( 'Center', 'short-news' ),
			'bottom' => __( 'Bottom', 'short-news' ),
	) ) );

	// Header Image Overlay
	$wp_customize->add_setting( 'header_image_dark_overlay', array(
		'default' => 0,
		'sanitize_callback' => 'short_news_sanitize_choices',
	) );

	$wp_customize->add_control( 'header_image_dark_overlay', array(
		'label'    => __( 'Header Image: Dark overlay', 'short-news' ),
		'description' => __('Add a dark overlay to ensure the right text readability and contrast.', 'short-news' ),
		'section'  => 'header_image',
		'priority' => 4,
		'type'     => 'select',
		'active_callback' => 'short_news_has_header_image',
		'choices'  => array(
			0  => __( '0%', 'short-news' ),
			10 => __( '10%', 'short-news' ),
			20 => __( '20%', 'short-news' ),
			30 => __( '30%', 'short-news' ),
			40 => __( '40%', 'short-news' ),
			50 => __( '50%', 'short-news' ),
			60 => __( '60%', 'short-news' ),
			70 => __( '70%', 'short-news' ),
			80 => __( '80%', 'short-news' ),
	) ) );

	// Logo - Size
	$wp_customize->add_setting( 'logo_size', array(
		'default' => 'resize',
		'sanitize_callback' => 'short_news_sanitize_choices',
	) );

	$wp_customize->add_control( 'logo_size', array(
		'label'    => __( 'Logo Size', 'short-news' ),
		'section'  => 'logo_settings',
		'type'     => 'radio',
		'priority' => 2,
		'choices'  => array(
			'fullwidth'	=> __( 'Fullwidth', 'short-news' ),
			'resize'	=> __( 'Resize', 'short-news' ),
	) ) );

	// Logo - Width
	$wp_customize->add_setting( 'logo_width', array(
		'default' => 220,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'logo_width', array(
		'label' => __( 'Logo Width', 'short-news' ),
		'description' => __( 'Set the max width for your Logo.', 'short-news' ),
		'section'  => 'logo_settings',
		'type'     => 'number',
		'priority' => 3,
		'active_callback' => 'short_news_resize_logo',
	) );

	// Featured Posts Area 1
	$wp_customize->add_setting( 'featured_posts_area_1', array(
		'default' => 1,
		'sanitize_callback' => 'short_news_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'featured_posts_area_1', array(
		'label'    => __( 'Display Featured Posts Area 1', 'short-news' ),
		'description' => __( 'Check this option to display Featured Posts at the top of the Homepage.', 'short-news' ),
		'section'  => 'featured_posts_1',
		'type'     => 'checkbox',
	) );

	$wp_customize->add_setting( 'featured_posts_layout_1', array(
		'default' => 'featured-style-1',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control(
		new Short_News_Customize_Radio_Image_Control(
			$wp_customize,
			'featured_posts_layout_1',
			array(
				'choices'	=>array(
				'featured-style-1' =>  array(
					'img'	=> get_template_directory_uri() . '/assets/images/featured-posts-1.png',
				),
				'featured-style-2' =>  array(
					'img'	=> get_template_directory_uri() . '/assets/images/featured-posts-2.png',
				),
			),
			'label'		=> __( 'Layout', 'short-news' ),
			'section'	=> 'featured_posts_1',
			)
		)
	);

	$wp_customize->add_setting('featured_posts_cat_1', array(
		'default' => 'all',
		'sanitize_callback' => 'short_news_sanitize_choices',
	) );

	$wp_customize->add_control('featured_posts_cat_1', array(
		'description' => __('Select a Category', 'short-news'),
		'section'  => 'featured_posts_1',
		'type'    => 'select',
		'choices' => $blog_categories
	) );

	$wp_customize->add_setting( 'exclude_featured_posts_1', array(
		'default' => 1,
		'sanitize_callback' => 'short_news_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'exclude_featured_posts_1', array(
		'label'    => __( 'Avoid duplicate posts', 'short-news' ),
		'description' => __('Enable this option to remove Featured Posts from the Homepage.', 'short-news'),
		'section'  => 'featured_posts_1',
		'type' => 'checkbox',
	) );

	// Featured Posts Area 2
	$wp_customize->add_setting( 'featured_posts_area_2', array(
		'default' => '',
		'sanitize_callback' => 'short_news_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'featured_posts_area_2', array(
		'label'    => __( 'Display Featured Posts Area 2', 'short-news' ),
		'description' => __( 'Check this option to display additional Featured Posts, below Featured Posts Area 1.', 'short-news' ),
		'section'  => 'featured_posts_2',
		'type'     => 'checkbox',
	) );

	$wp_customize->add_setting('featured_posts_cat_2', array(
		'default' => get_option('default_category'),
		'sanitize_callback' => 'short_news_sanitize_choices',
	) );

	$wp_customize->add_control('featured_posts_cat_2', array(
		'description' => __('Select a Category', 'short-news'),
		'section'  => 'featured_posts_2',
		'type'    => 'select',
		'choices' => $blog_categories
	) );

	$wp_customize->add_setting( 'featured_posts_title_2', array(
		'default' => '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'featured_posts_title_2', array(
		'label' => __( 'Title', 'short-news' ),
		'section'  => 'featured_posts_2',
		'type' => 'text',
	) );

	$wp_customize->add_setting( 'featured_posts_text_2', array(
		'default' => '',
		'sanitize_callback' => 'short_news_sanitize_html',
	) );

	$wp_customize->add_control( 'featured_posts_text_2', array(
		'label' => __( 'Text', 'short-news' ),
		'description' => __( 'HTML tags are allowed: strong, em, b, i, br, a.', 'short-news' ),
		'section'  => 'featured_posts_2',
		'type' => 'textarea',
	) );

	$wp_customize->add_setting( 'exclude_featured_posts_2', array(
		'default' => '',
		'sanitize_callback' => 'short_news_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'exclude_featured_posts_2', array(
		'label'    => __( 'Avoid duplicate posts', 'short-news' ),
		'description' => __('Enable this option to remove Top News from the Homepage.', 'short-news'),
		'section'  => 'featured_posts_2',
		'type' => 'checkbox',
	) );

	// Home - Layout
	$wp_customize->add_setting( 'home_layout', array(
		'default' => 'standard-grid',
		'sanitize_callback' => 'short_news_sanitize_choices',
	) );

	$wp_customize->add_control( 'home_layout', array(
		'label'    => __( 'Homepage Layout', 'short-news' ),
		'section'  => 'home_settings',
		'type'     => 'radio',
		'choices'  => array(
			'standard' => __('Standard', 'short-news'),
			'grid' => __('Grid', 'short-news'),
			'standard-grid' => __('First Standard then Grid', 'short-news'),
	) ) );

	// Home - Excerpt Length
	$wp_customize->add_setting( 'home_excerpt_length', array(
		'default' => 25,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'home_excerpt_length', array(
		'label'    => __( 'Excerpt length', 'short-news' ),
		'description'    => __( 'The default length is 25 words.', 'short-news' ),
		'section'  => 'home_settings',
		'type'     => 'number',
	) );

	// Archives - Sidebar Position
	$wp_customize->add_setting( 'archive_sidebar_position', array(
		'default' => '',
		'sanitize_callback' => 'short_news_sanitize_choices',
	) );

	$wp_customize->add_control( 'archive_sidebar_position', array(
		'label'    => __( 'Sidebar Position', 'short-news' ),
		'description'    => __( 'This option overrides the Site Options.', 'short-news' ),
		'section'  => 'archive_settings',
		'type'     => 'select',
		'choices'  => array(
			'content-sidebar' => __('Right Sidebar', 'short-news'),
			'sidebar-content' => __('Left Sidebar', 'short-news'),
			'content-fullwidth' => __('No Sidebar Full width', 'short-news'),
	) ) );

	// Archives - Layout
	$wp_customize->add_setting( 'archive_layout', array(
		'default' => 'grid',
		'sanitize_callback' => 'short_news_sanitize_choices',
	) );

	$wp_customize->add_control( 'archive_layout', array(
		'label'    => __( 'Archives Layout', 'short-news' ),
		'section'  => 'archive_settings',
		'type'     => 'radio',
		'choices'  => array(
			'standard' => __('Standard', 'short-news'),
			'grid' => __('Grid', 'short-news'),
			'standard-grid-' => __('First Standard then Grid', 'short-news'),
	) ) );

	// Archives - Excerpt Length
	$wp_customize->add_setting( 'archive_excerpt_length', array(
		'default' => 25,
		'sanitize_callback' => 'absint',
	) );

	$wp_customize->add_control( 'archive_excerpt_length', array(
		'label'    => __( 'Excerpt length', 'short-news' ),
		'description'    => __( 'The default length is 25 words.', 'short-news' ),
		'section'  => 'archive_settings',
		'type'     => 'number',
	) );

	// Post - Sidebar Position
	$wp_customize->add_setting( 'post_sidebar_position', array(
		'default' => '',
		'sanitize_callback' => 'short_news_sanitize_choices',
	) );

	$wp_customize->add_control( 'post_sidebar_position', array(
		'label'    => __( 'Sidebar Position', 'short-news' ),
		'description'    => __( 'This option overrides the Site Options.', 'short-news' ),
		'section'  => 'post_settings',
		'type'     => 'select',
		'choices'  => array(
			'content-sidebar' => __('Right Sidebar', 'short-news'),
			'sidebar-content' => __('Left Sidebar', 'short-news'),
			'content-fullwidth' => __('No Sidebar Full width', 'short-news'),
	) ) );

	// Post - Feauted Image
	$wp_customize->add_setting( 'post_has_featured_image', array(
		'default' => 1,
		'sanitize_callback' => 'short_news_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'post_has_featured_image', array(
		'label'    => __( 'Display Featured Image', 'short-news' ),
		'section'  => 'post_settings',
		'type'     => 'checkbox',
	) );

	// Post - Author Bio
	$wp_customize->add_setting( 'show_author_bio', array(
		'default' => '',
		'sanitize_callback' => 'short_news_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'show_author_bio', array(
		'label'    => __( 'Display Author Bio', 'short-news' ),
		'section'  => 'post_settings',
		'type'     => 'checkbox',
	) );

	// Page - Featured Image
	$wp_customize->add_setting( 'page_has_featured_image', array(
		'default' => 1,
		'sanitize_callback' => 'short_news_sanitize_checkbox',
	) );

	$wp_customize->add_control( 'page_has_featured_image', array(
		'label'    => __( 'Display Featured Image', 'short-news' ),
		'section'  => 'page_settings',
		'type'     => 'checkbox',
	) );

	// Colors - Site Tagline color
	$wp_customize->add_setting( 'site_tagline_color', array(
		'default' => '#888888',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'site_tagline_color', array(
		'label' => __( 'Site Tagline color', 'short-news' ),
		'section' => 'colors_general',
		'priority'	=> 3,
	) ) );

	// Colors - Accent color
	$wp_customize->add_setting( 'accent_color', array(
		'default' => '#0573b4',
		'sanitize_callback' => 'sanitize_hex_color',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent_color', array(
		'label' => __( 'Accent color', 'short-news' ),
		'priority' => 4,
		'section' => 'colors_general',
	) ) );
	
	// Colors - Pro Link
	$wp_customize->add_setting( 'color_pro_link', array(
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( new Short_News_Pro_Version( $wp_customize, 'color_pro_link', array(
		'label'      => __( 'Need more colors?', 'short-news' ),
		'priority' => 5,
		'section' => 'colors_general',
	) ) );
	
	// Custom Links
	$wp_customize->add_setting('short_news_links', array(
		'capability' => 'edit_theme_options',
		'sanitize_callback' => 'esc_url_raw',
	) );

	$wp_customize->add_control(new Short_News_Important_Links($wp_customize, 'short_news_links', array(
		'section' => 'custom_links',
	) ) );
}
add_action('customize_register', 'short_news_theme_customizer');


/**
 * Render the site title for the selective refresh partial.
 *
 */
function short_news_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 */
function short_news_customize_partial_blogdescription() {
	bloginfo( 'description' );
}


/**
 * Sanitize Checkbox
 *
 */
function short_news_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}


/**
 * Sanitize Radio Buttons and Select Lists
 *
 */
function short_news_sanitize_choices( $input, $setting ) {
	global $wp_customize;

	$control = $wp_customize->get_control( $setting->id );

	if ( array_key_exists( $input, $control->choices ) ) {
	return $input;
	} else {
	return $setting->default;
	}
}


/**
 * Sanitizes text: only <strong>, <em>, <b>, <i>, <br> and <a> tags.
 *
 */
function short_news_sanitize_html( $text ) {
	$args = array(
	//formatting
	'strong'	=> array(),
	'em'		=> array(),
	'b'			=> array(),
	'i'			=> array(),
	'br'		=> array(),
	//links
	'a'	 => array(
		'href' => array(),
		'target' => array()
	)
	);
	return wp_kses( $text, $args );
}


/**
 * Checks Header Top Bar Settings.
 */
function short_news_has_header_top( $control ) {
	if ( $control->manager->get_setting('show_header_top_bar')->value() == 1 ) {
		return true;
	} else {
		return false;
	}
}


/**
 * Checks if Single Post has featured image.
 */
function short_news_post_has_featured_image( $control ) {
	if ( $control->manager->get_setting('post_has_featured_image')->value() == 1 ) {
		return true;
	} else {
		return false;
	}
}


/**
 * Checks if Static Page has featured image.
 */
function short_news_page_has_featured_image( $control ) {
	if ( $control->manager->get_setting('page_has_featured_image')->value() == 1 ) {
		return true;
	} else {
		return false;
	}
}


/**
 * Checks whether a Header Image is set or not.
 */
function short_news_has_header_image( $control ) {
	if ( has_header_image() ) {
		return true;
	} else {
		return false;
	}
}


/**
 * Checks Logo Size Settings.
 */
function short_news_resize_logo( $control ) {
	if ( $control->manager->get_setting('logo_size')->value() == 'resize' ) {
		return true;
	} else {
		return false;
	}
}
