<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage corona
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <?php 
    global $smof_data;
    $_user_logged = is_user_logged_in();
    ?>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php
    ftc_theme_favicon();
    wp_head();
    ?>
</head>

<body <?php body_class(); ?> >
    <?php wp_body_open(); ?>
    <?php ftc_header_mobile_navigation(); ?>
    <div id="page" class="site">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'corona'); ?></a>

        <header id="masthead" class="site-header">
            <div class="header-ftc header-<?php echo esc_attr($smof_data['ftc_header_layout']); ?>">
                
                
                <div class="header-content">
					<?php echo do_shortcode('[miniorange_social_login]') ?>
                    <div class="container">

                        <div class="mobile-button">
                            <div class="mobile-nav"><i class="fa fa-bars"></i></div>
                        </div>
                        <?php if( isset($smof_data['ftc_middle_header_content'] ) && $smof_data['ftc_middle_header_content'] ): ?>
                            <div class="custom_content"><?php echo wp_kses_post(do_shortcode(stripslashes($smof_data['ftc_middle_header_content']))); ?></div>
                        <?php endif; ?>
                        <div class="logo-wrapper is-mobile"><?php echo wp_kses_post(ftc_theme_logo()); ?></div>
                        <div class="logo-wrapper is-desktop"><?php ftc_theme_logo(); ?></div>
                        <div class="wish-cart">
                            
                            <?php if (class_exists('YITH_WCWL') && $smof_data['ftc_enable_tiny_wishlist'] && isset($smof_data['ftc_enable_tiny_wishlist']) ): ?>
                            <div class="my-wishlist"><?php echo wp_kses_post(ftc_tini_wishlist()); ?></div>
                        <?php endif; ?>

                        <?php if ($smof_data['ftc_enable_tiny_shopping_cart'] && isset($smof_data['ftc_enable_tiny_shopping_cart'] )): ?>
                            <div class="ftc-shop-cart"><?php echo wp_kses_post(ftc_tiny_cart()); ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="header-content-menu">
                <?php if (has_nav_menu('primary')) : ?>
                    <div class="navigation-primary">
                        <?php get_template_part('template-parts/navigation/navigation', 'primary'); ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </header><!-- #masthead -->

    <div class="site-content-contain">
        <div id="content" class="site-content">