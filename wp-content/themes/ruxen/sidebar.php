<?php ruxen_sidebar_start(); ?>

	<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
		<div class="sidebar-right sidebar">
			<?php dynamic_sidebar( 'blog-sidebar' ); ?>
		</div>
	<?php } ?>
	
<?php ruxen_sidebar_end(); ?>