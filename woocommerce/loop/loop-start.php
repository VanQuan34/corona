<?php
/**
 * Product Loop Start
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version    5.0.0
 */
?>
<?php 
global $smof_data;
$style_product = $class_mansory = $class_animation = $class_slider = '';
if(isset($smof_data['ftc_effect_hover_product_style']) ) {
	$style_product = $smof_data['ftc_effect_hover_product_style'] ;
}

if(isset($smof_data['ftc_mansory_product_shop']) && $smof_data['ftc_mansory_product_shop'] ) {
	$class_mansory = 'ftc-mansory-shop' ;
}
if(isset($smof_data['ftc_animation_product_shop']) && $smof_data['ftc_animation_product_shop'] ) {
	$class_animation = 'animation-shop' ;
}
if(isset($smof_data['ftc_carousel_product_shop']) && $smof_data['ftc_carousel_product_shop'] && !$smof_data['ftc_mansory_product_shop'] && !$smof_data['ftc_loadmore_button_infinite']){
	$class_slider = 'slider-shop' ;
}
if( isset($_GET['opt-slider']) ){
	$layout = $_GET['opt-slider'];
	if( $layout = 'on'){
		$class_slider = 'slider-shop' ;
	}
}
?>
<div class="products owl-carousel <?php echo esc_attr($style_product); ?> <?php echo esc_attr($class_mansory); ?> <?php echo esc_attr($class_animation); ?> <?php echo esc_attr($class_slider) .' loading'; ?>">