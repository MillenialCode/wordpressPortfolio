<?php
/*
	* The template for displaying single
*/
get_header(); ?>

<?php
	if ( has_post_thumbnail( $post->ID ) ) {
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full-page-banner' );
?>
	<section class="page-banner">
		<section class="content-full-banner" style="background-image:url(<?php echo esc_attr( $image[0] ); ?>);">
			<section class="container">
				<h1><?php
				$title_page_meta_box_text = get_post_meta( get_the_ID(), 'title_page_meta_box_text', true );
				if( !empty( $title_page_meta_box_text ) ) {
					$title_page_meta_box_text_new = balanceTags ( stripcslashes( $title_page_meta_box_text ) ); // Embed code
					echo balanceTags ( stripslashes( addslashes( $title_page_meta_box_text_new ) ) ); // Embed code
				} 
				?></h1>
				<h2><?php
				$description_page_meta_box_text = get_post_meta( get_the_ID(), 'description_page_meta_box_text', true );
				if( !empty( $description_page_meta_box_text ) ) {
					$description_page_meta_box_text_new = balanceTags ( stripcslashes( $description_page_meta_box_text ) ); // Embed code
					echo balanceTags ( stripslashes( addslashes( $description_page_meta_box_text_new ) ) ); // Embed code
				} 
				?></h2>
				<?php
					$page_banner_excerpt = get_the_excerpt();
					if( !$page_banner_excerpt == "" ) :
				?>
				<p><?php the_excerpt(); ?></p>
				<?php endif; ?>
			</section>
		</section>
	</section>
<?php } else { ?>
	<section class="no-page-image-banner"></section>
<?php } ?>

<?php ruxen_site_content_start(); ?>
		
		<section class="container">
			<section class="site-page-content">
				<div id="post-<?php the_ID(); ?>" <?php post_class('page-content full-page-content'); ?>>
					<div class="content-area clearfix">
					
						<?php while ( have_posts() ) : the_post(); ?>
					
						<?php the_title( '<h3 class="page-title">', '</h1>' ); ?>
						
						<?php 
							the_content();
							
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
	
<?php ruxen_site_content_end(); ?>

<?php
get_footer();