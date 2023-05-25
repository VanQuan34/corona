<?php
/**
 * Single Product Thumbnails
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-thumbnails.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates 
 * @version     5.0.0
 */ 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product, $smof_data;

if(isset($smof_data['ftc_prod_advanced_zoom']) && $smof_data['ftc_prod_advanced_zoom'] == 'default'){

$attachment_ids = $product->get_gallery_image_ids();
$title = $product->get_title();
$vertical_thumbnail = isset($smof_data['ftc_prod_thumbnails_style']) && $smof_data['ftc_prod_thumbnails_style'] == 'vertical';

if ( $attachment_ids ) {
	if( is_array($attachment_ids) && has_post_thumbnail() && isset($smof_data['ftc_prod_cloudzoom']) && $smof_data['ftc_prod_cloudzoom'] == 1 ){
		array_unshift($attachment_ids, get_post_thumbnail_id());
	}
	$count_product = count($attachment_ids);
	?>
	<div class="thumbnails ftc-slider <?php echo esc_attr(( $count_product > 1 )?'loading':''); ?><?php if(isset($smof_data['ftc_prod_thumbnails_style']) && $smof_data['ftc_prod_thumbnails_style'] != 'vertical'): ?> owl-carousel <?php else: ?> vertical<?php endif; ?>">
			<ul class="details_thumbnails <?php if(isset($smof_data['ftc_prod_thumbnails_style']) && $smof_data['ftc_prod_thumbnails_style'] != 'vertical'): ?> owl-carousel <?php else: ?> vertical<?php endif; ?>">
			<?php
			$loop = 0;
			$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );

			foreach ( $attachment_ids as $attachment_id ) {

				$classes = array( 'zoom' );

				if ( $loop === 0 || $loop % $columns === 0 ) {
					$classes[] = 'first';
				}

				if ( ( $loop + 1 ) % $columns === 0 ) {
					$classes[] = 'last';
				}
				$image_class 	= esc_attr( implode( ' ', $classes ) );
				
				$full_size_image  = wp_get_attachment_image_src( $attachment_id, 'full' );
				$thumbnail        = wp_get_attachment_image_src( $attachment_id, 'shop_thumbnail' );
				$image_title	  = get_post_field( 'post_excerpt', $attachment_id );
				
				if( isset($smof_data['ftc_prod_cloudzoom']) && $smof_data['ftc_prod_cloudzoom'] == 1 ){
					$single_thumbnail = wp_get_attachment_image_src( $attachment_id, 'shop_single' );
					$image_class 	.= ' cloud-zoom-gallery ';
					$attributes = array(
						'title'                   => $image_title
						);
					$html  = '<li data-thumb="' . esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '" class="'.esc_attr($image_class).' swipebox" title="'.esc_html($title).'"data-rel="useZoom: \'product_zoom\', smallImage: \''.esc_url( $single_thumbnail[0] ).'\'">';
					$html .= wp_get_attachment_image( $attachment_id, 'shop_thumbnail', false, $attributes );
					$html .= '</a></li>';
				}
				else{
					$attributes = array(
						'title'                   => $image_title,
						'data-src'                => $full_size_image[0],
						'data-large_image'        => $full_size_image[0],
						'data-large_image_width'  => $full_size_image[1],
						'data-large_image_height' => $full_size_image[2],
						);
					$html  = '<li data-thumb="' . esc_url( $thumbnail[0] ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '" class="'.esc_attr($image_class).' swipebox" title="'.esc_html($title).'">';
					$html .= wp_get_attachment_image( $attachment_id, 'shop_thumbnail', false, $attributes );
					$html .= '</a></li>';
				}
				
				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $attachment_id );
				
				$loop++;
			}
			?>
		</ul>
		
		<?php if( $vertical_thumbnail ): ?>
			<div class="owl-controls">
				<div class="owl-nav">
					<div class="owl-prev"></div>
					<div class="owl-next"></div>
				</div>
			</div>
		<?php endif; ?>
		
	</div>
	<?php
}
}
	elseif(isset($smof_data['ftc_prod_advanced_zoom']) && $smof_data['ftc_prod_advanced_zoom'] == 'type_2'){
	global $product;

	$attachment_ids = $product->get_gallery_image_ids();

	if ( $attachment_ids && $product->get_image_id() ) {
		foreach ( $attachment_ids as $attachment_id ) {
		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id, 'full' ), $attachment_id); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
	}
	}

	}
	else{
	
	global $product;
	$attachment_ids = $product->get_gallery_image_ids();

	if ( $attachment_ids && $product->get_image_id() ) {
		foreach ( $attachment_ids as $attachment_id ) {
		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id ), $attachment_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
	}
	}


	}