<?php
/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://codecanyon.net/user/teknofraction/portfolio
 * @since      1.0.0
 *
 * @package    pslfree
 * @subpackage pslfree/includes
 */

	/**
	 * Remove woocommerce hooked action (method woocommerce_template_loop_product_thumbnail on woocommerce_before_shop_loop_item_title
	 * hook
	 */
	remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
	/**
	 * Add our own action to the woocommerce_before_shop_loop_item_title hook with the same priority that woocommerce used
	 */
	add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

	/**
	 * WooCommerce Loop Product Thumbs
	 */
if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
	/**
	 * Dislpay thumbnail HTML
	 *
	 * @return string
	 */
	function woocommerce_template_loop_product_thumbnail() {
		$thumbnail = woocommerce_get_product_thumbnail();
		return $thumbnail;
	}
}

	/**
	 * WooCommerce Product Thumbnail
	 */
if ( ! function_exists( 'woocommerce_get_product_thumbnail' ) ) {

	/**
	 * Add custom class to thumbnail
	 *
	 * @param string $size Size of the thumbnail.
	 * @param int    $placeholder_width Width of the thumbnail.
	 * @param int    $placeholder_height Height of the thumbnail.
	 */
	function woocommerce_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0 ) {
		global $post, $woocommerce;

		// NOTE: those are PHP 7 ternary operators. Change to classic if/else if you need PHP 5.x support.
		$placeholder_width = ! $placeholder_width ?
		wc_get_image_size( 'shop_catalog_image_width' )['width'] :
		$placeholder_width;

		$placeholder_height = ! $placeholder_height ?
		wc_get_image_size( 'shop_catalog_image_height' )['height'] :
		$placeholder_height;

		/**
		 * EDITED HERE: here I added a div around the <img> that will be generated
		 */

		/**
		 * This outputs the <img> or placeholder image.
		 * it's a lot better to use get_the_post_thumbnail() that hardcoding a text <img> tag
		 * as WordPress wil add many classes, srcset and stuff.
		 */

		/**
		 * Added div .placeholder
		 */
		?>
		<div class="placeholder">
			<?php
			echo has_post_thumbnail() ?
				get_the_post_thumbnail( $post->ID, $size ) :

				'<img src="' . esc_html( wc_placeholder_img_src() ) . '" width="' . esc_html( $placeholder_width ) . '" height="' . esc_html( $placeholder_height ) . '" />';
			?>
		</div>
		<?php
	}
}



add_filter( 'woocommerce_post_class', 'add_post_class', 21, 3 );
/**
 * Add custom class to Products
 *
 * @param string $classes list of classes to be added.
 * @return string
 */
function pslfree_add_post_class( $classes ) {
	if ( 'product' === get_post_type() ) {
		if ( is_singular( 'product' ) ) {
			$classes = array_merge( array( 'pslfree-single-product' ), $classes );
		} else {
			// only add these classes if we're on a product category page.
			$classes = array_merge( array( 'pslfree-product' ), $classes );
		}
	}
	return $classes;
}
