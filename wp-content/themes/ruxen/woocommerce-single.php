<?php
/**
	* The template for displaying woocommerce single
*/
get_header(); ?>

<?php ruxen_site_content_start(); ?>
		
	<section class="container">
		<section class="site-single-content">
			<section class="row">

				<?php ruxen_content_area_start(); ?>
				
					<div class="page-content">
						<div class="content-area clearfix">
							<?php woocommerce_content(); ?>
						</div>
					</div>
						
				<?php ruxen_content_area_end(); ?>
					
				<?php get_sidebar( 'shop' ); ?>
		
			</section>
		</section>
	</section>

<?php ruxen_site_content_end(); ?>