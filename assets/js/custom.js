jQuery(document).ready(function ($) {
    "use strict";

	function ftc_quickshop_handle() {
    jQuery('a.quickview').prettyPhoto({
        deeplinking: false
        , opacity: 0.9
        , social_tools: false
        , default_width: 900
        , default_height: 450
        , theme: 'pp_woocommerce'
        , changepicturecallback: function () {
            jQuery('.pp_inline').find('form.variations_form').wc_variation_form();
            jQuery('.pp_inline').find('form.variations_form .variations select').change();
            jQuery('body').trigger('wc_fragments_loaded');

            jQuery('.pp_inline .variations_form').on('click', '.reset_variations', function () {
                jQuery(this).closest('.variations').find('.ftc-product-attribute .option').removeClass('selected');
            });

            jQuery('.pp_woocommerce').addClass('loaded');

            var _this = jQuery('.ftc-quickshop-wrapper .images-slider-wrapper');

            if (_this.find('.image-item').length <= 1) {
                return;
            }

            var owl = _this.find('.image-items').owlCarousel({
                items: 1
                , loop: true
                , nav: true
                , navText: [, ]
                , dots: false
                , navSpeed: 1000
                , slideBy: 1
                , rtl: jQuery('body').hasClass('rtl')
                , margin: 10
                , navRewind: false
                , autoplay: false
                , autoplayTimeout: 5000
                , autoplayHoverPause: false
                , autoplaySpeed: false
                , mouseDrag: true
                , touchDrag: true
                , responsiveBaseElement: _this
                , responsiveRefreshRate: 1000
                , onInitialized: function () {
                    _this.addClass('loaded').removeClass('loading');
                }
            });

        }
    });

}
ftc_quickshop_handle();

    $('.ftc-header-template .ftc_login .login-text, .ftc-tiny-account-wrapper a.login').on('click', function(){
        $('body').addClass("show-form-login");
        $('body').on("click", ".ftc-header-login-overlay", function(){
          $('body').removeClass('show-form-login');
      });
    });

    $(".but-sl-h10").on('click',function(){
        $(".but-sl-h10").toggleClass('activeee');
        $(".gr-sl-h10").toggleClass('activeee');
    });
    $(".but1-sl-h10").on('click',function(){
        $(".but1-sl-h10").toggleClass('activeee1');
        $(".gr1-sl-h10").toggleClass('activeee1');
    });
    $(".but2-sl-h10").on('click',function(){
        $(".but2-sl-h10").toggleClass('activeee2');
        $(".gr2-sl-h10").toggleClass('activeee2');
    });
    $(".but3-sl-h10").on('click',function(){
        $(".but3-sl-h10").toggleClass('activeee3');
        $(".gr3-sl-h10").toggleClass('activeee3');
    });
    $(".but4-sl-h10").on('click',function(){
        $(".but4-sl-h10").toggleClass('activeee4');
        $(".gr4-sl-h10").toggleClass('activeee4');
    });
    $(".but5-sl-h10").on('click',function(){
        $(".but5-sl-h10").toggleClass('activeee5');
        $(".gr5-sl-h10").toggleClass('activeee5');
    });

    $('.portfolio-inner a[rel^="prettyPhoto"]').prettyPhoto({
        show_title: false
        ,deeplinking: false
        ,social_tools: false
    });
    $(window).on('load', function(){
        if( typeof $.fn.isotope == 'function' ){
          $('.ftc-portfolio-wrapper .portfolio-inner').isotope({filter: '*'});
      }
  });

    $('.ftc-portfolio-wrapper .filter-bar li').on('click', function(){
        $(this).siblings('li').removeClass('current');
        $(this).addClass('current');
        var container = $(this).parents('.ftc-portfolio-wrapper').find('.portfolio-inner');
        var data_filter = $(this).data('filter');
        container.isotope({filter: data_filter});
    });

    $('.ftc-portfolio-wrapper').each(function(){
        var element = $(this);
        var atts = element.data('atts');

        element.find('a.load-more').on('click', function(){
          var button = $(this);
          if( button.hasClass('loading') ){
            return false;
        }

        button.addClass('loading');
        var paged = button.attr('data-paged');

        $.ajax({
            type : "POST",
            timeout : 30000,
            url : ftc_shortcode_params.ajax_uri,
            data : {action: 'ftc_portfolio_load_items', paged: paged, atts : atts},
            error: function(xhr,err){

            },
            success: function(response) {
              button.removeClass('loading');
              button.attr('data-paged', ++paged);
              if( response != 0 && response != '' ){
                if( typeof $.fn.isotope == 'function' ){                                        
                  element.find('.portfolio-inner').isotope('insert', $(response));
                  element.find('.filter-bar li.current').trigger('click');
                  setTimeout(function(){
                    element.find('.portfolio-inner').isotope('layout');
                }, 500);
              }
          }
          else{ /* No results */
            button.parent().remove();
        }
    }
});

        return false;
    });
    });
    
    /* banner top header*/
    $("button.button-banner").on('click',function(){
        $(".custom_content").remove();
    });


    /* Header Sticky */
    if(typeof ftc_shortcode_params._ftc_enable_sticky_header != 'undefined' && ftc_shortcode_params._ftc_enable_sticky_header ){
        ftc_sticky_menu();
    }
    function ftc_sticky_menu(){
        var top_spacing = 0; 
        if( jQuery(window).width() ){       
            if( jQuery('body').hasClass('logged-in') && jQuery('body').hasClass('admin-bar')){
                top_spacing = 32;
            }
            var top_begin = jQuery('header.site-header').height() + 32;

            setTimeout( function(){
                jQuery('.header-sticky').sticky({
                    topSpacing: top_spacing
                    ,topBegin: top_begin                   
                });
            }, 200);
            var old_scroll_top = 0;
            var extra_space = 650 + top_spacing + top_begin;
            jQuery(window).scroll(function(){
                if( jQuery('.is-sticky').length > 0 ){
                    var scroll_top = jQuery(this).scrollTop();                
                    if( scroll_top > old_scroll_top && scroll_top > extra_space ){ /* Scroll Down */
                        jQuery('.header-sticky').addClass('header-sticky-hide');
                    }
                    else{ /* Scroll Up */ 
                        if( jQuery('.header-sticky').hasClass('header-sticky-hide') ){
                            jQuery('.header-sticky').removeClass('header-sticky-hide');
                        }     
                    }
                    old_scroll_top = scroll_top; 
                }           
            });
        }
    }


    /*footer - mobile -element*/
if( $(window).width() < 481 ){
    $('.respon_footer .active_col .elementor-heading-title').append('<i class="icon-arrow-down"></i>');
    $('.respon_footer ').each(function(){
        $(this).find('.elementor-heading-title').on('click', function(e){
            e.preventDefault();
            $(this).closest('.elementor-heading-title').toggleClass('active');
            $(this).closest('.respon_footer .active_col').find('.pay-mobi').slideToggle("fast");
            $(this).closest('.respon_footer .active_col').find('.tag-mobi').slideToggle("fast");
            $(this).closest('.respon_footer .active_col').find('.email-mobi').slideToggle("fast");
            $(this).closest('.respon_footer .active_col').find('.elementor-widget-icon-list').slideToggle("fast");
            $(this).closest('.respon_footer .active_col').find('.elementor-widget-ftc-gallery-instagram').slideToggle("fast");
            $(this).closest('.respon_footer .active_col').find('.elementor-widget-text-editor').slideToggle("fast");
            $(this).closest('.respon_footer .active_col').find('.elementor-widget-ftc_single_image').slideToggle("fast");
            $(this).closest('.respon_footer .active_col').find('.elementor-widget-ftc-cf7-forms').slideToggle("fast");
            $(this).closest('.respon_footer .active_col').find('.elementor-widget-ftc-products-widget').slideToggle("fast");
            $(this).closest('.respon_footer .active_col').find('.elementor-widget-ftc-posts-grid').slideToggle("fast");
        });
    });
}



    /*smart Menu*/
	/*
    if($("body").hasClass("mmm")){

        $('#main-menu').smartmenus({
            subMenusSubOffsetX: 1,
            subMenusSubOffsetY: -8
        });
    }
	*/
    /*Gallery post, image slider*/
    function ftc_blog_gallery() {
        $('.post-img .gallery, .thumbnail.gallery').each(function () {
            $(this).addClass('loaded').removeClass('loading');
            $(this).owlCarousel({
                items: 1
                ,loop: true
                ,nav: false
                ,dots: true
                ,navText: [,]
                ,navSpeed: 1000
                ,slideBy: 1
                ,rtl: $('body').hasClass('rtl')
                ,margin: 10
                ,navRewind: false
                ,autoplay: true
                ,autoplayTimeout: 1000
                ,autoplayHoverPause: true
                ,autoplaySpeed: 4000
                ,autoHeight: true
                ,responsive:{
                    0:{
                        items : 1
                    }
                }

            });

        });
    }
    ftc_blog_gallery();

 $( document ).on('click','.header-h4new-cart' , function () {
       $(".content-dropdown").slideToggle("slow");
   });

    /* canvas cart*/
    function ftc_off_canvas_cart() {
        var body = $('body');
        body.on("click", ".cart-item-canvas", function(t) {
            t.preventDefault();
            if(body.hasClass('cart-canvas')){
                body.removeClass('cart-canvas');
            } else {
                body.addClass('cart-canvas');
            }
        });
        body.on("click", ".close-cart", function(t) {
            if(body.hasClass('cart-canvas')){
                body.removeClass('cart-canvas');
            }
        });
        body.on("click", ".ftc-close-popup", function(t) {
            body.removeClass('cart-canvas');
        });
        $('body').on('added_to_cart', function(event, fragments, cart_hash) {
            body.addClass('cart-canvas');  
        }); 
    }  
    ftc_off_canvas_cart();
    
    $(".ftc-header-template button.search-button").on('click',function() {
        $(".ftc_search_ajax").slideToggle("fast");
    });
    
    /* Infinite-Shop */
    function ftc_infinite_shop() {
        var container = $('.archive.infinite .woocommerce .products, .archive.term-face-mask .woocommerce .products'),
        paginationNext = '.woocommerce-pagination li a.next';
        if (container.length === 0 || $(paginationNext).length === 0) {
            return;
        }
        var loadProduct = container.infiniteScroll({
            path: paginationNext,
            append: '.product',
            checkLastPage: true,
            status: '.page-load-status',
            hideNav: '.woocommerce-pagination',
            history: 'push',
            debug: false,
            scrollThreshold: 400,
            loadOnScroll: true
        });
        loadProduct.on('append.infiniteScroll', function(event, response, path, items) {
            $('img.ftc-lazy-load').on('load', function () {
                $(this).parents('.lazy-loading').removeClass('lazy-loading').addClass('lazy-loaded');
            });
            $('img.ftc-lazy-load').each(function () {
                if ($(this).data('src')) {
                    $(this).attr('src', $(this).data('src'));
                }
            });
            if($('.wcvendors_sold_by_in_loop').length){
                $('.product .item-description').addClass('wc-vendor');      
            }
            ftc_quickshop_handle();
        })
    }
    ftc_infinite_shop();

    /* Light box */
    $( '.swipebox' ).swipebox( {
        useCSS : true, // false will force the use of jQuery for animations
        useSVG : true, // false to force the use of png for buttons
        initialIndexOnArray : 0, // which image index to init when a array is passed
        hideCloseButtonOnMobile : false, // true will hide the close button on mobile devices
        removeBarsOnMobile : true, // false will show top bar on mobile devices
        hideBarsDelay : 3000, // delay before hiding bars on desktop
        videoMaxWidth : 1140, // videos max width
        beforeOpen: function() {}, // called before opening
        afterOpen: null, // called after opening
        afterClose: function() {}, // called after closing
        loopAtEnd: false // true will return to the first image after the last image is reached
    } );

    /* Single Product - Variable Product options */
    $(document).on('click', '.variations_form .ftc-product-attribute .variation-product__option a', function(){
        var _this = $(this);
        var val = _this.closest('.variation-product__option').data('variation');
        var selector = _this.closest('.ftc-product-attribute').siblings('select');
        if( selector.length > 0 ){
            if( selector.find('option[value="' + val + '"]').length > 0 ){
                selector.val(val).change();
                _this.closest('.ftc-product-attribute').find('.variation-product__option').removeClass('selected');
                _this.closest('.variation-product__option').addClass('selected');
            }
        }
        return false;
    });

    $('.variations_form').on('click', '.reset_variations', function(){
        $(this).closest('.variations').find('.ftc-product-attribute .variation-product__option').removeClass('selected');
    });
    /* Single Product Video */
    jQuery('a.ftc-product-video-button').prettyPhoto({
        deeplinking: false
        ,opacity: 0.9
        ,social_tools: false
        ,default_width: 800
        ,default_height: 506
        ,theme: 'ftc-product-video'
        ,changepicturecallback: function(){
            jQuery('.ftc-product-video').addClass('loaded');
        }
    });
    /*filter top*/ 
    // jQuery(document).ready(function ($) {
    //     if ($('.prod-cat-show-top-content-button').length >0) {
    //         $('.prod-cat-show-top-content-button').parent().addClass('is-filter');
    //     }
    // });
    /* FILTER TOP */
    /* Product Category Show Top Content Widget Area */
    $('.prod-cat-show-top-content-button a').on('click', function(){
        $(this).toggleClass('active');

        $('.product-category-top-content').slideToggle('fast');
        $('.product-category-top-content').toggleClass('show-adside-content');
        return false;
    });
    
    $(document).ready(function() {
        $('ul.yith-wcan li').on('click', function(){
            $(this).addClass('chosen');
        });    
    });
    /* cookie */
    function ftc_cookie_popup() {
        var cookies_version = ftc_shortcode_params.cookies_version;
        if( $.cookie( 'ftc_cookies_' + cookies_version ) == 'accepted' ) return;
        var popup = $( '.ftc-cookies-popup' );

        setTimeout(function() {
            popup.addClass('popup-display');
            popup.on('click', '.cookies-accept-btn', function(e) {
                e.preventDefault();
                acceptCookies();
            })
        }, 2500 );

        var acceptCookies = function() {
            popup.removeClass('popup-display').addClass('popup-hide');
            $.cookie( 'ftc_cookies_' + cookies_version, 'accepted', { expires: 60, path: '/' } );
        };
    }
    ftc_cookie_popup();

    /* Wc vendor*/
    $(document).ready(function() {
        if($('.wcvendors_sold_by_in_loop').length){
            $('.ftc-meta-widget.item-description').addClass('wc-vendor-w');  
            $('.woocommerce .products .product').addClass('wc-vendor-pr');  
        }
    });
    $(document).ready(function() {
        if($('.wcvendors_sold_by_in_loop').length){
            $('.product .item-description').addClass('wc-vendor');      
        }
    }); 
    $(document).ready(function() {
        if($('.wcvendors_sold_by_in_loop').length){
            $('.single-product .product_list_widget .item-description').addClass('wc-vendor1');      
        }
    });
    $(document).ready(function() {
        if($('.page-container .ftc-sidebar#left-sidebar').length){
            $('.page-container').find('.pv_shop_description').addClass('col-md-9');
        }
    });
    $(document).ready(function() {
        if($('.page-container .ftc-sidebar#right-sidebar').length){
            $('.page-container').find('.pv_shop_description').addClass('col-md-12');
        }
    });
    $(document).ready(function() {
        if($('.page-container .row .col-sm-12').length){
            $('.page-container').find('.pv_shop_description').addClass('col-md-12');
        }
    });


    if( $('html').offset().top < 100 ){
        $("#to-top").hide().addClass("off");
    }
    $(window).scroll(function(){
        if( $(this).scrollTop() > 100 ){
            $("#to-top").removeClass("off").addClass("on");
        } else {
            $("#to-top").removeClass("on").addClass("off");
        }
    });
    $('#to-top .scroll-button').on('click',function(){
        $('body,html').animate({
            scrollTop: '0px'
        }, 1000);
        return false;
    });

    function ftc_cloud_zoom(){
        jQuery('.cloud-zoom-wrap .cloud-zoom-big').remove();
        jQuery('.cloud-zoom, .cloud-zoom-gallery').unbind('click');
        var clz_width = jQuery('.cloud-zoom, .cloud-zoom-gallery').width();
        var clz_img_width = jQuery('.cloud-zoom, .cloud-zoom-gallery').children('img').width();
        var cl_zoom = jQuery('.cloud-zoom, .cloud-zoom-gallery').not('.on_pc');
        var temp = (clz_width-clz_img_width)/2;
        if(cl_zoom.length > 0 ){
            cl_zoom.data('zoom',null).siblings('.mousetrap').unbind().remove();
            cl_zoom.CloudZoom({ 
                adjustX:temp    
            });
        }
    }

    ftc_cloud_zoom();
    if( $('.cloud-zoom, .cloud-zoom-gallery').length > 0 ){
        $('form.variations_form').on('found_variation',function( event, variation ){
            $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom({}); 
        }).on('reset_image',function(){
            $('.cloud-zoom, .cloud-zoom-gallery').CloudZoom({});
        });
    } 

    /* Ajax Remove Cart */
    if( $('ftc-shop-cart')){
        $(document).on('click', '.cart-item-wrapper .remove', function(event){
            event.preventDefault();
            $(this).closest('li').addClass('loading');

            jQuery.ajax({
                type : 'POST'
                ,url : ftc_shortcode_params.ajax_uri 
                ,data : {
                    action : 'ftc_remove_cart_item', 
                    cart_item_key : $(this).data('key')
                }
                ,success : function(data){
                    if ( data && data.fragments ) {

                        $.each( data.fragments, function( key, value ) {
                            $( key ).replaceWith( value );
                        });
                    }
                }
            });
        });
    }

    $(".menu-ftc a").on('click',function () {
        $('#primary-menu').slideToggle("fast");
    });

    $('.ftc-product-slider').each(function () { 
        var margin = $(this).data('margin');
        var columns = $(this).data('columns');
        var nav = $(this).data('nav') == 1;                 
        var auto_play = $(this).data('auto_play') == 1;             
        var slider = $(this).data('slider') == 1;
        var desksmall_items = $(this).data('desksmall_items');
        var tabletmini_items = $(this).data('tabletmini_items');
        var tablet_items = $(this).data('tablet_items');
        var mobile_items = $(this).data('mobile_items');
        var mobilesmall_items = $(this).data('mobilesmall_items');        

        if( slider ){ 
            var _slider_data ={
                loop: true
                , nav: nav
                , dots: true
                , navSpeed: 1000
                , navText: [,]
                , rtl: $('body').hasClass('rtl')
                , margin: margin
                , autoplay: auto_play
                , autoplayTimeout: 5000
                , autoplaySpeed: 1000
                , responsiveBaseElement: $('body')
                , responsiveRefreshRate: 400
                , responsive: {
                    0:{
                        items: mobilesmall_items
                    },
                    480:{
                        items: mobile_items
                    },
                    540:{
                        items: tabletmini_items
                    },
                    700:{
                        items: tablet_items
                    },
                    748:{
                        items: tablet_items
                    },
                    991:{
                        items: desksmall_items
                    },
                    1199:{
                        items:columns
                    }
                }
                ,onInitialized: function(){
                    $(this).addClass('loaded').removeClass('loading');
                }
            };
            $(this).find('.meta-slider > div').owlCarousel(_slider_data);
        }
    });

    $('.ftc-sb-blogs').each(function () { 
        var element = $(this);
        var atts = element.data('atts');

        /* Slider */
        if (atts.is_slider) {
            var nav = parseInt(atts.show_nav) == 1;
            var dots = parseInt(atts.dots) == 1;
            var auto_play = parseInt(atts.auto_play) == 1;
            var margin = parseInt(atts.margin);
            var columns = parseInt(atts.columns);
            var desksmall_items = parseInt(atts.desksmall_items);
            var tablet_items = parseInt(atts.tablet_items);
            var tabletmini_items = parseInt(atts.tabletmini_items);
            var mobile_items = parseInt(atts.mobile_items);
            var mobilesmall_items = parseInt(atts.mobilesmall_items);   
            var _slider_data ={
                loop: true
                , nav: nav
                , dots: dots
                , navSpeed: 1000
                ,navText: [,]
                , rtl: $('body').hasClass('rtl')
                , margin: margin
                , autoplay: auto_play
                , autoplayTimeout: 5000
                , autoplaySpeed: 1000
                , responsiveBaseElement: $('body')
                , responsiveRefreshRate: 400
                , responsive: {
                    0:{
                        items: mobilesmall_items
                    },
                    415:{
                        items: mobile_items
                    },
                    736:{
                        items: tabletmini_items
                    },
                    800:{
                        items: tablet_items
                    },
                    1100:{
                        items: desksmall_items
                    },
                    1199:{
                        items:columns
                    }
                }
                ,onInitialized: function(){
                    $(this).addClass('loaded').removeClass('loading');
                }
            };
            $(this).find('.meta-slider > div').owlCarousel(_slider_data);
        }

        var masonry = false;
        if (atts.masonry && typeof $.fn.isotope == 'function') {
            masonry = true;
        }

        if (masonry) {
            $(window).on('load', function() {
                element.find('.blogs').isotope();
            });
        }
        /* Show more */
        element.find('a.load-more').on('click', function () {
            var button = $(this);
            if (button.hasClass('loading')) {
                return false;
            }

            button.addClass('loading');
            var paged = button.attr('data-paged');

            $.ajax({
                type: "POST",
                timeout: 30000,
                url: ftc_shortcode_params.ajax_uri,
                data: {action: 'ftc_blogs_load_items', paged: paged, atts: atts},
                error: function (xhr, err) {

                },
                success: function (response) {
                    button.removeClass('loading');
                    button.attr('data-paged', ++paged);
                    if (response != 0 && response != '') {
                        if (masonry) {
                            element.find('.blogs').isotope('insert', $(response));
                            setTimeout(function () {
                                element.find('.blogs').isotope('layout');
                            }, 500);
                        } else { /* Append and Update first-last classes */
                            element.find('.blogs').append(response);

                            var columns = parseInt(atts.columns);
                            element.find('.blogs .item').removeClass('first last');
                            element.find('.blogs .item').each(function (index, ele) {
                                if (index % columns == 0) {
                                    $(ele).addClass('first');
                                }
                                if (index % columns == columns - 1) {
                                    $(ele).addClass('last');
                                }
                            });
                        }
                    } else { /* No results */
                        button.parent().remove();
                    }
                }
            });

            return false;
        });

    });

if ($('.single-product').length > 0) {
    var wrapper = $('.single-product .product .details-img:not(.vertical) .thumbnails.loading');
    wrapper.find('.details_thumbnails').owlCarousel({
        loop: true
        , nav: true
        , navText: [, ]
        , dots: false
        , navSpeed: 1000
        , rtl: $('body').hasClass('rtl')
        , margin: 10
        , navRewind: false
        , autoplay: true
        , autoplayHoverPause: true
        , autoplaySpeed: 1000
        , responsiveBaseElement: wrapper
        , responsiveRefreshRate: 1000
        , responsive: {
            0: {
                items: 1
            },
            100: {
                items: 2
            },
            250: {
                items: 3
            },
            290: {
                items: 3
            }
        }
        , onInitialized: function () {
            wrapper.addClass('loaded').removeClass('loading');
        }
    });

    var wrapper = $('.single-product .product .details-img.vertical .thumbnails');
    if (wrapper.length > 0 && typeof $.fn.carouFredSel == 'function') {
        var items = 4;
        if ($('#left-sidebar').length > 0 || $('#right-sidebar').length > 0) {
            items = 3;
        }
        if ($('#left-sidebar').length > 0 && $('#right-sidebar').length > 0) {
            items = 4;
        }

        var _slider_data = {
            items: items
            , direction: 'up'
            , width: 'auto'
            , height: '150px'
            , infinite: true
            , prev: wrapper.find('.owl-prev').selector
            , next: wrapper.find('.owl-next').selector
            , auto: {
                play: true
                , timeoutDuration: 2000
                , duration: 800
                , delay: 2000
                , items: 1
                , pauseOnHover: true
            }
            , scroll: {
                items: 1
            }
            , swipe: {
                onTouch: true
                , onMouse: true
            }
            , onCreate: function () {
                wrapper.addClass('loaded').removeClass('loading');
            }
        };

        wrapper.find('.details_thumbnails').carouFredSel(_slider_data);

        $(window).on('load', function () {
            $(window).trigger('resize');
        });

        $(window).on('resize orientationchange', $.debounce(250, function () {
            if ($(window).width() < 420) {
                _slider_data.items = 2;
            } else if ($(window).width() < 500) {
                _slider_data.items = 3;
            } else if ($(window).width() < 768) {
                _slider_data.items = 4;
            } else {
                _slider_data.items = items;
            }
            wrapper.find('.details_thumbnails').trigger('configuration', _slider_data);
        }));
    }
}

$(window).on('load resize', function () {
    ftc_update_tab_min_height();
});

$('.vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab').on('click', function () {
    ftc_update_tab_min_height();
});

function ftc_update_tab_min_height() {
    setTimeout(function () {
        $('.vc_tta-tabs .vc_tta-panels').each(function () {
            $(this).find('.vc_tta-panel').css('min-height', 0);
            var min_height = $(this).find('.vc_tta-panel.vc_active').height();
            $(this).find('.vc_tta-panel').css('min-height', min_height);
        });
    }, 800);
}

function ftc_counter(elements) {
    if (elements.length > 0) {
        var interval = setInterval(function () {
            elements.each(function (index, element) {
                var day = 0;
                var hour = 0;
                var minute = 0;
                var second = 0;

                var delta = 0;
                var time_day = 60 * 60 * 24;
                var time_hour = 60 * 60;
                var time_minute = 60;

                var wrapper = $(element);

                wrapper.find('.days .number-wrapper .number').each(function (i, e) {
                    day = parseInt($(e).text());
                });
                wrapper.find('.hours .number-wrapper .number').each(function (i, e) {
                    hour = parseInt($(e).text());
                });
                wrapper.find('.minutes .number-wrapper .number').each(function (i, e) {
                    minute = parseInt($(e).text());
                });
                wrapper.find('.seconds .number-wrapper .number').each(function (i, e) {
                    second = parseInt($(e).text());
                });

                if (day != 0 || hour != 0 || minute != 0 || second != 0) {
                    delta = (day * time_day) + (hour * time_hour) + (minute * time_minute) + second;
                    delta--;

                    day = Math.floor(delta / time_day);
                    delta -= day * time_day;

                    hour = Math.floor(delta / time_hour);
                    delta -= hour * time_hour;

                    minute = Math.floor(delta / time_minute);
                    delta -= minute * time_minute;

                    if (delta > 0) {
                        second = delta;
                    } else {
                        second = '0';
                    }

                    day = (day < 10) ? zeroise(day, 2) : day.toString();
                    hour = (hour < 10) ? zeroise(hour, 2) : hour.toString();
                    minute = (minute < 10) ? zeroise(minute, 2) : minute.toString();
                    second = (second < 10) ? zeroise(second, 2) : second.toString();

                    wrapper.find('.days .number-wrapper .number').each(function (i, e) {
                        $(e).text(day);
                    });

                    wrapper.find('.hours .number-wrapper .number').each(function (i, e) {
                        $(e).text(hour);
                    });

                    wrapper.find('.minutes .number-wrapper .number').each(function (i, e) {
                        $(e).text(minute);
                    });

                    wrapper.find('.seconds .number-wrapper .number').each(function (i, e) {
                        $(e).text(second);
                    });
                }

            });
        }, 1000);
    }
}

ftc_counter($('.product .counter-wrapper, .ftc-countdown .counter-wrapper'));

$(window).on('load', function () {
    $('.ftc-twitter-slider, .ftc-sb-testimonial.ftc-slider').each(function () {
        var element = $(this);
        var validate_slider = true;

        if (element.find('.item').length <= 1) {
            validate_slider = false;
        }

        if (validate_slider) {
            var show_nav = false;
            var show_dots = false;
            var autoplay = false;
            if (element.data('nav')) {
                show_nav = true;
            }
            if (element.data('dots')) {
                show_dots = true;
            }
            if (element.data('autoplay')) {
                autoplay = true;
            }

            var slider_data = {
                items: 1
                , loop: true
                , nav: show_nav
                , dots: show_dots
                , navText: [, ]
                , navSpeed: 1000
                , slideBy: 1
                , rtl: $('body').hasClass('rtl')
                , margin: 0
                , navRewind: false
                , autoplay: autoplay
                , autoplayTimeout: 5000
                , autoplayHoverPause: true
                , autoplaySpeed: false
                , mouseDrag: false
                , touchDrag: true
                , center: false
                , startPosition: 1
                , responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 1
                    }
                }
                , onInitialized: function () {
                    element.addClass('loaded').removeClass('loading');
                }
            };
            element.owlCarousel(slider_data);
        } else {
            element.removeClass('loading');
        }
    });
});

if (typeof $.fn.prettyPhoto == 'function') {
    $('.ftc-button.ftc-button-popup').prettyPhoto({
        theme: 'ftc-lightbox'
        , social_tools: false
        , show_title: false
        , default_width: 680
        , default_height: 315
        , deeplinking: false
        , changepicturecallback: function () {
            $('.pp_pic_holder.ftc-lightbox').addClass('loaded');
        }
    });
}

/* Single Product Size Chart */
jQuery('a.ftc-size_chart').prettyPhoto({
    deeplinking: false
    ,opacity: 0.9
    ,social_tools: false
    ,default_width: 800
    ,default_height: 506
    ,theme: 'ftc-size_chart'
    ,changepicturecallback: function(){
        jQuery('.ftc-size-chart').addClass('loaded');
    }
});    
/* Popup Newsletter */
$(document).ready(function() {
    $('.newsletterpopup .close-popup, .popupshadow').on('click', function(){
        $('.newsletterpopup').hide();
        $('.popupshadow').hide();
    });    
});
$( window ).load(function() {
    if($('.newsletterpopup').length){
        var cookieValue = $.cookie("ftc_popup");
        if(cookieValue == 1) {
            $('.newsletterpopup').hide();
            $('.popupshadow').hide();
        }else{
            $('.newsletterpopup').show();
            $('.popupshadow').show();
        }               
    }     
});
$(document).on('change','#ftc_dont_show_again',function(){
    if ($(this).is(':checked')) {
        $.cookie("ftc_popup", 1, { expires : 24 * 60 * 60 * 1000 });
    }
}); 

/* Mobile Navigation */
function ftc_open_menu() {
    var body = $('body');

    body.on("click", ".mobile-nav", function() {
        if (body.hasClass("has-mobile-menu")) {
            body.removeClass("has-mobile-menu");
        } else {
            body.addClass("has-mobile-menu");
        }
    });
    body.on("click", ".btn-toggle-canvas", function() {
        body.removeClass("has-mobile-menu");
    });
    body.on("click touchstart", ".ftc-close-popup", function() {
        body.removeClass("has-mobile-menu");
    });
}
ftc_open_menu();

function ftc_gmap_initialize(map_content_obj, address, zoom, map_type, title) {
    var geocoder, map;
    geocoder = new google.maps.Geocoder();

    geocoder.geocode({'address': address}, function (results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
            var _ret_array = new Array(results[0].geometry.location.lat(), results[0].geometry.location.lng());
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: map
                , title: title
                , position: results[0].geometry.location
            });
        }
    });

    var mapCanvas = map_content_obj.get(0);
    var mapOptions = {
        center: new google.maps.LatLng(44.5403, -78.5463)
        , zoom: zoom
        , mapTypeId: google.maps.MapTypeId[map_type]
        , scrollwheel: false
        , zoomControl: true
        , panControl: true
        , scaleControl: true
        , streetViewControl: false
        , overviewMapControl: true
        , disableDoubleClickZoom: false
    }
    map = new google.maps.Map(mapCanvas, mapOptions)
}

$(window).on('load resize', function () {
    $('.google-map-container').each(function () {
        var element = $(this);
        var map_content = $(this).find('> div');
        var address = element.data('address');
        var zoom = element.data('zoom');
        var map_type = element.data('map_type');
        var title = element.data('title');
        ftc_gmap_initialize(map_content, address, zoom, map_type, title);
    });
});

$('.single-product .related .products').each(function () {
    var _this = $(this);
    if (_this.find('.product').length > 1) {
        _this.owlCarousel({
            loop: true
            , nav: true
            , navText: [, ]
            , dots: false
            , navSpeed: 1000
            , rtl: $('body').hasClass('rtl')
            , margin: 30
            , navRewind: false
            , responsiveBaseElement: _this
            , responsiveRefreshRate: 1000
            , responsive: {
                0: {
                  items: 2
                  , margin: 15
              },
              440: {
                  items: 2
              },
              640: {
                  items: 3
              },
              992: {
                  items: 4
              }
          }
      });
    }
});


$('.widget_categories > ul').each(function (index, ele) {
    var _this = $(ele);
    var icon_toggle_html = '<span class="icon-toggle"></span>';
    var ul_child = _this.find('ul.children');
    ul_child.hide();
    ul_child.closest('li').addClass('cat-parent');
    ul_child.before(icon_toggle_html);
});

$('.widget_categories span.icon-toggle').on('click', function () {
    var parent_li = $(this).parent('li.cat-parent');
    if (!parent_li.hasClass('active')) {
        parent_li.find('ul.children:first').slideDown();
        parent_li.addClass('active');
    } else {
        parent_li.find('ul.children').slideUp();
        parent_li.removeClass('active');
        parent_li.find('li.cat-parent').removeClass('active');
    }
});

$('.widget_categories li.current-cat').parents('ul.children').siblings('.icon-toggle').trigger('click');

$('.widget-container.ftc-product-categories-widget .icon-toggle').on('click', function () {
    var parent_li = $(this).parent('li.cat-parent');
    if (!parent_li.hasClass('active')) {
        parent_li.addClass('active');
        parent_li.find('ul.children:first').slideDown();
    } else {
        parent_li.find('ul.children').slideUp();
        parent_li.removeClass('active');
        parent_li.find('li.cat-parent').removeClass('active');
    }
});

$('.widget-container.ftc-product-categories-widget').each(function () {
    var element = $(this);

    var parent_li = element.find('ul.children').parent('li');
    parent_li.addClass('cat-parent');

    element.find('li.current').parents('ul.children').siblings('.icon-toggle').trigger('click');
});

$('.ftc-products-widget-wrapper').each(function () {
    var element = $(this);
    var show_nav = element.data('show_nav') == 1;
    var auto_play = element.data('auto_play') == 1;

    element.owlCarousel({
        loop: true
        , items: 1
        , nav: show_nav
        , navText: [, ]
        , dots: false
        , navSpeed: 1000
        , slideBy: 1
        , rtl: $('body').hasClass('rtl')
        , navRewind: false
        , autoplay: auto_play
        , autoplayTimeout: 5000
        , autoplayHoverPause: true
        , autoplaySpeed: false
        , mouseDrag: true
        , touchDrag: true
        , responsiveBaseElement: element
        , responsiveRefreshRate: 1000
        , responsive: {/* Fix for mobile */
            0: {
                items: 1
            },
            640: {
                items: 2
            }

        }
        , onInitialized: function () {
            element.addClass('loaded').removeClass('loading');
        }
    });
});

$(document).on('click', '.plus, .minus', function () {
    var $qty = $(this).closest('.quantity').find('.qty'),
    currentVal = parseFloat($qty.val()),
    max = parseFloat($qty.attr('max')),
    min = parseFloat($qty.attr('min')),
    step = $qty.attr('step');

// Format values
if (!currentVal || currentVal === '' || currentVal === 'NaN')
    currentVal = 0;
if (max === '' || max === 'NaN')
    max = '';
if (min === '' || min === 'NaN')
    min = 0;
if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN')
    step = 1;

// Change the value
if ($(this).is('.plus')) {

    if (max && (max == currentVal || currentVal > max)) {
        $qty.val(max);
    } else {
        $qty.val(currentVal + parseFloat(step));
    }
} else {

    if (min && (min == currentVal || currentVal < min)) {
        $qty.val(min);
    } else if (currentVal > 0) {
        $qty.val(currentVal - parseFloat(step));
    }
}

$qty.trigger('change');

});

$(window).on('load', function () {
    $('img.ftc-lazy-load').on('load', function () {
        $(this).parents('.lazy-loading').removeClass('lazy-loading').addClass('lazy-loaded');
    });

    $('img.ftc-lazy-load:not(.product-image-back):not(.ftc_thumb_list_hover)').each(function () {
        if ($(this).data('src')) {
            $(this).attr('src', $(this).data('src'));
        }
    });

    $('img.ftc-lazy-load.product-image-back').each(function () {
        if ($(this).data('src')) {
            $(this).attr('src', $(this).data('src'));
        }
    });
});

ftc_quickshop_handle();

$('body').on('added_to_wishlist', function () {
    ftc_update_tini_wishlist();
    $('.yith-wcwl-wishlistaddedbrowse.show, .yith-wcwl-wishlistexistsbrowse.show').closest('.yith-wcwl-add-to-wishlist').addClass('added');
});

$(document).on('click', '#yith-wcwl-form table tbody tr td a.remove, #yith-wcwl-form table tbody tr td a.add_to_cart_button', function () {
    var old_num_product = $('#yith-wcwl-form table tbody tr[id^="yith-wcwl-row"]').length;
    var count = 1;
    var time_interval = setInterval(function () {
        count++;
        var new_num_product = $('#yith-wcwl-form table tbody tr[id^="yith-wcwl-row"]').length;
        if (old_num_product != new_num_product || count == 20) {
            clearInterval(time_interval);
            ftc_update_tini_wishlist();
        }
    }, 500);
});

setTimeout(function () {
    ftc_compare_change_scroll_bar();
}, 1000);

$('form.variations_form').on('found_variation', function (event, variation) {
    var wrapper = $(this).parents('.summary');
    if (wrapper.find('.single_variation .stock').length > 0) {
        var stock_html = wrapper.find('.single_variation .stock').html();
        var classes = '';
        if (wrapper.find('.single_variation .stock').hasClass('in-stock')) {
            classes = 'in-stock';
        }
        if (wrapper.find('.single_variation .stock').hasClass('out-of-stock')) {
            classes = 'out-of-stock';
        }
        wrapper.find('p.availability span').html(stock_html);
        wrapper.find('p.availability').removeClass('in-stock out-of-stock').addClass(classes);
    } else {
        var stock_html_original = wrapper.find('p.availability').data('original');
        var classes = wrapper.find('p.availability').data('class');
        if (classes == '') {
            classes = 'in-stock';
        }
        wrapper.find('p.availability span').html(stock_html_original);
        wrapper.find('p.availability').removeClass('in-stock out-of-stock').addClass(classes);
    }
}).on('reset_image', function () {
    var wrapper = $(this).parents('.summary');
    var stock_html_original = wrapper.find('p.availability').data('original');
    var classes = wrapper.find('p.availability').data('class');
    if (classes == '') {
        classes = 'in-stock';
    }
    wrapper.find('p.availability span').html(stock_html_original);
    wrapper.find('p.availability').removeClass('in-stock out-of-stock').addClass(classes);
});

$('form.woocommerce-ordering ul.orderby ul a').on('click', function (e) {
    e.preventDefault();
    if ($(this).hasClass('current')) {
        return;
    }
    var form = $(this).closest('form.woocommerce-ordering');
    var data = $(this).attr('data-orderby');
    form.find('select.orderby').val(data);
    form.submit();
});

if (typeof $.fn.select2 == 'function') {
    $('.ftc-search select.select-category').select2();

    var MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;

    $.fn.attrchange = function (callback) {
        if (MutationObserver) {
            var options = {
                subtree: false,
                attributes: true
            };

            var observer = new MutationObserver(function (mutations) {
                mutations.forEach(function (e) {
                    callback.call(e.target, e.attributeName);
                });
            });

            return this.each(function () {
                observer.observe(this, options);
            });
        }
    }

    $('.header-ftc .ftc-search .select2-container').attrchange(function (attrName) {
        if (attrName == 'class') {
            if ($(this).hasClass('select2-dropdown-open')) {
                $('.select2-drop').addClass('category-dropdown');
            } else {
                $('.select2-drop').removeClass('category-dropdown');
            }
        }
    });

    /** Fix for IE9 - IE10 **/
    if ($.browser.msie) {
        var ie_version = parseInt($.browser.version);
        if (ie_version == 9 || ie_version == 10) {
            var search_object = $('.header-ftc .ftc-search .select2-container').get(0);
            if (search_object != undefined && search_object.addEventListener) {
                search_object.addEventListener('DOMAttrModified', ftc_search_by_category_change_attr, false);
            }
        }
    }

}

var on_touch = ftc_is_touch_device();

$('.widget-title-wrapper a.block-control').on('click', function (e) {
    e.preventDefault();
    $(this).parent().siblings().slideToggle(400);
    $(this).toggleClass('active');
});

ftc_widget_toggle();
if (!on_touch) {
    $(window).on('resize', $.throttle(250, function () {
        ftc_widget_toggle();
    }));
}

$(document).on('yith_infs_added_elem', function () {
    ftc_quickshop_handle();
});
});

function ftc_quickshop_handle() {
    jQuery('a.quickshop, a.quickview').prettyPhoto({
        deeplinking: false
        , opacity: 0.9
        , social_tools: false
        , default_width: 900
        , default_height: 450
        , theme: 'pp_woocommerce'
        , changepicturecallback: function () {
            jQuery('.pp_inline').find('form.variations_form').wc_variation_form();
            jQuery('.pp_inline').find('form.variations_form .variations select').change();
            jQuery('body').trigger('wc_fragments_loaded');

            jQuery('.pp_inline .variations_form').on('click', '.reset_variations', function () {
                jQuery(this).closest('.variations').find('.ftc-product-attribute .option').removeClass('selected');
            });

            jQuery('.pp_woocommerce').addClass('loaded');

            var _this = jQuery('.ftc-quickshop-wrapper .images-slider-wrapper');

            if (_this.find('.image-item').length <= 1) {
                return;
            }

            var owl = _this.find('.image-items').owlCarousel({
                items: 1
                , loop: true
                , nav: true
                , navText: [, ]
                , dots: false
                , navSpeed: 1000
                , slideBy: 1
                , rtl: jQuery('body').hasClass('rtl')
                , margin: 10
                , navRewind: false
                , autoplay: false
                , autoplayTimeout: 5000
                , autoplayHoverPause: false
                , autoplaySpeed: false
                , mouseDrag: true
                , touchDrag: true
                , responsiveBaseElement: _this
                , responsiveRefreshRate: 1000
                , onInitialized: function () {
                    _this.addClass('loaded').removeClass('loading');
                }
            });

        }
    });

}

function ftc_update_tini_wishlist() {
    if (typeof ftc_shortcode_params.ajax_uri == 'undefined') {
        return;
    }

    var wishlist_wrapper = jQuery('.my-wishlist-wrapper');
    if (wishlist_wrapper.length == 0) {
        return;
    }

    wishlist_wrapper.addClass('loading');

    jQuery.ajax({
        type: 'POST'
        , url: ftc_shortcode_params.ajax_uri
        , data: {action: 'update_tini_wishlist', security: ftc_platform.ajax_nonce}
        , success: function (response) {
            var first_icon = wishlist_wrapper.children('i.fa:first');
            wishlist_wrapper.html(response);
            if (first_icon.length > 0) {
                wishlist_wrapper.prepend(first_icon);
            }
            wishlist_wrapper.removeClass('loading');
        }
    });
}

function ftc_compare_change_scroll_bar() {
    var yith_compare_wrapper = jQuery('.DTFC_ScrollWrapper');
    if (yith_compare_wrapper.length > 0) {
        var div_html = '<div class="ftc-scroll-wrapper" style="position: fixed; bottom: 0; overflow-x: auto;"><div class="ftc-scroll-content" style="display: inline-block;"></div></div>';
        yith_compare_wrapper.append(div_html);
        var div_temp = yith_compare_wrapper.find(".ftc-scroll-wrapper");
        var left = parseInt(yith_compare_wrapper.find(".dataTables_scroll").css("left").replace(/px/gi, "")) + parseInt(yith_compare_wrapper.parents("body").css("padding-left")) + 3; /* 3px = border of body tag + table tag */
        div_temp.css({
            width: yith_compare_wrapper.find(".dataTables_scroll .dataTables_scrollBody").width()
            , height: ftc_get_scrollbar_width + "px"
            , left: left + "px"
        });
        yith_compare_wrapper.find(".dataTables_scroll .dataTables_scrollBody").css({"overflow": "hidden"});
        div_temp.find(".ftc-scroll-content").css({
            width: yith_compare_wrapper.find(".dataTables_scroll .dataTables_scrollBody table").width()
        });
        div_temp.scroll(function () {
            yith_compare_wrapper.find(".dataTables_scrollBody").scrollLeft(jQuery(this).scrollLeft());
        });
    }
}

function ftc_widget_toggle() {
    if (typeof ftc_shortcode_params._ftc_enable_responsive != 'undefined' && !ftc_shortcode_params._ftc_enable_responsive) {
        return;
    }
    jQuery('.wpb_widgetised_column .widget-title-wrapper a.block-control, .footer-container .widget-title-wrapper a.block-control').remove();
    var window_width = jQuery(window).width();
    window_width += ftc_get_scrollbar_width(); 
    if (window_width >= 992) {
        jQuery('.widget-title-wrapper a.block-control').removeClass('active').hide();
        jQuery('.widget-title-wrapper a.block-control').parent().siblings().show();
    }if (window_width >= 768) {
        jQuery('.wpb_widgetised_column .widget-title-wrapper a.block-control').parent().siblings().show();
        jQuery('.wpb_widgetised_column .widget-title-wrapper a.block-control,.elementor-widget-sidebar .widget-title-wrapper a.block-control,.single-post .widget-title-wrapper a.block-control').addClass('active').hide();
    } else {
        jQuery('.widget-title-wrapper a.block-control').removeClass('active').show();
        jQuery('.widget-title-wrapper a.block-control').parent().siblings().hide();
        jQuery('.wpb_widgetised_column .widget-title-wrapper, .footer-container .widget-title-wrapper').siblings().show();
    }
}

function ftc_woocommerce_quantity_increment($) {
    $(document).on('click', '.plus, .minus', function () {

        var $qty = $(this).closest('.quantity').find('.qty'),
        currentVal = parseFloat($qty.val()),
        max = parseFloat($qty.attr('max')),
        min = parseFloat($qty.attr('min')),
        step = $qty.attr('step');

        if (!currentVal || currentVal === '' || currentVal === 'NaN')
            currentVal = 0;
        if (max === '' || max === 'NaN')
            max = '';
        if (min === '' || min === 'NaN')
            min = 0;
        if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN')
            step = 1;

        if ($(this).is('.plus')) {

            if (max && (max == currentVal || currentVal > max)) {
                $qty.val(max);
            } else {
                $qty.val(currentVal + parseFloat(step));
            }

        } else {

            if (min && (min == currentVal || currentVal < min)) {
                $qty.val(min);
            } else if (currentVal > 0) {
                $qty.val(currentVal - parseFloat(step));
            }

        }

        $qty.trigger('change');

    });
}

(function (a) {
    jQuery.browser.ftc_mobile = /android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4))
})(navigator.userAgent || navigator.vendor || window.opera);
function ftc_is_touch_device() {
    var is_touch = !!("ontouchstart" in window) ? true : false;
    if (jQuery.browser.ftc_mobile) {
        is_touch = true;
    }
    return is_touch;
}

function ftc_get_scrollbar_width() {
    var $inner = jQuery('<div style="width: 100%; height:200px;">test</div>'),
    $outer = jQuery('<div style="width:200px;height:150px; position: absolute; top: 0; left: 0; visibility: hidden; overflow:hidden;"></div>').append($inner),
    inner = $inner[0],
    outer = $outer[0];

    jQuery('body').append(outer);
    var width1 = inner.offsetWidth;
    $outer.css('overflow', 'scroll');
    var width2 = outer.clientWidth;
    $outer.remove();

    return (width1 - width2);
}



function ftc_search_by_category_change_attr(event) {
    if ('attrChange' in event) {
        if (event.attrName == 'class') {
            if (jQuery('.header-ftc .ftc-search .select2-container').hasClass('select2-dropdown-open')) {
                jQuery('.select2-drop').addClass('category-dropdown');
            } else {
                jQuery('.select2-drop').removeClass('category-dropdown');
            }
        }
    }
}

/* Ajax Search */
if( typeof ftc_shortcode_params._ftc_enable_ajax_search != 'undefined' && ftc_shortcode_params._ftc_enable_ajax_search == 1 ){
    ftc_ajax_search();
}

/** Ajax search **/
function ftc_ajax_search(){
    var search_string = '';
    var search_previous_string = '';
    var search_timeout;
    var search_input;
    var search_cache_data = {};
    jQuery('.ftc_search_ajax').append('<div class="ftc-enable-ajax-search"></div>');
    var ftc_enable_ajax_search = jQuery('.ftc-enable-ajax-search');

    jQuery('.header-ftc .ftc_search_ajax input[name="s"], .ftc-header-template .ftc_search_ajax input[name="s"]').on('keyup', function(e){
        search_input = jQuery(this);
        ftc_enable_ajax_search.hide();

        search_string = jQuery.trim(jQuery(this).val());
        if( search_string.length < 2 ){
            search_input.parents('.ftc_search_ajax').removeClass('loading');
            return;
        }

        if( search_cache_data[search_string] ){
            ftc_enable_ajax_search.html(search_cache_data[search_string]);
            ftc_enable_ajax_search.show();
            search_previous_string = '';
            search_input.parents('.ftc_search_ajax').removeClass('loading');

            ftc_enable_ajax_search.find('.view-all a').on('click', function(e){
                e.preventDefault();
                search_input.parents('form').submit();
            });

            return;
        }

        clearTimeout(search_timeout);
        search_timeout = setTimeout(function(){
            if( search_string == search_previous_string || search_string.length < 2 ){
                return;
            }
            search_previous_string = search_string;
            search_input.parents('.ftc_search_ajax').addClass('loading');

            /* check category */
            var category = '';
            var select_category = search_input.parents('.ftc_search_ajax').siblings('.select-category');
            if( select_category.length > 0 ){
                category = select_category.find(':selected').val();
            }

            jQuery.ajax({
                type : 'POST'
                ,url : ftc_shortcode_params.ajax_uri
                ,data : {
                    action : 'ftc_ajax_search', 
                    search_string: search_string, 
                    category: category,
                    security: ftc_platform.ajax_nonce
                }
                ,error : function(xhr,err){
                    search_input.parents('.ftc_search_ajax').removeClass('loading');
                }
                ,success : function(response){
                    if( response != '' ){
                        response = JSON.parse(response);
                        if( response.search_string == search_string ){
                            ftc_enable_ajax_search.html(response.html);
                            search_cache_data[search_string] = response.html;

                            ftc_enable_ajax_search.css({
                                'position': 'absolute'
                                ,'display': 'block'
                                ,'z-index': '999'
                            });

                            search_input.parents('.ftc_search_ajax').removeClass('loading');

                            ftc_enable_ajax_search.find('.view-all a').on('click', function(e){
                                e.preventDefault();
                                search_input.parents('form').submit();
                            });
                        }
                    }
                    else{
                        search_input.parents('.ftc_search_ajax').removeClass('loading');
                    }
                }
            });
        }, 500);
    });

    ftc_enable_ajax_search.on('hover',function(){}, function(){ftc_enable_ajax_search.show();});

    jQuery('body').on('click', function(){
        ftc_enable_ajax_search.hide();
    });

    jQuery('.ftc-search-product select.select-category').on('change', function(){
        search_previous_string = '';
        search_cache_data = {};
        jQuery(this).parents('.ftc-search-product').find('.ftc_search_ajax input[name="s"]').trigger('keyup');
    });
}

function zeroise(str, max) {
    str = str.toString();
    return str.length < max ? zeroise('0' + str, max) : str;
}

jQuery(document).ready(function ($) {


    /* Show hide popover */
    $(".dropdown-button").on('click',function () {
        $(this).find(".dropdown-list").slideToggle("fast");
    });
});


jQuery(document).ready(function ($) {
    "use strict";

    
    // Related post
    $('.single-post .related-posts.loading .meta-slider .blogs').each(function () {
      $(this).addClass('loaded').removeClass('loading');
      $(this).owlCarousel({ 
        loop: true
        , nav: false
        , navText: [, ]
        , dots: false
        , navSpeed: 1000
        , slideBy: 1
        , rtl: jQuery('body').hasClass('rtl')
        , margin: 30
        , autoplayTimeout: 5000
        , responsiveRefreshRate: 400
        , responsive: {
          0: {
            items: 1
        },
        480: {
            items: 2
        },
        800: {
            items: 2
        }
    }       
});

  });
    /*filter by products*/
    if ($(window).width() < 991) {
        $('.button-sidebar').on('click', function(){
            $('body').toggleClass("sidebar-show");
            $('.button-sidebar').toggleClass('active');
            $('.archive .ftc-sidebar, .single-product .ftc-sidebar').toggleClass("show-popup");

            $('body').on("click", ".ftc-close-popup", function(){
                $('.archive .ftc-sidebar, .single-product .ftc-sidebar').removeClass('show-popup');
                $('body').removeClass("sidebar-show");
                $('.button-sidebar').removeClass('active');
            });
            return false;
        });

    }

    /*read more short_description*/ 
    jQuery(function($) {
        $(document).ready(function() {
            $("#readMore, #readless").on('click',function(){
                $(".collapsed-content").toggle('slow', 'swing');
                $(".full-content").toggle('slow', 'swing');
            $("#readMore").toggle();// "read more link id"
            $("#readless").toggle();
            return false;
        });
        });
    });
    /*end*/
    /*Read more desciption in Tab*/
    jQuery(function($) {
        $(document).ready(function() {
            $("#readmore_des, #readless_des").on('click',function(){
                $(".desciption_content").toggle('slow', 'swing');
                $(".description_fullcontent").toggle('slow', 'swing');
                $("#readmore_des").toggle();
                $("#readless_des").toggle();

                return false;
            });
        });
        /* Product  360*/
        $('a.ftc-video360').magnificPopup({
          type: 'inline',
          mainClass: 'product-360',
          preloader: false,
          fixedContentPos: false,
          callbacks: {
            open: function() {
              $(window).resize()
          },
      },
  });

    });

    /*end*/
    $('.single-product .upsells .products, .woocommerce .ftc-cross-sells .products').each(function () {
        var _this = $(this);
        if (_this.find('.product').length > 1) {
            _this.owlCarousel({
                loop: true
                , nav: false
                , navText: [, ]
                , dots: false
                , navSpeed: 1000
                , rtl: $('body').hasClass('rtl')
                , margin: 30
                , navRewind: false
                , responsiveBaseElement: _this
                , responsiveRefreshRate: 1000
                , responsive: {
                    0: {
                        items: 2,
                        margin: 15
                    },
                    480: {
                        items: 2
                    },
                    640: {
                        items: 3
                    },
                    992: {
                        items: 3
                    },
                }
            });
        }
    });

    function ftc_thumbnail_gallery() {
        jQuery('.ftc-product .thum_list_gallery ul li a').mouseenter(function(event){
            jQuery('.active').removeClass('active');
            jQuery(this).addClass('active');
            jQuery(this).closest('.ftc-product').find('.item-image a .has-more-image').addClass('active');
            var changeSrc = jQuery(this).attr("href");
            jQuery("a .has-more-image.active .attachment-shop_catalog").attr("srcset", changeSrc).fadeIn(300);
            event.preventDefault();
        });

        jQuery(".ftc-product .thum_list_gallery ul li a").mouseleave(function() {
            jQuery("a .has-more-image.active .attachment-shop_catalog").attr("srcset", '').fadeIn(300);
        });

    }
    ftc_thumbnail_gallery();

    
    /*fix speed resize img product*/
    $(".thum_list_gallery").each(function(){
        $(".thum_list_gallery").hide();
        setTimeout(function(){
            $('.thum_list_gallery').show();
        }, 3000);
    });


    /*Scroll animation Shop*/
    // Detect request animation frame
    var scroll = window.requestAnimationFrame ||
    // IE Fallback
    function(callback){ window.setTimeout(callback, 1000/60)};
    var elementsToShow = document.querySelectorAll('.archive .animation-shop .ftc-product.product');

    function ftc_animation_loop() {

      Array.prototype.forEach.call(elementsToShow, function(element){
        if (isElementInViewport(element)) {
          element.classList.add('is-visible');
      } else {
          element.classList.remove('is-visible');
      }
  });

      scroll(ftc_animation_loop);
  }

    // Call the loop for the first time
    ftc_animation_loop();

    function isElementInViewport(el) {
    // special bonus for those using jQuery
    if (typeof jQuery === "function" && el instanceof jQuery) {
      el = el[0];
  }
  var rect = el.getBoundingClientRect();
  return (
      (rect.top <= 0
        && rect.bottom >= 0)
      ||
      (rect.bottom >= (window.innerHeight || document.documentElement.clientHeight) &&
        rect.top <= (window.innerHeight || document.documentElement.clientHeight))
      ||
      (rect.top >= 0 &&
        rect.bottom <= (window.innerHeight || document.documentElement.clientHeight))
      );
}

/*Load more button product in shop*/
function ftc_button_loadmore_infinite(){
  var paginationNext = ".woocommerce-pagination li a.next";
  var $container = $('.ftc-button-infinite .woocommerce .products').infiniteScroll({
    // options...
    path: paginationNext,
    append: ".product",
    checkLastPage: true,
    status: ".ftc-loading-shop",
    hideNav: ".woocommerce-pagination",
    history: "push",
    debug: false,
    scrollThreshold: 400,
    loadOnScroll: false,
    // enable button
    button: '.ftc-load-more-button-shop',
});
  $container.on("append.infiniteScroll", function(event, response, path, items){
    $("img.ftc-lazy-load").on("load", function() {
      $(this)
      .parents(".lazy-loading")
      .removeClass("lazy-loading")
      .addClass("lazy-loaded");
  });
    $("img.ftc-lazy-load").each(function() {
      if ($(this).data("src")) {
        $(this).attr("src", $(this).data("src"));
    }
});
    ftc_quickshop_process_action();
});

  var $viewMoreButton = $('.ftc-load-more-button-shop');

    // get Infinite Scroll instance
    var infScroll = $container.data('infiniteScroll');

    $container.on( 'load.infiniteScroll', onPageLoad );

    ftc_animation_loop();

    function onPageLoad() {
      if ( infScroll.loadCount == 1 ) {
        // after 2nd page loaded
        // disable loading on scroll
        $container.infiniteScroll( 'option', {
          loadOnScroll: false,
      });
        // show button
        $viewMoreButton.show();
        // remove event listener
        $container.off( 'load.infiniteScroll', onPageLoad );

    }
}
}
ftc_button_loadmore_infinite();

/*Shop Carousel*/
$(".archive .products.slider-shop").each(function() {

    var _slider_data = {
        loop: true,
        nav: true,
        dots: true,
        navSpeed: 1000,
        navText: [,],
        rtl: $("body").hasClass("rtl"),
        margin: 0,
        autoplay: false,
        autoplayTimeout: 5000,
        autoplaySpeed: 1000,
        responsiveBaseElement: $("body"),
        responsiveRefreshRate: 400,
        responsive: {
            0: {
                items: 2,
                margin: 0,
            },
            480: {
                items: 2
            },
            640: {
                items: 3
            },
            768: {
                items:3
            },
            991: {
                items: 4
            },
            1199: {
                items: 4
            }
        },
        onInitialized: function() {
            $('.archive .products.slider-shop').append("<div class='container-load'><div class='ftc-loader'><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--dot'></div><div class='loader--text'></div></div></div>");
            $('.archive .woocommerce-pagination').hide();

            setTimeout(function(){
                $('.archive .products.slider-shop').addClass("loaded").removeClass("loading").fadeIn(500);
                $('.archive .products.slider-shop').find('.container-load').remove('.container-load');
                $('.archive .woocommerce-pagination').show();
            }, 3000);
        }
    };
    $(this).owlCarousel(_slider_data);

});

/*advanced filter*/

$(".ftc-advanced-filter .ftc-product-tabs-filter li").on("click", function() {
  $(this)
  .siblings("li")
  .removeClass("current");
  $(this).addClass("current");
  var container = $(this)
  .parents(".woocommerce")
  .find(".products:not(.list)");
  var data_filter = $(this).data("filter");
  container.isotope({ filter: data_filter });
});



});

jQuery(document).ready(function($){

    $('.button-filter-boxed a').on('click', function(e){
        e.preventDefault();
        $('.woocommerce .ftc-filter-boxed').toggleClass('showw');
        if($('.woocommerce .ftc-filter-boxed').hasClass('showw') ){
            $('body #main-content').addClass('change');
            if($('body #main-content').hasClass('change') ){
                $('body #main-content').attr('style','width:75%; float:right').fadeIn(500);
            }
            else{
                $('body #main-content').attr('style','').fadeIn(500);
            }
        }
        if (jQuery(window).width() > 767) {
            if($('.woocommerce .ftc-filter-boxed').hasClass('showw') ){
                e.stopPropagation();
                $('body').on('click', function(){
                    $('.woocommerce .ftc-filter-boxed').removeClass('showw');
                    $('body #main-content').attr('style','').fadeIn(500);
                });
                $('.woocommerce-result-count').hide();
                $('.button-filter-boxed').addClass('activee');
            }else{
                $('.woocommerce-result-count').show();
                $('.button-filter-boxed').removeClass('activee');
            }
        }
    });

    /*summary fixed*/
    if( $(window).width()  > 768 ){
        $('.ftc-single-grid').each(function(){
            var height_header = $('.site-header').height() + $('.site-content .breadcrumb-title-wrapper').height() + 70;
            var height_im = $('.single-product .ftc-grid-main-images').height() - 270;
            var height_tabs = $('.single-product .woocommerce-tabs #tab-description').height();
            var width_sum = $('.ftc-single-grid .product:not(.ftc-quickshop-wrapper) .summary.entry-summary').width();

            var  height_sum = $(window).height() - height_header;

            jQuery(window).scroll(function() {
                var scroll_top_pro = jQuery(this).scrollTop();
                if (scroll_top_pro > height_header && scroll_top_pro < height_im) {
                    /* Scroll Down */
                    if($("body").hasClass("admin-bar")){
                        jQuery(".summary.entry-summary").addClass("fixed").fadeIn(100).css({'top': '30px','width': +  width_sum +  'px'});
                    }else{
                        jQuery(".summary.entry-summary").addClass("fixed").fadeIn(100).css({'top': '0px','width': +  width_sum +  'px'});
                    }
                } else if(scroll_top_pro > height_im){
                    jQuery(".summary.entry-summary").removeClass("fixed").attr('style','').css({'position': 'absolute','top': 'auto','bottom': '0px'});
                }else {
                    /* Scroll Up */
                    jQuery(".summary.entry-summary").removeClass("fixed").attr('style','');
                }
            });
        });
    }

    /*scroll stiky add to cart*/
    $(window).scroll(function() {
        if ($(this).scrollTop() > ($('.single-product .details-img').height() + $('.site-header').height() + $('.breadcrumb-title-wrapper').height()) && $(window).width() > 991 && $('body').hasClass('single-product')) {
          $("section.ftc-sticky-atc").addClass("show");
          $("section.ftc-sticky-atc").closest('body').find('footer').attr('style','padding-bottom:120px');
      } else {
          $("section.ftc-sticky-atc ").removeClass("show");
          $('footer').attr('style','');
      }
  });


});

/*Ajaxx add to cart single product*/
(function ($) {

  $(document).on('click', '.product.product-type-simple .single_add_to_cart_button, section.ftc-sticky-atc .single-add-to-cart .single_add_to_cart_button:not(.disabled)', function (e) {
    e.preventDefault();
    var notification = $('.ftc-single-added');

    var $thisbutton = $(this),
    $form = $thisbutton.closest('form.cart'),
    id = $thisbutton.val(),
    product_qty = $form.find('input[name=quantity]').val() || 1,
    product_id = $form.find('input[name=product_id]').val() || id,
    variation_id = $form.find('input[name=variation_id]').val() || 0;

    var data = {
      action: 'woocommerce_ajax_add_to_cart',
      product_id: product_id,
      product_sku: '',
      quantity: product_qty,
      variation_id: variation_id,
  };

  $(document.body).trigger('adding_to_cart', [$thisbutton, data]);

  $.ajax({
      type: 'post',
      url: wc_add_to_cart_params.ajax_url,
      data: data,
      beforeSend: function (response) {
        $thisbutton.removeClass('added').addClass('loading');
    },
    complete: function (response) {
        $thisbutton.addClass('added').removeClass('loading');
    },
    success: function (response) {

        if (response.error && response.product_url) {
          window.location = response.product_url;
          return;
      } else {
          $(document.body).trigger('added_to_cart', [response.fragments, response.cart_hash, $thisbutton]);
      }
      setTimeout(function() {

          notification.addClass("show_ad").delay(2500).queue(function(){
            $(this).removeClass("show_ad").dequeue();
        });
      }, 200);
  },
});

  return false;
});


  /*shop variation*/
  $(document).ready(function() {
    $('.images .woocommerce-product-gallery__image a .has-more-image img, .images .woocommerce-product-gallery__image a .no-back-image img').addClass('wp-post-image');
});

  $('.ftc-variation .product').each(function(){
    $(this).find('.item-description .variations_form').on('click', function(e){
      e.preventDefault();
      $(this).addClass("show-price");
    });
  });
  if( $(window).width()  < 481 ){
    $('.footer-section .elementor-heading-title').append('<i class="fa fa-angle-up"></i>');
    $('.footer-section .footer-column ').each(function(){
      $(this).find('.elementor-heading-title').on('click', function(e){
        e.preventDefault();
        $(this).closest('.elementor-heading-title').toggleClass('active');
        $(this).closest('.footer-section .footer-column').find('.elementor-widget-icon-list').slideToggle("fast");
        $(this).closest('.footer-section .footer-column').find('.elementor-widget-text-editor').slideToggle("fast");
        $(this).closest('.footer-section .footer-column').find('.elementor-widget-ftc_single_image').slideToggle("fast");

      });
    });
}
    /*js for home24*/
if( $(window).width()  > 991 ){
    var height_win = $(window).innerHeight();
    var height_header12 = $('.header-ftc.header-layout10').innerHeight();
    
    var margin_topp = $('.fixed-media .content-media').innerHeight();
    $('.fixed-media .content-media').attr('style', 'height:' + margin_topp + 'px');
    $('.fixed-media .header-ftc.header-layout10').attr('style', 'margin-top:' + margin_topp + 'px');	
              $(window).on("resize", function(){
    $('.fixed-media .content-media').attr('style', 'height:' + ($(window).innerHeight() - 142) + 'px');
    $('.fixed-media .header-ftc.header-layout10').attr('style', 'margin-top:' + ($(window).innerHeight() - 142) + 'px');	
    });
    }
/*toggle-menu dropdown*/
$( document ).on('click','.mobile-nav-desk' , function () {
    $(".content-toggle").slideToggle("slow");
 });

var timeout;

  jQuery( function( $ ) {
   $('.ftc-off-canvas-cart .woocommerce.widget_shopping_cart .cart_list li').each(function(){
    $('.woocommerce').on('change keyup', 'input.qty', function(){

      if ( timeout !== undefined ) {
        clearTimeout( timeout );
      }
       var $el = $(this);
      timeout = setTimeout(function() {

        $("[name='update_cart']").trigger("click");

        $el.closest('.ftc-off-canvas-cart .woocommerce.widget_shopping_cart .cart_list li').addClass('loading');

    }, 500 ); // 1 second delay, half a second (500) seems comfortable too



    });
  });
 } );


  jQuery(document).on('submit', '.ftc-off-canvas-cart .shop_table.cart form', function() {   
    updateMiniCartQuantity();
    return false;
  });

  function updateMiniCartQuantity() {
    var cartForm = jQuery('.shop_table.cart form');
    jQuery('<input />').attr('type', 'hidden')
    .attr('name', 'update_cart')
    .attr('value', 'Update Cart')
    .appendTo(cartForm);

    var formData = cartForm.serialize();
    jQuery.ajax({
      type: cartForm.attr('method'),
      url: cartForm.attr('action'),
      data: formData,
      dataType: 'html',
      success: function(response) {
        console.log(response);
        let wc_cart_fragment_url = (wc_cart_fragments_params.wc_ajax_url).replace("%%endpoint%%", "get_refreshed_fragments");
        jQuery.ajax({
          type: 'post',
          url: wc_cart_fragment_url,
          success: function(response) {
            console.log(response);
            var mini_cart_wrapper = jQuery('.widget_shopping_cart_content');
            var parent = mini_cart_wrapper.parent();
            mini_cart_wrapper.remove();
            parent.append(response.fragments['div.widget_shopping_cart_content']);

          },
          complete: function() {
            cartForm = jQuery('.shop_table.cart form');
            $('.off-canvas-cart-title .title').trigger( 'wc_fragment_refresh' );
          }
        });
      }
    });
  }

  
})(jQuery);