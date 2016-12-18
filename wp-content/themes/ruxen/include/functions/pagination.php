<?php
/*------------- PAGINATION START -------------*/
function ruxen_pagination() {
	if( is_singular() )
		return;

	global $wp_query;

	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	if( $paged >= 1 )
		$links[] = $paged;

	if( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<nav class="home-page-navigation"><ul class="pagination">' . "\n";

	if( get_previous_posts_link() )
		printf( '<li>' . get_previous_posts_link( '<span aria-hidden="true">&laquo;</span>' ) . '</li>' );

	if( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if( ! in_array( 2, $links ) )
			echo '<li><a href="">&middot;&middot;&middot;</a></li>';
	}

	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	if( ! in_array( $max, $links ) ) {
		if( ! in_array( $max - 1, $links ) )
			echo '<li><a href="">&middot;&middot;&middot;</a></li>' . "\n";

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	if( get_next_posts_link() )
		printf( '<li>' . get_next_posts_link( '<span aria-hidden="true">&raquo;</span>' ) . '</li>' );

	echo '</ul></nav>' . "\n";
}
/*------------- PAGINATION END -------------*/

/*------------- SINGLE NAVIGATION START -------------*/
function ruxen_single_nav() {
	$post_navigation_hide = get_theme_mod( 'post_navigation_hide' );
	if( !$post_navigation_hide == '1' ):
	$ruxen_single_nav_prev = __( 'Previous Post', 'ruxen' );
	$ruxen_single_nav_next = __( 'Next Post', 'ruxen' );
?>
	<div class="post-nav">
		<nav>
			<ul class="pager">
				<li class="previous"><?php previous_post_link( '%link', '<span aria-hidden="true">&lt;&lt;</span> ' . $ruxen_single_nav_prev . ' <div class="pager-post-name">%title</div>' ); ?> </li>
				<li class="next"><?php next_post_link( '%link', '' . $ruxen_single_nav_next . ' <span aria-hidden="true">&gt;&gt;</span> <div class="pager-post-name">%title</div>' ); ?></li>
			</ul>
		</nav>
	</div>
<?php
	endif;
}
/*------------- SINGLE NAVIGATION END -------------*/