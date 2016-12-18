<?php
/*
	* The template used for displaying single standart content
*/
?>

<div class="page-content">
	<div class="content-area clearfix">
		<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
			<section id="page-content" class="category-post-list clearfix">
			
				<div class="post-header">
					<div class="single-title">
						<h1><?php the_title(); ?></h1>
					</div>
				</div>
				
				<div class="post-entry">
					<?php echo wp_get_attachment_link( $image, 'full', true, true ); ?>
					<?php the_content(); ?>
				</div>

				
				<div class="post-share">
					<?php ruxen_post_social_share(); ?>
				</div>
				
			</section>
		</article>
	</div>
</div>