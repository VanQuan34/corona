<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 5.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $smof_data;

$lazy_load = isset($smof_data['ftc_prod_lazy_load']) && $smof_data['ftc_prod_lazy_load'] && !( defined( 'DOING_AJAX' ) && DOING_AJAX );
if( defined( 'YITH_INFS' ) && (is_shop() || is_product_taxonomy()) ){ /* Compatible with YITH Infinite Scrolling */
	$lazy_load = false;
}

// Ensure visibility
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

$class_pro = $class_pro_fea  = $class_pro_sell = '';
if ( $product->is_on_sale() ){
	$class_pro = 'sale';
}
if ($product->is_featured() ){
	$class_pro_fea = 'featured';
}
if ($product->is_type( 'variable' )){
	$class_pro_sell = 'variable';
}

$class_gallery = '';
if (is_shop() && isset($smof_data['ftc_gallery_on_product']) && $smof_data['ftc_gallery_on_product'] ){
	$class_gallery = 'product-gallery';
}

$class_catalog = '';
if (is_shop() && isset($smof_data['ftc_enable_catalog_mode']) && $smof_data['ftc_enable_catalog_mode'] ){
	$class_catalog = 'product-catalog';
}

?>
<div class="ftc-product product <?php echo esc_attr($class_pro ); ?> <?php echo esc_attr($class_pro_fea ); ?> <?php echo esc_attr($class_pro_sell ); ?> <?php echo esc_attr($class_gallery ); ?>">
	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
	
	<div class="item-image <?php echo esc_attr(($lazy_load)?'lazy-loading':'') ?> <?php if(isset($smof_data['ftc_variation_product_shop']) && $smof_data['ftc_variation_product_shop']): ?> images<?php endif; ?>">

		<?php if(isset($smof_data['ftc_variation_product_shop']) && $smof_data['ftc_variation_product_shop']){
			echo '<div class="woocommerce-product-gallery__image" data-thumb="">';
		}
		?>
		<a href="<?php the_permalink(); ?>">

			<?php
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_show_product_loop_sale_flash - 10
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
			?>

		</a>
		<?php if(isset($smof_data['ftc_variation_product_shop']) && $smof_data['ftc_variation_product_shop']){
			echo '</div>';
		}
		?>
		<?php
		/**
		 * woocommerce_shop_loop_item_title hook.
		 *
		 * @hooked woocommerce_template_loop_product_title - 10
		 */
		do_action( 'woocommerce_shop_loop_item_title' );

		/**
		 * woocommerce_after_shop_loop_item_title hook
		 *
		 * @hooked woocommerce_template_loop_rating - 5
		 * @hooked woocommerce_template_loop_price - 10
		 */
		do_action( 'woocommerce_after_shop_loop_item_title' );
		?>

	</div>
	<div class="item-description">
		<?php
		if(is_shop() && isset($smof_data['ftc_gallery_on_product']) && $smof_data['ftc_gallery_on_product'] ){
			echo ftc_template_gallery_image();
		}
		?>

		<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
	</div>

	<?php do_action( 'ftc_after_shop_loop_item' ); ?>
</div>