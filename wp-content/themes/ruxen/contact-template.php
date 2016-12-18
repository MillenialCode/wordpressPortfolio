<?php
/*
	* The template for displaying contact page
	* Template Name: Contact Template
*/
get_header(); ?>

<?php
	$google_maps_lat = get_theme_mod( 'google_maps_lat' );
	$google_maps_lng = get_theme_mod( 'google_maps_lng' );
	if( !$google_maps_lat == '' and !$google_maps_lat == '' ):
?>

<div id="googlemaps_canvas"></div>

<?php endif; ?>

<?php ruxen_site_content_start(); ?>
		
		<section class="container">
			<section class="site-page-content contact-form-content">
				<section class="row">
					<div id="post-<?php the_ID(); ?>" <?php post_class('page-content full-page-content'); ?>>
						<div class="content-area clearfix">
						
							<?php while ( have_posts() ) : the_post(); ?>
							
							<div class="clearfix contact-page-information">
								<div class="col-sm-8 col-xs-12">
									<?php
									$contact_form_shortcode = get_theme_mod( 'contact_form_shortcode' );
									if( !$contact_form_shortcode == '' ): ?>
									<h3><?php _e( 'CONTACT FORM', 'ruxen' ); ?></h3>
									<?php echo do_shortcode( $contact_form_shortcode ); ?>
									<?php endif; ?>
								</div>
								<div class="col-sm-4 col-xs-12">
									<!-- CONTACT INFORMATION START -->
									<?php
										$contact_page_address = get_theme_mod( 'contact_page_address' );
										$contact_page_telephone1 = get_theme_mod( 'contact_page_telephone1' );
										$contact_page_telephone2 = get_theme_mod( 'contact_page_telephone2' );
										$contact_page_fax = get_theme_mod( 'contact_page_fax' );
										$contact_page_email = get_theme_mod( 'contact_page_email' );
										$contact_form_hide_social_media = get_theme_mod( 'contact_form_hide_social_media' );
									?>
									<?php if( !$contact_page_address == '' or !$contact_page_telephone1 == '' or !$contact_page_telephone2 == '' or !$contact_page_fax == '' or !$contact_page_email == '' ): ?>
										<h3><?php _e( 'CONTACT INFORMATION', 'ruxen' ); ?></h3>
										<ul class="contact-information-list">
											<?php
												if( !$contact_page_address == '' ):
											?>
											<li><i class="fa fa-map-marker"></i> <span><?php echo $contact_page_address; ?></span></li>
											<?php endif; ?>
											<?php
												if( !$contact_page_telephone1 == '' ):
											?>
											<li><i class="fa fa-phone"></i> <span><?php echo $contact_page_telephone1; ?></span></li>
											<?php endif; ?>
											<?php
												if( !$contact_page_telephone2 == '' ):
											?>
											<li><i class="fa fa-phone"></i> <span><?php echo $contact_page_telephone2; ?></span></li>
											<?php endif; ?>
											<?php
												if( !$contact_page_fax == '' ):
											?>
											<li><i class="fa fa-fax"></i> <span><?php echo $contact_page_fax; ?></span></li>
											<?php endif; ?>
											<?php
												if( !$contact_page_email == '' ):
											?>
											<li><i class="fa fa-envelope"></i> <span><?php echo $contact_page_email; ?></span></li>
											<?php endif; ?>
										</ul>
									<?php endif; ?>
									<?php if( $contact_form_hide_social_media == '' ): ?>
									<h4><?php _e( 'SOCIAL MEDIA', 'ruxen' ); ?></h4>
									<p><?php _e( 'Follow us on social media', 'ruxen' ); ?></p>
									<?php ruxen_contact_social_media_links(); ?>
									<?php endif; ?>
									<!-- CONTACT INFORMATION END -->
								</div>
							</div>
							
							<div class="clearfix contact-page-content">
								<?php the_content(); ?>
							</div>
							
							<?php 								
								wp_link_pages( array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'ruxen' ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span>',
									'link_after'  => '</span>',
								) );

								edit_post_link( __( 'Edit Page', 'ruxen' ), '<span class="edit-link">', '</span>' );
							?>
							
							<?php endwhile; ?>
							
						</div>
					</div>
				</section>
			</section>
		</section>
	
<?php ruxen_site_content_end(); ?>

<?php
get_footer();