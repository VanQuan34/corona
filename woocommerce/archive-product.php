<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     5.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $smof_data;

get_header( $smof_data['ftc_header_layout'] );

$extra_class = "";
$page_column_class = ftc_page_layout_columns_class($smof_data['ftc_prod_cat_layout']);

$show_breadcrumb = get_post_meta(wc_get_page_id( 'shop' ), 'ftc_show_breadcrumb', true);
$show_page_title = apply_filters( 'woocommerce_show_page_title', true ) && get_post_meta(wc_get_page_id( 'shop' ), 'ftc_show_page_title', true);
if($show_breadcrumb && isset($smof_data['ftc_breadcrumb_layout']) ){
	$extra_class = 'show_breadcrumb_'.$smof_data['ftc_breadcrumb_layout'];
}
ftc_breadcrumbs_title($show_breadcrumb, $show_page_title, woocommerce_page_title(false));

$show_top_content_widget_area = is_active_sidebar('product-category-top-content') && $smof_data['ftc_prod_cat_top_content'];
?>
<div class="page-container container <?php echo esc_attr($extra_class) ?>">
	<div class="row">

		<?php if( $page_column_class['left_sidebar'] || $page_column_class['right_sidebar'] ): ?>
			<div class="button-sidebar" title="Filter">
				<i class="fa fa-plus-square-o" ></i>
			</div>
		<?php endif; ?>
		
		<!-- Left Sidebar -->
		<?php if( $page_column_class['left_sidebar'] ): ?>
			<aside id="left-sidebar" class="ftc-sidebar <?php echo esc_attr($page_column_class['left_sidebar_class']); ?>">
				<?php if( is_active_sidebar($smof_data['ftc_prod_cat_left_sidebar']) ): ?>
					<?php dynamic_sidebar( $smof_data['ftc_prod_cat_left_sidebar'] ); ?>
				<?php endif; ?>
			</aside>
		<?php endif; ?>	

		<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
		?>
		<div id="main-content" class="<?php echo esc_attr($page_column_class['main_class']); ?>">	
			<div id="primary" class="site-content">
					<?php
					global $post;
					$id = get_queried_object_id();
					$banner_id  = get_term_meta($id, 'shortcode_banner_id', true);
					if( !empty($banner_id) && is_tax('product_cat') ){
						?>
						<div class="ftc-banner-category"><?php echo wp_get_attachment_image($banner_id, 'full'); ?></div>
						<?php
					}
					?>
				
					<?php do_action( 'woocommerce_archive_description' ); ?>

				<?php if ( have_posts() ) : ?>

					<div class="before-loop-wrapper">
						<?php
				/**
				 * woocommerce_before_shop_loop hook
				 *
				 * @hooked woocommerce_result_count - 20
				 * @hooked woocommerce_catalog_ordering - 30
				 */
				do_action( 'woocommerce_before_shop_loop' );
				?>
			</div>
			
			<!-- Top Sidebar -->
			<?php if( $show_top_content_widget_area ): ?>
				<aside class="ftc-sidebar product-category-top-content" style="display: none">
					<?php dynamic_sidebar( 'product-category-top-content' ); ?>
				</aside>
			<?php endif; ?>
			
			<?php 
			global $woocommerce_loop;
			if( absint($smof_data['ftc_prod_cat_columns']) > 0 ){
				$woocommerce_loop['columns'] = absint($smof_data['ftc_prod_cat_columns']);
			}

			if (isset($smof_data['ftc_advanced_filter_product_shop']) && $smof_data['ftc_advanced_filter_product_shop']) {
				?>
				<ul class="ftc-product-tabs-filter">
					<li data-filter="*" class="current"><?php echo esc_html__('All','corona') ?></li>
					<li data-filter=".featured" class=""><?php echo esc_html__('Hot Products','corona'); ?></li>
					<li data-filter=".sale" class=""><?php echo esc_html__('Sales Products', 'corona'); ?></li>
					<li data-filter=".variable" class=""><?php echo esc_html__('Variation Products', 'corona'); ?></li>                               
				</ul>
				<?php
			}
			
			?>

			<div class="woocommerce columns-<?php echo esc_attr($woocommerce_loop['columns']); ?>">
				<?php echo ftc_boxed_sidebar_filter(); ?>
				<?php woocommerce_product_loop_start(); ?>

				<?php $woocommerce_loop['loop'] = 0; ?>
				<?php if ( wc_get_loop_prop( 'total' ) ) : ?>
					<?php while ( have_posts() ) : the_post(); ?>

						<?php wc_get_template_part( 'content', 'product' ); ?>

					<?php endwhile; // end of the loop. ?>
				<?php endif;  ?>

				<?php woocommerce_product_loop_end(); ?>
			</div>
			<div class="after-loop-wrapper">
				<?php
				/**
				 * woocommerce_after_shop_loop hook
				 *
				 * @hooked woocommerce_pagination - 10
				 */
				do_action( 'woocommerce_after_shop_loop' );
				?>
			</div>
			
		<?php else : ?>

			<?php wc_get_template( 'loop/no-products-found.php' ); ?>

		<?php endif; ?>

		<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
		?>
	</div>
</div>
<!-- Right Sidebar -->
<?php if( $page_column_class['right_sidebar'] ): ?>
	<aside id="right-sidebar" class="ftc-sidebar <?php echo esc_attr($page_column_class['right_sidebar_class']); ?>">
		<?php if( is_active_sidebar($smof_data['ftc_prod_cat_right_sidebar']) ): ?>
			<?php dynamic_sidebar( $smof_data['ftc_prod_cat_right_sidebar'] ); ?>
		<?php endif; ?>
	</aside>
<?php endif; ?>
</div>
</div>
<?php get_footer( 'shop' ); ?>