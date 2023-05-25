(function($) {
  "use strict";
function ftc_quickshop_handle() {
    if (typeof prettyPhoto == "function"){
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
}
ftc_quickshop_handle();

})(jQuery);