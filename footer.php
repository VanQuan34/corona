<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage corona
 * @since 1.0
 * @version 1.0
 */

?>

</div><!-- #content -->
<div class="container-full top-footer">
	<?php
	if ( is_active_sidebar( 'footer-top' ) ) { ?>
		<div class="widget-column footer-top">
			<?php dynamic_sidebar( 'footer-top' ); ?>
		</div>
	<?php } ?>
</div>  
<footer id="colophon" class="site-footer">
	<?php
	get_template_part( 'template-parts/footer/footer', 'widgets' );
	?>
</footer><!-- #colophon -->
</div><!-- .site-content-contain -->
</div><!-- #page -->

<div class="ftc-close-popup"></div>
<?php
global $smof_data, $woocommerce;
if (isset($smof_data['ftc_mobile_layout']) && $smof_data['ftc_mobile_layout']): 
	?>
	<div class="footer-mobile">
		<div class="mobile-home">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" >
				<i class="fa fa-home"></i>
				<?php echo esc_html('Home','corona'); ?>
			</a>   
		</div>  
		<div class="mobile-view-cart" >
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" >
				<i class="fa fa-shopping-cart"></i>
				<?php echo esc_html('Cart','corona'); ?>
				<?php echo wp_kses_post(ftc_cart_subtotal()); ?>
			</a>   
		</div>
		<div class="mobile-wishlist">
	
			<?php if( class_exists('YITH_WCWL')): ?>
				<div class="my-wishlist-wrapper"><?php echo wp_kses_post(ftc_tini_wishlist()); ?></div>
			<?php endif; ?>

		</div>
		<div class="mobile-account">
			<?php 
			$_user_logged = is_user_logged_in();
			ob_start();
			?>
			<a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php echo esc_html('Login','corona'); ?>">
				<i class="fa fa-user"></i>
				<?php if ($_user_logged): ?>
					<?php echo esc_html('Account','corona'); ?>
				<?php endif; ?>
				<?php if (!$_user_logged): ?>
					<?php echo esc_html('Login','corona'); ?>
				<?php endif; ?>
			</a>
		</div>
	</div>
<?php endif; ?>
<?php 
global $smof_data, $ftc_page_datas;
if( ( !wp_is_mobile() && $smof_data['ftc_back_to_top_button'] && isset($smof_data['ftc_back_to_top_button'] )) || ( wp_is_mobile() && $smof_data['ftc_back_to_top_button_on_mobile'] && isset($smof_data['ftc_back_to_top_button_on_mobile']) ) ): 
	?>
<div id="to-top" class="scroll-button">
	<a class="scroll-button" href="javascript:void(0)" title="<?php echo esc_html('Back to Top', 'corona'); ?>"><?php echo esc_html('Back to Top', 'corona'); ?></a>
</div>
<?php endif; ?>
<?php wp_footer(); ?>
<?php if( $ftc_page_datas['ftc_page_enable_popup'] == 1 && (isset($smof_data['ftc_enable_popup']) && $smof_data['ftc_enable_popup']) && is_active_sidebar('popup-newletter')) : ?>
<?php corona_popup_newsletter(); ?>
<?php endif;  ?>
</body>
</html>
