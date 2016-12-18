<?php echo get_theme_mod( 'widget_title_heading_color' ); ?> <!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<?php ruxen_favicon(); ?>
	<?php wp_head(); ?>
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body <?php body_class( 'ruxen-class' ); ?>>
<?php ruxen_page_loading(); ?>
<div class="color-selector">
	<a id="setting_panel_toggle"><i class="fa fa-tint"></i></a>
	<div id="picker"></div>
</div>
<?php 
	$header_top = get_theme_mod( 'header_top' );
	if( $header_top == '' ):
		ruxen_slider_area();
	endif;
?>

<!-- HEADER START -->
<header class="header" id="header">
	<section class="container">
		<!-- LOGO START -->
		<?php ruxen_site_logo(); ?>
		<!-- LOGO END -->
		<!-- SEARCH START -->
		<?php ruxen_header_search(); ?>
		<!-- SEARCH END -->
		<!-- NAV MENU START -->
		<nav class="navbar">
			<!-- MOBILE MENU START -->
			<div class="navbar-header">
			  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
				<span class="sr-only"><?php _e( 'Toggle navigation', 'ruxen' ); ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			  </button>
			</div>
			<!-- MOBILE MENU END -->
			<!-- MENU LIST START -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<?php wp_nav_menu( array( 'depth' => 4, 'theme_location' => 'mainmenu', 'fallback_cb' => 'ruxen_navwalker::fallback', 'walker'  => new ruxen_navwalker(), 'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>', 'menu_class' => 'nav navbar-nav' ) ); ?>
			</div>
			<!-- MENU LIST END -->
		</nav>
		<!-- NAV MENU END -->
	</section>
</header>
<!-- HEADER END -->

<?php 
	$header_top = get_theme_mod( 'header_top' );
	if( $header_top == '1' ):
		ruxen_slider_area();
	endif;
?>