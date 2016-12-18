<?php
/*------------- LATEST POST WIDGET START -------------*/
function ruxen_latest_posts_register_widgets() {
	register_widget( 'ruxen_latest_Latest_Posts_Widget' );
}
add_action( 'widgets_init', 'ruxen_latest_posts_register_widgets' );

class ruxen_latest_Latest_Posts_Widget extends WP_Widget {
	function ruxen_latest_Latest_Posts_Widget() {
		parent::__construct(
	            'ruxen_latest_Latest_Posts_Widget',
        	    __( 'Ruxen Latest Posts', 'ruxen' ),
 	           array( 'description' => __( 'Latest posts widget.', 'ruxen' ), )
		);
	}
	
	function widget( $args, $instance ) {
		
		echo $args['before_widget'];
		$latest_posts_widget_title_control = esc_attr( $instance['latest_posts_widget_title'] );
		if ( !empty( $instance['latest_posts_widget_title'] ) ) {
			echo '<div class="widget-title"><h4>'. esc_attr( $latest_posts_widget_title_control ) .'</h4></div>';
		}
		
		if( $instance) {
			$latest_posts_widget_title = strip_tags( esc_attr( $instance['latest_posts_widget_title'] ) );
			$postcount = strip_tags( esc_attr( $instance['postcount'] ) );
			$postfeaturedimage = strip_tags( esc_attr( $instance['postfeaturedimage'] ) );
			$postdate = strip_tags( esc_attr( $instance['postdate'] ) );
			$postcategory = strip_tags( esc_attr( $instance['postcategory'] ) );
			$postexcerpt = strip_tags( esc_attr( $instance['postexcerpt'] ) );
			$categorylist = strip_tags( esc_attr( $instance['categorylist'] ) );
		} 
		?>
		<ul class="latest-posts-widget">
			<?php
				$args_latest_posts = array(
				'posts_per_page' => $postcount,
				'cat' => $categorylist
				); 
				$wp_query = new WP_Query($args_latest_posts);
				while ( $wp_query->have_posts() ) :
				$wp_query->the_post();
			?>
			<li>
				<?php if( !empty($postcategory) or !empty($postdate) ): ?>
					<div class="latest-posts-widget-info">
						<?php if( !empty($postcategory) ): ?>
							<span class="category"><?php $category = get_the_category(); echo $category[0]->cat_name; ?></span>
						<?php endif; ?>
						<?php if( !empty($postcategory) and !empty($postdate) ): ?>
							<span class="separate">//</span>
						<?php endif; ?>
						<?php if( !empty($postdate) ): ?>
							<span class="date"><?php the_time('j.m.Y'); ?></span>
						<?php endif; ?>
					</div>
				<?php endif; ?>
				<h3><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
				<?php if( !empty($postfeaturedimage) ): ?>
				<div class="latest-post-images">
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'latestposts' );
						}
						?>
					</a>
				</div>
				<?php endif; ?>
				<?php if( !empty($postexcerpt) ): ?>
					<?php the_excerpt(); ?>
				<?php endif; ?>
			</li>
			<?php endwhile; ?>
		</ul>
		<?php
		echo $args['after_widget'];
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['latest_posts_widget_title'] = strip_tags( esc_attr( $new_instance['latest_posts_widget_title'] ) );
		$instance['postcount'] = strip_tags( esc_attr( $new_instance['postcount'] ) );
		$instance['postfeaturedimage'] = strip_tags( esc_attr( $new_instance['postfeaturedimage'] ) );
		$instance['postdate'] = strip_tags( esc_attr( $new_instance['postdate'] ) );
		$instance['postcategory'] = strip_tags( esc_attr( $new_instance['postcategory'] ) );
		$instance['postexcerpt'] = strip_tags( esc_attr( $new_instance['postexcerpt'] ) );
		$instance['categorylist'] = strip_tags( esc_attr( $new_instance['categorylist'] ) );
		return $instance;
	}

	function form($instance) {
	 	$latest_posts_widget_title = '';
	 	$postcount = '';
		$postfeaturedimage = '';
		$postdate = '';
		$postcategory = '';
		$postexcerpt = '';
		$categorylist = '';

		if( $instance) {
			$latest_posts_widget_title = strip_tags( esc_attr( $instance['latest_posts_widget_title'] ) );
			$postcount = strip_tags( esc_attr( $instance['postcount'] ) );
			$postfeaturedimage = strip_tags( esc_attr( esc_textarea( $instance['postfeaturedimage'] ) ) );
			$postdate = strip_tags( esc_attr( esc_attr( $instance['postdate'] ) ) );
			$postcategory = strip_tags( esc_attr( esc_attr( $instance['postcategory'] ) ) );
			$postexcerpt = strip_tags( esc_attr( esc_attr( $instance['postexcerpt'] ) ) );
			$categorylist = strip_tags( esc_attr( esc_attr( $instance['categorylist'] ) ) );
		} ?>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_title' ) ); ?>"><?php _e( 'Widget Title:', 'ruxen' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'latest_posts_widget_title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'latest_posts_widget_title' ) ); ?>" type="text" value="<?php echo esc_attr( $latest_posts_widget_title ); ?>" />
		</p>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'postcount' ) ); ?>"><?php _e( 'Post Count:', 'ruxen' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'postcount' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postcount' ) ); ?>" type="text" value="<?php echo esc_attr( $postcount ); ?>" />
		</p>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'categorylist' ) ); ?>"><?php _e( 'Category:', 'ruxen' ); ?></label>
			<select name="<?php echo esc_attr( $this->get_field_name('categorylist') ); ?>" id="<?php echo esc_attr( $this->get_field_id('categorylist') ); ?>" class="widefat"> 
				<option value=""><?php echo __( 'All Categories', 'ruxen' ); ?></option>
				<?php
				 $categories =  get_categories('child_of=0'); 
				 foreach ($categories as $category) {
					$deneme = '';
					if ( $categorylist == $category->cat_ID )
					{
						$deneme = "selected";
					}
					$option = '<option value="' . esc_attr( $category->cat_ID ) . '"' . $deneme . '>';
					$option .= $category->cat_name;
					$option .= '</option>';
					echo balanceTags( $option );
				 }
				?>
			</select>
		</p>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'postfeaturedimage' ) ); ?>"><?php _e( 'Post Featured Image:', 'ruxen' ); ?></label>
			<input type="checkbox" class="widefat" <?php checked($postfeaturedimage, 'on'); ?> id="<?php echo esc_attr( $this->get_field_id( 'postfeaturedimage' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postfeaturedimage' ) ); ?>" />
		</p>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'postdate' ) ); ?>"><?php _e( 'Post Date:', 'ruxen' ); ?></label>
			<input type="checkbox" class="widefat" <?php checked($postdate, 'on'); ?> id="<?php echo esc_attr( $this->get_field_id( 'postdatepostdate' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postdate' ) ); ?>" />
		</p>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'postcategory' ) ); ?>"><?php _e( 'Post Category:', 'ruxen' ); ?></label>
			<input type="checkbox" class="checkbox" <?php checked($postcategory, 'on'); ?> id="<?php echo esc_attr( $this->get_field_id( 'postcategory' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postcategory' ) ); ?>" />
		</p>
		 
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'postexcerpt' ) ); ?>"><?php _e( 'Post Excerpt:', 'ruxen' ); ?></label>
			<input type="checkbox" class="checkbox" <?php checked($postexcerpt, 'on'); ?> id="<?php echo esc_attr( $this->get_field_id( 'postexcerpt' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'postexcerpt' ) ); ?>" />
		</p>
		
	<?php }
	
}
/*------------- LATEST POST WIDGET END -------------*/