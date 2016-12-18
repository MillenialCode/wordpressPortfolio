<?php
/*
	* The template for displaying 404 page
*/
get_header(); ?>

<?php ruxen_site_content_start(); ?>

		<section class="site-content-wrapper">
			<section class="content-404-page" style="background-image:url(<?php echo get_template_directory_uri(); ?>/assets/img/pagebanner2.jpg);">
				<section class="container">
					<h1><?php _e( '404', 'ruxen' ); ?></h1>
					<h2><?php _e( 'That\'s an error', 'ruxen' ); ?></h2>
					<p><?php _e( 'We can\'t find your request.', 'ruxen' ); ?></p>
					<a class="more" href="<?php echo home_url(); ?>"><i class="fa fa-chevron-right"></i> <?php _e( 'Home Page', 'ruxen' ); ?></a>
				</section>
			</section>
		</section>
	
<?php ruxen_site_content_end(); ?>

<?php
get_footer();