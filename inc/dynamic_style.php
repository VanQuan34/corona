<?php 
global $smof_data;
if( !isset($data) ){
    $data = $smof_data;
}

$data = ftc_array_atts(
   array(
    /* FONTS */
    'ftc_body_font_enable_google_font'                  => 1
    ,'ftc_body_font_family'                             => "Arial"
    ,'ftc_body_font_google'                             => "Cormorant Garamond"

    ,'ftc_secondary_body_font_enable_google_font'       => 1
    ,'ftc_secondary_body_font_family'                   => "Raleway"
    ,'ftc_secondary_body_font_google'                   => "Raleway"

    /* COLORS */
    ,'ftc_primary_color'                                    => "#0a7986"

    ,'ftc_secondary_color'                              => "#333"

    ,'ftc_body_background_color'                                => "#ffffff"
    /* RESPONSIVE */
    ,'ftc_responsive'                                   => 1
    ,'ftc_layout_fullwidth'                             => 0
    ,'ftc_enable_rtl'                                   => 0

    /* FONT SIZE */
    /* Body */
    ,'ftc_font_size_body'                               => 12
    ,'ftc_line_height_body'                             => 24

    /* Custom CSS */
    ,'ftc_custom_css_code'                              => ''
), $data);      

/* Filter [site_url] */
$data = apply_filters('ftc_custom_style_data', $data);

extract( $data );

/* font-body */
if( $data['ftc_body_font_enable_google_font'] ){
    $ftc_body_font              = $data['ftc_body_font_google']['font-family'];
}
else{
    $ftc_body_font              = $data['ftc_body_font_family'];
}

if( $data['ftc_secondary_body_font_enable_google_font'] ){
    $ftc_secondary_body_font        = $data['ftc_secondary_body_font_google']['font-family'];
}
else{
    $ftc_secondary_body_font        = $data['ftc_secondary_body_font_family'];
}

?>  

/*
1. FONT FAMILY
2. GENERAL COLORS
*/


/* ============= 1. FONT FAMILY ============== */

html, 
body, h1, h2,h3,h4,h5,h6,footer,
.widget-title.heading-title,.subscribe-email .button.button-secondary,
.mega_main_menu.primary ul li .mega_dropdown > li.sub-style > .item_link .link_text,
.subscribe .elementor-text-editor .mc4wp-form .mc4wp-form-fields input[type=submit],
.ftc-product-categories .item-desciption  .title,
.ordo-home-1 .ftc-image-content,
.ordo-home-2 .ftc-image-content,
.ordo-home-2 p,
.ordo-home-1 p,
.titlecatedesc  .elementor-text-editor p,
.ordo-home-2 span,
.ordo-home-1 strong,
.ftc-products .item-description.item-description .meta_info .add-to-cart,
.ftc-products .item-description .heading-title a,
.ordo-home-3 .ftc-image-content,
.ordo-home-3 .ftc-image-content .ftc-image-caption p,
.ftc-element-testimonial.style_1 .title-testi-slider,
.ftc-blogs-slider .style_1 .inner-wrap .meta span,
.ftc-blogs-slider .style_1 .inner-wrap .post-text h4,
.ftc-blogs-slider .style_1 p,
.ftc-blogs-slider .style_1  .inner-wrap .post-text .ftc-readmore,
.ftc-blogs-slider .style_1 .inner-wrap .post-text .element-date-timeline .month,
.ftc-blogs-slider .style_1 .inner-wrap .post-text .element-date-timeline .day,
.footertitle .elementor-text-editor p,
.ifmft h3,
.titlefooter h3,
.headingtitle h2,
.headingh2_1 h2,
.products_1 .ftc_products_slider .ftc-product .item-description .heading-title a,
.products_1 .ftc_products_slider .ftc-product .item-description .price span,
.products_1 .ftc_products_slider .ftc-product .item-description .meta_info .add-to-cart .button span,
.heading2_2 h2,
.saleoff_1 .elementor-text-editor p,
.img_5 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption p,
.products_2 .ftc_products_slider .ftc-product .item-description .heading-title a,
.products_2 .ftc_products_slider .ftc-product .item-description .price span,
.products_2 .ftc_products_slider .ftc-product .item-description .meta_info .add-to-cart .button span,
.content_1 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption p,
.content_2 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption p,
.content_3 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption p,
.elementor-column.footeracount .elementor-column-wrap .elementor-widget-wrap  h2,
.elementor-column.footerinfomation .elementor-column-wrap .elementor-widget-wrap  h2,
.ordo_1 .elementor-text-editor p,
.desc_5 .elementor-text-editor p,
.footermail_2 h2,
.elementor-column.footerform .elementor-column-wrap .elementor-widget-wrap  .elementor-text-editor .mc4wp-form .mc4wp-form-fields .submit input[type=submit],
.ftc-product-grid.style_2  .products .ftc-product .item-description .heading-title a,
.ftc-product-grid.style_1  .products .ftc-product .item-description .heading-title a,
.home3_prod_desc2 h2,
.home3_prod3_desc h2,
.home3_desc_f2 h2,
.home3_prod3_desc .elementor-text-editor p,
.home3_title1 h2,
.home3_blog_title h2,
elementor-element.product_slide1 .ftc_products_slider .ftc-product .item-description .heading-title,
.home3blogslide .ftc-blogs-slider .blogs-slider .inner-wrap .post-text .element-date-timeline .day,
.home3blogslide .ftc-blogs-slider .blogs-slider .inner-wrap .post-text .element-date-timeline .month,
.home3ftmail .elementor-icon-box-wrapper .elementor-icon-box-content .elementor-icon-box-title span,
.home3ftform .elementor-text-editor .mc4wp-form .mc4wp-form-fields .submit input[type="submit"],
.home3footestore h2,
.home3footemyacc h2,
.home3footeinfo h2,
.home4_title1 .elementor-text-editor p,
.elementor-column.home4_desc1 .elementor-column-wrap .elementor-widget-wrap  h3,
.h4proruct_title2 h3,
.elementor-column.home4_desc2 .elementor-column-wrap .elementor-widget-wrap  h3,
.elementor-column.home4_desc3 .elementor-column-wrap .elementor-widget-wrap  h3,
.elementor-column.home4_desc4 .elementor-column-wrap .elementor-widget-wrap  h3,
.elementor-column.home4_desc5 .elementor-column-wrap .elementor-widget-wrap  h3,
.elementor-column.home4_desc6 .elementor-column-wrap .elementor-widget-wrap  h3,
.home4_number .elementor-text-editor p,
.h4proruct_title1 .elementor-text-editor p,
.h4product_desc2 .elementor-text-editor p,
.h4title_proc h3,
.ftc_products_slider.style_3 .ftc-product .item-description .meta_info .add-to-cart a,
.ftc-element-testimonial.style_2 .title-testi-slider h2,
.ftc-element-testimonial.style_2 .swiper-wrapper .item .byline,
.elementor-column.h4bottom2 .elementor-column-wrap .elementor-widget-wrap  .elementor-text-editor .mc4wp-form .mc4wp-form-fields .submit input[type="submit"],
.h4blogstitle h2,
.blogs-slider.style_2 .blogs-slider .inner-wrap .post-text .meta .element-date-timeline .day,
.blogs-slider.style_2 .blogs-slider .inner-wrap .post-text .meta .element-date-timeline .month,
.blogs-slider.style_2 .blogs-slider .inner-wrap .post-text h4,
.blogs-slider.style_2 .blogs-slider .inner-wrap .post-text .ftc-readmore,
.elementor-section.icontop .elementor-container .elementor-row .elementor-column .elementor-column-wrap .elementor-widget-wrap  .elementor-icon-box-wrapper .elementor-icon-box-content h3,
.product_titleh5 h2,
.ftc-product-tabs.style_2 .tabs-wrapper .tab-title .title,
.tabs-content-wrapper.style_2 .ftc-tabs .ftc-product .item-description .heading-title,
.tabs-content-wrapper.style_2 .ftc-tabs .ftc-product .item-description .price,
.ftc_products_slider.style_5 .ftc-product .item-description .heading-title,
.ftc_products_slider.style_5 .ftc-product .item-description .meta_info .add-to-cart a.button,
.ftc_products_slider.style_5 .ftc-product .item-description .price,
.ftc_products_slider.style_5 .ftc-product .item-description .meta_info .add-to-cart a.added_to_cart,
.titileprod_1 h2,
.ftc-product-grid.def_style_5 .products .ftc-product .item-description .heading-title a,
.ftc-product-grid.def_style_5 .products .ftc-product .item-description .price span,
.titileprod_2 h2,
.time_countdown .countdown-timer-init .items .ftc-number,
.titileprod_3 h2,
.ftc-element-testimonial.style_5 .title-testi-slider h2 > *,
.ftc-element-testimonial.style_5 .swiper-wrapper .item .name > *,
.h5desc3 .elementor-text-editor,
.h5button .elementor-button-wrapper .elementor-button-link .elementor-button-content-wrapper span,
.elementor-column.h5information .elementor-widget-wrap  .elementor-text-editor p,
.titlecategories .elementor-text-editor p,
.titlemyacc .elementor-text-editor p,
.titleletter .elementor-text-editor p,
.banner-title .elementor-text-editor p,
.sing-img1 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption h2,
.sing-img2 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption h2,
.sing-img3 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption h2,
.ftc-product-tabs.style_3 .tabs-content-wrapper .ftc-tabs .ftc-products-tabs .ftc-product .item-description .price span,
.ftc-product-tabs.style_3 .tabs-content-wrapper .ftc-tabs .ftc-products-tabs .ftc-product .item-description .heading-title a,
.producth6-button .elementor-button-wrapper .elementor-button-link .elementor-button-content-wrapper .elementor-button-text,
.ftc-elements-blogs.style_1 .ftc-blogs .inner-wrap .post-text h4>a,
.ftc-product-tabs.style_4 .tabs-content-wrapper .ftc-tabs .ftc-product .owl-stage-outer .owl-stage .owl-item .ftc-product .item-description .heading-title a,
.ftc-product-tabs.style_4 .tabs-content-wrapper .ftc-tabs .ftc-product .owl-stage-outer .owl-stage .ftc-product .item-description .price span,
.blogh6-3 .ftc-elements-blogs .ftc-blogs .inner-wrap .post-text a.ftc-readmore,
.blogh6-2 .ftc-elements-blogs .ftc-blogs .inner-wrap .post-text a.ftc-readmore ,
.blogh6-1 .ftc-elements-blogs .ftc-blogs .inner-wrap .post-text a.ftc-readmore,
.header-menuh7 .main-navigation .mega_main_menu .menu_holder .menu_inner .mega_main_menu_ul .menu-item .item_link .link_content .link_text,
.h7-vertical-menu .ftc-element .title-menu .title,
.footer-bottom-h7 .elementor-text-editor p,
.footer-title-h7 .elementor-text-editor p,
.ftc-blogs-slider .style_7 .blogs-slider .inner-wrap .post-text a.ftc-readmore,
.ftc-blogs-slider .style_7 .blogs-slider .inner-wrap .post-text .meta .author,
.ftc-blogs-slider .style_7 .blogs-slider .inner-wrap .post-text h4>a,
.ftc-blogs-slider .style_7 .blogs-slider .inner-wrap .post-text .meta .element-date-timeline,
.ftc_products_slider.style_7 .ftc-product .item-description .heading-title a,
.ftc_products_slider.style_7 .ftc-product .item-description .price span,
.single-img5h7 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption p,
.single-img3h7 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption span,
.single-img6h7 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption span,
.single-img4h7 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption,
.single-img5h7 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption span,
.single-img3h7 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption p,
.ftc_products_slider.style_6 .ftc-product .item-description .meta_info a.compare.added,
.ftc_products_slider.style_6 .ftc-product .item-description .meta_info .add-to-cart a.added_to_cart,
.ftc_products_slider.style_6 .ftc-product .item-description .meta_info .add-to-cart a.button span,
.ftc_products_slider.style_6 .ftc-product .item-description .price span,
.ftc_products_slider.style_6 .ftc-product .item-description .heading-title a,
.single-imgh7 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption p,
.single-img2h7 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption span,
.ftc-product-grid.style_4 .products .ftc-product .item-description .meta_info a.compare.added,
.ftc-product-grid.style_4 .products .ftc-product .item-description .meta_info .add-to-cart a.added_to_cart,
.ftc-product-grid.style_4 .products .ftc-product .item-description .meta_info .add-to-cart a.button span,
.ftc-product-grid.style_4 .products .ftc-product .item-description .price span,
.ftc-product-grid.style_4 .products .ftc-product .item-description .heading-title a,
.ftc-product-categories.style_3 .swiper-wrapper .category .ftc-categories .item-desciption .title,
.single-img1-h7 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption p,
.single-img2-h7 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption p,
.slide-img-h7 .elementor-image-carousel-wrapper .elementor-image-carousel .swiper-slide .swiper-slide-inner .elementor-image-carousel-caption .image-carousel span.sl-title1,
.slide-img-h7 .elementor-image-carousel-wrapper .elementor-image-carousel .swiper-slide .swiper-slide-inner .elementor-image-carousel-caption .image-carousel span.sl-title,
.ftc-product-grid.style_6 .products .ftc-product .item-description .heading-title a,
.ftc-product-grid.style_6 .products .ftc-product .item-description .price span,
.h8single_imgbanner .elementor-image .wp-caption .ftc-image-content .ftc-image-caption,
.ftc-element-testimonial.style_3 .title-testi-slider h2>p,
.ftc-element-testimonial.style_3 .swiper-wrapper .item .name,
.h8form-ft .elementor-text-editor .mc4wp-form .mc4wp-form-fields .submit input[type="submit"],
.h9-formfooter .elementor-text-editor .mc4wp-form .mc4wp-form-fields .submit input[type="submit"],
.single3_h9 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption p,
.blogs-slider.style_3 .blogs-slider .inner-wrap .post-text h4>a,
.blogs-slider.style_3 .blogs-slider .inner-wrap .post-text .meta .author,
.ftc-element-testimonial.style_4 .swiper-wrapper .item .name,
.ftc-element-testimonial.style_4 .title-testi-slider h2>p,
.single1_h9 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption p,
.single2_h9 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption p,
.ftc-product-tabs.style_5 .tabs-content-wrapper .ftc-tabs .ftc-products-tabs .ftc-product .item-description .meta_info .add-to-cart a.added_to_cart,
.ftc-product-tabs.style_5 .tabs-content-wrapper .ftc-tabs .ftc-products-tabs .ftc-product .item-description .meta_info .add-to-cart .button span.ftc-tooltip,
.ftc-product-tabs.style_5 .tabs-content-wrapper .ftc-tabs .ftc-products-tabs .ftc-product .item-description .price span,
.ftc-product-tabs.style_5 .tabs-content-wrapper .ftc-tabs .ftc-products-tabs .ftc-product .item-description .heading-title a
, .ftc_products_slider.style_1 .ftc-products .item-description .price
, .ftc_products_slider.style_2 .ftc-products .item-description .price
, .ftc-contact-form.style_c2 input.wpcf7-submit
, .ftc-contact-form.style_c4 form input.wpcf7-submit
, .ftc-contact-form.style_c5 form input.wpcf7-submit
, .text2-h11 p
, .ftc-product-tabs.style_6 .woocommerce .ftc-product .images .group-button-product .add-to-cart a span
, .ftc-product-tabs.style_6 .woocommerce .ftc-product .item-description .product-name
, .ftc-product-tabs.style_6 .woocommerce .ftc-product .item-description .price
, .ftc-element-testimonial.style_6 .title-testi-slider h2 p
, .blogs-slider.style_4 .blogs-slider .post-text h4
, .ins-h11 .ftc-element-instgram .owl-item .images a:after
, .copyright-h11 p a 
, .ftc-product-tabs.style_7 .woocommerce .ftc-product .images .group-button-product .add-to-cart a span
, .ftc-product-tabs.style_7 .woocommerce .ftc-product .item-description .product-name
, .ftc-product-tabs.style_7 .woocommerce .ftc-product .item-description .price
, .banner-h12 figure .ftc-image-content h2
, .blogs-slider.style_5 .blogs-slider .post-text h4
, .copyright-h12 p a
, .banner-h13 figure .ftc-image-content h2,
.banner1-h15 figure .ftc-image-content .ftc-image-caption h2,
.ftc-product-grid.style_7.woocommerce .ftc-product.product .item-description h3.product-name a,
.ftc-product-grid.style_7.woocommerce .ftc-product.product .item-description .price ins bdi,
.ftc-product-grid.style_7.woocommerce .ftc-product.product .item-description .price > span > bdi,
.ftc-elements-blogs.style_7 .post .post-text .meta .element-date-timeline .day,
.ftc-element-testimonial.style_11 .title-testi-slider h2 p,
.ftc-blogs-slider .blogs-slider.style_8 .post-text .meta .element-date-timeline .day,
.box2-ft-h16 .copyright-ft-h15 .elementor-text-editor span,
.wpcf7 form .sub-form-h16 .button-h16,
.ftc-product-grid.style_8.woocommerce .product .item-description .product-name a,
.ftc-product-grid.style_8.woocommerce .product .item-description .price,
.ftc-product-grid.style_8.woocommerce .product .item-description .price > .amount > bdi,
.ftc-product-grid.style_8.woocommerce .product .item-description .price > ins > .amount > bdi,
.ftc_products_slider.style_8 .product .item-description .product-name a,
.ftc_products_slider.style_8 .product .item-description .price,
.ftc_products_slider.style_8 .product .item-description .price > .amount > bdi,
.ftc_products_slider.style_8 .product .item-description .price > ins > .amount > bdi,
.ftc-element-testimonial.style_12 .swiper-wrapper .item .infomation p,
.wpcf7 form .sub-form-h17 .button-h17,
.ftc-element-testimonial.style_13 .swiper-wrapper .item .infomation p,
.ftc-blogs-slider .blogs-slider.style_9 .post-text .meta .element-date-timeline .day,
.copyright-ft-h15.copyright-ft-h18 .elementor-text-editor span,
.ftc-blogs-slider .blogs-slider.style_10 .post-text .meta .element-date-timeline .day,
.wpcf7 form .sub-form-h19 textarea,
.wpcf7 form .sub-form-h19 textarea::placeholder,
.header-layout-19.ftc-header-template .ftc-cart-tini .cart-total,
.ftc_products_deal_slider.style_1 .ftc-deal-products .heading-title a,
.ftc_products_deal_slider.style_1 .ftc-deal-products .item-description .price ins > .amount,
.ftc_products_deal_slider.style_1 .ftc-deal-products .item-description .price del > .amount,
.button2-h20 a:before,
.ftc_products_slider.style_9 .product .heading-title a,
.ftc_products_slider.style_9 .product .item-description .price > .amount,
.ftc_products_slider.style_9 .product .item-description .price del > .amount,
.ftc-blogs-slider .blogs-slider.style_11 .post-text .meta .author,
.ftc-element-testimonial.style_14 .testimonial-content .infomation:after,
.ftc_products_slider.style_10 .ftc-products .item-description .price > .amount,
.contact-ft-h20.contact-ft-h15 ul li span span,
.contact-ft-h20.contact-ft-h15 ul li a span,
.ftc_products_slider.style_11 .ftc-products .item-description .price,
.ftc-element-testimonial.style_15 .title-testi-slider h2 p,
.ftc-product-grid.style_9.woocommerce.product-template .item-description .product-name a,
.ftc-product-grid.style_9.woocommerce.product-template .item-description .price .amount,
.copyright-ft-h15.copyright-ft-h21 .elementor-text-editor span,
.header-layout-22.ftc-header-template .mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link > .link_content > .link_text,
.ftc-product-grid.style_10.woocommerce.product-template .product .item-description .product-name a,
.ftc-product-grid.style_10.woocommerce.product-template .product .item-description .price > .amount,
.ftc-product-grid.style_10.woocommerce.product-template .product .item-description .price ins > .amount,
.ftc-product-grid.style_10.woocommerce.product-template .product .item-description .price del > .amount,
.video-h22 .elementor-custom-embed-play::before,
.ftc-element-testimonial.style_16 .swiper-wrapper .item .infomation p,
.banner-h22 figure .ftc-image-content .ftc-image-caption h2,
.linklist-ft-h22 ul li a span,
.copyright-ft-h15.copyright-ft-h22 .elementor-text-editor span,
.banner4-h23 figure .ftc-image-content .ftc-image-caption h2,
.ftc-element-testimonial.style_17 .swiper-wrapper .item .infomation p,
.wpcf7 form .sub-form-h23 .button-h23,
.copyright-ft-h15.copyright-ft-h23 .elementor-text-editor span,
.ftc-product-tabs.style_8 .woocommerce .product .item-description .product-name a,
.ftc-product-tabs.style_8 .woocommerce .product .item-description .price .amount,
.wpcf7 form .sub-form-h24 .button-h24,
.contact-ft-h15.contact-ft-h24 ul li span span
{
  font-family: <?php echo esc_html($ftc_body_font) ?>;
}

.mega_main_menu.primary ul li .mega_dropdown > li.sub-style > ul.mega_dropdown,
.mega_main_menu li.multicolumn_dropdown > .mega_dropdown > li .mega_dropdown > li,
.mega_main_menu.primary ul li .mega_dropdown > li > .item_link .link_text,
.info-open,
.info-phone,
.my-account-wrapper .account-control > a,
.my-account-wrapper,
.my-wishlist-wrapper *,
.dropdown-button span > span,
body p,
.wishlist-empty,
div.product .social-sharing li a,
.ftc-search form,
.ftc-shop-cart,
.conditions-box,
.item-description .heading-title,
.item-description .price,
.testimonial-content .content,
.testimonial-content .byline,
.widget-container ul.product-categories ul.children li a,
.widget-container:not(.ftc-product-categories-widget):not(.widget_product_categories):not(.ftc-products-widget) :not(.widget-title),
.ftc-products-category-tabs-block ul.tabs li span.title,
.woocommerce-pagination,
.woocommerce-result-count,
.woocommerce .products.list .product h3.product-name > a,
.woocommerce-page .products.list .product h3.product-name > a,
.woocommerce .products.list .product .price .amount,
.woocommerce-page .products.list .product .price .amount,
.products.list .short-description.list,
div.product .single_variation_wrap .amount,
div.product div[itemprop="offers"] .price .amount,
.orderby-title,
.blogs .excerpt,
.blog .entry-info .entry-summary .short-content,
.single-post .entry-info .entry-summary .short-content,
.single-post article .post-info .info-category,
.single-post article .post-info .info-category,
#comments .comments-title,
#comments .comment-metadata a,
.post-navigation .nav-previous,
.post-navigation .nav-next,
.woocommerce div.product .product_title,
.woocommerce-review-link,
.feature-excerpt,
.woocommerce div.product p.stock,
.woocommerce div.product .summary div[itemprop="description"],
.woocommerce div.product p.price,
.woocommerce div.product .woocommerce-tabs .panel,
.woocommerce div.product form.cart .group_table td.label,
.woocommerce div.product form.cart .group_table td.price,
footer a, footer span, footer p,
.blogs article .effect-thumbnail:before,
.blogs article a.gallery .owl-item:after,
.ordo-home-3 .ftc-image-content .ftc-image-caption .wp-caption-text,
.ftc-element-testimonial.style_1 .swiper-wrapper .swiper-slide .infomation p,
.ftc-element-testimonial .testimonial-content .byline,
.footerdesc .elementor-text-editor p,
.subscribe .elementor-text-editor .mc4wp-form .mc4wp-form-fields input[type=email],
.myftac .elementor-text-editor p,
.ifmft .elementor-text-editor p,
.hometext .elementor-text-editor p,
.calltext .elementor-text-editor p ,
.mailtext .elementor-text-editor p,
.locktext .elementor-text-editor p,
.myftac .elementor-text-editor p a,
.ifmft .elementor-text-editor p a,
.ftc-blogs-slider .style_1  .inner-wrap p,
.desc_1 .elementor-text-editor p,
.products_1 .ftc_products_slider .ftc-product .item-description .product-categories a,
.coundown .ftc-countdown-element .countdown-timer-init .items .ftc-number,
.coundown .ftc-countdown-element .countdown-timer-init .items .ftc-label,
.products_2 .ftc_products_slider .ftc-product .item-description .product-categories a,
.content_1 .elementor-image .wp-caption .ftc-image-content .button-banner a,
.content_2 .elementor-image .wp-caption .ftc-image-content .button-banner a,
.content_3 .elementor-image .wp-caption .ftc-image-content .button-banner a,
.elementor-section.footerinfo_1 .elementor-container .elementor-row .elementor-column .elementor-column-wrap .elementor-widget-wrap  .elementor-text-editor p,
.elementor-section.footerinfo_2 .elementor-container .elementor-row .elementor-column .elementor-column-wrap .elementor-widget-wrap  .elementor-text-editor p,
.elementor-section.footerinfo_3 .elementor-container .elementor-row .elementor-column .elementor-column-wrap .elementor-widget-wrap  .elementor-text-editor p,
.elementor-section.footerinfo_4 .elementor-container .elementor-row .elementor-column .elementor-column-wrap .elementor-widget-wrap  .elementor-text-editor p,
.elementor-column.footerform .elementor-column-wrap .elementor-widget-wrap  .elementor-text-editor .mc4wp-form .mc4wp-form-fields .email input[type=email],
.elementor-column.desc_6 .elementor-column-wrap .elementor-widget-wrap  .elementor-text-editor p,
.medicien .elementor-text-editor p,
.desc_4 .elementor-text-editor p,
.load-more-product.style_2 .load-more.button,
.home3_prod_desc1 .elementor-text-editor p,
.home3_prod2_desc .elementor-text-editor p,
.home3_desc_f1 .elementor-text-editor p,
.home3_prod_desc3 .elementor-text-editor p,
.home3_prod5_desc .elementor-text-editor p,
.home3_desc_f3 .elementor-text-editor p,
.home3_prod_desc4 .elementor-button-wrapper .elementor-button-link .elementor-button-content-wrapper span,
.home3_descf2 .elementor-button-wrapper .elementor-button-link .elementor-button-content-wrapper span,
.home3_descf2 .elementor-button-wrapper .elementor-button-link .elementor-button-content-wrapper span,
.home3_title1 .elementor-text-editor p,
.home3_blog_titledesc .elementor-text-editor p,
.product_slide1 .ftc_products_slider .ftc-product .item-description .product-categories,
.product_slide1 .ftc_products_slider .ftc-product .item-description .price,
.home3ft_desc .elementor-text-editor p,
.home3ftform .elementor-text-editor .mc4wp-form .mc4wp-form-fields .email input::placeholder,
.home3footerlogo .ftc-element-logo .description-logo p,
.home3footerhome .elementor-icon-box-wrapper .elementor-icon-box-content .elementor-icon-box-title span,
.home3footerphone  .elementor-icon-box-wrapper .elementor-icon-box-content .elementor-icon-box-title span,
.home3footermail .elementor-icon-box-wrapper .elementor-icon-box-content .elementor-icon-box-title span,
.home3footerclock .elementor-icon-box-wrapper .elementor-icon-box-content .elementor-icon-box-title span,
.footermyacc1 .elementor-text-editor p,
.footermyinfo1 .elementor-text-editor p,
.home4_desc_2 .elementor-text-editor p,
.elementor-column.h4bottom2 .elementor-column-wrap .elementor-widget-wrap  .elementor-text-editor .mc4wp-form .mc4wp-form-fields .email input::placeholder,
.ftc-element-testimonial.style_2 .swiper-wrapper .item .name a,
.h4desc_proc .lementor-widget-container .elementor-text-editor p,
.h4product_desc1 .elementor-text-editor p,
.home4_desc_1 .elementor-text-editor p,
.tabs-content-wrapper.style_2 .ftc-tabs .ftc-product .item-description .product-categories a,
.ftc_products_slider.style_5 .ftc-product .item-description .product-categories a,
.ftc-element-testimonial.style_5 .swiper-wrapper .item .infomation > *,
.h5desc_1 h2,
.h5desc2 .elementor-text-editor p,
.h5desc4 .elementor-text-editor,
.elementor-column.h5information .elementor-column-wrap .elementor-widget-wrap  .elementor-icon-box-wrapper .elementor-icon-box-content .elementor-icon-box-title span,
.desccategories .elementor-text-editor p,
.descmyacc .elementor-text-editor p,
.descnewletter .elementor-text-editor p,
.h5copyright .elementor-text-editor p,
.banner-desc .elementor-text-editor p,
.ftc-elements-blogs.style_1 .ftc-blogs .inner-wrap .post-text p,
.ftc-elements-blogs.style_1 .ftc-blogs .inner-wrap .post-text a.ftc-readmore,
.slide-img-h7 .elementor-image-carousel-wrapper .elementor-image-carousel .swiper-slide .swiper-slide-inner .elementor-image-carousel-caption .image-carousel span.sl-img1,
.slide-img-h7 .elementor-image-carousel-wrapper .elementor-image-carousel .swiper-slide .swiper-slide-inner .elementor-image-carousel-caption .image-carousel span.sl-img2,
.slide-img-h7 .elementor-image-carousel-wrapper .elementor-image-carousel .swiper-slide .swiper-slide-inner .elementor-image-carousel-caption .image-carousel span.sl-sale,
.slide-img-h7 .elementor-image-carousel-wrapper .elementor-image-carousel .swiper-slide .swiper-slide-inner .elementor-image-carousel-caption .image-carousel span.sl-sale1,
.list-categories .ftc-product-categories.style_2 .category .ftc-categories .item-desciption .title,
.ftc-product-grid.style_4 .products .ftc-product .item-description .product-categories a,
.single-imgh7 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption span,
.single-img2h7 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption p>span,
.single-imgh7 .elementor-image .wp-caption .ftc-image-content .button-banner a.single-image-button,
.ftc_products_slider.style_6 .ftc-product .item-description .product-categories a,
.single-img6h7 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption p,
.single-img6h7 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption p>span,
.ftc_products_slider.style_7 .ftc-product .item-description .product-categories a,
.ftc-blogs-slider .style_7 .blogs-slider .inner-wrap .post-text p,
.footer-content-h7 .elementor-text-editor p,
.footer-form-h7 .elementor-text-editor .mc4wp-form .mc4wp-form-fields .email input::placeholder,
.h7-vertical-menu .ftc-element .menu-dropdown .menu-categories-container .menu .menu-item,
.desc-footerh8 .elementor-text-editor p,
.ftc-element-testimonial.style_3 .swiper-wrapper .item .byline,
.ftc-element-testimonial.style_3 .swiper-wrapper .item .infomation p,
.ftc-product-grid.style_6 .products .ftc-product:hover .item-description .meta_info .add-to-cart a.added_to_cart,
.ftc-product-grid.style_6 .products .ftc-product:hover .item-description .meta_info .add-to-cart .button span.ftc-tooltip,
.ftc-product-tabs.style_5 .tabs-content-wrapper .ftc-tabs .ftc-products-tabs .ftc-product .item-description .short-description,
.ftc-element-testimonial.style_4 .swiper-wrapper .item .infomation p,
.ftc-element-testimonial.style_4 .swiper-wrapper .item .byline,
.blogs-slider.style_3 .blogs-slider .inner-wrap .post-text .meta .published,
.blogs-slider.style_3 .blogs-slider .inner-wrap .post-text p,
.h4blogsdesc .elementor-text-editor p,
.single3_h9 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption span
, .footer-mobile a
, .header-layout-4 .main-navigation .mega_main_menu .menu-item .item_link .link_content .link_text
, .header-layout-5 .main-navigation .mega_main_menu .menu-item .item_link .link_content .link_text
, .header-layout-6 .main-navigation .mega_main_menu .menu-item .item_link .link_content .link_text
, .header-layout-8 .main-navigation .mega_main_menu .menu-item .item_link .link_content .link_text
, .header-layout-9 .main-navigation .mega_main_menu .menu-item .item_link .link_content .link_text
, .header-layout-10 .main-navigation .mega_main_menu .menu-item .item_link .link_content .link_text
, .ftc-cart-tini .cart-total, .ftc_excerpt > a, .ftc-hotspot-number
, .woocommerce-checkout-payment li.woocommerce-notice
, .woocommerce-checkout-payment .form-row.place-order button#place_order
, .woocommerce form.register .wcfmmp_become_vendor_link a
, .woocommerce-checkout-review-order-table tbody tr td
, .woocommerce table.shop_table.cart tr.cart_item td
, .woocommerce .cart-collaterals .cart_totals tr td
, .woocommerce .cart-collaterals .cart_totals tr th
, .checkout-login-coupon-wrapper .woocommerce-info
, .ftc-product-tabs.style_6 .woocommerce .ftc-product .item-description .short-description
, .blogs-slider.style_4 .blogs-slider .post-text a
, .header-layout-12 .mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link .link_text
, .ftc-product-tabs.style_7 .woocommerce .ftc-product .item-description .short-description
, .banner-h12 figure .ftc-image-content p
, .blogs-slider.style_5 .blogs-slider .post-text a
, .header-layout-13 .mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link .link_text
, .price-list-h13 ul li .ftc-price-list-header .ftc-price-list-price
, .blogs-slider.style_6 .blogs-slider .post-text .meta .published
, .banner-h13 figure .ftc-image-content p,
.header-layout-15.ftc-header-template .ftc-search .search-button span,
.banner1-h15 figure .ftc-image-content .ftc-image-caption span,
.banner1-h15 figure .ftc-image-content .button-banner a,
.ftc-product-grid.style_7.woocommerce .ftc-product.product .item-description .price del bdi,
.ftc-elements-blogs.style_7 .post .post-text .meta .author a,
.ftc-elements-blogs.style_7 .post .post-text .meta .element-date-timeline .month,
.wpcf7 form .sub-form-h15 input[type="email"],
.wpcf7 form .sub-form-h15 input[type="email"]::placeholder,
.wpcf7 form .sub-form-h15 .button-h15,
.header-layout-16.ftc-header-template .ftc-search .search-button span,
.wpcf7 form .booking-h16-section .booking-h16-column select,
.wpcf7 form .booking-h16-section .booking-h16-column input[type="text"],
.wpcf7 form .booking-h16-section .booking-h16-column input[type="text"]::placeholder,
.ftc-blogs-slider .blogs-slider.style_8 .post-text .meta .author a,
.ftc-blogs-slider .blogs-slider.style_8 .post-text .meta .element-date-timeline .month,
.wpcf7 form .sub-form-h16 input[type="email"],
.wpcf7 form .sub-form-h16 input[type="email"]::placeholder,
.header-layout-17.ftc-header-template .ftc-search .search-button span,
.ftc-product-grid.style_8.woocommerce .product .item-description .product-categories a,
.ftc_products_slider.style_8 .product .item-description .product-categories a,
.wpcf7 form .sub-form-h17 input[type="email"],
.wpcf7 form .sub-form-h17 input[type="email"]::placeholder,
.header-layout-18.ftc-header-template .ftc-search .search-button span,
.banner-h18 .ftc-element-image .ftc-image-content .ftc-image-caption span,
.wpcf7 form .booking-h18-section .booking-h18-column select,
.wpcf7 form .booking-h18-section .booking-h18-column input[type="text"],
.wpcf7 form .booking-h18-section .booking-h18-column input[type="text"]::placeholder,
.ftc-element-testimonial.style_13 .swiper-wrapper .item .avatar-image::before,
.banner4-h18 .ftc-element-image .ftc-image-content .ftc-image-caption > span,
.ftc-blogs-slider .blogs-slider.style_9 .post-text .meta .author a,
.ftc-blogs-slider .blogs-slider.style_9 .post-text .meta .element-date-timeline .month,
.wpcf7 form .sub-form-h18 input[type="email"],
.wpcf7 form .sub-form-h18 input[type="email"]::placeholder,
.header-layout-19.ftc-header-template .ftc-search .search-button span,
.header-layout-19.ftc-header-template .ftc-cart-tini:before,
.ftc-blogs-slider .blogs-slider.style_10 .post-text .meta .author a,
.ftc-blogs-slider .blogs-slider.style_10 .post-text .meta .element-date-timeline .month,
.wpcf7 form .sub-form-h191 input[type="email"],
.wpcf7 form .sub-form-h191 input[type="email"]::placeholder,
.wpcf7 form .sub-form-h191 textarea::placeholder,
.wpcf7 form .sub-form-h19 input[type="email"],
.wpcf7 form .sub-form-h19 input[type="email"]::placeholder,
.header-layout-21.ftc-header-template .tini-wishlist a,
.header-layout-21.ftc-header-template .ftc-cart-tini .cart-total::before,
.header-layout-21.ftc-header-template .ftc-cart-tini .cart-total::after,
.header-layout-21.ftc-header-template .tini-wishlist .count-wish,
.ftc_products_slider.style_11 .ftc-products .item-description .short-description,
.banner1-h21 figure .ftc-image-content .ftc-image-caption p,
.banner2-h21 figure .ftc-image-content .ftc-image-caption p,
.video-h21 .elementor-custom-embed-play::before,
.ftc-blogs-slider .blogs-slider.style_12 .post-text .meta .element-date-timeline .day,
.ftc-blogs-slider .blogs-slider.style_12 .post-text .meta .element-date-timeline .month,
.ftc-blogs-slider .blogs-slider.style_12 .post-text .meta .author,
.ftc-element-testimonial.style_15 .swiper-pagination .swiper-pagination-bullet:before,
.ftc-product-grid.style_9.woocommerce.product-template .item-description .short-description,
.ftc-product-grid.style_10.woocommerce.product-template .item-description .short-description,
.banner-h22 figure .ftc-image-content .ftc-image-caption span,
.wpcf7 form .sub-form-h22 input[type="email"],
.wpcf7 form .sub-form-h22 input[type="email"]::placeholder,
.header-layout-23.ftc-header-template .ftc-search .search-button span,
.banner4-h23 figure .ftc-image-content .ftc-image-caption p,
.ftc_products_slider.style_12 .woocommerce .product .item-description .price > .amount,
.ftc_products_slider.style_12 .woocommerce .product .item-description .price ins > .amount,
.wpcf7 form .sub-form-h23 input[type="email"],
.wpcf7 form .sub-form-h23 input[type="email"]::placeholder,
.header-layout10 .header-content .setting-wrapper .ftc-search-product .ftc-search button,
.header-layout10 .ftc-shop-cart .cart-item > a .cart-total,
.header-layout10 .ftc-shop-cart .ftc-cart-tini:before,
.wpcf7 form .booking-h24-section .booking-h24-column select,
.wpcf7 form .booking-h24-section .booking-h24-column input[type="text"],
.wpcf7 form .booking-h24-section .booking-h24-column input[type="text"]::placeholder,
.wpcf7 form .sub-form-h24 input[type="email"],
.wpcf7 form .sub-form-h24 input[type="email"]::placeholder,
{
  font-family: <?php echo esc_html($ftc_secondary_body_font) ?>;
}
body,
.site-footer,
.woocommerce div.product form.cart .group_table td.label,
.woocommerce .product .conditions-box span, .item-description .meta_info .compare a,
ul.product_list_widget li > a, h3.product-name > a, h3.product-name, 
.single-navigation a .product-info span,
.info-company li i,
.social-icons .ftc-tooltip:before,
.widget-container ul.product-categories ul.children li,
.tagcloud a,
.details_thumbnails .owl-nav > div:before,
div.product .summary .yith-wcwl-add-to-wishlist a:before,
.pp_woocommerce div.product .summary .compare:before,
.woocommerce div.product .summary .compare:before,
.woocommerce-page div.product .summary .compare:before,
.woocommerce #content div.product .summary .compare:before,
.woocommerce-page #content div.product .summary .compare:before,
.woocommerce div.product form.cart .variations label,
.woocommerce-page div.product form.cart .variations label,
.pp_woocommerce div.product form.cart .variations label,
.ftc-products-category-tabs-block ul.tabs li span.title,
blockquote,
.ftc-milestone h3.subject,
.woocommerce .widget_price_filter .price_slider_amount,
.wishlist-empty,
.woocommerce div.product form.cart .button,
.woocommerce table.wishlist_table,
{
    font-size: <?php echo esc_html($ftc_font_size_body) ?>px;
}
/* ========== 2. GENERAL COLORS ========== */
/* ========== Primary color ========== */
.header-currency:hover .wcml_currency_switcher > a,
.header-language:hover li .lang_sel_sel,
.woocommerce a.remove:hover,
.dropdown-container .dropdown-footer > a.button.view-cart:hover,
.my-wishlist-wrapper a:hover,
.my-account-wrapper .account-control > a:hover,
.header-currency .wcml_currency_switcher ul li:hover,
.dropdown-button span:hover,
body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab.vc_active > a,
body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab > a:hover,
.mega_main_menu.primary > .menu_holder.sticky_container > .menu_inner > ul > li > .item_link:hover *,
.mega_main_menu.primary > .menu_holder.sticky_container > .menu_inner > ul > li.current-menu-item > .item_link *,
.mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link *,
.mega_main_menu.primary > .menu_holder > .menu_inner > ul > li:hover > .item_link *,
.mega_main_menu.primary .mega_dropdown > li > .item_link:hover *,
.mega_main_menu.primary .mega_dropdown > li > .item_link:focus *,
.mega_main_menu.primary .mega_dropdown > li.current-menu-item > .item_link *,
.mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-item > .item_link *,
.mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link:focus *,
.woocommerce .products .product .price,
.woocommerce div.product p.price,
.woocommerce div.product span.price,
.woocommerce .products .star-rating,
.woocommerce-page .products .star-rating,
.star-rating:before,
div.product div[itemprop="offers"] .price .amount,
div.product .single_variation_wrap .amount,
.pp_woocommerce .star-rating:before,
.woocommerce .star-rating:before,
.woocommerce-page .star-rating:before,
.woocommerce-product-rating .star-rating span,
ins .amount,
.ftc-wg-meta .price ins,
.ftc-wg-meta .star-rating,
.ul-style.circle li:before,
.woocommerce form .form-row .required,
.blogs .comment-count i,
.blog .comment-count i,
.single-post .comment-count i,
.single-post article .post-info .info-category,
.single-post article .post-info .info-category .cat-links a,
.single-post article .post-info .info-category .vcard.author a,
.breadcrumb-title .breadcrumbs-container,
.breadcrumb-title .breadcrumbs-container span.current,
.breadcrumb-title .breadcrumbs-container a:hover,
.ftc-wg-meta.item-description .meta_info a:hover,
.ftc-wg-meta.item-description .meta_info .yith-wcwl-add-to-wishlist a:hover,
.gridlist-toggle a.active,
.shortcode-icon .vc_icon_element.vc_icon_element-outer .vc_icon_element-inner.vc_icon_element-color-orange .vc_icon_element-icon,
.comment-reply-link .icon,
body table.compare-list tr.remove td > a .remove:hover:before,
a:hover,
a:focus,
.vc_toggle_title h4:hover,
.vc_toggle_title h4:before,
.blogs article h3.heading-title a:hover, .ftc-search .search-button:hover, .ftc-shoppping-cart a.ftc_cart:hover, .dropdown-menu-header:hover, .shortcode-heading-wrapper .heading-title, .ftc-feedburner-subscription-shortcode h2, .ftc-sb-testimonial .testimonial-content .name a:hover, .ftc-blogs article .post-info .date-time, .info-company li i, li.cat-item.current a, .woocommerce div.product .woocommerce-tabs ul.tabs li.active
,.contact_info_map .info_contact .info_column ul:before,
.vcard.author a,.caftc-link a, .tags-link a,.woocommerce-info::before,.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a,.single-product .product_list_widget span.yith-wcwl-wishlistexistsbrowse.show i,.single-product .product_list_widget span.yith-wcwl-wishlistaddedbrowse.show i,.woocommerce-page .products.list .product h3.product-name a:hover,
.mc4wp-form-fields .widgettitle,
.price .woocommerce-Price-amount,
.woocommerce table.wishlist_table .product-price .woocommerce-Price-amount, .info-com .no-padding.info-company li a:hover,
.mobile-wishlist a.tini-wishlist:hover i, .mobile-wishlist a.tini-wishlist:hover span,
.ftc-product-video-button .watch-video:hover,
.slider-h1 span.text1,
.header-layout1 .custom_content .banner_hide .free_ship.container p,
.slider-products.home3 .owl-nav > div.owl-prev,
.slider-products.home3 .owl-nav > div.owl-next,
.blog-home .blogs a.button-readmore,
.ftc-sidebar .yith-woo-ajax-reset-navigation .yith-wcan a.yith-wcan-reset-navigation.button:hover,
a.lang_sel_sel.icl-en:hover,
.ft-home .ft-top ul.no-padding.bullet.noSwipe li a:hover,
.ft-home .ft-middle .contact li a:hover,
p.copy a.text1:hover,
.mfp-close-btn-in .mfp-close:hover,
.dropdown-menu-header .dropdown-list .tini-wishlist:hover span,
.ftc-shop-cart .cart-item >a:hover i,
.widget-container.ftc-product-categories-widget ul.product-categories li.cat-parent:hover > span.icon-toggle,
.info_column.email li a:hover,
.widget-container ul > li.cat-item:hover,
.ftc-blogs-widget .ftc-blogs-widget-wrapper .post_list_widget .post-meta .author:hover .fa,
.dokan-category-menu #cat-drop-stack > ul li.parent-cat-wrap a:hover,
.dokan-category-menu #cat-drop-stack > ul li.parent-cat-wrap a:hover .fa,
.widget-container ul.product-categories ul.children li a:hover,
span.comment-count span.number,
.ftc-product-video-button:hover:before,
.woocommerce .product .images a.ftc-video360:hover:before,
.slider-products .owl-nav > div.owl-next:hover,
.slider-products .owl-nav > div.owl-prev:hover,
#swipebox-arrows a:hover:before,
.deal-product.home3 .owl-nav > div.owl-prev:hover,
.deal-product.home3 .owl-nav > div.owl-next:hover,
.ftc-off-canvas-cart .woocommerce ul.product_list_widget span.woocommerce-Price-amount.amount,
.ftc-element-testimonial .testimonial-content h4.name,
.ftc-element-testimonial .navigation-slider .nav-prev:hover:before,
.ftc-element-testimonial .navigation-slider .nav-next:hover:before,
.ftc-blogs-slider .style_1  .inner-wrap .post-text .ftc-readmore:hover,
.ftc-element-testimonial.style_2 .title-testi-slider h2:before,
.ftc-element-testimonial.style_2 .title-testi-slider h2:after,
.ftc-element-testimonial.style_2 .swiper-wrapper .item .byline,
.load-more-product.style_2 .load-more.button:hover,
.home3blogslide .ftc-blogs-slider .blogs-slider .inner-wrap .post-text .element-date-timeline .month,
.home3ftform .elementor-text-editor .mc4wp-form .mc4wp-form-fields .submit input[type="submit"],
.elementor-column.h8-counter1 .elementor-column-wrap .elementor-widget-wrap  .elementor-counter .elementor-counter-title:hover,
.elementor-column.h8-counter2 .elementor-column-wrap .elementor-widget-wrap  .elementor-counter .elementor-counter-title:hover,
.elementor-column.h8-counter3 .elementor-column-wrap .elementor-widget-wrap  .elementor-counter .elementor-counter-title:hover,
.elementor-column.h8-counter4 .elementor-column-wrap .elementor-widget-wrap  .elementor-counter .elementor-counter-title:hover,
.elementor-column.h8-counter5 .elementor-column-wrap .elementor-widget-wrap  .elementor-counter .elementor-counter-title:hover,
.ftc-element-testimonial.style_3 .swiper-wrapper .item .name,
.ftc-element-testimonial.style_3 .title-testi-slider h2:before,
.ftc-element-testimonial.style_3 .title-testi-slider h2>p,
.h8iconnext .elementor-button-wrapper .elementor-button-link:hover .elementor-button-content-wrapper .elementor-button-icon i.fa-arrow-alt-circle-right:before,
.h8iconprev .elementor-button-wrapper .elementor-button-link:hover .elementor-button-content-wrapper .elementor-button-icon i.fa-arrow-alt-circle-left:before,
.ftc-product-grid.style_6 .products .ftc-product:hover .item-description .meta_info .add-to-cart a.added_to_cart,
.ftc-product-grid.style_6 .products .ftc-product:hover .item-description .meta_info .add-to-cart .button span.ftc-tooltip,
.ftc-blogs-slider .style_7 .blogs-slider .inner-wrap .post-text .meta .author,
.ftc-blogs-slider .style_7 .blogs-slider .inner-wrap .post-text h4>a:hover,
.title-seller .elementor-text-editor p:after,
.title-chance .elementor-text-editor p:after,
.single-imgh7 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption span,
.ftc-product-grid.style_4 .products .ftc-product .item-description .meta_info a.compare.added:hover,
.ftc-product-grid.style_4 .products .ftc-product .item-description .meta_info .add-to-cart a.added_to_cart:hover,
.title-counprod .elementor-text-editor p:after,
.ftc-product-grid.style_4 .products .ftc-product .item-description .meta_info .yith-wcwl-add-to-wishlist .add_to_wishlist i:before,
.ftc-product-grid.style_4 .products .ftc-product .item-description .meta_info .compare i:before,
.ftc-product-grid.style_4 .products .ftc-product .item-description .meta_info .add-to-cart a.button:hover span,
.ftc-product-categories.style_3 .swiper-wrapper .category .ftc-categories .item-desciption:hover .title,
.list-categories .ftc-product-categories.style_2 .category:hover .ftc-categories .item-desciption .title,
.slide-img-h7 .elementor-image-carousel-wrapper .elementor-image-carousel .swiper-slide .swiper-slide-inner .elementor-image-carousel-caption .image-carousel span.sl-title1,
.slide-img-h7 .elementor-image-carousel-wrapper .elementor-image-carousel .swiper-slide .swiper-slide-inner .elementor-image-carousel-caption .image-carousel span.sl-title,
.ftc-product-tabs.style_3 .tabs-content-wrapper .ftc-tabs .ftc-products-tabs .ftc-product .item-description .heading-title:hover a,
.single3_h9 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption p,
.blogs-slider.style_3 .blogs-slider .inner-wrap .post-text h4>a,
.ftc-element-testimonial.style_4 .title-testi-slider h2>p,
.single1_h9 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption p,
.single2_h9 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption p,
.ftc-product-tabs.style_5 .tabs-content-wrapper .ftc-tabs .ftc-products-tabs .ftc-product .item-description .meta_info .add-to-cart a.button:hover span,
.ftc-product-tabs.style_5 .tabs-content-wrapper .ftc-tabs .ftc-products-tabs .ftc-product .item-description .meta_info .add-to-cart a.added_to_cart:hover,
.ftc-product-tabs.style_5 .tabs-content-wrapper .ftc-tabs .ftc-products-tabs .ftc-product .item-description .price span,
.ftc-product-tabs.style_5 .tabs-content-wrapper .ftc-tabs .ftc-products-tabs .ftc-product .item-description .heading-title a,
.ftc-product-tabs.style_5 .ftc-tab-grid .tab-title:hover,
.slider_9 .elementor-image-carousel-wrapper .elementor-swiper-button-prev,
.h9-header-cart .ftc-cart-element .ftc-tini-cart .cart-item .ftc-cart-tini:hover i,
.mobile-wishlist .tini-wishlist:hover
, .item-description .meta_info .yith-wcwl-add-to-wishlist a
, .ftc-contact-form.style_c3 input.wpcf7-submit
, .tabs-content-wrapper.style_2 .ftc-product .item-description .meta_info a
, .ftc_products_slider.style_3 .ftc-product .item-description .meta_info .add-to-cart a
, .ftc_products_slider.style_5 .ftc-product .item-description .meta_info a
, .ftc-product-tabs.style_3 .ftc-product.product .item-image .product-group-button > a:hover
, .ftc-product-tabs.style_3 .ftc-product.product .item-image .product-group-button > div:hover a
, .ftc-product-tabs.style_4 .ftc-product.product .item-image .product-group-button > a:hover
, .ftc-product-tabs.style_4 .ftc-product.product .item-image .product-group-button > div:hover a
, .ftc-product-tabs.style_2 .ftc-product .item-description .meta_info .add-to-cart a:before
, .tabs-content-wrapper.style_2 .ftc-product .item-description .meta_info .compare
, .tabs-content-wrapper.style_2 .ftc-product .item-description .meta_info .yith-wcwl-add-to-wishlist
, .ftc_products_slider.style_6 .ftc-product .item-description .meta_info a
, .ftc_products_slider.style_6 .ftc-product .item-description .meta_info .add-to-cart a:before
, .ftc-product-tabs.style_5 .ftc-product .item-description .heading-title
, .ftc-element-testimonial.style_4 .navigation-slider div:hover:before
, .h10-formfooter .elementor-text-editor .mc4wp-form .mc4wp-form-fields .submit input[type="submit"]:hover
, .ftc_products_slider.style_2 .ftc-products .item-description .heading-title:hover
, .ftc-product-grid.style_1 .load-more-product a.load-more
, .ftc-account .ftc_login:hover i
, .elementor-element .ftc_account_form.dropdown-container .ftc_forgot_pass a:hover
, #dokan-store-listing-filter-wrap .right .toggle-view .active
, .archive .products .product-category.product .heading-title:hover
, .ftc-breadcrumbs-category .ftc-product-categories-list ul li:hover a
, .ftc-product-tabs-filter > li.current
, .woocommerce .products.style_2:not(.list) .item-description .meta_info > div:hover a
, .woocommerce .products.style_3:not(.list) .item-description .meta_info > .add-to-cart a
, .ftc-element-testimonial .rating .star-rating span::before
, .navigation-slider.style_5 > div:hover
, .ftc-portfolio-wrapper .item .thumbnail .figcaption h3:hover
, .ftc-portfolio-wrapper .item .thumbnail .figcaption .read-more-button:hover
, .ftc-product-categories .btn-category:hover, .ftc-team-member header > h3:hover
, .ftc-product-categories .item-desciption .title:hover
, .ftc-product-categories.def_style_5 .ftc-categories .item-desciption .title:hover
, .ftc-product-categories.def_style_5 .ftc-categories .item-desciption .product-count:hover
, .ftc_products_deal_slider.def_style_4 .product .item-description .meta_info > div a:hover
, .wp-block-quote cite, .woocommerce form.register .wcfmmp_become_vendor_link a
, .woocommerce #customer_login .woocommerce-LostPassword.lost_password a
, .checkout-login-coupon-wrapper .woocommerce-info a.showcoupon
, .checkout-login-coupon-wrapper .woocommerce-info a.showlogin
, table.shop_table.cart .product-name a:hover
, .woocommerce .cart_totals table.shop_table .order-total td
, .header-layout-11.ftc-header-template .ftc-search .search-button:hover
, .title1-h11 .elementor-heading-title span
, .social-icon-h11 .elementor-grid-item a i
, .blogs-slider.style_4 .blogs-slider .post-text > a
, .ftc-contact-form.style_c7 form>p:before
, .copyright-h11 p a:hover
, .title1-h12 .elementor-heading-title span
, .title2-h12 .elementor-heading-title span
, .title3-h12 .elementor-heading-title span
, .blogs-slider.style_5 .blogs-slider .post-text > a
, .ftc-element-testimonial.style_7 .swiper-wrapper .item .infomation::before
, .ftc-contact-form.style_c8 form>p:before
, .social-icon-h12 .elementor-social-icons-wrapper a i:hover
, .copyright-h12 p a:hover
, .video-h12 .elementor-custom-embed-play i:hover
, .title2-h13.title2-h12 .elementor-heading-title span:first-child
, .ftc-element-testimonial.style_8 .swiper-wrapper .item .infomation::before
, .blogs-slider.style_6 .blogs-slider .post-text .meta .published,.icon-box-svg-h4-new h3:hover,
.ftc-element-testimonial.style_10  .testimonial-content .byline,
.header-layout-14 .mega_main_menu.primary .mega_dropdown > li > .item_link:hover *,
.header-ftc-element .mega_main_menu.primary .mega_dropdown > li.current-menu-item > .item_link *
.header-ftc-element .mega_main_menu.primary .mega_dropdown > li > .item_link:hover *,
.img-box-h12 h3.elementor-image-box-title:hover a,.blogs-slider.style_5 .blogs-slider .post-text h4 a:hover,
.header-layout-14 .ftc-search .search-button:hover:after,.price-list-h4-new .ftc-price-list .ftc-price-list-item .ftc-price-list-title:hover,.header-layout-12.ftc-header-template .ftc-search .search-button:hover,
.header-layout-12 .ftc-cart-element .ftc-tini-cart .cart-item a i:hover,
.header-layout-13.ftc-header-template .ftc-search .search-button:hover,
.header-layout-13 .ftc-cart-element .ftc-tini-cart .cart-item a i:hover,
.header-layout-7 .mega_main_menu.vertical > .menu_holder > .menu_inner > ul > li > .item_link:hover > .link_content > .link_text,
.banner1-h15 figure .ftc-image-content .button-banner a,
.video-h15 .elementor-custom-embed-play i,
.ftc-product-grid.style_7.woocommerce .ftc-product.product .item-description h3.product-name a:hover,
.ftc-elements-blogs.style_7 .post .post-text .meta .element-date-timeline .day,
.ftc-elements-blogs.blog-template-elementor.style_7 .inner-wrap .post-text h4:hover a,
.wpcf7 form .sub-form-h15 .button-h15,
.copyright-ft-h15 .elementor-text-editor span:hover,
.header-layout-16.ftc-header-template .header-icon i:hover,
.header-layout-16.ftc-header-template .ftc-search .search-button:hover span,
.video-h16 .elementor-custom-embed-play i,
.ftc-blogs-slider .blogs-slider.style_8 .post-text .meta .element-date-timeline .day,
.ftc-product-grid.style_8.woocommerce .product .item-description .price > .amount > bdi,
.ftc-product-grid.style_8.woocommerce .product .item-description .price > ins > .amount > bdi,
.ftc-product-grid.style_8.woocommerce .product .item-description .product-name a:hover,
.video-h17 .elementor-custom-embed-play i,
.ftc_products_slider.style_8 .product .item-description .price > .amount > bdi,
.ftc_products_slider.style_8 .product .item-description .price > ins > .amount > bdi,
.ftc_products_slider.style_8 .product .item-description .product-name a:hover,
.title1-h17 .elementor-heading-title span,
.ftc-element-testimonial.style_12 .swiper-wrapper .item .infomation::before,
.header-layout-18.ftc-header-template .mega_main_menu.primary > .menu_holder > .menu_inner > ul > li:hover > .item_link .link_text,
.header-layout-18.ftc-header-template .mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link .link_text,
.ftc-element-testimonial.style_13 .navigation-slider .nav-next:hover:before,
.ftc-element-testimonial.style_13 .navigation-slider .nav-prev:hover:before,
.banner4-h18 .ftc-element-image .ftc-image-content .button-banner a:hover,
.banner4-h18 .ftc-element-image .ftc-image-content .button-banner a:hover:before,
.ftc-blogs-slider .blogs-slider.style_9 .post-text .meta .element-date-timeline .day,
.wpcf7 form .sub-form-h18 .button-h18:hover,
.header-layout-19.ftc-header-template .mega_main_menu.primary > .menu_holder > .menu_inner > ul > li:hover > .item_link .link_text,
.header-layout-19.ftc-header-template .mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link .link_text,
.header-layout-19.ftc-header-template .ftc-search .search-button span:hover,
.header-layout-19.ftc-header-template .ftc-cart-tini:hover:before,
.header-layout-19.ftc-header-template .ftc-cart-tini:hover .cart-total,
.ftc-blogs-slider .blogs-slider.style_10 .post-text .meta .element-date-timeline .day,
.wpcf7 form .sub-form-h19 .button-h19:hover,
.title1-h20 .elementor-heading-title:before,
.ftc_products_deal_slider.style_1 .ftc-deal-products .item-description .heading-title a:hover,
.ftc_products_deal_slider.style_1 .ftc-deal-products .item-description .meta_info .add-to-cart a:before,
.ftc_products_deal_slider.style_1 .ftc-deal-products .item-description .meta_info .compare i,
.ftc_products_deal_slider.style_1 .ftc-deal-products .item-description .meta_info .add-to-cart:hover a span,
.button2-h20 a:before,
.ftc_products_slider.style_9 .product .item-description .heading-title a:hover,
.ftc_products_slider.style_9 .product .item-description .meta_info .add-to-cart a:before,
.ftc_products_slider.style_9 .product .item-description .meta_info .compare i,
.ftc_products_slider.style_9 .product .item-description .meta_info .add-to-cart:hover a span,
.ftc_products_deal_slider.style_1 .navigation-slider div:hover,
.pro3-h20 .navigation-slider div:hover,
.banner1-h20 figure .ftc-image-content .ftc-image-caption h2 span:first-child,
.ftc_products_slider.style_10 .ftc-products .item-description .price > .amount,
.ftc_products_slider.style_10 .ftc-products .item-description .meta_info .add-to-cart a:before,
.ftc_products_slider.style_10 .ftc-products .item-description .heading-title a:hover,
.ftc_products_slider.style_10 .ftc-products .item-description .meta_info .add-to-cart:hover a span,
.contact-ft-h20.contact-ft-h15 ul li span span,
.header-layout-21.ftc-header-template .tini-wishlist:hover,
.header-layout-21.ftc-header-template .ftc-search .search-button:hover:after,
.header-layout-21.ftc-header-template .header-icon i:hover,
.header-layout-21.ftc-header-template .header-dropdown-element .content-dropdown a.lang_sel_sel.icl-en:hover,
.header-layout-21.ftc-header-template .header-dropdown-element .content-dropdown a.wcml_selected_currency:hover,
.header-layout-21.ftc-header-template .header-dropdown-element .content-dropdown .ftc-checkout-menu:hover,
.header-layout-21.ftc-header-template .header-dropdown-element .content-dropdown .wcml_currency_switcher ul li:hover,
.header-layout-21.ftc-header-template .header-dropdown-element .content-dropdown .ftc_language ul ul li a:hover,
.ftc_products_slider.style_11 .ftc-products .item-description .product-name a:hover,
.ftc_products_slider.style_11 .ftc-products .item-description .meta_info > .add-to-cart a,
.ftc_products_slider.style_11 .woocommerce .product .images .group-button-product .product-group-button .quickview:hover,
.ftc_products_slider.style_11 .woocommerce .product .images .group-button-product .product-group-button .yith-wcwl-add-to-wishlist:hover a,
.video-h21 .elementor-custom-embed-play i:before,
.ftc-blogs-slider .blogs-slider.style_12 .post-text .meta .element-date-timeline .day,
.ftc-product-grid.style_9.woocommerce.product-template .item-description .product-name a:hover,
.header-layout-22.ftc-header-template .mega_main_menu.primary > .menu_holder > .menu_inner > ul > li:hover > .item_link .link_text,
.header-layout-22.ftc-header-template .mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link .link_text,
.ftc-product-grid.style_10.woocommerce.product-template .product .item-description .product-name a:hover,
.ftc-product-grid.style_10.woocommerce.product-template .product .item-description .price > .amount,
.ftc-product-grid.style_10.woocommerce.product-template .product .item-description .price ins > .amount,
.video-h22 .elementor-custom-embed-play i:before,
.video-h22 .elementor-custom-embed-play::before,
.ftc-element-testimonial.style_16 .swiper-wrapper .item .infomation::before,
.wpcf7 form .sub-form-h22 .button-h22:hover,
.copyright-ft-h15.copyright-ft-h22 .elementor-text-editor span,
.header-layout-23.ftc-header-template a.tini-wishlist:hover,
.header-layout-23.ftc-header-template .ftc-search .search-button:hover,
.header-layout-23.ftc-header-template .mega_main_menu.primary > .menu_holder > .menu_inner > ul > li:hover > .item_link .link_text,
.header-layout-23.ftc-header-template .mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link .link_text,
.video-h23 .elementor-custom-embed-play i,
.ftc_products_slider.style_12 .woocommerce .product .item-description .product-name a:hover,
.wpcf7 form .sub-form-h23 .button-h23:hover,
.header-layout10 .header-content .setting-wrapper .toggle-menu .ftc_language ul li a.lang_sel_sel.icl-en:hover,
.header-layout10 .header-content .setting-wrapper .toggle-menu .header-currency a.wcml_selected_currency:hover,
.header-layout10 .header-content .setting-wrapper .ftc-search-product .ftc-search button:hover,
.header-layout10 .ftc-shop-cart .ftc-cart-tini:hover:before,
.header-layout10 .header-content .setting-wrapper .toggle-menu .mobile-nav-desk:hover,
.header-layout10 .mega_main_menu.primary > .menu_holder > .menu_inner > ul > li:hover > .item_link .link_text,
.header-layout10 .mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link .link_text,
.ftc-product-tabs.style_8.horizontal .tabs-wrapper .tab-title.active,
.ftc-product-tabs.style_8.horizontal .tabs-wrapper .tab-title:hover,
.ftc-product-tabs.style_8 .woocommerce .product .item-description .product-name a:hover,
.ftc-product-tabs.style_8 .woocommerce .product .item-description .meta_info > .yith-wcwl-add-to-wishlist a:hover,
.wpcf7 form .sub-form-h24 .button-h24,
.contact-ft-h15.contact-ft-h24 ul li span span,
.header-layout-15.ftc-header-template .header-dropdown-element .content-dropdown .wcml_currency_switcher ul li:hover,
.header-layout-16.ftc-header-template .header-dropdown-element .content-dropdown .wcml_currency_switcher ul li:hover,
.header-layout-23.ftc-header-template .header-dropdown-element .content-dropdown .wcml_currency_switcher ul li:hover,
.ftc-header-template .header-mobile .mobile-button i:hover .fa-bars:before,
.header-layout-19.ftc-header-template .ftc-cart-tini i.fa.fa-shopping-cart:hover,
.header-layout-16.ftc-header-template .ftc-cart-tini i.fa.fa-shopping-cart:hover,
.header-layout-17.ftc-header-template .ftc-cart-tini i.fa.fa-shopping-cart:hover,
.header-layout-18.ftc-header-template .ftc-cart-tini i.fa.fa-shopping-cart:hover,
.mobile-button .fa-bars:hover:before,
.ftc-header-template .ftc-cart-tini:hover .fa-shopping-cart,
.header-layout-16.ftc-header-template .mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link > .link_content > .link_text:hover,
.header-layout-17.ftc-header-template .mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link > .link_content > .link_text:hover,
.header-layout-19.ftc-header-template .mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .item_link > .link_content > .link_text:hover,
.header-layout-21.ftc-header-template .ftc-cart-tini .cart-total:hover,
.header-layout10 .ftc-shop-cart .cart-item > a .cart-total:hover,
.header-layout10 .header-content .setting-wrapper .toggle-menu .mobile-nav-desk:hover i:before,
.ftc-header-template.header-layout-12 .ftc-shop-cart .cart-item >a i:hover,
.ftc-header-template.header-layout-13 .ftc-shop-cart .cart-item >a i:hover,
.prod_6 .ftc-product-tabs.style_3 .ftc-product.product .group-button-product .yith-wcwl-add-to-wishlist:hover i:before,
.archive .woocommerce .products.grid .product .item-description a.compare:hover i:before,
.off-canvas-cart-title a.close-cart:hover,
.ftc-off-canvas-cart .quantity input[type="button"]:hover,
.woocommerce table.shop_table td.product-quantity input[type="button"]:hover,
.woocommerce div.product form.cart div.quantity input[type="button"]:hover,
div.product form.cart div.quantity input[type="button"]:hover,
div.product .summary .yith-wcwl-add-to-wishlist:hover a,
.woocommerce #content div.product .summary .compare:hover,
.ftc-off-canvas-cart .woocommerce .total .amount:hover,
.single-pro .elementor-widget-container div.product .summary .compare:hover,
.video-h20 .elementor-custom-embed-play:before,
.ftc-off-canvas-cart .woocommerce ul.product_list_widget > li a:hover
{
    color: <?php echo esc_html($ftc_primary_color) ?>;
}

.info_column.email li a:hover,
.header-menuh7 .main-navigation .mega_main_menu .menu_holder .menu_inner .mega_main_menu_ul .menu-item .item_link .link_content .link_text:hover,
.ftc-product-grid.style_4 .products .ftc-product .item-description .meta_info .add-to-cart a.button:before,
.header-menuh6 .main-navigation .mega_main_menu .menu_holder .menu_inner .mega_main_menu_ul .menu-item .item_link .link_content .link_text:hover,
.header-menuh9 .main-navigation .mega_main_menu .menu_holder .menu_inner .mega_main_menu_ul .menu-item .item_link .link_content .link_text:hover,
.ftc-smartmenu li.current-menu-ancestor > a,
.ftc-smartmenu li:hover > a,
.ftc-mobile-wrapper .mobile-menu-wrapper .menu-main-menu-container .ftc-smartmenu .menu-item a>span:before,
.ftc-mobile-wrapper .mobile-wishlist .ftc-my-wishlist a:hover,
.ftc-mobile-wrapper .mobile-account a:hover
, span.theme-color:hover , a.theme-color:hover
, .contact-ft-h11 ul li a:hover span
, .linklist-ft-h11 ul li a:hover span
, .linklist-ft-h12 ul li a:hover span
, .contact-ft-h12 ul li a:hover span
, .icon-box-h12 .elementor-icon:hover,
.icon-box-h4-new-header .elementor-icon-box-title a,
.ftc-elements-blogs.blog-template-elementor.style_7 .inner-wrap .post-text > a:hover,
.contact-ft-h15 ul li a span.elementor-icon-list-text:hover,
.social-icon-ft-h15 a:hover i,
body div.pp_details a.pp_close:hover:before,
.banner-h18 .ftc-element-image .ftc-image-content .button-banner a:hover,
.header-layout-20.ftc-header-template .iconbox-header-h20 .elementor-icon-box-wrapper:hover .elementor-icon,
.header-layout-20.ftc-header-template .iconbox-header-h20 .elementor-icon-box-wrapper:hover .elementor-icon-box-description,
.header-layout-20.ftc-header-template .mega_main_menu.primary > .menu_holder > .menu_inner > ul > li:hover > .item_link .link_text,
.header-layout-20.ftc-header-template .mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link .link_text
{
    color: <?php echo esc_html($ftc_primary_color) ?> !important;
}
.gridlist-toggle a.active svg rect, .gridlist-toggle a:hover svg rect{
    fill: <?php echo esc_html($ftc_primary_color) ?>;
}
.dropdown-container .dropdown-footer > a.button.checkout:hover,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.woocommerce-page .widget_price_filter .price_slider_amount .button:hover,
input.wpcf7-submit:hover,
.tp-bullets .tp-bullet:after,
.woocommerce .product .conditions-box .onsale,
.woocommerce #respond input#submit:hover,
.woocommerce button.button:hover, 
.woocommerce input.button:hover,
.woocommerce .products .product .item-image .button-in:hover a:hover,
.vc_color-orange.vc_message_box-solid,
.woocommerce nav.woocommerce-pagination ul li span.current,
.woocommerce-page nav.woocommerce-pagination ul li span.current,
.woocommerce nav.woocommerce-pagination ul li a.next:hover,
.woocommerce-page nav.woocommerce-pagination ul li a.next:hover,
.woocommerce nav.woocommerce-pagination ul li a.prev:hover,
.woocommerce-page nav.woocommerce-pagination ul li a.prev:hover,
.woocommerce nav.woocommerce-pagination ul li a:hover,
.woocommerce-page nav.woocommerce-pagination ul li a:hover,
.woocommerce .form-row input.button:hover,
.load-more-wrapper .button:hover,
body .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab:hover,
body .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab.vc_active,
.woocommerce div.product form.cart .button:hover,
.woocommerce div.product div.summary p.cart a:hover,
.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
.tagcloud a:hover,
.woocommerce .wc-proceed-to-checkout a.button.alt:hover,
.woocommerce .wc-proceed-to-checkout a.button:hover,
.woocommerce-cart table.cart input.button:hover,
.owl-dots > .owl-dot span:hover,
.owl-dots > .owl-dot.active span,
footer .style-3 .feedburner-subscription .button.button-secondary.transparent,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
body .vc_tta.vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-title > a,
body .vc_tta.vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a:hover,
.vc_toggle_title h4:after,
body.error404 .page-header a,
body .button.button-secondary,
.pp_woocommerce div.product form.cart .button,
.shortcode-icon .vc_icon_element.vc_icon_element-outer .vc_icon_element-inner.vc_icon_element-background-color-orange.vc_icon_element-background,
.style1 .ftc-countdown .counter-wrapper > div,
.style2 .ftc-countdown .counter-wrapper > div,
.style3 .ftc-countdown .counter-wrapper > div,
#cboxClose:hover,
body > h1,
table.compare-list .add-to-cart td a:hover,
.vc_progress_bar.wpb_content_element > .vc_general.vc_single_bar > .vc_bar,
div.product.vertical-thumbnail .details-img .owl-controls div.owl-prev:hover,
div.product.vertical-thumbnail .details-img .owl-controls div.owl-next:hover,
ul > .page-numbers.current,
ul > .page-numbers:hover,
article a.button-readmore:hover, .owl-nav > div.owl-next:hover, .owl-nav > div.owl-prev:hover, .shortcode-heading-wrapper .heading-title:before, .deal-product a:hover.add_to_wishlist.wishlist, .deal-product a:hover.quickview, .woocommerce .form-row input.button, .woocommerce .wishlist_table td.product-add-to-cart a, .woocommerce div.product div.summary p.cart a, .ftc-shortcode .shortcode-heading-wrapper .heading-title:before, body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tabs-container:before, .site-content .related.products h2:before, .ftc-heading:before, .related-posts .theme-title .heading-title:before, .woocommerce #respond input#submit,body .subscribe_comingsoon .subscribe-email .button.button-secondary:hover,
.mc4wp-form-fields input[type="submit"],
.item-image .product-group-button > .quickview:hover, 
.deal-product .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse.show a:hover,
.ftc-sidebar .yith-woocompare-widget .compare:hover,
body a.dokan-btn-theme, body .dokan-btn-theme,
body a.dokan-btn-theme, body .dokan-btn-theme:focus,
body .dokan-category-menu h3.widget-title, body #dokan-secondary .widget h3.widget-title,
.woocommerce-account .woocommerce-MyAccount-content a.woocommerce-Button.button:hover,
.cookies-buttons a.btn.btn-size-small.btn-color-primary.cookies-accept-btn:hover,
.widget.dokan-store-contact .dokan-btn-theme,
.footerdesc .elementor-text-editor p:before
, .woocommerce .product .item-image .product-group-button > div:hover
, .woocommerce .product .item-image .product-group-button > a:hover
, .woocommerce .product .images .product-group-button > div:hover
, .woocommerce .product .images .product-group-button > a:hover
, .woocommerce .list .product .meta_info > div:hover
, .woocommerce .list .product .meta_info > a:hover
, .ftc_products_slider.style_1 .ftc-products .item-description .meta_info .add-to-cart
, .ftc_products_slider.style_2 .ftc-products .item-description .meta_info .add-to-cart
, .ftc-contact-form.style_c3 form.wpcf7-form label:after
, .ftc-off-canvas-cart .woocommerce.widget_shopping_cart .buttons .wc-forward:hover
, .ftc_products_slider.style_5 .swiper-pagination-progressbar .swiper-pagination-progressbar-fill
, .ftc_products_slider.style_6 .swiper-pagination-progressbar .swiper-pagination-progressbar-fill
, .tabs-content-wrapper.style_2 .ftc-product .item-description .meta_info > div:hover
, .tabs-content-wrapper.style_2 .ftc-product .item-description .meta_info > a:hover
, .ftc_products_slider.style_5 .ftc-product .item-description .meta_info > div:hover
, .ftc_products_slider.style_5 .ftc-product .item-description .meta_info > a:hover
, .ftc_products_slider.style_6 .ftc-product .item-description .meta_info > div:hover
, .ftc_products_slider.style_6 .ftc-product .item-description .meta_info > a:hover
, .ftc-image-content.style_8 .button-banner .single-image-button
, .ftc-header-template .ftc-cart-tini:hover .cart-total
, table.compare-list .add-to-cart td a:not(.unstyled_button):hover
, .ftc-contact-form.style_c4 form input.wpcf7-submit
, .ftc-contact-form.style_c5 form input.wpcf7-text.wpcf7-email
, .ftc-contact-form.style_c2 input.wpcf7-text.wpcf7-email
, .elementor-widget-ftc-posts-grid a.ftc-loadmore:hover
, .ftc-contact-form.style_c6 .wpcf7 input.wpcf7-submit:hover, .dont_show_popup
, .woocommerce button.button.alt:hover, .header-layout-7 .ftc-cart-tini .cart-total
, .ftc-breadcrumbs-category .ftc-product-categories-list ul li:hover a:after
, a.ftc-load-more-button-shop
, .button-filter-boxed
, .woocommerce div.product form.cart .added_to_cart:hover
, section.ftc-sticky-atc .single-add-to-cart .added_to_cart:hover
, .ftc-elements-blogs-timeline.def_style_1 .element-timeline:before
, .ftc-elements-blogs-timeline.def_style_1 .ftc-blogs:last-child .element-timeline:after
, .ftc-element-brand.def_style_5 .item
, .ftc_products_deal_slider.prodeal-df .counter-wrapper > div
, .product-template.def_style_5 .product .item-description .meta_info .add-to-cart:hover
, .load-more-product.style_3 .load-more
, .woocommerce div.product .woocommerce-tabs ul.tabs.wc-tabs li.active
, .woocommerce #customer_login button.button
, .checkout-login-coupon-wrapper form.woocommerce-form-login .woocommerce-form-login__submit
, .header-layout-11 .ftc-cart-element .ftc-tini-cart .cart-item a .cart-tota
, .product-tab-template.ftc-product-tabs.style_6 .tabs-wrapper .tab-title.active::before
, .product-tab-template.ftc-product-tabs.style_6 .tabs-wrapper .tab-title:hover:before
, .ftc-product-tabs.style_6 .woocommerce .ftc-product .images .group-button-product .add-to-cart
, .blogs-slider.style_4 .blogs-slider .post-text> a:hover
, .header-layout-12 .mega_main_menu>.menu_holder>.menu_inner>.mega_main_menu_ul>li.current_page_parent>a .link_text::before
, .title2-h12 .elementor-heading-title span::before
, .product-tab-template.ftc-product-tabs.style_7 .tabs-wrapper .tab-title.active::before
, .product-tab-template.ftc-product-tabs.style_7 .tabs-wrapper .tab-title:hover:before
, .ftc-product-tabs.style_7 .woocommerce .ftc-product .images .group-button-product .add-to-cart
, .list-h12 ul::before
, .banner-h12 figure:hover:before
, .ftc_products_slider.style_4 .woocommerce .ftc-product .images .group-button-product .add-to-cart
, .blogs-slider.style_5 .blogs-slider .post-text> a:hover
, .ftc-element-testimonial.style_7 .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active
, .ftc-element-testimonial.style_7 .swiper-pagination .swiper-pagination-bullet:hover
, .header-layout-13 .mega_main_menu>.menu_holder>.menu_inner>.mega_main_menu_ul>li.current_page_parent>a .link_text::before
, .header-layout-13 .mega_main_menu>.menu_holder>.menu_inner>.mega_main_menu_ul>li:hover>a .link_text::before
, .ftc-element-testimonial.style_8 .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active
, .ftc-element-testimonial.style_8 .swiper-pagination .swiper-pagination-bullet:hover
, .blogs-slider.style_6 .blogs-slider .post-text>a
, .banner-h13 figure:hover:before,.header-icon-h4-new .ftc-cart-tini .cart-total,
.header-layout-12.ftc-header-template .ftc-cart-tini .cart-total ,.ftc-product-tabs.style_6 .woocommerce .ftc-product .ftc-product.product .item-description .meta_info > .quickview:hover, .ftc-product-tabs.style_7 .woocommerce .ftc-product .ftc-product.product .item-description .meta_info > .quickview:hover,
.header-layout-11 .ftc-cart-element .ftc-tini-cart .cart-item a .cart-total,.navigation-slider.style_6 div:hover,
.title1-h15:before,
.title3-h15:before,
.title1-h16:before,
.video-h15 .elementor-custom-embed-play i:hover,
.ftc-elements-blogs.style_7 .post .post-text .meta .author:before,
.toggle-h16 .elementor-toggle .elementor-tab-title.elementor-active .elementor-toggle-icon,
.ftc-element-testimonial.style_11 .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active:before,
.ftc-blogs-slider .blogs-slider.style_8 .post-text .meta .author:before,
.wpcf7 form .sub-form-h16 input[type="email"],
.wpcf7 form .sub-form-h17 input[type="email"],
.header-layout-18.ftc-header-template .header-icon i,
.header-layout-18.ftc-header-template .header-icon i::before,
.banner-h18 .ftc-element-image .ftc-image-content .button-banner a::before,
.ftc-blogs-slider .blogs-slider.style_9 .post-text .meta .author:before,
.ftc-blogs-slider .blogs-slider.style_10 .post-text .meta .author:before,
.wpcf7 form .sub-form-h191 .button-h191,
.header-layout-20.ftc-header-template .ftc-cart-tini .cart-total,
.wpcf7 form .sub-form-h20 .button-h20,
.header-layout-21.ftc-header-template .header-icon:hover i,
.header-layout-21.ftc-header-template .header-icon:hover i:before,
.header-layout-21.ftc-header-template .header-icon:hover i:after,
.ftc_products_slider.style_11 .ftc-products .item-description .meta_info > .add-to-cart:hover,
.ftc-blogs-slider .blogs-slider.style_12 .inner-wrap .post-text > a,
.header-layout-22.ftc-header-template .ftc-cart-tini .cart-total,
.header-layout-23.ftc-header-template .ftc-cart-tini .cart-total,
.header-layout-23.ftc-header-template .header-icon:hover i,
.header-layout-23.ftc-header-template .header-icon:hover i:before,
.header-layout-23.ftc-header-template .header-icon:hover i:after,
.ftc-product-tabs.style_8.horizontal .tabs-wrapper .tab-title.active:before,
.ftc-product-tabs.style_8.horizontal .tabs-wrapper .tab-title:hover:before,
.off-canvas-cart-title a.close-cart:hover:before,
.off-canvas-cart-title a.close-cart:hover:after,
.woocommerce-cart .cart-collaterals .shipping-calculator-form button.button:hover,
.woocommerce div.product .summary.entry-summary form.cart .button:hover
{
    background-color: <?php echo esc_html($ftc_primary_color) ?>;
}
.ftc-sb-testimonial .owl-next:hover, 
.ftc-sb-testimonial .owl-prev:hover,
.list a.added_to_cart.wc-forward, .woocommerce span.onsale,.text_service a,
.vc_toggle_title h4:before,
.woocommerce .products.list .product .item-description .compare:hover,
.menu-ftc,#today, .btn-danger,
.slider-products.home3 .owl-nav > div.owl-prev:hover,
.slider-products.home3 .owl-nav > div.owl-next:hover,
.blog-home .blogs a.button-readmore:after,
.contact_form.vc_col-sm-6 input.wpcf7-form-control.wpcf7-submit:hover,
.dokan-single-store .dokan-store-tabs ul li a:hover,
.deal-product span.yith-wcwl-wishlistaddedbrowse.show > a:hover,
.ftc-element-testimonial .testimonial-content h4.name a:before,
.profile-info-box .img-social  .social-store ul li a:hover
, .button-h11 a:hover
, .button2-h11 a,.ftc_products_slider.style_4 .woocommerce .ftc-product .images .conditions-box span.featured
{
    background-color: <?php echo esc_html($ftc_primary_color) ?> !important;
}
.dropdown-container .dropdown-footer > a.button.view-cart:hover,
.dropdown-container .dropdown-footer > a.button.checkout:hover,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.woocommerce-page .widget_price_filter .price_slider_amount .button:hover,
input.wpcf7-submit:hover,
#right-sidebar .product_list_widget:hover li,
.ftc-wg-meta.item-description .meta_info a:hover,
.ftc-wg-meta.item-description .meta_info .yith-wcwl-add-to-wishlist a:hover,
.archive .woocommerce .products.list .product:hover,
.ftc-products-category-tabs-block ul.tabs li:hover,
.ftc-products-category-tabs-block ul.tabs li.current,
body .vc_tta.vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-title > a,
body .vc_tta.vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a:hover,
body div.pp_details a.pp_close:hover:before,
.wpcf7 p input:focus,
.wpcf7 p textarea:focus,
.woocommerce form .form-row .input-text:focus,
body .button.button-secondary,
.ftc-quickshop-wrapper .owl-nav > div.owl-next:hover,
.ftc-quickshop-wrapper .owl-nav > div.owl-prev:hover,
#cboxClose:hover, .feedburner-subscription, #ftc-ajax-search-result,.subscribe_comingsoon .feedburner-subscription input[type="text"]:focus,body .subscribe_comingsoon .subscribe-email .button.button-secondary:hover,
.mc4wp-form-fields, .ftc-mobile-wrapper .menu-text .btn-toggle-canvas.btn-danger,
.mega_main_menu.primary li.default_dropdown > .mega_dropdown > .menu-item > .item_link:hover:before,
body a.dokan-btn-theme, body .dokan-btn-theme:focus
, .load-more-product.style_2 .load-more:hover
, .ftc-contact-form.style_c4 form label input.wpcf7-text
, .ftc-contact-form.style_c4 form label textarea
, .ftc-element-testimonial.style_1 .testimonial-content h4.name
, .woocommerce .products .product .item-description .thum_list_gallery ul li:hover
, .ftc-product-tabs-filter > li.current
, .woocommerce .products.style_3:not(.list) .item-description .meta_info > .add-to-cart
, .ftc-elements-blogs-timeline .element-timeline img
, .ftc-elements-blogs-timeline.def_style_1 .ftc-blogs:hover .date-timeline-element
, .ftc-element-team.def_style_2 .ftc-team-member header
, .ftc-portfolio-wrapper.def_style_4 .thumbnail
, .header-layout-11 .ftc-cart-element .ftc-tini-cart .cart-item a:hover
, .header-layout-11.ftc-header-template .ftc-search .search-button:hover
, .blogs-slider.style_4 .blogs-slider .post-text > a:hover,
, .blogs-slider.style_5 .blogs-slider .post-text > a:hover,
.ftc-element-testimonial.style_11 .swiper-pagination .swiper-pagination-bullet.swiper-pagination-bullet-active,
.ftc_products_slider.style_11 .ftc-products .item-description .meta_info > .add-to-cart:hover,
.banner-h23 figure .ftc-image-content .button-banner a:hover,
.wpcf7 form .sub-form-h23 .button-h23:hover,
.woocommerce-cart-form .shop_table .cart_item .product-remove a.remove:hover
{
    border-color: <?php echo esc_html($ftc_primary_color) ?>;
}
.blogs-slider.style_5 .blogs-slider .post-text .meta .element-date-timeline,
.ftc_products_slider.style_11 .ftc-products .item-description .meta_info > .add-to-cart:hover,
.social-icon-ft-h15 a:hover,
.woocommerce-cart-form .shop_table .cart_item .product-remove a.remove:hover,
.load-more-product.style_2 a.load-more.button:hover,
.details_thumbnails .owl-nav .owl-prev:hover, 
.details_thumbnails .owl-nav .owl-next:hover
{
    border-color: <?php echo esc_html($ftc_primary_color) ?>;
}
.ftc_language ul ul,
.header-currency ul,
.ftc-tiny-account-wrapper .dropdown-container,
.ftc-shop-cart .dropdown-container,
.mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current_page_item,
.mega_main_menu > .menu_holder > .menu_inner > ul > li:hover,
.mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link,
.mega_main_menu > .menu_holder > .menu_inner > ul > li.current_page_item > a:first-child:after,
.mega_main_menu > .menu_holder > .menu_inner > ul > li > a:first-child:hover:before,
.mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current-menu-ancestor > .item_link:before,
.mega_main_menu.primary > .menu_holder > .menu_inner > ul > li.current_page_item > .item_link:before,
.mega_main_menu.primary > .menu_holder > .menu_inner > ul > li > .mega_dropdown,
.woocommerce .product .conditions-box .onsale:before,
.woocommerce .product .conditions-box .featured:before,
.woocommerce .product .conditions-box .out-of-stock:before,.woocommerce-info
, .ftc-account .ftc_login:hover .login-text .ftc_account_form,
.header-layout-15.ftc-header-template .header-dropdown-element .content-dropdown .wcml_currency_switcher ul,
.header-layout-16.ftc-header-template .header-dropdown-element .content-dropdown .wcml_currency_switcher ul,
.header-layout-21.ftc-header-template .header-dropdown-element .content-dropdown .wcml_currency_switcher ul,
.header-layout10 .header-content .setting-wrapper .toggle-menu .content-toggle,
.ftc-off-canvas-cart .woocommerce.widget_shopping_cart .cart_list li.loading:after
{
    border-top-color: <?php echo esc_html($ftc_primary_color) ?>;
}
.woocommerce .products.list .product:hover .item-description:after,
.woocommerce-page .products.list .product:hover .item-description:after
{
    border-left-color: <?php echo esc_html($ftc_primary_color) ?>;
}
footer#colophon .ftc-footer .widget-title:before,
.woocommerce div.product .woocommerce-tabs ul.tabs,
#customer_login h2 span:before,
.cart_totals  h2 span:before,
.banner4-h18 .ftc-element-image .ftc-image-content .button-banner a
{
    border-bottom-color: <?php echo esc_html($ftc_primary_color) ?>;
}
.slider-products span.yith-wcwl-wishlistexistsbrowse.show a, .slider-2 span.yith-wcwl-wishlistexistsbrowse.show a, .slider-products span.yith-wcwl-wishlistaddedbrowse.show > a, .grid span.yith-wcwl-wishlistaddedbrowse.show > a, .related span.yith-wcwl-wishlistaddedbrowse.show > a, .slider-2 span.yith-wcwl-wishlistaddedbrowse.show > a
{
   color: <?php echo esc_html($ftc_primary_color) ?> !important;
}
.icon-box-svg-h4-new svg:hover{
    fill:<?php echo esc_html($ftc_primary_color) ?>;
}
/* ========== Secondary color ========== */
body,
.mega_main_menu.primary ul li .mega_dropdown > li.sub-style > .item_link .link_text,
.woocommerce a.remove,
body.wpb-js-composer .vc_general.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-tab,
.pp_woocommerce .star-rating.no-rating:before,
.vc_progress_bar .vc_single_bar .vc_label,
.vc_btn3.vc_btn3-size-sm.vc_btn3-style-outline,
.vc_btn3.vc_btn3-size-sm.vc_btn3-style-outline-custom,
.vc_btn3.vc_btn3-size-md.vc_btn3-style-outline,
.vc_btn3.vc_btn3-size-md.vc_btn3-style-outline-custom,
.vc_btn3.vc_btn3-size-lg.vc_btn3-style-outline,
.vc_btn3.vc_btn3-size-lg.vc_btn3-style-outline-custom,
.style1 .ftc-countdown .counter-wrapper > div .ref-wrapper,
.style2 .ftc-countdown .counter-wrapper > div .ref-wrapper,
.style3 .ftc-countdown .counter-wrapper > div .ref-wrapper,
.style4 .ftc-countdown .counter-wrapper > div .number-wrapper .number,
.style4 .ftc-countdown .counter-wrapper > div .ref-wrapper,
body table.compare-list tr.remove td > a .remove:before,
.blogs-slider.style_2 .blogs-slider .inner-wrap .post-text .ftc-readmore,
.ftc-element-testimonial.style_2 .swiper-wrapper .item .name a,
.ftc-element-testimonial.style_2 .title-testi-slider h2,
.h8single_imgbanner .elementor-image .wp-caption .ftc-image-content .ftc-image-caption,
.ftc-product-grid.style_6 .products .ftc-product .item-description .heading-title a,
.single-img3h7 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption span,
.single-img6h7 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption span,
.single-img4h7 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption,
.single-img5h7 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption span,
.ftc_products_slider.style_6 .ftc-product .item-description .heading-title,
.single-imgh7 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption p,
.single-img2h7 .elementor-image .wp-caption .ftc-image-content .ftc-image-caption span,
.ftc-product-grid.style_4 .products .ftc-product .item-description .meta_info a.compare.added,
.ftc-product-grid.style_4 .products .ftc-product .item-description .meta_info .add-to-cart a.added_to_cart,
.ftc-product-grid.style_4 .products .ftc-product .item-description .meta_info .add-to-cart a.button span,
.ftc-product-grid.style_4 .products .ftc-product .item-description .heading-title a,
.style_9 .ftc-search .search-button:after,
.ftc-product-tabs.style_5 .tabs-content-wrapper .ftc-tabs .ftc-products-tabs .ftc-product .item-description .short-description,
.ftc-element-testimonial.style_4 .swiper-wrapper .item .infomation p,
.ftc-element-testimonial.style_4 .swiper-wrapper .item .byline,
.blogs-slider.style_3 .blogs-slider .inner-wrap .post-text p
{
    color: <?php echo esc_html($ftc_secondary_color) ?>;
}
.dropdown-container .dropdown-footer > a.button.checkout,
.pp_woocommerce div.product form.cart .button:hover,
.info-company li i,
body .button.button-secondary:hover,
div.pp_default .pp_close, body div.pp_woocommerce.pp_pic_holder .pp_close,
body div.ftc-product-video.pp_pic_holder .pp_close,
body .ftc-lightbox.pp_pic_holder a.pp_close,
#cboxClose
{
    background-color: <?php echo esc_html($ftc_secondary_color) ?>;
}
.dropdown-container .dropdown-footer > a.button.checkout,
.pp_woocommerce div.product form.cart .button:hover,
body .button.button-secondary:hover,
#cboxClose
{
    border-color: <?php echo esc_html($ftc_secondary_color) ?>;
}

/* ========== Body Background color ========== */
body
{
    background-color: <?php echo esc_html($ftc_body_background_color) ?>;
}
/* Custom CSS */
<?php 
if( !empty($ftc_custom_css_code) ){
  echo html_entity_decode( trim( $ftc_custom_css_code ) );
}
?>