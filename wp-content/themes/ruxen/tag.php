<?php
/**
	* The template for displaying tag pages
*/

get_header(); ?>

<?php ruxen_site_content_start(); ?>
			
			<section class="category-archive-title">
				<section class="container">
					<h1><h1><?php printf( __( 'Tag: <span>%s</span>', 'ruxen' ), single_cat_title( '', false ) ); ?></h1></h1>
				</section>
			</section>
			
			<section class="container">
				<section class="site-page-content">
					<section class="row">
					
						<?php ruxen_content_area_start(); ?>
						
						<?php if ( have_posts() ) : ?>
						
							<div class="category-list">
							
								<?php while ( have_posts() ) : the_post(); ?>
								
									<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
									
										<div class="post-header">
											<div class="single-title">
												<h1><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
											</div>
											<div class="single-top-information">
												<div class="single-top-info">
													<div class="category"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></div>
													<span>//</span>
													<span class="date"><?php the_time( 'j F Y' ); ?></span>
												</div>
											</div>
										</div>
										
										<?php if( has_post_format( 'audio' ) ): ?>
										
											<?php 
											$audio_post_meta_box_text = get_post_meta( get_the_ID(), 'audio_post_meta_box_text', true );
											if( !empty( $audio_post_meta_box_text ) ) {
											?>
											
											<div class="post-sound">
											
											<?php
												$audio_post_meta_box_text_new = balanceTags ( stripcslashes( $audio_post_meta_box_text ) );
												echo balanceTags ( stripslashes( addslashes( $audio_post_meta_box_text_new ) ) );
											?>
											</div>
											
											<?php } ?>
											
										<?php elseif( has_post_format( 'gallery' ) ): ?>
										
											<?php $post_gallery_images = get_post_meta($post->ID, 'vdw_gallery_id', true); ?>
				
											<?php if( !empty( $post_gallery_images ) ): ?>
											
											<div class="post-gallery">
												<ul class="bxslider">
													<?php
													
													foreach ($post_gallery_images as $image) {
													?>
													<li><?php echo wp_get_attachment_image( $image, 'large', true, true ); ?></li>
													<?php
													
													}
													?>
												</ul>
											</div>
											
											<?php endif; ?>
											
										<?php elseif( has_post_format( 'link' ) ): ?>
										
											<?php
											$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'link-single' );
											$link_post_meta_box_text = get_post_meta( get_the_ID(), 'link_post_meta_box_text', true );
											if( !empty( $link_post_meta_box_text ) ) {
												?>
												<div class="post-link">
													<div class="post-link-area" style="background-image:url(<?php echo $image[0]; ?>);">
														<h4>
															<a href="<?php
																$link_post_meta_box_text_new = balanceTags ( stripcslashes( $link_post_meta_box_text ) ); // Embed code
																echo balanceTags ( stripslashes( addslashes( $link_post_meta_box_text_new ) ) ); // Embed code
																?>" target="_blank">
																<i class="fa fa-link"></i>
																<?php
																$link_post_meta_box_text_new = balanceTags ( stripcslashes( $link_post_meta_box_text ) ); // Embed code
																echo balanceTags ( stripslashes( addslashes( $link_post_meta_box_text_new ) ) ); // Embed code
																?>
															</a>
														</h4>
													</div>
												</div>
												<?php
											} 
											?>
											
										<?php elseif( has_post_format( 'video' ) ): ?>
										
											<?php 
											$video_post_meta_box_text = get_post_meta( get_the_ID(), 'video_post_meta_box_text', true );
											if( !empty( $video_post_meta_box_text ) ) {
											?>
												<div class="post-video">
													<?php
													$video_post_meta_box_text_new = balanceTags ( stripcslashes( $video_post_meta_box_text ) ); // Embed code
													echo balanceTags ( stripslashes( addslashes( $video_post_meta_box_text_new ) ) ); // Embed code
													?>
												</div>
											<?php } ?>
											
										<?php else: ?>
										
											<?php if ( has_post_thumbnail() ) { ?>
												<div class="post-img">
													<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
														<?php the_post_thumbnail( 'single-image' ); ?>
													</a>
												</div>
											<?php } ?>
																		
										<?php endif; ?>
										
										<div class="post-entry">
											<?php the_excerpt(); ?>
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="more"><i class="fa fa-chevron-right"></i> <?php _e( 'More', 'ruxen' ); ?></a>
										</div>
										
									</article>
									
								<?php endwhile; ?>
								
							</div>

						<?php else : ?>
						
							<?php get_template_part( 'include/formats/content', 'none' ); ?>
							
						<?php endif; ?>
					
						<?php ruxen_pagination(); ?>
						
						<?php ruxen_content_area_end(); ?>
							
						<?php get_sidebar(); ?>
					</section>
				</section>
			</section>
			
<?php ruxen_site_content_end(); ?>

<?php
get_footer();