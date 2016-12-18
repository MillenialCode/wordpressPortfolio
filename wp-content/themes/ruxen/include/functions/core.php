<?php
/*------------- ruxen THEME SETUP -------------*/
add_action( 'after_setup_theme', 'ruxen_setup' );
function ruxen_setup(){
	load_theme_textdomain( 'ruxen', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-background' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array( 'quote', 'gallery', 'image', 'video', 'audio', 'chat', 'link' ) );
	if( function_exists( 'add_image_size' ) ) { 
		add_image_size( 'home1', 1920, 380, true );
		add_image_size( 'home2', 570, 465, true );
		add_image_size( 'home3', 875, 535, true );
		add_image_size( 'home4', 375, 465, true );
		add_image_size( 'single-image', 850, 525, true );
		add_image_size( 'relatedposts', 360, 255, true );
		add_image_size( 'latestposts', 270, 180, true );
		add_image_size( 'single-gallery', 875, 540, true );
		add_image_size( 'single-full-image', 1170, 605, true );
		add_image_size( 'link-single', 875, 290, true );
		add_image_size( 'page-banner', 1170, 650, true );
	}
	if( ! isset( $content_width ) ) {
		$content_width = 600;
	}
	if( is_singular() ) wp_enqueue_script( 'comment-reply' );
}

/*------------- ruxen BODY CLASS START -------------*/
add_filter( 'body_class', 'ruxen_my_class_names' );
function ruxen_my_class_names( $classes ) {
	$classes[] = 'ruxen-class';
	return $classes;
}
/*------------- ruxen BODY CLASS END -------------*/

/*------------- EDITOR STYLE START -------------*/
function ruxen_my_theme_add_editor_styles() {
	add_editor_style( 'custom-editor-style.css' );
}
add_action( 'admin_init', 'ruxen_my_theme_add_editor_styles' );
/*------------- EDITOR STYLE END -------------*/

/*------------- EXCERPT START -------------*/
function ruxen_new_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'ruxen_new_excerpt_more' );

add_action( 'init', 'ruxen_my_add_excerpts_to_pages' );
function ruxen_my_add_excerpts_to_pages() {
	add_post_type_support( 'page', 'excerpt' );
}
/*------------- EXCERPT END -------------*/

/*------------- SITE CONTENT START -------------*/
function ruxen_site_content_start() {
	?>
	<section class="site-content-wrapper" id="site-content-wrapper">
	<?php
}

function ruxen_site_content_end() {
	?>
	</section>
	<?php
}
/*------------- SITE CONTENT END -------------*/

/*------------- THEME SIDEBAR - WIDGET START -------------*/
if( !function_exists( 'ruxen_sidebars_init' ) ) {
	function ruxen_sidebars_init() {
		register_sidebar(array(
			'id' => 'blog-sidebar',
			'name' => __( 'Blog Sidebar', 'ruxen' ),
			'before_widget' => '<div id="%1$s" class="shop-sidebar-wrap widget-box fadeload %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-title"><h4>',
			'after_title' => '</h4></div>',
		));
		
		register_sidebar(array(
			'id' => 'shop-sidebar',
			'name' => __( 'Shop Sidebar', 'ruxen' ),
			'before_widget' => '<div id="%1$s" class="shop-sidebar-wrap widget-box fadeload %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<div class="widget-title"><h4>',
			'after_title' => '</h4></div>',
		));
	}
}

add_action( 'widgets_init', 'ruxen_sidebars_init' );
/*------------- THEME SIDEBAR - WIDGET END -------------*/

/*------------- SUB MENU CLASS START -------------*/
class ruxen_navwalker extends Walker_Nav_Menu {

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat( "\t", $depth );
		$output .= "\n$indent<ul class=\"dropdown-menu\" role=\"menu\">\n";
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';
		/**
		 * Dividers & Headers
	     * ==================
		 * Determine whether the item is a Divider, Header, or regular menu item.
		 * To prevent errors we use the strcasecmp() function to so a comparison
		 * that is not case sensitive. The strcasecmp() function returns a 0 if 
		 * the strings are equal.
		 */
		if(strcasecmp($item->title, 'divider') == 0) {

			$output .= $indent . '<li class="divider">';
		} else if(strcasecmp($item->title, 'divider-vertical') == 0) {

			$output .= $indent . '<li class="divider-vertical">';
		} else if(strcasecmp($item->title, 'nav-header') == 0) {

			$output .= $indent . '<li class="nav-header">' . esc_attr( $item->attr_title );
		} else {
			$class_names = $value = '';
			$classes = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
			
			if($args->has_children) {
				$class_names .= ' dropdown';
			}
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';
			$output .= $indent . '<li' . $id . $value . $class_names .'>';
			$atts = array();
			$atts['title']  = ! empty( $item->title ) 	   ? $item->title 	   : '';
			$atts['target'] = ! empty( $item->target )     ? $item->target     : '';
			$atts['rel']    = ! empty( $item->xfn )        ? $item->xfn        : '';
			
			if($args->has_children) {
				$atts['href']   		= ! empty( $item->url ) ? $item->url : '';
				$atts['class']			= 'dropdown-toggle';
				$atts['data-toggle'] = 'dropdown';
				$atts['data-target'] = ! empty( $item->url ) ? $item->url : '';
			} else {
				$atts['href'] = ! empty( $item->url ) ? $item->url : '';
			}
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args );
			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if( ! empty( $value ) ) {
					$value = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}
			$item_output = $args->before;
		
			if(! empty( $item->attr_title )){
				$item_output .= '<a'. $attributes .'><i class="' . esc_attr( $item->attr_title ) . '"></i>&nbsp;';
			} else {
				$item_output .= '<a'. $attributes .'>';
			}
			
			$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
			$item_output .= ($args->has_children) ? ' </a>' : '</a>';
			$item_output .= $args->after;
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}

	function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
        if( !$element ) {
            return;
        }
        $id_field = $this->db_fields['id'];
		
        if( is_object( $args[0] ) ) {
           $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}
/*------------- SUB MENU CLASS END -------------*/

/*------------- ENQUE ruxen SCRIPT FILE AND STYLE FILE START -------------*/
function ruxen_scripts_basic()
{
   wp_enqueue_script( 'jquery-script', get_template_directory_uri() . '/assets/js/jquery.min.js','','',true );
    wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/assets/js/bootstrap.min.js','','',true );
    wp_enqueue_script( 'ruxen-script', get_template_directory_uri() . '/assets/js/ruxen.js','','',true );
    wp_enqueue_script( 'google-maps', 'https://maps.google.com/maps/api/js?sensor=false','','',true );
    wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap.min.css'  );
    wp_enqueue_style( 'ruxen-style', get_stylesheet_uri() );
    // For either a plugin or a theme, you can then enqueue the script:
}
add_action( 'wp_enqueue_scripts', 'ruxen_scripts_basic' );

function ruxen_load_custom_wp_admin() {
	wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/assets/css/admin.css'  );
	wp_enqueue_script( 'bonica_admin_script', get_template_directory_uri() . '/assets/js/admin.js' );
}
add_action( 'admin_enqueue_scripts', 'ruxen_load_custom_wp_admin' );
/*------------- ENQUE ruxen SCRIPT FILE AND STYLE FILE END -------------*/

/*------------- GENERATE WORDPRESS TITLE START -------------*/
function ruxen_wp_title( $title, $sep ) {
	if( is_feed() ) {
		return $title;
	}
	
	global $page, $paged;

	$title .= get_bloginfo( 'name', 'display' );

	$site_description = get_bloginfo( 'description', 'display' );
	if( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	if( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'ruxen' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'ruxen_wp_title', 10, 2 );
/*------------- GENERATE WORDPRESS TITLE END -------------*/

/*------------- ruxen MENUS START -------------*/
register_nav_menus( 
	array(
		'mainmenu'	=>	__( 'Main Navigation', 'ruxen' ),
		'footermenu'	=>	__( 'Footer Navigation', 'ruxen' )
	)
);
/*------------- ruxen MENUS END -------------*/

/*------------- PAGE LOADING START -------------*/
function ruxen_page_loading() {
 echo '<div class="loader-wrapper"><div class="loader"></div><div class="loader-section section-left"></div><div class="loader-section section-right"></div></div>';
}
/*------------- PAGE LOADING END -------------*/

/*------------- WOOCOMMERCE START -------------*/
add_action( 'after_setup_theme', 'ruxen_woocommerce_support' );
function ruxen_woocommerce_support() {
	add_theme_support( 'woocommerce' );
}
/*------------- WOOCOMMERCE END -------------*/

/*------------- HEADER SEARCH START -------------*/
function ruxen_header_search() {
	$ruxen_hide_header_search = get_theme_mod( 'ruxen_hide_header_search' );
	if( !$ruxen_hide_header_search == '1' ) :
?>
	<div class="header-search">
		<div class="header-search-form-button"><i class="fa fa-search"></i></div>
		<div class="header-search-form">
			<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<div>
					<input type="text" placeholder="Search..." name="s" class="search">
					<button type="submit"><?php _e( 'SEARCH', 'ruxen' ); ?></button>
				</div>
			</form>
		</div>
	</div>
<?php
	endif;
}
/*------------- HEADER SEARCH END -------------*/

/*------------- GO TOP START -------------*/
function ruxen_go_top() {
	$ruxen_hide_go_top = get_theme_mod( 'ruxen_hide_go_top' );
	if( !$ruxen_hide_go_top == '1' ) :
?>
	<section class="footer-bottom clearfix">
		<div class="top-icon">
			<i class="fa fa-chevron-up"></i>
			<span><?php _e( 'Top', 'ruxen' ); ?></span>
		</div>
		<?php ruxen_footer_text(); ?>
	</section>
<?php
	endif;
}
/*------------- GO TOP END -------------*/

add_filter( 'wpcf7_form_elements', 'ruxen_mycustom_wpcf7_form_elements' );

function ruxen_mycustom_wpcf7_form_elements( $form ) {
$form = do_shortcode( $form );

return $form;
}

function ruxen_woo_related_products_limit() {
  global $product;
	
	$args['posts_per_page'] = 3;
	return $args;
}
add_filter( 'woocommerce_output_related_products_args', 'ruxen_related_products_args' );
  function ruxen__related_products_args( $args ) {
	$args['posts_per_page'] = 3; // 4 related products
	$args['columns'] = 3; // arranged in 2 columns
	return $args;
}