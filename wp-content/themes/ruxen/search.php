<?php
/*
	* The template used for displaying search page
*/

get_header(); ?>

<?php ruxen_site_content_start(); ?>

	<section class="category-archive-title">
		<section class="container">
			<h1><?php printf( __( 'Search: <span>%s</span>', 'ruxen' ), get_search_query() ); ?></h1>
		</section>
	</section>
	
	<section class="container">
		<section class="site-page-content">
			<section class="row">
			
				<?php ruxen_content_area_start(); ?>
				
				<?php if ( have_posts() ) : ?>
				
					<div class="category-list">
					
						<?php while ( have_posts() ) : the_post(); ?>
						
							<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
							
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
								
								<div class="post-img">
									<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
										<?php if ( has_post_thumbnail() ) {
											the_post_thumbnail( 'single-image' );
										}
										?>
									</a>
								</div>
								
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