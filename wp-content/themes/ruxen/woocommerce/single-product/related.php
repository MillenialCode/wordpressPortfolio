<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

$related = $product->get_related( $posts_per_page );

if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

	<div class="related products">
		<h4 class="section-title"><?php _e( 'Related Products', 'woocommerce' ); ?></h4>
		<div class="section-body row">
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
				<div class="col-sm-4 col-xs-12 product">
					<a href="<?php the_permalink(); ?>">
						<?php wc_get_template_part( 'content', 'related-products' ); ?>
					</a>
				</div>
			<?php endwhile; // end of the loop. ?>
		</div>
	</div>
	
<?php endif;

wp_reset_postdata();
