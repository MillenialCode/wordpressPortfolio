<?php
/*
	* The template used for displaying none content
*/
?>

<article>
	<section id="page-content" class="none-content-list clearfix">
		<div class="arthive-content-list">
		
		<h3 class="page-title"><?php _e( 'None Content', 'ruxen' ); ?></h3>
	
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
		
		<?php $get_started_here = __( 'Get started here.', 'ruxen' ); ?>

		<p class=><?php printf( __( 'Ready to publish your first post? ', 'ruxen' ) . '<a href="%s">' . $get_started_here . '</a>', admin_url( 'post-new.php' ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

		<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'ruxen' ); ?></p>
		
		<div class="content-none-search">
			<?php get_search_form(); ?>
		</div>
		
		<?php else : ?>

		<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ruxen' ); ?></p>
		<div class="content-none-search">
			<?php get_search_form(); ?>
		</div>

		<?php endif; ?>
			
		</div>
	</section>
</article>