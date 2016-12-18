<!-- FOOTER START -->
<footer class="footer">
	<?php ruxen_footer_intagram_area(); ?>
	<section class="container">
		<section class="row">
			<div class="col-sm-4 col-xs-12">
				<?php ruxen_footer_logo(); ?>
			</div>
			<div class="col-sm-4 col-xs-12">
				<?php ruxen_footer_social_media_links(); ?>
			</div>
			<div class="col-sm-4 col-xs-12">
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<?php wp_nav_menu( array( 'depth' => 1, 'theme_location' => 'footermenu', 'fallback_cb' => 'ruxen_navwalker::fallback', 'walker'  => new ruxen_navwalker(), 'items_wrap'  => '<ul id="%1$s" class="%2$s">%3$s</ul>', 'menu_class' => 'nav navbar-nav' ) ); ?>
			</div>
			</div>
		</section>
	</section>
</footer>
<!-- FOOTER END -->
<?php ruxen_go_top(); ?>
<?php wp_footer(); ?>
</body>
</html>