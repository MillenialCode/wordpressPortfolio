<?php
/**
	* The template for displaying single
*/
get_header(); ?>

<?php ruxen_site_content_start(); ?>
	
	<section class="container">
		<section class="site-single-content">
			<section class="row">
				
				<?php ruxen_content_area_start(); ?>
				
					<?php while ( have_posts() ) : the_post(); ?>
					
						<?php get_template_part( 'include/formats/content', get_post_format() ); ?>
					
					<?php endwhile; ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}
					?>
							
				<?php endwhile; ?>
						
				<?php ruxen_content_area_end(); ?>
					
				<?php get_sidebar(); ?>
			
			</section>
		</section>
	</section>
	
<?php ruxen_site_content_end(); ?>

<?php
get_footer();