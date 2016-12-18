<?php
/*
	Template Name: Home Template 3
*/

get_header();
?>

<?php ruxen_site_content_start(); ?>
			
			<section class="two-grid-content">

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
					<?php while( $wp_query->have_posts() ) : ?>
					<?php $wp_query->the_post(); ?>
					<?php
					if ( has_post_thumbnail( $post->ID ) ) {
						$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'home3' );
					}
					?>
						<!-- BLOG LIST ITEM START -->						
						<div class="col-sm-6 col-xs-12">
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<div class="two-grid-image" style="background-image:url(<?php echo esc_attr( $image[0] ); ?>);"></div>
									<div class="two-grid-item-content">
										<div class="post-list-information">
											<div class="category"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></div>
											<span>//</span>
											<span class="date"><?php the_time( 'j F Y' ); ?></span>
										</div>
										<div class="two-grid-title"><h2><?php the_title(); ?></h2></div>
										<?php the_excerpt(); ?>
										<span class="more"><i class="fa fa-chevron-right"></i> <?php _e( 'More', 'ruxen' ); ?></span>
									</div>
								</a>
							</article>
						</div>
						<!-- BLOG LIST ITEM END -->
					<?php endwhile; ?>
				<?php endif; ?>
				<?php wp_reset_postdata(); ?>
				<div class="clearfix"></div>
			</section>
				
			<?php ruxen_pagination(); ?>
			
<?php ruxen_site_content_end(); ?>

<?php
get_footer();