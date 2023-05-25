<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
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
	exit;
}

global $post, $product, $smof_data;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
	'woocommerce-product-gallery',
	'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
	'woocommerce-product-gallery--columns-' . absint( $columns ),
	'images',
) );

$vertical_thumbnail = isset($smof_data['ftc_prod_thumbnails_style']) && $smof_data['ftc_prod_thumbnails_style'] == 'vertical';
$title = $product->get_title();

if(isset($smof_data['ftc_prod_advanced_zoom']) && $smof_data['ftc_prod_advanced_zoom'] == 'default'){
?>
<div class="details-img <?php if($vertical_thumbnail){ echo 'vertical' ;} ?>">

	<?php
	if( $vertical_thumbnail ){
		do_action( 'woocommerce_product_thumbnails' ); 
	}
	
	echo '<div class="images">';
	
	do_action('ftc_before_product_image');
	
	if ( has_post_thumbnail() ) {
		$post_thumbnail_id = get_post_thumbnail_id( $post->ID );
		$full_size_image   = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
		$attributes = array(
			'title'                   => get_post_field( 'post_excerpt', $post_thumbnail_id ),
			'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
			'data-src'                => $full_size_image[0],
			'data-large_image'        => $full_size_image[0],
			'data-large_image_width'  => $full_size_image[1],
			'data-large_image_height' => $full_size_image[2],
		);
		
		if( isset($smof_data['ftc_prod_cloudzoom']) && $smof_data['ftc_prod_cloudzoom'] == 1 ){
			$html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '" class="woocommerce-main-image cloud-zoom zoom '.(wp_is_mobile()?'':'on_pc').'" id=\'product_zoom\' data-rel="position:\'inside\',showTitle:0,titleOpacity:0.5,lensOpacity:0.5,fixWidth:362,fixThumbWidth:72,fixThumbHeight:72,adjustX: 0, adjustY:'.(wp_is_mobile()?'0':'-4').'">';
			$html .= get_the_post_thumbnail( $post->ID, 'woocommerce_single', $attributes );
			$html .= '</a>';
			$html .= '</div>';
			$html .='<div  class="ftc_lightbox" >';
			$html .= '<a href="' . esc_url( $full_size_image[0] ) . '" class="swipebox" title="'.esc_html($title).'">';
                        $html .= '<span class="fullscreen">'.esc_html__('Fullscreen', 'corona').'';
				$html .= '</span>';
			$html .= get_the_post_thumbnail( $post->ID, 'woocommerce_single', $attributes );
		
			$html .='</a></div>';
		}
		else{
			$html  = '<div data-thumb="' . get_the_post_thumbnail_url( $post->ID, 'shop_thumbnail' ) . '" class="woocommerce-product-gallery__image"><a href="' . esc_url( $full_size_image[0] ) . '" class="swipebox" title="'.esc_html($title).'">';
			$html .= get_the_post_thumbnail( $post->ID, 'woocommerce_single', $attributes );
			global $product;
			$attachment_ids = $product->get_gallery_image_ids();
			$html .= '</a></div>';
		}
	} else {
		$html  = '<div class="woocommerce-product-gallery__image--placeholder ">';
		$html  .= '<a class="swipebox" href="'.esc_url( wc_placeholder_img_src()).'" >';
		$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'corona' ) );
		$html .= '</a></div>';
	}
	
	echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, get_post_thumbnail_id( $post->ID ) );
	
	echo '</div>';
	?>

	<?php 
	if( !$vertical_thumbnail ){
		do_action( 'woocommerce_product_thumbnails' ); 
	}
	?>

</div>
<?php
}
elseif(isset($smof_data['ftc_prod_advanced_zoom']) && $smof_data['ftc_prod_advanced_zoom'] == 'type_2'){
	?>
	<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?> ftc-grid-main-images" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
		<figure class="woocommerce-product-gallery__wrapper">
			<?php
			if ( $product->get_image_id() ) {
				$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
			} else {
				$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
				$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'corona' ) );
				$html .= '</div>';
			}
		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

		do_action( 'woocommerce_product_thumbnails' );
		?>
	</figure>
	</div>
	<?php
	}
	else{
	?>
	<div class="ftc-adzoom details-img">
		<div class="images">
			<?php do_action('ftc_before_product_image'); ?>
			<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
				<figure class="woocommerce-product-gallery__wrapper">
					<?php
					if ( $product->get_image_id() ) {
						$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
					} else {
						$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
						$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'corona' ) );
						$html .= '</div>';
					}

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped

		do_action( 'woocommerce_product_thumbnails' );
		?>
	</figure>
	</div>
	</div>
	</div>

	<?php

	} 
