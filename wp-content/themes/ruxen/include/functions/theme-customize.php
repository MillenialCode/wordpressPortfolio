<?php
/*------------- THEME OPTIONS START -------------*/
function ruxen_santanize( $input ) {
		return $input;
}

/*-- FONT CUSTOMIZE START --*/
new theme_customizer();
class theme_customizer
{
    public function __construct()
    {
        add_action ('admin_menu', array(&$this, 'customizer_admin'));
        add_action( 'customize_register', array(&$this, 'customize_manager_demo' ));
    }

    public function customizer_admin() {
        add_theme_page( __( 'Customize', 'ruxen' ), __( 'Customize', 'ruxen' ), 'edit_theme_options', 'customize.php' );
    }

    public function customize_manager_demo( $wp_manager )
    {
        $this->demo_section( $wp_manager );
        $this->custom_sections( $wp_manager );
    }

    private function demo_section( $wp_manager )
    {
        $wp_manager->add_section( 'customiser_demo_section', array(
            'title'          => __( 'Default Demo Controls', 'ruxen' ),
            'priority'       => 35,
        ) );
    }

    private function custom_sections( $wp_manager )
    {
        $wp_manager->add_section( 'customiser_demo_custom_section', array(
            'title'          => __( 'Custom Controls Demo', 'ruxen' ),
            'priority'       => 36,
        ) );

        require_once dirname(__FILE__) . '/google-font-dropdown-custom-control.php';
        $wp_manager->add_setting( 'heading-font', array(
            'default'        => 'Roboto Slab',
			'sanitize_callback' => 'ruxen_santanize'
        ) );
		
        $wp_manager->add_control( new ruxen_Google_Font_Dropdown_Custom_Control( $wp_manager, 'heading-font', array(
            'label'   => __( 'Heading Font (Headings, buttons, form elements etc.)', 'ruxen' ),
            'section' => 'font',
            'settings'   => 'heading-font',
            'priority' => 12
        ) ) );
		
        $wp_manager->add_setting( 'text-font', array(
            'default'        => 'Roboto Condensed',
			'sanitize_callback' => 'ruxen_santanize'
        ) );
		
        $wp_manager->add_control( new ruxen_Google_Font_Dropdown_Custom_Control( $wp_manager, 'text-font', array(
            'label'   => __( 'Text Font', 'ruxen' ),
            'section' => 'font',
            'settings'   => 'text-font',
            'priority' => 12
        ) ) );
		
        $wp_manager->add_setting( 'menu-font', array(
            'default'        => 'Roboto Condensed',
			'sanitize_callback' => 'ruxen_santanize'
        ) );
		
        $wp_manager->add_control( new ruxen_Google_Font_Dropdown_Custom_Control( $wp_manager, 'menu-font', array(
            'label'   => __('Menu Font', 'ruxen' ),
            'section' => 'font',
            'settings'   => 'menu-font',
            'priority' => 12
        ) ) );
		
        $wp_manager->add_setting( 'single_title', array(
            'default'        => 'Roboto Condensed',
			'sanitize_callback' => 'ruxen_santanize'
        ) );
		
        $wp_manager->add_control( new ruxen_Google_Font_Dropdown_Custom_Control( $wp_manager, 'single_title', array(
            'label'   => __( 'Single Title', 'ruxen' ),
            'section' => 'font',
            'settings'   => 'single_title',
            'priority' => 12
        ) ) );
    }

}
/*-- FONT CUSTOMIZE END --*/

function ruxen_customizer( $wp_customize ) {
/*-- GENERAL START --*/
	$wp_customize->add_section( 'generalsettings', array(
        'title' => __( 'General', 'ruxen' ),
        'description' => 'Theme general settings..',
    ) );
	
/*-- SIDEBAR POSITION --*/
	$wp_customize->add_setting( 'sidebar_position', array(
			'default' => 'right',
			'sanitize_callback' => 'ruxen_santanize'
		) );
	 
	$wp_customize->add_control( 'sidebar_position', array(
			'type' => 'radio',
			'label' => __( 'General Sidebar', 'ruxen' ),
			'section' => 'generalsettings',
			'choices' => array(
				'left' => __( 'Left', 'ruxen' ),
				'right' => __( 'Right', 'ruxen' ),
				'nosidebar' => __( 'No Sidebar', 'ruxen' ),
			),
		) );
/*-- GENERAL END --*/

/*-- SLIDER SETTINGS START --*/
	$wp_customize->add_section( 'slider', array(
        'title' => __( 'Slider', 'ruxen' ),
        'description' => 'Theme general settings..',
    ) );
	
/*-- SLIDER HIDE --*/
	$wp_customize->add_setting( 'ruxen_hide_slider', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'ruxen_hide_slider', array(
        'type' => 'checkbox',
        'label' => __( 'Hide Slider', 'ruxen' ),
        'section' => 'slider',
    ) );
	
/*-- SLIDER TAG --*/
	$wp_customize->add_setting( 'slider_tag', array(
		'default' => 'slider',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'slider_tag', array(
		'label' => __( 'Slider Post Tag', 'ruxen' ),
		'section' => 'slider',
	) );
	
/*-- SLIDER LIMIT --*/
	$wp_customize->add_setting( 'slider_limit', array(
		'default' => '3',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'slider_limit', array(
		'label' => __( 'Slider Post Limit', 'ruxen' ),
		'section' => 'slider',
	) );
	
/*-- SLIDER TIME --*/
	$wp_customize->add_setting( 'slider_time', array(
		'default' => '4000',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'slider_time', array(
		'label' => __( 'Slider Transition Time', 'ruxen' ),
		'section' => 'slider',
	) );
	
/*-- SLIDER CATEGORY --*/
    $categories = get_categories();
	$cats = array();
	$i = 0;
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cats[$category->slug] = $category->name;
	}
 
	$wp_customize->add_setting('slider_category', array(
		'default'        => $default,
		'sanitize_callback' => 'ruxen_santanize'
	));
	$wp_customize->add_control( 'slider_category', array(
		'label'   => __( 'Select Category:', 'ruxen' ),
		'section'  => 'slider',
		'type'    => 'select',
		'choices' => $cats,
	));
	
/*-- SLIDER TYPE --*/
	$wp_customize->add_setting( 'slider_type', array(
			'default' => 'tags',
			'sanitize_callback' => 'ruxen_santanize'
		) );
	 
	$wp_customize->add_control( 'slider_type', array(
			'type' => 'radio',
			'label' => __( 'Slider Type', 'ruxen' ),
			'section' => 'slider',
			'choices' => array(
				'tags' => __( 'Tags', 'ruxen' ),
				'category' => __( 'Category', 'ruxen' ),
				'latestposts' => __( 'Latest Posts', 'ruxen' ),
			),
		) );
/*-- SLIDER SETTINGS END --*/

/*-- PAGE & POST SETINGS START --*/
	$wp_customize->add_section( 'pagepost', array(
        'title' => __( 'Page & Post', 'ruxen' ),
        'description' => 'Theme page and post settings..',
    ) );
	
/*-- POST BOTTOM HIDE --*/
	$wp_customize->add_setting( 'post_bottom_hide', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'post_bottom_hide', array(
        'type' => 'checkbox',
        'label' => __( 'Post Bottom Hide', 'ruxen' ),
        'section' => 'pagepost',
    ) );
	
/*-- RELATED POSTS HIDE --*/
	$wp_customize->add_setting( 'related_posts_hide', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'related_posts_hide', array(
        'type' => 'checkbox',
        'label' => __( 'Related Posts Hide', 'ruxen' ),
        'section' => 'pagepost',
    ) );
	
/*-- POST AUTHOR INFO HIDE --*/
	$wp_customize->add_setting( 'post_author_info_hide', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'post_author_info_hide', array(
        'type' => 'checkbox',
        'label' => __( 'Post Author Info Hide', 'ruxen' ),
        'section' => 'pagepost',
    ) );
	
/*-- POST CATEGORY HIDE --*/
	$wp_customize->add_setting( 'post_category_hide', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'post_category_hide', array(
        'type' => 'checkbox',
        'label' => __( 'Post Category Hide', 'ruxen' ),
        'section' => 'pagepost',
    ) );
	
/*-- POST NAVIGATION HIDE --*/
	$wp_customize->add_setting( 'post_navigation_hide', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'post_navigation_hide', array(
        'type' => 'checkbox',
        'label' => __( 'Post Navigation Hide', 'ruxen' ),
        'section' => 'pagepost',
    ) );
	
/*-- POST FEATURED IMAGE HIDE --*/
	$wp_customize->add_setting( 'post_featured_image_hide', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'post_featured_image_hide', array(
        'type' => 'checkbox',
        'label' => __( 'Post Featured Image Hide', 'ruxen' ),
        'section' => 'pagepost',
    ) );
	
/*-- POST COMMENT AREA HIDE --*/
	$wp_customize->add_setting( 'post_comment_hide', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'post_comment_hide', array(
        'type' => 'checkbox',
        'label' => __( 'Post Comment Area Hide', 'ruxen' ),
        'section' => 'pagepost',
    ) );
	
/*-- GOOGLE MAPS LAT --*/
	$wp_customize->add_setting( 'google_maps_lat', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'google_maps_lat', array(
		'label' => __( 'Google Maps Lat', 'ruxen' ),
        'section' => 'pagepost',
	) );
	
/*-- GOOGLE MAPS LNG --*/
	$wp_customize->add_setting( 'google_maps_lng', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'google_maps_lng', array(
		'label' => __( 'Google Maps Lng', 'ruxen' ),
        'section' => 'pagepost',
	) );
	
/*-- GOOGLE MAPS ZOOM --*/
	$wp_customize->add_setting( 'google_maps_zoom', array(
		'default' => '18',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'google_maps_zoom', array(
		'label' => __( 'Google Maps Zoom', 'ruxen' ),
        'type' => 'number',
        'section' => 'pagepost',
	) );
	
/*-- GOOGLE MAPS TEXT --*/
	$wp_customize->add_setting( 'google_maps_text', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'google_maps_text', array(
		'label' => __( 'Google Maps Title', 'ruxen' ),
        'section' => 'pagepost',
	) );
	
/*-- CONTACT PAGE FORM SHORTCODE --*/
	$wp_customize->add_setting( 'contact_form_shortcode', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'contact_form_shortcode', array(
		'label' => __( 'Contact Page Form Shortcode', 'ruxen' ),
        'section' => 'pagepost',
	) );
	
/*-- CONTACT PAGE ADDRESS --*/
	$wp_customize->add_setting( 'contact_page_address', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'contact_page_address', array(
		'label' => __( 'Contact Page Address', 'ruxen' ),
        'section' => 'pagepost',
	) );
	
/*-- CONTACT PAGE TELEPHONE 1 --*/
	$wp_customize->add_setting( 'contact_page_telephone1', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'contact_page_telephone1', array(
		'label' => __( 'Contact Page Telephone 1', 'ruxen' ),
        'type' => 'tel',
        'section' => 'pagepost',
	) );
	
/*-- CONTACT PAGE TELEPHONE 2 --*/
	$wp_customize->add_setting( 'contact_page_telephone2', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'contact_page_telephone2', array(
		'label' => __( 'Contact Page Telephone 2', 'ruxen' ),
        'type' => 'tel',
        'section' => 'pagepost',
	) );
	
/*-- CONTACT PAGE FAX --*/
	$wp_customize->add_setting( 'contact_page_fax', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'contact_page_fax', array(
		'label' => __( 'Contact Page Fax', 'ruxen' ),
        'type' => 'tel',
        'section' => 'pagepost',
	) );
	
/*-- CONTACT PAGE EMAIL --*/
	$wp_customize->add_setting( 'contact_page_email', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'contact_page_email', array(
		'label' => __( 'Contact Page Email', 'ruxen' ),
        'type' => 'email',
        'section' => 'pagepost',
	) );

/*-- CONTACT FORM HIDE SOCIAL MEDIA --*/
	$wp_customize->add_setting( 'contact_form_hide_social_media', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'contact_form_hide_social_media', array(
        'type' => 'checkbox',
        'label' => __( 'Contact Form Hide Social Media', 'ruxen' ),
        'section' => 'pagepost',
    ) );
/*-- PAGE & POST SETINGS END --*/

/*-- FONT START --*/
	$wp_customize->add_section( 'font', array(
        'title' => __( 'Font', 'ruxen' ),
        'description' => 'Theme font style..',
    ) );

/*-- FONT ITALICS --*/
	$wp_customize->add_setting( 'font_italic', array(
		'default' => '1',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'font_italic', array(
        'type' => 'checkbox',
        'label' => __( 'Include The Font Style Italic', 'ruxen' ),
        'section' => 'font',
    ) );

/*-- CYRILLIC EXT FONT --*/
	$wp_customize->add_setting( 'font_cyrillic_ext', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'font_cyrillic_ext', array(
        'type' => 'checkbox',
        'label' => __( 'Include Cyrillic Extended (cyrillic-ext)', 'ruxen' ),
        'section' => 'font',
		'priority' => 50,
    ) );

/*-- GREEK EXT FONT --*/
	$wp_customize->add_setting( 'font_greek_ext', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'font_greek_ext', array(
        'type' => 'checkbox',
        'label' => __( 'Include Greek Extended (greek-ext)', 'ruxen' ),
        'section' => 'font',
		'priority' => 50,
    ) );

/*-- GREEK FONT --*/
	$wp_customize->add_setting( 'font_greek', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'font_greek', array(
        'type' => 'checkbox',
        'label' => __( 'Include Greek (greek)', 'ruxen' ),
        'section' => 'font',
		'priority' => 50,
    ) );

/*-- VIETNAMESE FONT --*/
	$wp_customize->add_setting( 'font_vietnamese', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'font_vietnamese', array(
        'type' => 'checkbox',
        'label' => __( 'Include Vietnamese (vietnamese)', 'ruxen' ),
        'section' => 'font',
		'priority' => 50,
    ) );

/*-- CYRILLIC FONT --*/
	$wp_customize->add_setting( 'font_cyrillic', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'font_cyrillic', array(
        'type' => 'checkbox',
        'label' => __( 'Include Cyrillic (cyrillic)', 'ruxen' ),
        'section' => 'font',
		'priority' => 50,
    ) );
	
/*-- BODY FONT SIZE --*/
	$wp_customize->add_setting( 'body_font_size', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'body_font_size', array(
		'label' => __( 'Body Font Size', 'ruxen' ),
        'type' => 'number',
		'section' => 'font',
		'priority' => 60,
	) );
	
/*-- BODY LINE HEIGHT --*/
	$wp_customize->add_setting( 'body_line_height', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'body_line_height', array(
		'label' => __( 'Body Line Height', 'ruxen' ),
        'type' => 'number',
		'section' => 'font',
		'priority' => 60,
	) );
	
/*-- FORM ELEMENT TITLE SIZE --*/
	$wp_customize->add_setting( 'form_element_size', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'form_element_size', array(
		'label' => __( 'Form Element Font Size', 'ruxen' ),
        'type' => 'number',
		'section' => 'font',
		'priority' => 60,
	) );
	
/*-- WIDGET TITLE FONT SIZE --*/
	$wp_customize->add_setting( 'title_widget_font_size', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'title_widget_font_size', array(
		'label' => __( 'Widget Title Font Size', 'ruxen' ),
        'type' => 'number',
		'section' => 'font',
		'priority' => 60,
	) );
	
/*-- MENU FONT SIZE --*/
	$wp_customize->add_setting( 'menu_font_size', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'menu_font_size', array(
		'label' => __( 'Menu Font Size', 'ruxen' ),
        'type' => 'number',
		'section' => 'font',
		'priority' => 60,
	) );
	
/*-- SUB MENU FONT SIZE --*/
	$wp_customize->add_setting( 'sub_menu_font_size', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'sub_menu_font_size', array(
		'label' => __( 'Submenu Font Size', 'ruxen' ),
        'type' => 'number',
		'section' => 'font',
		'priority' => 60,
	) );
/*-- FONT END --*/

/*-- HEADER ELEMENT START --*/
	$wp_customize->add_section( 'headerelement', array(
        'title' => __( 'Header', 'ruxen' ),
        'description' => 'Theme header elements..',
    ) );
	
/*-- HEADER LOGO --*/
	$wp_customize->add_setting( 'ruxen_logo', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
 
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ruxen_logo', array(
        'label'    => __( 'Logo Upload', 'ruxen' ),
		'section' => 'headerelement',
    ) ) );
	
/*-- FAVICON --*/
	$wp_customize->add_setting( 'ruxen_favicon', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
 
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'ruxen_favicon', array(
        'label'    => __( 'Favicon Upload', 'ruxen' ),
		'section' => 'headerelement',
    ) ) );

/*-- TOP BORDER HIDE --*/
	$wp_customize->add_setting( 'ruxen_hide_topborder', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'ruxen_hide_topborder', array(
        'type' => 'checkbox',
        'label' => __( 'Hide Top Border', 'ruxen' ),
        'section' => 'headerelement',
    ) );

/*-- TOP BAR HIDE --*/
	$wp_customize->add_setting( 'ruxen_hide_header_search', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'ruxen_hide_header_search', array(
        'type' => 'checkbox',
        'label' => __( 'Hide Header Search', 'ruxen' ),
        'section' => 'headerelement',
    ) );
	
/*-- LOGO MARGIN --*/
	$wp_customize->add_setting( 'logo_top_margin', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'logo_top_margin', array(
		'label' => __( 'Logo Top Margin (px)', 'ruxen' ),
        'type' => 'number',
        'section' => 'headerelement',
	) );
	
/*-- LOGO HEIGHT --*/
	$wp_customize->add_setting( 'logo_height', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'logo_height', array(
		'label' => __( 'Logo Height (px)', 'ruxen' ),
        'type' => 'number',
        'section' => 'headerelement',
	) );
	
/*-- LOGO WIDTH --*/
	$wp_customize->add_setting( 'logo_width', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'logo_width', array(
		'label' => __( 'Logo Width (px)', 'ruxen' ),
        'type' => 'number',
        'section' => 'headerelement',
	) );
	
/*-- HEADER TOP --*/
	$wp_customize->add_setting( 'header_top', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'header_top', array(
		'label' => __( 'Header Top (Header slider get over it)', 'ruxen' ),
        'type' => 'checkbox',
        'section' => 'headerelement',
	) );
/*-- HEADER ELEMENT END --*/

/*-- SOCIAL MEDIA START --*/
	$wp_customize->add_section( 'socialmedia', array(
		'title' => __( 'Social Media', 'ruxen' ),
		'description' => 'Social media links..',
	) );
	
/*-- FACEBOOK --*/
	$wp_customize->add_setting( 'ruxen_facebook', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'ruxen_facebook', array(
		'label' => __( 'Facebook URL', 'ruxen' ),
		'section' => 'socialmedia',
	) );

/*-- GOOGLE PLUS --*/
	$wp_customize->add_setting( 'ruxen_googleplus', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'ruxen_googleplus', array(
		'label' => __( 'Google+ URL', 'ruxen' ),
		'section' => 'socialmedia',
	) );
	
/*-- INSTAGRAM --*/
	$wp_customize->add_setting( 'ruxen_instagram', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'ruxen_instagram', array(
		'label' => __( 'Instagram URL', 'ruxen' ),
		'section' => 'socialmedia',
	) );
	
/*-- LINKEDIN --*/
	$wp_customize->add_setting( 'ruxen_linkedin', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'ruxen_linkedin', array(
		'label' => __( 'Linkedin URL', 'ruxen' ),
		'section' => 'socialmedia',
	) );
	
/*-- VINE --*/
	$wp_customize->add_setting( 'ruxen_vine', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'ruxen_vine', array(
		'label' => __( 'Vine URL', 'ruxen' ),
		'section' => 'socialmedia',
	) );
		
/*-- TWITTER --*/
	$wp_customize->add_setting( 'ruxen_twitter', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'ruxen_twitter', array(
		'label' => __( 'Twitter URL', 'ruxen' ),
		'section' => 'socialmedia',
	) );
		
/*-- PINTEREST --*/
	$wp_customize->add_setting( 'ruxen_pinterest', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'ruxen_pinterest', array(
		'label' => __( 'Pinterest URL', 'ruxen' ),
		'section' => 'socialmedia',
	) );
		
/*-- RSS --*/
	$wp_customize->add_setting( 'ruxen_rss', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'ruxen_rss', array(
		'label' => __( 'RSS URL', 'ruxen' ),
		'section' => 'socialmedia',
	) );
	
/*-- YOUTUBE --*/
	$wp_customize->add_setting( 'ruxen_youtube', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'ruxen_youtube', array(
		'label' => __( 'YouTube URL', 'ruxen' ),
		'section' => 'socialmedia',
	) );
	
/*--  INSTAGRAM USER ID --*/
	$wp_customize->add_setting( 'instagram_user_id', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'instagram_user_id', array(
		'label' => __( 'Instagram User ID', 'ruxen' ),
		'section' => 'socialmedia',
	) );
	
/*--  INSTAGRAM ACCESS TOKEN --*/
	$wp_customize->add_setting( 'instagram_access_token', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'instagram_access_token', array(
		'label' => __( 'Instagram Access Token', 'ruxen' ),
		'section' => 'socialmedia',
	) );

/*-- FOOTER INSTAGRAM AREA HIDE --*/
	$wp_customize->add_setting( 'footer_instagram_hide', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'footer_instagram_hide', array(
        'type' => 'checkbox',
        'label' => __( 'Footer Instagram Area Hide', 'ruxen' ),
        'section' => 'socialmedia',
    ) );

/*-- SOCIAL SHARE HIDE --*/
	$wp_customize->add_setting( 'social_share_hide', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'social_share_hide', array(
        'type' => 'checkbox',
        'label' => __( 'Post Social Share Hide', 'ruxen' ),
        'section' => 'socialmedia',
    ) );

/*-- SOCIAL SHARE ICONS --*/
	$wp_customize->add_setting( 'social_share_facebook', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'social_share_facebook', array(
        'type' => 'checkbox',
        'label' => __( 'Facebook Share Hide', 'ruxen' ),
        'section' => 'socialmedia',
    ) );

	$wp_customize->add_setting( 'social_share_twitter', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'social_share_twitter', array(
        'type' => 'checkbox',
        'label' => __( 'Twitter Share Hide', 'ruxen' ),
        'section' => 'socialmedia',
    ) );

	$wp_customize->add_setting( 'social_share_googleplus', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'social_share_googleplus', array(
        'type' => 'checkbox',
        'label' => __( 'Google+ Share Hide', 'ruxen' ),
        'section' => 'socialmedia',
    ) );

	$wp_customize->add_setting( 'social_share_linkedin', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'social_share_linkedin', array(
        'type' => 'checkbox',
        'label' => __( 'Linkedin Share Hide', 'ruxen' ),
        'section' => 'socialmedia',
    ) );

	$wp_customize->add_setting( 'social_share_pinterest', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'social_share_pinterest', array(
        'type' => 'checkbox',
        'label' => __( 'Pinterest Share Hide', 'ruxen' ),
        'section' => 'socialmedia',
    ) );

	$wp_customize->add_setting( 'social_share_reddit', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'social_share_reddit', array(
        'type' => 'checkbox',
        'label' => __( 'Reddit Share Hide', 'ruxen' ),
        'section' => 'socialmedia',
    ) );

	$wp_customize->add_setting( 'social_share_delicious', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'social_share_delicious', array(
        'type' => 'checkbox',
        'label' => __( 'Delicious Share Hide', 'ruxen' ),
        'section' => 'socialmedia',
    ) );

	$wp_customize->add_setting( 'social_share_stumbleupon', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'social_share_stumbleupon', array(
        'type' => 'checkbox',
        'label' => __( 'Stumbleupon Share Hide', 'ruxen' ),
        'section' => 'socialmedia',
    ) );

	$wp_customize->add_setting( 'social_share_tumblr', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'social_share_tumblr', array(
        'type' => 'checkbox',
        'label' => __( 'Tumblr Share Hide', 'ruxen' ),
        'section' => 'socialmedia',
    ) );
/*-- SOCIAL MEDIA END  --*/

/*-- FOOTER START --*/	
	$wp_customize->add_section( 'footertext', array(
        'title' => __( 'Footer', 'ruxen' ),
        'description' => __( 'Theme footer elements..', 'ruxen' ),
    ) );

/*-- FOOTER TEXT  --*/
	$wp_customize->add_setting( 'ruxen_footer_text', array(
		'default' => __( 'Footer Text', 'ruxen' ),
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'ruxen_footer_text', array(
		'label' => __( 'Footer Text', 'ruxen' ),
		'section' => 'footertext'
	) );
	
/*-- FOOTER LOGO --*/
	$wp_customize->add_setting( 'footer_logo', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
 
    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'footer_logo', array(
        'label'    => __( 'Logo Upload', 'ruxen' ),
		'section' => 'footertext',
    ) ) );

/*-- FOOTER LOGO HIDE --*/
	$wp_customize->add_setting( 'ruxen_hide_footer_logo', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'ruxen_hide_footer_logo', array(
        'type' => 'checkbox',
        'label' => __( 'Hide Footer Logo', 'ruxen' ),
        'section' => 'footertext',
    ) );

/*-- FOOTER HIDE --*/
	$wp_customize->add_setting( 'ruxen_hide_footer', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'ruxen_hide_footer', array(
        'type' => 'checkbox',
        'label' => __( 'Hide Footer', 'ruxen' ),
        'section' => 'footertext',
    ) );

/*-- FOOTER SOCIAL MEDIA HIDE --*/
	$wp_customize->add_setting( 'ruxen_hide_footer_social_media', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'ruxen_hide_footer_social_media', array(
        'type' => 'checkbox',
        'label' => __( 'Hide Footer Social Media', 'ruxen' ),
        'section' => 'footertext',
    ) );

/*-- COPYRIGHT HIDE  --*/
	$wp_customize->add_setting( 'ruxen_hide_go_top', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'ruxen_hide_go_top', array(
        'type' => 'checkbox',
        'label' => __( 'Hide Go Top', 'ruxen' ),
        'section' => 'footertext',
    ) );
	
/*-- FOOTER END --*/	

/*-- CUSTOM COLOR START --*/	
/*-- THEME GENERAL COLOR --*/	
	$wp_customize->add_setting( 'theme_color', array(
		'default' => '#F83A3A',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'theme_color', array(
		'label' => __( 'Theme Color', 'ruxen' ),
		'section' => 'colors',
		'settings' => 'theme_color',
	) ) );
	
/*-- HEADER BACKGROUND --*/	
	$wp_customize->add_setting( 'header_background', array(
		'default' => '#FFFFFF',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'header_background', array(
		'label' => __( 'Header Background', 'ruxen' ),
		'section' => 'colors',
		'settings' => 'header_background',
	) ) );
	
/*-- FOOTER BACKGROUND --*/	
	$wp_customize->add_setting( 'footer_background', array(
		'default' => '#FFFFFF',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_background', array(
		'label' => __( 'Footer Background', 'ruxen' ),
		'section' => 'colors',
		'settings' => 'footer_background',
	) ) );
	
/*-- MENU LINK COLOR --*/	
	$wp_customize->add_setting( 'menu_link_color', array(
		'default' => '#666666',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_link_color', array(
		'label' => __( 'Menu Link Color', 'ruxen' ),
		'section' => 'colors',
		'settings' => 'menu_link_color',
	) ) );
	
/*-- MENU LINK HOVER COLOR --*/	
	$wp_customize->add_setting( 'menu_link_hover_color', array(
		'default' => '#F83A3A',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_link_hover_color', array(
		'label' => __( 'Menu Link Hover Color', 'ruxen' ),
		'section' => 'colors',
		'settings' => 'menu_link_hover_color',
	) ) );
	
/*-- TOP BORDER COLOR --*/	
	$wp_customize->add_setting( 'top_border_color', array(
		'default' => '#F83A3A',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'top_border_color', array(
		'label' => __( 'Top Border Color', 'ruxen' ),
		'section' => 'colors',
		'settings' => 'top_border_color',
	) ) );
	
/*-- GO TOP BACKGROUND COLOR --*/	
	$wp_customize->add_setting( 'go_top_background_color', array(
		'default' => '#676767',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'go_top_background_color', array(
		'label' => __( 'Go Top Background Color', 'ruxen' ),
		'section' => 'colors',
		'settings' => 'go_top_background_color',
	) ) );
	
/*-- GO TOP BACKGROUND COLOR --*/	
	$wp_customize->add_setting( 'footer_social_media_color', array(
		'default' => '#848383',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_social_media_color', array(
		'label' => __( 'Footer Social Media Color', 'ruxen' ),
		'section' => 'colors',
		'settings' => 'footer_social_media_color',
	) ) );
	
/*-- WIDGET TITLE COLOR --*/	
	$wp_customize->add_setting( 'sidebar_title_heading_color', array(
		'default' => '#F83A3A',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sidebar_title_heading_color', array(
		'label' => __( 'Widget Title Color', 'ruxen' ),
		'section' => 'colors',
		'settings' => 'sidebar_title_heading_color',
	) ) );
	
/*-- CATEGORY - Single TITLE & INFORMATION BACKGROUND COLOR --*/	
	$wp_customize->add_setting( 'category_title_info_bg_color', array(
		'default' => '#F83A3A',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'category_title_info_bg_color', array(
		'label' => __( 'Category - Single Title & Information Background Color', 'ruxen' ),
		'section' => 'colors',
		'settings' => 'category_title_info_bg_color',
	) ) );
	
/*-- CUSTOM THEME GRADIENT --*/	
	$wp_customize->add_setting( 'theme_gradient', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );
	
	$wp_customize->add_control( 'theme_gradient', array(
		'label' => __( 'Custom Gradient (CSS3 Code)', 'ruxen' ),
		'section' => 'colors',
		'type' => 'textarea',
	) );
/*-- CUSTOM COLOR END --*/	

/*-- CUSTOM CODE START --*/	
	$wp_customize->add_section( 'customcode', array(
        'title' => __( 'Custom Code', 'ruxen' ),
        'description' => __( 'Your custom code..', 'ruxen' ),
    ) );
	
/*-- CUSTOM CSS  --*/
	$wp_customize->add_setting( 'custom_css', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'custom_css', array(
		'label' => __( 'Custom CSS', 'ruxen' ),
        'type'       => 'textarea',
		'section' => 'customcode',
	) );
	
/*-- CUSTOM JS  --*/
	$wp_customize->add_setting( 'custom_js', array(
		'default' => '',
		'sanitize_callback' => 'ruxen_santanize'
	) );

	$wp_customize->add_control( 'custom_js', array(
		'label' => __( 'Custom JS', 'ruxen' ),
        'type'       => 'textarea',
		'section' => 'customcode',
	) );
/*-- CUSTOM CODE END --*/

}
add_action( 'customize_register', 'ruxen_customizer', 11 );

/*-- SOCIAL MEDIA TEMPLATE FUNCTION START --*/
function ruxen_footer_social_media_links() {
    
	$ruxen_hide_footer_social_media = get_theme_mod( 'ruxen_hide_footer_social_media' ); 
	if( $ruxen_hide_footer_social_media == '' ) :
		if( !get_theme_mod( 'ruxen_facebook' ) == "" or !get_theme_mod( 'ruxen_googleplus' ) == "" or !get_theme_mod( 'ruxen_instagram' ) == "" or !get_theme_mod( 'ruxen_linkedin' ) == "" or !get_theme_mod( 'ruxen_vine' ) == "" or !get_theme_mod( 'ruxen_twitter' ) == "" or !get_theme_mod( 'ruxen_youtube' ) == "" or !get_theme_mod( 'ruxen_pinterest' ) == "" or !get_theme_mod( 'ruxen_rss' ) == "" ) { ?>
			<ul class="footer-social-media">
				<?php if( !get_theme_mod( 'ruxen_facebook' ) == ""  ) { ?>
				<li><a href="<?php echo get_theme_mod( 'ruxen_facebook' ); ?>" title="<?php echo __( 'Facebook', 'ruxen' ); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
				<?php } ?>
				
				<?php if( !get_theme_mod( 'ruxen_googleplus' ) == ""  ) { ?>
				<li><a href="<?php echo get_theme_mod( 'ruxen_googleplus' ); ?>" title="<?php echo __( 'Google+', 'ruxen' ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
				<?php } ?>
				
				<?php if( !get_theme_mod( 'ruxen_instagram' ) == ""  ) { ?>
				<li><a href="<?php echo get_theme_mod( 'ruxen_instagram' ); ?>" title="<?php echo __( 'Instagram', 'ruxen' ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
				<?php } ?>
				
				<?php if( !get_theme_mod( 'ruxen_linkedin' ) == ""  ) { ?>
				<li><a href="<?php echo get_theme_mod( 'ruxen_linkedin' ); ?>" title="<?php echo __( 'Linkedin', 'ruxen' ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
				<?php } ?>
				
				<?php if( !get_theme_mod( 'ruxen_vine' ) == ""  ) { ?>
				<li><a href="<?php echo get_theme_mod( 'ruxen_vine' ); ?>" title="<?php echo __( 'Vine', 'ruxen' ); ?>" target="_blank"><i class="fa fa-vine"></i></a></li>
				<?php } ?>
				
				<?php if( !get_theme_mod( 'ruxen_twitter' ) == ""  ) { ?>
				<li><a href="<?php echo get_theme_mod( 'ruxen_twitter' ); ?>" title="<?php echo __( 'Twitter', 'ruxen' ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
				<?php } ?>
				
				<?php if( !get_theme_mod( 'ruxen_youtube' ) == ""  ) { ?>
				<li><a href="<?php echo get_theme_mod( 'ruxen_youtube' ); ?>" title="<?php echo __( 'YouTube', 'ruxen' ); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
				<?php } ?>
				
				<?php if( !get_theme_mod( 'ruxen_pinterest' ) == ""  ) { ?>
				<li><a href="<?php echo get_theme_mod( 'ruxen_pinterest' ); ?>" title="<?php echo __( 'Pinterest', 'ruxen' ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
				<?php } ?>
				
				<?php if( !get_theme_mod( 'ruxen_rss' ) == ""  ) { ?>
				<li><a href="<?php echo get_theme_mod( 'ruxen_rss' ); ?>" title="<?php echo __( 'RSS', 'ruxen' ); ?>" target="_blank"><i class="fa fa-rss"></i></a></li>
				<?php } ?>
			</ul>
		<?php }
	endif;
}

function ruxen_contact_social_media_links() {
    
	if( !get_theme_mod( 'ruxen_facebook' ) == "" or !get_theme_mod( 'ruxen_googleplus' ) == "" or !get_theme_mod( 'ruxen_instagram' ) == "" or !get_theme_mod( 'ruxen_linkedin' ) == "" or !get_theme_mod( 'ruxen_vine' ) == "" or !get_theme_mod( 'ruxen_twitter' ) == "" or !get_theme_mod( 'ruxen_youtube' ) == "" or !get_theme_mod( 'ruxen_pinterest' ) == "" or !get_theme_mod( 'ruxen_rss' ) == "" ) { ?>
		<ul class="social-media-page-link">
			<?php if( !get_theme_mod( 'ruxen_facebook' ) == ""  ) { ?>
			<li><a href="<?php echo get_theme_mod( 'ruxen_facebook' ); ?>" title="<?php echo __( 'Facebook', 'ruxen' ); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
			<?php } ?>
			
			<?php if( !get_theme_mod( 'ruxen_googleplus' ) == ""  ) { ?>
			<li><a href="<?php echo get_theme_mod( 'ruxen_googleplus' ); ?>" title="<?php echo __( 'Google+', 'ruxen' ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
			<?php } ?>
			
			<?php if( !get_theme_mod( 'ruxen_instagram' ) == ""  ) { ?>
			<li><a href="<?php echo get_theme_mod( 'ruxen_instagram' ); ?>" title="<?php echo __( 'Instagram', 'ruxen' ); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
			<?php } ?>
			
			<?php if( !get_theme_mod( 'ruxen_linkedin' ) == ""  ) { ?>
			<li><a href="<?php echo get_theme_mod( 'ruxen_linkedin' ); ?>" title="<?php echo __( 'Linkedin', 'ruxen' ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
			<?php } ?>
			
			<?php if( !get_theme_mod( 'ruxen_vine' ) == ""  ) { ?>
			<li><a href="<?php echo get_theme_mod( 'ruxen_vine' ); ?>" title="<?php echo __( 'Vine', 'ruxen' ); ?>" target="_blank"><i class="fa fa-vine"></i></a></li>
			<?php } ?>
			
			<?php if( !get_theme_mod( 'ruxen_twitter' ) == ""  ) { ?>
			<li><a href="<?php echo get_theme_mod( 'ruxen_twitter' ); ?>" title="<?php echo __( 'Twitter', 'ruxen' ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
			<?php } ?>
			
			<?php if( !get_theme_mod( 'ruxen_youtube' ) == ""  ) { ?>
			<li><a href="<?php echo get_theme_mod( 'ruxen_youtube' ); ?>" title="<?php echo __( 'YouTube', 'ruxen' ); ?>" target="_blank"><i class="fa fa-youtube"></i></a></li>
			<?php } ?>
			
			<?php if( !get_theme_mod( 'ruxen_pinterest' ) == ""  ) { ?>
			<li><a href="<?php echo get_theme_mod( 'ruxen_pinterest' ); ?>" title="<?php echo __( 'Pinterest', 'ruxen' ); ?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
			<?php } ?>
			
			<?php if( !get_theme_mod( 'ruxen_rss' ) == ""  ) { ?>
			<li><a href="<?php echo get_theme_mod( 'ruxen_rss' ); ?>" title="<?php echo __( 'RSS', 'ruxen' ); ?>" target="_blank"><i class="fa fa-rss"></i></a></li>
			<?php } ?>
		</ul>
	<?php }
}
/*-- SOCIAL MEDIA TEMPLATE FUNCTION END --*/

/*-- FOOTER TEXT FUNCTION START --*/
function ruxen_footer_text() {
	if( !get_theme_mod( 'ruxen_footer_text' ) == ""  ) { ?>
		<p><?php echo get_theme_mod( 'ruxen_footer_text' ); ?></p>
	<?php }
}
/*-- FOOTER TEXT FUNCTION END --*/

/*------------- FAVICON START -------------*/
function ruxen_favicon() {
	?>
		<?php
		$ruxen_favicon = get_theme_mod( 'ruxen_favicon' );
		if( !$ruxen_favicon == ""  ) { ?>
		<link rel="shortcut icon" href="<?php echo get_theme_mod( 'ruxen_favicon' ); ?>" />
		<?php } else { ?>
		<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" />
		<?php } ?>
	<?php
}
/*------------- FAVICON END -------------*/

/*-- THEME CUSTOM STYLE  FUNCTION START --*/
function ruxen_custom_style() {
	?>
		<style type="text/css">
			<?php
			/*-- CUSTOM FONT START --*/
			$menu_font = get_theme_mod( 'menu-font' );
			$heading_font = get_theme_mod( 'heading-font' );
			$text_font = get_theme_mod( 'text-font' );
			$single_title = get_theme_mod( 'single_title' );
			
			$font_italic = get_theme_mod( 'font_italic' );
			if( $font_italic == '1' ):
				$font_italic = '900italic,800italic,700italic,600italic,500italic,400italic,300italic,200italic,100italic';
			else:
				$font_italic = '';
			endif;
			
			$font_cyrillic_ext = get_theme_mod( 'font_cyrillic_ext' );
			if( $font_cyrillic_ext == '1' ):
				$font_cyrillic_ext = ',cyrillic-ext';
			else:
				$font_cyrillic_ext = '';
			endif;
			
			$font_greek_ext = get_theme_mod( 'font_greek_ext' );
			if( $font_greek_ext == '1' ):
				$font_greek_ext = ',greek-ext';
			else:
				$font_greek_ext = '';
			endif;
			
			$font_greek = get_theme_mod( 'font_greek' );
			if( $font_greek == '1' ):
				$font_greek = ',greek';
			else:
				$font_greek = '';
			endif;
			
			$font_vietnamese = get_theme_mod( 'font_vietnamese' );
			if( $font_vietnamese == '1' ):
				$font_vietnamese = ',vietnamese';
			else:
				$font_vietnamese = '';
			endif;
			
			$font_cyrillic = get_theme_mod( 'font_cyrillic' );
			if( $font_cyrillic == '1' ):
				$font_cyrillic = ',cyrillic';
			else:
				$font_cyrillic = '';
			endif;
			
			$font_character_set_select = $font_cyrillic_ext . $font_greek_ext . $font_greek . $font_vietnamese . $font_cyrillic;
			
			if( !$menu_font == '' ):
				$google_menu_font = str_replace(' ', '+', $menu_font);
				?>
					@import url(https://fonts.googleapis.com/css?family=<?php echo esc_attr( $google_menu_font ); ?>:<?php echo esc_attr( $font_italic ); ?>00,800,700,600,500,400,300,200,100&subset=latin,latin-ext<?php echo esc_attr( $font_character_set_select ); ?>);
				<?php
			endif;
			
			if( !$heading_font == '' ):
				$google_heading_font = str_replace(' ', '+', $heading_font);
				?>
					@import url(https://fonts.googleapis.com/css?family=<?php echo esc_attr( $google_heading_font ); ?>:<?php echo esc_attr( $font_italic ); ?>00,800,700,600,500,400,300,200,100&subset=latin,latin-ext<?php echo esc_attr( $font_character_set_select ); ?>);
				<?php
			endif;
			
			if( !$text_font == '' ):
				$google_text_font = str_replace(' ', '+', $text_font);
				?>
					@import url(https://fonts.googleapis.com/css?family=<?php echo esc_attr( $google_text_font ); ?>:<?php echo esc_attr( $font_italic ); ?>00,800,700,600,500,400,300,200,100&subset=latin,latin-ext<?php echo esc_attr( $font_character_set_select ); ?>);
				<?php
			endif;
			
			if( !$single_title == '' ):
				$google_single_title = str_replace(' ', '+', $single_title);
				?>
					@import url(https://fonts.googleapis.com/css?family=<?php echo esc_attr( $google_single_title ); ?>:<?php echo esc_attr( $font_italic ); ?>00,800,700,600,500,400,300,200,100&subset=latin,latin-ext<?php echo esc_attr( $font_character_set_select ); ?>);
				<?php
			endif;
			
			if( !$heading_font == '' ):
				$google_heading_font = str_replace(' ', '+', $heading_font);
				?>
					.nav-tabs>li>a, .content-404-page a.more, .content-404-page a.more:visited, .contact-form-content .btn-danger, .contact-form-content .btn-danger.focus, .category-list article a.more, .category-list article a.more:visited, .tree-grid-content article a.more, .tree-grid-content article a.more:visited, .two-grid-content article .more, .two-grid-content article .more:visited, .boxed-grid-content article a.more, .boxed-grid-content article a.more:visited, .comment-list li cite, .post-nav .pager li>a .pager-post-name, .widget_mc4wp_widget .btn-danger, .widget_mc4wp_widget .btn-danger.focus, .widget_mc4wp_widget .btn-danger:focus, .widget_mc4wp_widget .btn-danger:hover, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .comment-form .btn-danger, .comment-form .btn-danger.focus, .comment-form .btn-danger:focus, .comment-form .btn-danger:hover, input[type="email"], input[type="number"], input[type="password"], input[type="tel"], input[type="url"], input[type="text"], input[type="time"], input[type="week"], input[type="search"], input[type="month"], input[type="datetime"], input[type="date"], textarea, textarea.form-control, select, .woocommerce form .woocommerce-validated .select2-container, .woocommerce form .woocommerce-shipping-fields .select2-container, .woocommerce form .form-row .select2-container, .form-control, section.category-archive-title h1 span, h1, h2, h3, h4, h5, h6, h7, .full-grid-content article .more, .slider-area a.more, .comments-title, .comment-reply-title, .woocommerce div.product h4, .product-category h4, .comment-list li .commentmetadata, .comment-list li  .reply a, .comment-list li  .reply a:visited, .post .single-top-info, section.category-archive-title h1 span {
						font-family: '<?php echo esc_attr( $heading_font ); ?>';
					}
				<?php
			endif;
			
			if( !$text_font == '' ):
				$google_text_font = str_replace(' ', '+', $text_font);
				?>
					#tribe-events-content .tribe-events-calendar div[id*=tribe-events-event-] h3.tribe-events-month-event-title, .post-list-information, body, .sidebar .widget-title h4, .post-in-category h6, .post-in-tag h6, .post-author .author-info-description h4 {
						font-family: '<?php echo esc_attr( $text_font ); ?>';
					}
				<?php
			endif;
			
			if( !$menu_font == '' ):
				$google_menu_font = str_replace(' ', '+', $menu_font);
				?>
					 .footer .nav>li>a, .footer .nav>li>a:visited, .header .dropdown-menu>li>a, .header .navbar {
						font-family: '<?php echo esc_attr( $menu_font ); ?>';
					}
				<?php
			endif;
			
			if( !$single_title == '' ):
				$google_menu_font = str_replace(' ', '+', $single_title);
				?>
					 .category-list .single-title h1, .post .single-title h1 {
						font-family: '<?php echo esc_attr( $single_title ); ?>';
					}
				<?php
			endif;
			
			$body_font_size = get_theme_mod( 'body_font_size' );
			if( !$body_font_size == '' ):
				?>
					body, .post-share .post-in-category a, .post-share .post-in-category a:visited, .post-nav, .category-list article a.more, .category-list article a.more:visited, .pagination>li>a, .pagination>li>a:visited, .tagcloud a, .tagcloud a:visited, .footer p, .footer p {
						font-size: <?php echo esc_attr( $body_font_size ); ?>px;
					}
				<?php
			endif;
			
			$body_line_height = get_theme_mod( 'body_line_height' );
			if( !$body_line_height == '' ):
				?>
					body {
						line-height: <?php echo esc_attr( $body_line_height ); ?>px;
					}
				<?php
			endif;
			
			$content_title_size = get_theme_mod( 'content_title_size' );
			if( !$content_title_size == '' ):
				?>
					{
						font-size: <?php echo esc_attr( $content_title_size ); ?>px;
					}
				<?php
			endif;
			
			$form_element_size = get_theme_mod( 'form_element_size' );
			if( !$form_element_size == '' ):
				?>
					input[type="email"], input[type="number"], input[type="password"], input[type="tel"], input[type="url"], input[type="text"], input[type="time"], input[type="week"], input[type="search"], input[type="month"], input[type="datetime"], input[type="date"], textarea, textarea.form-control, select, .woocommerce form .woocommerce-validated .select2-container, .woocommerce form .woocommerce-shipping-fields .select2-container, .woocommerce form .form-row .select2-container {
						font-size: <?php echo esc_attr( $form_element_size ); ?>px;
					}
				<?php
			endif;
			
			$menu_font_size = get_theme_mod( 'menu_font_size' );
			if( !$menu_font_size == '' ):
				?>
					@media (min-width: 992px) {
						.header .navbar-nav>li>a, .header .navbar-nav>li>a:visited {
							font-size: <?php echo esc_attr( $menu_font_size ); ?>px;
						}
					}
					
					@media (max-width: 991px) {
						.header .navbar-nav>li>a, .header .navbar-nav>li>a:visited {
							font-size: <?php echo esc_attr( $menu_font_size ); ?>px;
						}
					}
				<?php
			endif;
			
			$sub_menu_font_size = get_theme_mod( 'sub_menu_font_size' );
			if( !$sub_menu_font_size == '' ):
				?>
					.header .dropdown-menu>li>a {
						font-size: <?php echo esc_attr( $sub_menu_font_size ); ?>px;
					}
				<?php
			endif;
			
			$title_widget_font_size = get_theme_mod( 'title_widget_font_size' );
			if( !$title_widget_font_size == '' ):
				?>
					.sidebar .widget-title h4 {
						font-size: <?php echo esc_attr( $title_widget_font_size ); ?>px;
					}
				<?php
			endif;
			/*-- CUSTOM FONT END --*/
			
				$ruxen_hide_footer = get_theme_mod( 'ruxen_hide_footer' ); 
				if( $ruxen_hide_footer == '1' ) :
				?>
				.footer {
					display:none;
				}
			<?php endif; 
				$theme_color = get_theme_mod( 'theme_color' ); 
				if( !$theme_color == '' ) :
				?>
				body .site-content-wrapper #tribe-events .tribe-events-button, body .site-content-wrapper .tribe-events-button, .widget_product_search input[type="submit"], .category-list article a.more, .category-list article a.more:visited, .category-list .single-top-info, .category-list .single_title h1, .post-link .post-link-area:hover h4 i, .page-links span, .post-related .related-post-info, .post .single-top-info, .post .single_title h1, .comment-form .btn-danger, .comment-form .btn-danger.focus, .comment-form .btn-danger:focus, .comment-form .btn-danger:hover, .content-404-page a.more, .content-404-page a.more:visited, .tree-grid-content article a.more, .tree-grid-content article a.more:visited, .tree-grid-content .tree-grid-item:hover .tree-grid-item-content .full-grid-title h2, .two-grid-content article .more, .two-grid-content article .more:visited, .two-grid-content article:hover .two-grid-item-content .two-grid-title h2, .boxed-grid-content article a.more, .boxed-grid-content article a.more:visited, .boxed-grid-content .boxed-grid-item:hover .boxed-grid-item-content .full-grid-title h2, .full-grid-content article:hover .full-grid-title h2, .slider-area a.more, .slider-area a.more:visited, .slider-area .carousel-caption .slider-post-title span.slider-post-title-top, .header .header-search-form button, .search-form-widget button#searchsubmit, .widget_mc4wp_widget .btn-danger, .widget_mc4wp_widget .btn-danger.focus, .widget_mc4wp_widget .btn-danger:focus, .widget_mc4wp_widget .btn-danger:hover, .latest-posts-widget .latest-posts-widget-info, .contact-form-content .btn-danger, .contact-form-content .btn-danger.focus, ul.social-media-page-link li a, ul.social-media-page-link li a:visited, .pagination>li>a, .pagination>li>span, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt {
					background:<?php echo esc_attr( $theme_color ); ?>;
				}
				
				#tribe-events .tribe-events-button, #tribe-events .tribe-events-button:hover, #tribe_events_filters_wrapper input[type=submit], .tribe-events-button, .tribe-events-button.tribe-active:hover, .tribe-events-button.tribe-inactive, .tribe-events-button:hover, .tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-], .tribe-events-calendar td.tribe-events-present div[id*=tribe-events-daynum-]>a, .site-content-wrapper .tribe-events-calendar thead th, .woocommerce span.onsale, .woocommerce .widget_price_filter .ui-slider .ui-slider-range, .woocommerce .widget_price_filter .ui-slider .ui-slider-handle, .header .navbar-toggle, .pagination>.active>a, .pagination>.active>a:focus, .pagination>li>a:hover, .pagination>li>a:focus, .pagination>li>a, .pagination>li>a:visited, .nicescroll-cursors, .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover{
					background-color:<?php echo esc_attr( $theme_color ); ?> !important;
				}
				
				.comment-list li cite, #tribe-events-content .tribe-events-tooltip h4, #tribe_events_filters_wrapper .tribe_events_slider_val, .single-tribe_events a.tribe-events-gcal, .single-tribe_events a.tribe-events-ical, .tree-grid-content .tree-grid-item:hover .tree-grid-item-content .post-list-information, .prices, .woocommerce ul.cart_list li del, .woocommerce ul.cart_list li .amount, .woocommerce ul.cart_list li ins, .woocommerce ul.product_list_widget li del, .woocommerce ul.product_list_widget li ins, .woocommerce ul.product_list_widget li .amount, .woocommerce div.product p.price, .woocommerce div.product span.price, .category-list article a.more:hover, .category-list article a.more:focus, section.category-archive-title h1 span, .page-links a:hover span, .page-links a:focus span, .page-links span:hover, .page-links span:focus, .post-author .author-info-description h4, .post-nav .pager li>a .pager-post-name:hover, .post-nav .pager li>a .pager-post-name:focus, .post-in-tag h6, .post-in-category h6, .comment-list li cite a, .comment-list li cite a:visited, .comments-title i, .comment-reply-title i, .content-404-page a.more:hover, .content-404-page a.more:focus, .content-404-page h1, .shortcode-page-title, .tree-grid-content article a.more:hover, .tree-grid-content article a.more:focus, .two-grid-content article .more:hover, .two-grid-content article .more:focus, .two-grid-content article:hover .post-list-information, .boxed-grid-content article a.more:hover, .boxed-grid-content article a.more:focus, .boxed-grid-content .boxed-grid-item:hover .boxed-grid-item-content .post-list-information, .full-grid-content article .more, .full-grid-content article:hover .post-list-information, .slider-area a.more:hover, .slider-area a.more:focus, .header .header-search-form button:hover, .search-form-widget button#searchsubmit:hover, .latest-tweets ul li a, .latest-tweets ul li a:visited, .latest-tweets ul li span, .latest-tweets .fa-twitter, .contact-form-content .btn-danger:focus, .contact-form-content .btn-danger:hover, ul.social-media-page-link li a:hover, ul.social-media-page-link li a:focus, section.content-full-banner h1 span, .contact-information-list li i{
					color:<?php echo esc_attr( $theme_color ); ?>;
				}	
				
				.site-content-wrapper .tribe-events-calendar thead th, .widget_product_search input[type="submit"], .widget_product_search .search-field, .category-list article a.more:hover, .category-list article a.more:focus, .page-links a:hover span, .page-links a:focus span, .page-links a span, .page-links a:visited span, .page-links span:hover, .page-links span:focus, .comment-form .btn-danger, .comment-form .btn-danger.focus, .comment-form .btn-danger:focus, .comment-form .btn-danger:hover, .tree-grid-content article a.more:hover, .tree-grid-content article a.more:focus, .boxed-grid-content article a.more:hover, .boxed-grid-content article a.more:focus, .search-form-widget button#searchsubmit, .search-form-widget .searchform-text, .contact-form-content .btn-danger:focus, .contact-form-content .btn-danger:hover, .contact-form-content .btn-danger, .contact-form-content .btn-danger.focus, ul.social-media-page-link li a:hover, ul.social-media-page-link li a:focus, .pagination>li>a, .pagination>li>span, .pagination>.active>a, .pagination>.active>a:focus, .pagination>li>a:hover, .pagination>li>a:focus, .pagination>li>a, .pagination>li>a:visited, .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
					border-color:<?php echo esc_attr( $theme_color ); ?>;
				}
				
				.header, body .loader-wrapper .loader:after, body .loader-wrapper .loader, body .loader-wrapper .loader:before {
					border-top-color:<?php echo esc_attr( $theme_color ); ?>;
				}
				
				.full-grid-content article .more {
					border-bottom-color:<?php echo esc_attr( $theme_color ); ?>;
				}
				
				@media (min-width:768px) {
					.header .navbar-nav>li>a:focus, .header .navbar-nav>li>a:hover {
						color:<?php echo esc_attr( $theme_color ); ?>;
					}
				}
				
				.slider-area a.more:hover, .slider-area a.more:focus {
					background: #FFF;
				}
				
				.tree-grid-content article a.more:hover, .tree-grid-content article a.more:focus {
					background: #FFF;
				}
				
				.boxed-grid-content article a.more:hover, .boxed-grid-content article a.more:focus {
					background: #FFF;
				}
				
				.content-404-page a.more:hover, .content-404-page a.more:focus {
					background: #FFF;
				}
				
				<?php 
					$header_top = get_theme_mod( 'header_top' );
					if( !$header_top == '' ):
				?>
				.slider-area {
					margin-bottom: 5px;
				}
				<?php
					endif;
				?>
				
				<?php
					$header_background = get_theme_mod( 'header_background' ); 
					if( !$header_background == '' ) :
				?>
				.header {
					background:<?php echo get_theme_mod( 'header_background' ); ?>;
				}
				<?php
					endif;
				?>
				
				<?php
					$footer_background = get_theme_mod( 'footer_background' ); 
					if( !$footer_background == '' ) :
				?>
				.footer {
					background:<?php echo get_theme_mod( 'footer_background' ); ?>;
				}
				<?php
					endif;
				?>
				
				<?php
					$menu_link_color = get_theme_mod( 'menu_link_color' ); 
					if( !$menu_link_color == '' ) :
				?>
				@media (min-width: 768px) {
					.header .navbar-nav>li>a, .header .navbar-nav>li>a:visited {
						color:<?php echo get_theme_mod( 'menu_link_color' ); ?>;
					}
				}
				
				.header .dropdown-menu>li>a {
					color:<?php echo get_theme_mod( 'menu_link_color' ); ?>;
				}
				<?php
					endif;
				?>
				
				<?php
					$menu_link_hover_color = get_theme_mod( 'menu_link_hover_color' ); 
					if( !$menu_link_hover_color == '' ) :
				?>
				@media (min-width: 768px) {
					.header .navbar-nav>li>a:focus, .header .navbar-nav>li>a:hover {
						color:<?php echo get_theme_mod( 'menu_link_hover_color' ); ?>;
					}
				}
				<?php
					endif;
				?>
				
				<?php
					$scroll_color = get_theme_mod( 'scroll_color' ); 
					if( !$scroll_color == '' ) :
				?>
				.nicescroll-cursors {
					background-color: <?php echo get_theme_mod( 'scroll_color' ); ?> !important;
				}
				<?php
					endif;
				?>
				
				<?php
					$top_border_color = get_theme_mod( 'top_border_color' ); 
					if( !$top_border_color == '' ) :
				?>
				.header {
					border-top-color: <?php echo get_theme_mod( 'top_border_color' ); ?>;
				}
				<?php
					endif;
				?>
				
				<?php
					$go_top_background_color = get_theme_mod( 'go_top_background_color' ); 
					if( !$go_top_background_color == '' ) :
				?>
				.footer-bottom {
					background-color: <?php echo get_theme_mod( 'go_top_background_color' ); ?>;
				}
				
				.top-icon {
					background-color: <?php echo get_theme_mod( 'go_top_background_color' ); ?>;
				}
				<?php
					endif;
				?>
				
				<?php
					$footer_social_media_color = get_theme_mod( 'footer_social_media_color' ); 
					if( !$footer_social_media_color == '' ) :
				?>
				ul.footer-social-media li a, ul.footer-social-media li a:visited {
					color: <?php echo get_theme_mod( 'footer_social_media_color' ); ?>;
				}
				<?php
					endif;
				?>
				
				<?php
					$sidebar_title_heading_color = get_theme_mod( 'sidebar_title_heading_color' ); 
					if( !$sidebar_title_heading_color == '' ) :
				?>
				.sidebar .widget-title h4 {
					color: <?php echo get_theme_mod( 'sidebar_title_heading_color' ); ?>;
					border-bottom-color: <?php echo get_theme_mod( 'sidebar_title_heading_color' ); ?>;
				}
				<?php
					endif;
				?>
				
				<?php
					$category_title_info_bg_color = get_theme_mod( 'category_title_info_bg_color' ); 
					if( !$category_title_info_bg_color == '' ) :
				?>
				.post .single-title h1, .category-list .single_title h1, .post .single_title h1 {
					background: <?php echo get_theme_mod( 'category_title_info_bg_color' ); ?>;
				}
				
				.category-list .single-top-info, .post .single-top-info {
					background: <?php echo get_theme_mod( 'category_title_info_bg_color' ); ?>;
				}
				<?php
					endif;
				?>
				
				<?php
					$theme_gradient = get_theme_mod( 'theme_gradient' ); 
					if( !$theme_gradient == '' ) :
				?>
				.slider-bg-img:after, .content-full-banner:before, .full-grid-content article:hover:before, .boxed-grid-content article:hover .boxed-grid-item a:before, .tree-grid-content article:hover .tree-grid-item a:before, .post-link-area:before, .two-grid-content article a:hover .two-grid-image:before {
					<?php echo get_theme_mod( 'theme_gradient' ); ?>
				}
				
				<?php
					endif;
				?>
				
			<?php endif;
			
				$ruxen_hide_topborder = get_theme_mod( 'ruxen_hide_topborder' );
				if( !$ruxen_hide_topborder == '' ) :
				?>
				.header {
					border-top:none;
				}
			<?php endif; ?>
			<?php
				$logo_width = get_theme_mod( 'logo_width' );
				$logo_height = get_theme_mod( 'logo_height' );
				$logo_top_margin = get_theme_mod( 'logo_top_margin' );
				if( !$logo_width == '' or !$logo_height == '' ):
			?>
				a.site-logo img {
					height:<?php echo $logo_height; ?>px;
					width:<?php echo $logo_width; ?>px;
				}
			<?php
				endif;
				if( !$logo_top_margin == '' ):
					?>
				a.site-logo {
					margin-top:<?php echo $logo_top_margin; ?>px
				}
			<?php
				endif;
			?>
			<?php
				$custom_css = get_theme_mod( 'custom_css' );
				if( !$custom_css == '' ):
					echo esc_attr( $custom_css );
				endif;
			?>
		</style>
		
		<?php
		$custom_js = get_theme_mod( 'custom_js' );
		if( !$custom_js == '' ):
		?>
			<script type="text/javascript">
				<?php echo esc_js( $custom_js ); ?>
			</script>
		<?php endif; ?>
<?php
}
add_action( 'wp_head', 'ruxen_custom_style' );
/*-- THEME CUSTOM STYLE FUNCTION END --*/

/*------------- POST SOCIAL SHARE START -------------*/
function ruxen_post_social_share() {
	$social_share_hide = get_theme_mod( 'social_share_hide' );
	$social_share_facebook = get_theme_mod( 'social_share_facebook' );
	$social_share_twitter = get_theme_mod( 'social_share_twitter' );
	$social_share_googleplus = get_theme_mod( 'social_share_googleplus' );
	$social_share_linkedin = get_theme_mod( 'social_share_linkedin' );
	$social_share_pinterest = get_theme_mod( 'social_share_pinterest' );
	$social_share_reddit = get_theme_mod( 'social_share_reddit' );
	$social_share_delicious = get_theme_mod( 'social_share_delicious' );
	$social_share_stumbleupon = get_theme_mod( 'social_share_stumbleupon' );
	$social_share_tumblr = get_theme_mod( 'social_share_tumblr' );
	$social_share_link_title = __( 'Share to', 'ruxen' );
	if( !$social_share_hide == '1' ) :
	?>
		<div class="post-social-share">
			<ul>
				<?php if( !$social_share_facebook == '1' ) : ?><li><a class="share-facebook"  href="https://www.facebook.com/sharer/sharer.php?u=<?php echo the_permalink(); ?>&t=<?php the_title(); ?>" title="<?php echo esc_attr( $social_share_link_title ); ?> <?php echo __( 'Facebook', 'ruxen' ); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li><?php endif; ?>
				<?php if( !$social_share_twitter == '1' ) : ?><li><a class="share-twitter"  href="https://twitter.com/intent/tweet?url=<?php echo the_permalink(); ?>&text=<?php the_title(); ?>" title="<?php echo esc_attr( $social_share_link_title ); ?> <?php echo __( 'Twitter', 'ruxen' ); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li><?php endif; ?>
				<?php if( !$social_share_googleplus == '1' ) : ?><li><a class="share-googleplus"  href="https://plus.google.com/share?url=<?php echo the_permalink(); ?>" title="<?php echo esc_attr( $social_share_link_title ); ?> <?php echo __( 'Google+', 'ruxen' ); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li><?php endif; ?>
				<?php if( !$social_share_linkedin == '1' ) : ?><li><a class="share-linkedin"  href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo the_permalink(); ?>&title=<?php the_title(); ?>" title="<?php echo esc_attr( $social_share_link_title ); ?> <?php echo __( 'Linkedin', 'ruxen' ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li><?php endif; ?>
				<?php if( !$social_share_pinterest == '1' ) : ?><li><a class="share-pinterest"  href="https://pinterest.com/pin/create/button/?url=<?php echo the_permalink(); ?>&description=<?php the_title(); ?>" title="<?php echo esc_attr( $social_share_link_title ); ?> <?php echo __( 'Pinterest', 'ruxen' ); ?>" target="_blank"><i class="fa fa-pinterest-p"></i></a></li><?php endif; ?>
				<?php if( !$social_share_reddit == '1' ) : ?><li><a class="share-reddit"  href="http://reddit.com/submit?url=<?php echo the_permalink(); ?>&title=<?php the_title(); ?>" title="<?php echo esc_attr( $social_share_link_title ); ?> <?php echo __( 'Reddit', 'ruxen' ); ?>" target="_blank"><i class="fa fa-reddit"></i></a></li><?php endif; ?>
				<?php if( !$social_share_delicious == '1' ) : ?><li><a class="share-delicious"  href="http://del.icio.us/post?url=<?php echo the_permalink(); ?>" title="<?php echo esc_attr( $social_share_link_title ); ?> <?php echo __( 'Delicious', 'ruxen' ); ?>" target="_blank"><i class="fa fa-delicious"></i></a></li><?php endif; ?>
				<?php if( !$social_share_stumbleupon == '1' ) : ?><li><a class="share-stumbleupon"  href="http://www.stumbleupon.com/submit?url=<?php echo the_permalink(); ?>&title=<?php the_title(); ?>" title="<?php echo esc_attr( $social_share_link_title ); ?> <?php echo __( 'Stumbleupon', 'ruxen' ); ?>" target="_blank"><i class="fa fa-stumbleupon"></i></a></li><?php endif; ?>
				<?php if( !$social_share_tumblr == '1' ) : ?><li><a class="share-tumblr"  href="http://www.tumblr.com/share/link?url=<?php echo the_permalink(); ?>" title="<?php echo esc_attr( $social_share_link_title ); ?> <?php echo __( 'Tumblr', 'ruxen' ); ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li><?php endif; ?>
			</ul>
		</div>
	<?php
	endif;
}
/*------------- POST SOCIAL SHARE END -------------*/

/*------------- SLIDER FUNCTION START -------------*/
function ruxen_slider_area() {
	if ( is_page_template( 'home-1-template.php' ) or is_page_template( 'home-2-template.php' ) or is_page_template( 'home-3-template.php' ) or is_page_template( 'home-4-template.php' ) ) {
		$ruxen_hide_slider = get_theme_mod( 'ruxen_hide_slider' );
		$slider_time = get_theme_mod( 'slider_time' );
		$slider_limit = get_theme_mod( 'slider_limit' );
		$slider_tag = get_theme_mod( 'slider_tag' );
		$slider_category = get_theme_mod( 'slider_category' );
		$slider_type = get_theme_mod( 'slider_type' );
		
		if( !$slider_time == '' ) :
			$slider_time = get_theme_mod( 'slider_time' );
		elseif( $slider_time == '' ):
			$slider_time = "8000";
		endif;
		
		if( !$ruxen_hide_slider == '1' ) :
		?>
		<section class="slider-area">
			<section id="carousel-example-generic" class="carousel slide carousel-fade" data-interval="<?php echo esc_attr( $slider_time ); ?>" data-ride="carousel">
				<div class="carousel-inner" role="listbox">
					<?php
						if( $slider_type == 'tags' ):
							$slider_args = array(
								'tag' => $slider_tag,
								'posts_per_page' => $slider_limit,
							);
							
						elseif( $slider_type == 'category' ):
							$slider_args = array(
								'category_name' => $slider_category,
								'posts_per_page' => $slider_limit,
							);
							
						elseif( $slider_type == 'latestposts' ):
							$slider_args = array(
								'posts_per_page' => $slider_limit,
							);
							
						endif;
						
						$slider_query = new WP_Query( $slider_args );
						if( $slider_query->have_posts() ) {
						
							while ( $slider_query->have_posts() ) {
								$slider_query->the_post();

							$post_id = get_the_ID();
							
							if( has_post_thumbnail( $post_id ) ) :
							$slider_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'slider-image' );
							endif;
							$post_slider_title1_meta_box_text = get_post_meta( get_the_ID(), 'post_slider_title1_meta_box_text', true );
							$post_slider_title2_meta_box_text = get_post_meta( get_the_ID(), 'post_slider_title2_meta_box_text', true );
					?>

								<div class="item">
									<div class="slider-bg-img" style="background-image:url(<?php echo esc_url( $slider_image[0] ); ?>);"></div>
									<div class="carousel-caption">
										<div class="slider-post-information animated fadeInDown">
											<span class="category"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></span>
											<span>//</span>
											<span class="date"><?php the_time( 'j F Y' ); ?></span>
										</div>
										<div class="slider-post-title">
											<?php if( !empty($post_slider_title1_meta_box_text) or !empty($post_slider_title2_meta_box_text) ): ?>
												<?php 
												if( !empty( $post_slider_title1_meta_box_text ) ) {
												?>
												<span class="slider-post-title-top animated fadeInLeftBig"><?php echo esc_attr( $post_slider_title1_meta_box_text ); ?></span>
												<?php } ?>
												<?php 
												if( !empty( $post_slider_title2_meta_box_text ) ) {
												?>
												<span class="slider-post-title-bottom animated fadeInRightBig"><?php echo esc_attr( $post_slider_title2_meta_box_text ); ?></span>
												<?php } ?>
											<?php else: ?>
												<span class="slider-post-title-bottom animated fadeInRightBig"><?php the_title(); ?></span>
											<?php endif; ?>
										</div>
										<?php the_excerpt( '' ); ?>
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="more animated fadeInUpBig"><i class="fa fa-chevron-right"></i> <?php _e( 'More', 'ruxen' ); ?></a>
									</div>
								</div>
					
							<?php } ?>
					
					<?php } ?>
					
					<?php wp_reset_postdata(); ?>
					
				</div>
				<!-- SLIDER CONTROL START -->
				<a class="left carousel-control left-slider-arrow" href="#carousel-example-generic" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only"><?php _e( 'Previous', 'ruxen' ); ?></span>
				</a>
				<a class="right carousel-control right-slider-arrow" href="#carousel-example-generic" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only"><?php _e( 'Next', 'ruxen' ); ?></span>
				</a>
				<!-- SLIDER CONTROL END -->
				<?php 
					$header_top = get_theme_mod( 'header_top' );
					if( $header_top == '' ):
				?>
					<a href="#header" class="slider-down"><i class="fa fa-angle-down bounce"></i></a>
				<?php else: ?>
					<a href="#site-content-wrapper" class="slider-down"><i class="fa fa-angle-down bounce"></i></a>
				<?php endif; ?>
			</section>
		</section>
		<?php
		endif;
	} else {
	}
	
}
/*------------- SLIDER FUNCTION END -------------*/

/*------------- SIDEBAR START -------------*/
function ruxen_content_area_start() {
		$sidebar_position = get_theme_mod( 'sidebar_position' );
		
		
		if( is_page_template( 'template-page-left-sidebar.php' ) ) {
			echo '<div class="col-lg-9 col-sm-9 col-xs-12 pull-right">';
		}
		
		elseif( is_page_template( 'template-page-right-sidebar.php' ) ) {
			echo '<div class="col-lg-9 col-sm-9 col-xs-12">';
		}
		
		elseif( $sidebar_position == 'left' ) {
			echo '<div class="col-lg-9 col-sm-9 col-xs-12 pull-right">';
		}
		
		elseif( $sidebar_position == 'right' ) {
			echo '<div class="col-lg-9 col-sm-9 col-xs-12">';
		}
		
		elseif( $sidebar_position == 'nosidebar' ) {
			echo '<div class="col-lg-12 col-sm-12 col-xs-12 pull-right">';
		}
		
		else {
			echo '<div class="col-lg-9 col-sm-9 col-xs-12">';
		}
}

function ruxen_content_area_end() {
	echo '</div>';
}

function ruxen_sidebar_start() {
		$sidebar_position = get_theme_mod( 'sidebar_position' );
		
		if( $sidebar_position == 'left' ) {
			echo '<div class="col-lg-3 col-sm-3 col-xs-12">';
		}
		
		elseif( $sidebar_position == 'right' ) {
			echo '<div class="col-lg-3 col-sm-3 col-xs-12">';
		}
		
		elseif( $sidebar_position == 'nosidebar' ) {
			echo '<div class="col-lg-12 col-sm-12 col-xs-12 hide">';
		}
		
		else {
			echo '<div class="col-lg-3 col-sm-3 col-xs-12">';
		}
}

function ruxen_sidebar_end() {
	echo '</div>';
}
/*------------- SIDEBAR END -------------*/

/*------------- POST BOTTOM AUTHOR INFO START -------------*/
function ruxen_post_bottom_author_info() {
	$author             = get_the_author();
	$author_description = get_the_author_meta( 'description' );
	$author_url         = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
	$author_avatar      = get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wpex_author_bio_avatar_size', 75 ) );
	$post_author_info_hide = get_theme_mod( 'post_author_info_hide' );
	
	if( !$post_author_info_hide == '1' ) :
	
		if ( $author_description ) : ?>
			<div class="post-author">
				<aside class="about-author">
					<?php if ( $author_avatar ) { ?>
						<div class="author-info-avatar">
							<a href="<?php echo esc_url( $author_url ); ?>" rel="author">
								<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wpex_author_bio_avatar_size', 150 ) ); ?>
							</a>
						</div>
					<?php } ?>
					<div class="author-info-description">
						<h4><span><?php printf( __( '%s', 'ruxen' ), $author ); ?></span></h4>
						<p><?php echo esc_attr( $author_description ); ?></p>
					</div>
				</aside>
			</div>
<?php
		endif;

	endif;	
}
/*------------- POST BOTTOM AUTHOR INFO END -------------*/

/*------------- HEADER LOGO START -------------*/
function ruxen_site_logo() {
	echo '<a href="' . site_url() . '" class="site-logo">';
	$logo = get_theme_mod( 'ruxen_logo' );
	if( !$logo == ""  ) {
	echo '<img alt="Logo" src="' . get_theme_mod( 'ruxen_logo' ) . '" />';
	} else {
	echo '<img alt="Logo" src="' . get_template_directory_uri() . '/assets/img/logo.png" />';
	}
	echo '</a>';
}
/*------------- HEADER LOGO END -------------*/

/*------------- POST BOTTOM FEATURES START -------------*/
function ruxen_post_bottom_features() {
	$post_bottom_hide = get_theme_mod( 'post_bottom_hide' );
	if( !$post_bottom_hide == '1' ) :
	?>
	<div class="page-content post-bottom-features">
		<div class="post-bottom-features-content">
			<?php
				ruxen_single_nav();
				ruxen_post_bottom_author_info();
				ruxen_related_posts();
			?>
		</div>
	</div>
	<?php
	endif;
}
/*------------- POST BOTTOM FEATURES END -------------*/

/*------------- RELATED POSTS START -------------*/
function ruxen_related_posts() {
	$related_posts_hide = get_theme_mod( 'related_posts_hide' );
	if( !$related_posts_hide == '1' ) :
	?>
	<div class="post-related">
		<div class="post-related-row">
			<?php
				global $post;
				$tags = wp_get_post_tags( $post->ID );
		 
				if ($tags) {
				$tag_ids = array();
				foreach( $tags as $individual_tag ) $tag_ids[] = $individual_tag->term_id;
					$args=array(
						'tag__in' => $tag_ids,
						'post__not_in' => array($post->ID),
						'posts_per_page' => 3
					);
		 
				$my_query = new wp_query( $args );
				while( $my_query->have_posts() ) {
					$my_query->the_post();
			?>
				
				<div class="col-sm-4 col-xs-12">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<div class="related-post-info">
							<div class="category"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></div>
							<span>//</span>
							<span class="date"><?php the_time( 'j F Y' ); ?></span>
						</div>
						<div class="relatedpostsimage">
							<?php if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'relatedposts' );
							}
							?>
						</div>
						<h4><?php the_title(); ?></h4>
					</a>
				</div>
		 
				<?php
					}
				}
				wp_reset_postdata();
			?>
		</div>
	</div>
	<?php
	endif;
}
/*------------- RELATED POSTS END -------------*/

/*------------- GOOGLE MAPS SCRIPT START -------------*/
function ruxen_google_maps_script( ) {
?>
	<script type='text/javascript'>
		function init_map() {
			var myOptions = {
				zoom: <?php echo get_theme_mod( 'google_maps_zoom' ); ?>,
				center: new google.maps.LatLng(<?php echo get_theme_mod( 'google_maps_lat' ); ?>, <?php echo get_theme_mod( 'google_maps_lng' ); ?>), //change the coordinates
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				scrollwheel: false,
				mapTypeControl: false,
				styles: [{featureType:'all'}]
			};
			 
			var map = new google.maps.Map(document.getElementById("googlemaps_canvas"), myOptions);
			var marker = new google.maps.Marker({
				map: map,
				position: new google.maps.LatLng(<?php echo get_theme_mod( 'google_maps_lat' ); ?>, <?php echo get_theme_mod( 'google_maps_lng' ); ?>) //change the coordinates
			});
			<?php
			$google_maps_text = get_theme_mod( 'google_maps_text' );
			if( !$google_maps_text == '' ): ?>
				var infowindow = new google.maps.InfoWindow({
					content: "<?php echo get_theme_mod( 'google_maps_text' ); ?>"  //add your address
				});
			<?php endif; ?>
			google.maps.event.addListener(marker, "click", function () {
				infowindow.open(map, marker);
			});
			infowindow.open(map, marker);
		}
			
		if ($("#googlemaps_canvas").length > 0){
			google.maps.event.addDomListener(window, 'load', init_map);
		};
	</script>
<?php
}
add_action( 'wp_footer', 'ruxen_google_maps_script', 40 );
/*------------- GOOGLE MAPS SCRIPT END -------------*/



/*------------- FOOTER INSTAGRAM AREA START -------------*/
function ruxen_footer_intagram_area() {
	$footer_instagram_hide = get_theme_mod( 'footer_instagram_hide' );
	$instagram_user_id = get_theme_mod( 'instagram_user_id' );
	$instagram_access_token = get_theme_mod( 'instagram_access_token' );
	if( !$footer_instagram_hide == '1' ) :
		function ruxen_footer_intagram_area_widget_javascript( ) {
		?>
		<script type='text/javascript'>
			$(document).ready(function(){
			(function(){var e,t;e=function(){function e(e,t){var n,r;this.options={target:"instafeed",get:"popular",resolution:"thumbnail",sortBy:"none",links:!0,mock:!1,useHttp:!1};if(typeof e=="object")for(n in e)r=e[n],this.options[n]=r;this.context=t!=null?t:this,this.unique=this._genKey()}return e.prototype.hasNext=function(){return typeof this.context.nextUrl=="string"&&this.context.nextUrl.length>0},e.prototype.next=function(){return this.hasNext()?this.run(this.context.nextUrl):!1},e.prototype.run=function(t){var n,r,i;if(typeof this.options.clientId!="string"&&typeof this.options.accessToken!="string")throw new Error("Missing clientId or accessToken.");if(typeof this.options.accessToken!="string"&&typeof this.options.clientId!="string")throw new Error("Missing clientId or accessToken.");return this.options.before!=null&&typeof this.options.before=="function"&&this.options.before.call(this),typeof document!="undefined"&&document!==null&&(i=document.createElement("script"),i.id="instafeed-fetcher",i.src=t||this._buildUrl(),n=document.getElementsByTagName("head"),n[0].appendChild(i),r="instafeedCache"+this.unique,window[r]=new e(this.options,this),window[r].unique=this.unique),!0},e.prototype.parse=function(e){var t,n,r,i,s,o,u,a,f,l,c,h,p,d,v,m,g,y,b,w,E,S;if(typeof e!="object"){if(this.options.error!=null&&typeof this.options.error=="function")return this.options.error.call(this,"Invalid JSON data"),!1;throw new Error("Invalid JSON response")}if(e.meta.code!==200){if(this.options.error!=null&&typeof this.options.error=="function")return this.options.error.call(this,e.meta.error_message),!1;throw new Error("Error from Instagram: "+e.meta.error_message)}if(e.data.length===0){if(this.options.error!=null&&typeof this.options.error=="function")return this.options.error.call(this,"No images were returned from Instagram"),!1;throw new Error("No images were returned from Instagram")}this.options.success!=null&&typeof this.options.success=="function"&&this.options.success.call(this,e),this.context.nextUrl="",e.pagination!=null&&(this.context.nextUrl=e.pagination.next_url);if(this.options.sortBy!=="none"){this.options.sortBy==="random"?d=["","random"]:d=this.options.sortBy.split("-"),p=d[0]==="least"?!0:!1;switch(d[1]){case"random":e.data.sort(function(){return.5-Math.random()});break;case"recent":e.data=this._sortBy(e.data,"created_time",p);break;case"liked":e.data=this._sortBy(e.data,"likes.count",p);break;case"commented":e.data=this._sortBy(e.data,"comments.count",p);break;default:throw new Error("Invalid option for sortBy: '"+this.options.sortBy+"'.")}}if(typeof document!="undefined"&&document!==null&&this.options.mock===!1){a=e.data,this.options.limit!=null&&a.length>this.options.limit&&(a=a.slice(0,this.options.limit+1||9e9)),n=document.createDocumentFragment(),this.options.filter!=null&&typeof this.options.filter=="function"&&(a=this._filter(a,this.options.filter));if(this.options.template!=null&&typeof this.options.template=="string"){i="",o="",l="",v=document.createElement("div");for(m=0,b=a.length;m<b;m++)s=a[m],u=s.images[this.options.resolution].url,this.options.useHttp||(u=u.replace("http://","//")),o=this._makeTemplate(this.options.template,{model:s,id:s.id,link:s.link,image:u,caption:this._getObjectProperty(s,"caption.text"),likes:s.likes.count,comments:s.comments.count,location:this._getObjectProperty(s,"location.name")}),i+=o;v.innerHTML=i,S=[].slice.call(v.childNodes);for(g=0,w=S.length;g<w;g++)h=S[g],n.appendChild(h)}else for(y=0,E=a.length;y<E;y++)s=a[y],f=document.createElement("img"),u=s.images[this.options.resolution].url,this.options.useHttp||(u=u.replace("http://","//")),f.src=u,this.options.links===!0?(t=document.createElement("a"),t.href=s.link,t.appendChild(f),n.appendChild(t)):n.appendChild(f);document.getElementById(this.options.target).appendChild(n),r=document.getElementsByTagName("head")[0],r.removeChild(document.getElementById("instafeed-fetcher")),c="instafeedCache"+this.unique,window[c]=void 0;try{delete window[c]}catch(x){}}return this.options.after!=null&&typeof this.options.after=="function"&&this.options.after.call(this),!0},e.prototype._buildUrl=function(){var e,t,n;e="https://api.instagram.com/v1";switch(this.options.get){case"popular":t="media/popular";break;case"tagged":if(typeof this.options.tagName!="string")throw new Error("No tag name specified. Use the 'tagName' option.");t="tags/"+this.options.tagName+"/media/recent";break;case"location":if(typeof this.options.locationId!="number")throw new Error("No location specified. Use the 'locationId' option.");t="locations/"+this.options.locationId+"/media/recent";break;case"user":if(typeof this.options.userId!="number")throw new Error("No user specified. Use the 'userId' option.");if(typeof this.options.accessToken!="string")throw new Error("No access token. Use the 'accessToken' option.");t="users/"+this.options.userId+"/media/recent";break;default:throw new Error("Invalid option for get: '"+this.options.get+"'.")}return n=""+e+"/"+t,this.options.accessToken!=null?n+="?access_token="+this.options.accessToken:n+="?client_id="+this.options.clientId,this.options.limit!=null&&(n+="&count="+this.options.limit),n+="&callback=instafeedCache"+this.unique+".parse",n},e.prototype._genKey=function(){var e;return e=function(){return((1+Math.random())*65536|0).toString(16).substring(1)},""+e()+e()+e()+e()},e.prototype._makeTemplate=function(e,t){var n,r,i,s,o;r=/(?:\{{2})([\w\[\]\.]+)(?:\}{2})/,n=e;while(r.test(n))i=n.match(r)[1],s=(o=this._getObjectProperty(t,i))!=null?o:"",n=n.replace(r,""+s);return n},e.prototype._getObjectProperty=function(e,t){var n,r;t=t.replace(/\[(\w+)\]/g,".$1"),r=t.split(".");while(r.length){n=r.shift();if(!(e!=null&&n in e))return null;e=e[n]}return e},e.prototype._sortBy=function(e,t,n){var r;return r=function(e,r){var i,s;return i=this._getObjectProperty(e,t),s=this._getObjectProperty(r,t),n?i>s?1:-1:i<s?1:-1},e.sort(r.bind(this)),e},e.prototype._filter=function(e,t){var n,r,i,s,o;n=[],i=function(e){if(t(e))return n.push(e)};for(s=0,o=e.length;s<o;s++)r=e[s],i(r);return n},e}(),t=typeof exports!="undefined"&&exports!==null?exports:window,t.Instafeed=e}).call(this);

			var feed = new Instafeed({
				get: 'user',
				userId: <?php echo get_theme_mod( 'instagram_user_id' ); ?>,
				resolution: 'low_resolution',
				imit: 25,
				accessToken: '<?php echo get_theme_mod( 'instagram_access_token' ); ?>',
				after: function () {
					var owl = $('.owl2row-plugin');
					owl.owlCarousel({
						loop: true,
						margin: 0,
						navText:['',''],
						nav: true,
						dots: false,
						owl2row: 'true',
						owl2rowTarget: 'item',
						owl2rowContainer: 'owl2row-item',
						owl2rowDirection: 'utd',
						responsive: {
							0: {
								items: 2
							},
							
							500: {
								items: 6
							}
						}
					});
				},
				template: '<div class="item"><a class="animation" href="{{link}}" target="_blank"><img src="{{image}}" /></a></div>'
			});
			feed.run();
			});
		</script>
		<?php
		}
		add_action( 'wp_footer', 'ruxen_footer_intagram_area_widget_javascript', 41 );
		?>
		<div id="owl2row-plugin" class="owl-carousels">
			<h2><?php _e( 'Follow Us Instagram', 'ruxen' ); ?></h2>
			<div id="instafeed" class="owl2row-plugin"></div>
		</div>
	<?php
	endif;
}
/*------------- FOOTER INSTAGRAM AREA END -------------*/

/*------------- FOOTER LOGO START -------------*/
function ruxen_footer_logo() {
	$ruxen_hide_footer_logo = get_theme_mod( 'ruxen_hide_footer_logo' ); 
	if( $ruxen_hide_footer_logo == '' ) :
		echo '<a href="' . site_url() . '" class="footer-logo">';
		$logo = get_theme_mod( 'footer_logo' );
		if( !$logo == ""  ) {
		echo '<img alt="Logo" src="' . get_theme_mod( 'footer_logo' ) . '" />';
		} else {
		echo '<img alt="Logo" src="' . get_template_directory_uri() . '/assets/img/footer-logo.png" />';
		}
		echo '</a>';
	endif;
}
/*------------- FOOTER LOGO END -------------*/
/*------------- THEME OPTIONS END -------------*/