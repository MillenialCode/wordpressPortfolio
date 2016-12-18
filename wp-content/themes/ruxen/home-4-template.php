<?php
/*
	Template Name: Home Template 4
*/

get_header();
?>

<?php ruxen_site_content_start(); ?>
			
			<section class="tree-grid-content">
				<section class="container">
					<section class="row">

						<?php
						$posts_per_page = get_option( 'posts_per_page' );
						if ( is_front_page() ) {
							$paged = (get_query_var('page')) ? get_query_var('page') : 1;
						} else {
							$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
						}
						$args = array(
							'pagination' => true,
							'post_status' => 'publish',
							'post_type' => 'post',
							'paged' => $paged,
							'showposts' => $posts_per_page,
						); 
						$wp_query = new WP_Query($args);
						?>
						
						<?php if( $wp_query->have_posts() ) : ?> 
							<?php $x = 1; ?>
							<?php while( $wp_query->have_posts() ) : ?>
							<?php $wp_query->the_post(); ?>				
								<div class="col-sm-4 col-xs-12">
									<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
										<div class="tree-grid-item">
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
												<div class="tree-grid-image">
													<?php if ( has_post_thumbnail() ) : ?>
														<?php the_post_thumbnail( 'home4' ); ?>
													<?php endif; ?>
												</div>
												<div class="tree-grid-item-content">
													<div class="post-list-information">
														<div class="category"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></div>
														<span>//</span>
														<span class="date"><?php the_time( 'j F Y' ); ?></span>
													</div>
													<div class="full-grid-title"><h2><?php the_title(); ?></h2></div>
												</div>
											</a>
										</div>
										<?php the_excerpt(); ?>
										<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="more"><i class="fa fa-chevron-right"></i> <?php _e( 'More', 'ruxen' ); ?></a>
									</article>
								</div>
								<!-- BLOG LIST ITEM END -->
								
								<?php
								if ( $x % 3 != 0 ){
								} else {
								?>
									<div class="clearfix"></div>
									<span class="boxed-grid-border"></span>
								<?php
								}
								$x++;
								?>
								
							<?php endwhile; ?>
						<?php endif; ?>
						<?php wp_reset_postdata(); ?>
					</section>
				</section>
			</section>
				
			<?php ruxen_pagination(); ?>
			
<?php ruxen_site_content_end(); ?>

<?php
get_footer();