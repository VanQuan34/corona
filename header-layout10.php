<?php
/**
* The header for our theme
*
* This is the template that displays all of the <head> section and everything up until <div id="content">
*
* @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
*
* @package WordPress
* @subpackage Carna
* @since 1.0
* @version 1.0
*/

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
    <?php global $smof_data; ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">

    <?php 
    ftc_theme_favicon();
    wp_head(); 
    ?>
</head>

<body <?php body_class(); ?> >
    <?php ftc_header_mobile_navigation(); ?>
    <div id="page" class="site fixed-media">
        <a class="skip-link screen-reader-text" href="#content"><?php esc_attr( 'Skip to content', 'corona' ); ?></a>
        <div class="content-media">
         <?php global $ftc_page_datas ;
         $slider = $ftc_page_datas['ftc_page_revo_slider'];
         if ( $slider ) {

            $slider_shortcode = '[rev_slider alias="' . $slider . '"]';

            echo do_shortcode( $slider_shortcode );

        }

        ?>
    </div>
    <header id="masthead" class="site-header">
        <div class="header-ftc header-<?php echo esc_attr($smof_data['ftc_header_layout']); ?>">
            <div class="header-content header-sticky">
                <div class="container">   
                    <div class="mobile-button">
                        <div class="mobile-nav">
                            <i class="fa fa-bars"></i>
                        </div>
                    </div>

                    <div class="logo-wrapper is-desktop"><?php ftc_theme_logo(); ?></div>
                    <div class="logo-wrapper is-mobile"><?php ftc_theme_mobile_logo(); ?></div>
                    <div class="menu-wrapper">
                        <?php if ( has_nav_menu( 'primary' ) ) : ?>
                            <div class="navigation-primary">
                                <?php get_template_part( 'template-parts/navigation/navigation', 'primary' ); ?>
                            </div><!-- .navigation-top -->
                        <?php endif; ?>
                    </div>
                    <div class="setting-wrapper">
                        <?php if( isset($smof_data['ftc_enable_search']) && $smof_data['ftc_enable_search'] ): ?>
                            <div class="ftc-search-product"><?php ftc_get_search_form_not_category(); ?></div>
                        <?php endif; ?>
                        <?php if( isset($smof_data['ftc_enable_tiny_shopping_cart']) && $smof_data['ftc_enable_tiny_shopping_cart'] ): ?>
                            <div class="ftc-shop-cart"><?php echo wp_kses_post(ftc_tiny_cart()); ?></div>
                        <?php endif; ?>
                        
                        <div class="toggle-menu">
                            <div class="mobile-nav-desk"> <i class="fa fa-bars"></i></div>
                            <div class="content-toggle" style="display:none">
                                <?php if( isset($smof_data['ftc_header_language']) && $smof_data['ftc_header_language'] ): ?>
                                    <div class="ftc-sb-language"><?php ftc_wpml_language_selector(); ?></div>
                                <?php endif; ?>
                                <?php if( isset($smof_data['ftc_header_currency']) && $smof_data['ftc_header_currency'] ): ?>
                                    <div class="header-currency"><?php ftc_woocommerce_multilingual_currency_switcher(); ?></div>
                                <?php endif; ?>
                                <?php if( isset($smof_data['ftc_enable_tiny_account']) && $smof_data['ftc_enable_tiny_account'] ): ?>
                                    <div class="ftc-sb-account"><?php print_r(ftc_tiny_account()) ; ?></div>
                                <?php endif; ?>
                                <div class="ftc-my-wishlist"><?php echo wp_kses_post(ftc_tini_wishlist()); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </header><!-- #masthead -->

    <div class="site-content-contain">
        <div id="content" class="site-content">
