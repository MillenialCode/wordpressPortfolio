<?php
/*
	* The template used for displaying single content video
*/
?>

<div class="page-content">
	<div class="content-area clearfix">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<section id="page-content" class="category-post-list clearfix">
			
				<div class="post-header">
					<div class="single-title">
						<h1><?php the_title(); ?></h1>
					</div>
					<div class="single-top-information">
						<div class="single-top-info">
							<div class="category"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></div>
							<span>//</span>
							<span class="date"><?php the_time( 'j F Y' ); ?></span>
						</div>
					</div>
				</div>
				
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
				
				<div class="post-entry">
					<?php the_content(); ?>
				</div>
				
				<div class="post-share">
					<div class="col-sm-6 col-xs-12 nopaddingleft">
						<?php
							$post_category_hide = get_theme_mod( 'post_category_hide' );
							if( !$post_category_hide == '1' ):
						?>
						<div class="post-in-category">
							<h6><?php _e( 'Categories', 'ruxen' ); ?></h6>
							<div class="post-in-category-list">
									<?php the_category( ', ', '' ); ?>
							</div>
						</div>
						<?php endif; ?>
					</div>
					<div class="col-sm-6 col-xs-12 nopaddingright">
						<?php ruxen_post_social_share(); ?>
					</div>
				</div>
				
				<div class="post-tag">
					<div class="col-sm-6 col-xs-12 nopaddingleft">
						<div class="post-in-tag">
							<h6><?php _e( 'Tags:', 'ruxen' ); ?></h6>
							<div class="post-in-tag">
								<?php the_tags( '<div class="post-in-category-list"><span>', ',</span> <span>', '</span></div>' ); ?>
							</div>
						</div>
					</div>
					<div class="col-sm-6 col-xs-12 nopaddingright">
						<?php
							wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'ruxen' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
							) );
						?>
					</div>
				</div>
						
				<?php ruxen_post_bottom_features(); ?>
				
			</section>
		</article>
	</div>
</div>