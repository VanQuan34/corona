<!DOCTYPE html>
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
<?php
$header_classes = array();
if( isset($smof_data['ftc_enable_sticky_header']) && $smof_data['ftc_enable_sticky_header'] ){
    $header_classes[] = 'header-sticky';
}
?>  
<body <?php body_class(); ?>>
    <?php ftc_header_mobile_navigation(); ?>
    <div id="page" class="site">
       <header id="masthead" class="site-header">
           <?php
            global $smof_data;
                    $header  =  '';
                    if(isset($smof_data['ftc_header_template'])  && isset($smof_data['ftc_header_layout']) && $smof_data['ftc_header_layout'] = 'template' && $smof_data['ftc_header_template'] !='' ){
                        $header = $smof_data['ftc_header_template'] ;
                    }
            ?>
        <div class="ftc-header-template header-ftc-element <?php echo sanitize_title(get_the_title($header)) ?>">
            <div class="header-content <?php echo esc_attr(implode(' ', $header_classes)); ?>">
                <div class="container-full">
<?php echo do_shortcode('[miniorange_social_login]') ?>
                    <?php 
                    echo \Elementor\Plugin::$instance->frontend->get_builder_content($header);

                    ?>
                </div>
            </div>
            <div class="header-mobile <?php echo esc_attr(implode(' ', $header_classes)); ?>">
                <div class="mobile-button">
                    <div class="mobile-nav">
                        <i class="fa fa-bars"></i>
                    </div>
                </div>

                <div class="logo-wrapper is-mobile"><?php ftc_theme_mobile_logo(); ?></div>
                 <?php if (isset($smof_data['ftc_enable_tiny_shopping_cart']) && $smof_data['ftc_enable_tiny_shopping_cart'] ): ?>
                    <div class="ftc-shop-cart"><?php echo wp_kses_post(ftc_tiny_cart()); ?></div>
                <?php endif; ?>
            </div>
        </div>
    </header><!-- #masthead -->
    <div class="site-content-contain">
      <div id="content" class="site-content">
