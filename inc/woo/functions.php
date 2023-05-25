<?php
/*** Tiny account ***/
if (!function_exists('ftc_tiny_account')) {
    function ftc_tiny_account()
    {
        global $wp;
        $login_url = '#';
        $register_url = '#';
        $profile_url = '#';
        $logout_url = wp_logout_url(get_permalink());

        if (ftc_has_woocommerce()) { /* Active woocommerce */
            $myaccount_page_id = get_option('woocommerce_myaccount_page_id');
            if ($myaccount_page_id) {
                $login_url = get_permalink($myaccount_page_id);
                $register_url = $login_url;
                $profile_url = $login_url;
            }
        } else {
            $login_url = wp_login_url();
            $register_url = wp_registration_url();
            $profile_url = admin_url('profile.php');
        }



        $_user_logged = is_user_logged_in();
        ob_start();

        ?>
        <div class="ftc-tiny-account-wrapper">
            <div class="account-control">
                <?php if (!$_user_logged): ?>
                    <a class="login" href="#"
                       title="<?php echo esc_html('Login', 'corona'); ?>"><span><?php echo esc_html('Login', 'corona'); ?></span></a>
                       /
                       <a class="sign-up" href="<?php echo esc_url($register_url); ?>"
                           title="<?php echo esc_html('Create New Account', 'corona'); ?>"><span><?php echo esc_html('Sign up', 'corona'); ?></span></a>
                           <?php else: ?>
                            <a class="my-account" href="<?php echo esc_url($profile_url); ?>"
                               title="<?php echo esc_html('My Account', 'corona'); ?>"><span><?php echo esc_html('My Account', 'corona'); ?></span></a> /
                               <a class="log-out" href="<?php echo esc_url($logout_url); ?>"
                                   title="<?php echo esc_html('Logout', 'corona'); ?>"><span><?php echo esc_html('Logout', 'corona'); ?></span></a>
                               <?php endif; ?>
                           </div>
                           
              </div>

              <?php
              return ob_get_clean();
          }
      }

      /* * * Tiny Cart ** */
      if (!function_exists('ftc_tiny_cart')) {

        function ftc_tiny_cart() {
            if (!ftc_has_woocommerce()) {
                return '';
            }
            global $smof_data;
            ob_start();
            ?>
            <div class="ftc-tini-cart">
                <div class="cart-item">
                    <a class="ftc-cart-tini <?php if(isset($smof_data['ftc_mobile_layout']) && $smof_data['ftc_cart_layout'] == 'off-canvas') {
                        echo "cart-item-canvas";
                    } ?>" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
                    <i class="fa fa-shopping-cart"></i>
                    <?php echo wp_kses_post(ftc_cart_total()); ?>
                </a>
            </div>
            <?php if(isset($smof_data['ftc_mobile_layout']) && $smof_data['ftc_cart_layout'] == 'dropdown'): ?>
                <div class="tini-cart-inner">
                    <div class="woocommerce widget_shopping_cart">
                        <div class="widget_shopping_cart_content">
                            <?php echo wp_kses_post(woocommerce_mini_cart()); ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <?php
        return ob_get_clean();
    }
}
add_action('wp_footer', 'ftc_canvas_cart');
function ftc_canvas_cart(){
    if (!ftc_has_woocommerce()) {
        return '';
    }
    global $smof_data;
    ?>
    <?php if(isset($smof_data['ftc_mobile_layout']) && $smof_data['ftc_cart_layout'] == 'off-canvas'): ?>
        <div class="ftc-off-canvas-cart">
            <div class="off-canvas-cart-title">
                <div class="title"><?php echo esc_html('Your Cart', 'corona'); ?>
                    <span class="total-count-cart"><?php echo wp_kses_post(ftc_cart_total()); ?></span>  
                </div>
                <a class="close-cart"> <?php echo esc_html('Close', 'corona') ?></a>
            </div>
            <div class="off-can-vas-inner">
                <div class="woocommerce widget_shopping_cart">
                    <div class="widget_shopping_cart_content">
                        <?php echo woocommerce_mini_cart(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
    <?php

}

function ftc_cart_total() {
    ob_start();
    if(!WC()->cart ){
return;
}
    ?>
    <div class="cart-total"><?php echo WC()->cart->get_cart_contents_count() ?></div>
    <?php
    return ob_get_clean();
}
add_filter('woocommerce_add_to_cart_fragments', 'ftc_tiny_cart_filter');

function ftc_tiny_cart_filter($fragments) {
    $fragments['.cart-total'] = ftc_cart_total();
    return $fragments;
}

/** Tini wishlist **/
function ftc_tini_wishlist(){
    if (!(ftc_has_woocommerce() && class_exists('YITH_WCWL'))) {
        return;
    }

    ob_start();

    $wishlist_page_id = get_option('yith_wcwl_wishlist_page_id');
    if (function_exists('wpml_object_id_filter')) {
        $wishlist_page_id = wpml_object_id_filter($wishlist_page_id, 'page', true);
    }
    $wishlist_page = get_permalink($wishlist_page_id);

    $count = yith_wcwl_count_products();

    ?>

    <a title="<?php echo esc_html('Wishlist', 'corona'); ?>" href="<?php echo esc_url($wishlist_page); ?>" class="tini-wishlist">
      <i class="fa fa-heart"></i>  
      <?php echo esc_html('Wishlist', 'corona'); ?> <span class="count-wish"><?php echo '(' . ($count > 0 ? zeroise($count, 1) : '0') . ')'; ?></span>
  </a>

  <?php
  $tini_wishlist = ob_get_clean();
  return $tini_wishlist;
}



add_action('wp_footer', 'ftc_login_form');
function ftc_login_form(){
    $login_url = '#';
    $register_url = '#';
    if (ftc_has_woocommerce()) { /* Active woocommerce */
        $myaccount_page_id = get_option('woocommerce_myaccount_page_id');
        if ($myaccount_page_id) {
            $login_url = get_permalink($myaccount_page_id);
            $register_url = $login_url;
        }
    } else {
        $login_url = wp_login_url();
        $register_url = wp_registration_url();
    }
    ?>
    <div class="ftc-header-login ftc-header-template">
        <div class="ftc-header-login-overlay"></div>
        <div class="ftc-account">
            <div class="ftc_account_form dropdown-container">
                <p class="login-tx1"><?php echo esc_html__('Already have an account?', 'corona'); ?></p>
                <h2 class="login-tx2"><?php echo esc_html__('Login', 'corona'); ?></h2>
                <form name="ftc-login-form" class="ftc-login-form" action="<?php echo esc_url(wp_login_url()); ?>" method="post">

                    <p class="login-username">
                        <input type="text" name="log" class="input" value="" size="20" autocomplete="off" placeholder="User Name *">
                    </p>
                    <p class="login-password">
                        <input type="password" name="pwd" class="input" value="" size="20" placeholder="Password *">
                    </p>
                    <label class="checkbox-login woocommerce-form__label woocommerce-form__label-for-checkbox woocommerce-form-login__rememberme">
                        <input class="woocommerce-form__input woocommerce-form__input-checkbox" name="rememberme" type="checkbox" id="rememberme" value="forever"> <span><?php echo esc_html__('Remember me', 'corona'); ?></span>
                    </label>
                    <p class="login-submit">
                        <input type="submit" name="wp-submit" class="button-secondary button" value="<?php echo esc_attr('Login', 'corona'); ?>">
                        <input type="hidden" name="redirect_to" value="<?php echo esc_url(home_url()) ?>">
                    </p>

                </form>

                <p class="ftc_forgot_pass"><a href="<?php echo esc_url(wp_lostpassword_url()); ?>" title="<?php echo esc_attr('Forgot Your Password?', 'corona'); ?>"><?php echo esc_html__('Forgot Your Password?', 'corona'); ?></a></p>
                <p class="call-signup"><a href="<?php echo esc_url($register_url); ?>" title="<?php echo esc_attr('Create New Account', 'corona'); ?>"><span><?php echo esc_html__('Sign up', 'corona'); ?></span></a></p>
            </div>
        </div>
    </div>
    
    
    <?php

}


/*Ajax add to cart single product*/

// add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
// add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');

// function woocommerce_ajax_add_to_cart() {

//     $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
//     $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
//     $variation_id = absint($_POST['variation_id']);
//     $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
//     $product_status = get_post_status($product_id);

//     if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {

//         do_action('woocommerce_ajax_added_to_cart', $product_id);

//         if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
//             wc_add_to_cart_message(array($product_id => $quantity), true);
//         }

//         WC_AJAX :: get_refreshed_fragments();
//     } else {

//         $data = array(
//             'error' => true,
//             'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

//         echo wp_send_json($data);
//     }

//     wp_die();
// }

// add_action( 'wp_footer', 'ftc_nofication_added_to_cart');

// function ftc_nofication_added_to_cart(){
//     echo '<span class="ftc-single-added">'.esc_html__('Added to cart','corona').'</span>';
// }

/* Off-canvas */
function ftc_boxed_sidebar_filter(){
    global $smof_data;
    if($smof_data['ftc_prod_cat_layout'] == '0-1-0' && isset($smof_data['ftc_prod_box_sidebar_filter']) && $smof_data['ftc_prod_box_sidebar_filter']) {
        echo '<div class="ftc-filter-boxed">';
        if( is_active_sidebar($smof_data['ftc_prod_cat_left_sidebar']) ){
            dynamic_sidebar( $smof_data['ftc_prod_cat_left_sidebar'] ); 
        }
        echo '</div>';
    }
}



/* woo_remove_product_tabs */
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 100, 1 );

function woo_remove_product_tabs( $tabs ) {

    unset( $tabs['seller'] );
    unset( $tabs['wcfm_product_multivendor_tab'] );
    unset( $tabs['more_seller_product'] );
    unset( $tabs['wcfm_policies_tab'] );
    unset( $tabs['wcfm_enquiry_tab'] );
    
    return $tabs;

}




/*Cart footer*/
add_filter('woocommerce_add_to_cart_fragments', 'ftc_cart_filter');
function ftc_cart_filter($fragments) {
    ob_start();
    ftc_cart_subtotal();
    $subtotal = ob_get_clean();
    $fragments['span.footer-cart-number'] = $subtotal;

    return $fragments;
}

if( ! function_exists( 'ftc_cart_subtotal' ) ) {
    function ftc_cart_subtotal() {
        ?>
        <span class="footer-cart-number"> <?php echo "(". WC()->cart->get_cart_contents_count().  ")"?></span>
        <?php
    }
}

function ftc_update_tini_wishlist(){
    check_ajax_referer( 'platform_security', 'security' );
    wp_die(ftc_tini_wishlist());
}

add_action('wp_ajax_update_tini_wishlist', 'ftc_update_tini_wishlist');
add_action('wp_ajax_nopriv_update_tini_wishlist', 'ftc_update_tini_wishlist');

if (!function_exists('ftc_woocommerce_multilingual_currency_switcher')) {
    function ftc_woocommerce_multilingual_currency_switcher()
    {
        if (class_exists('woocommerce_wpml') && class_exists('WooCommerce') && class_exists('SitePress')) {
            global $sitepress, $woocommerce_wpml;

            if (!isset($woocommerce_wpml->multi_currency)) {
                return;
            }

            $settings = $woocommerce_wpml->get_settings();

            $format = isset($settings['wcml_curr_template']) && $settings['wcml_curr_template'] != '' ? $settings['wcml_curr_template'] : '%code%';
            $wc_currencies = get_woocommerce_currencies();
            if (!isset($settings['currencies_order'])) {
                $currencies = $woocommerce_wpml->multi_currency->get_currency_codes();
            } else {
                $currencies = $settings['currencies_order'];
            }

            $selected_html = '';
            foreach ($currencies as $currency) {
                if ($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1) {
                    $currency_format = preg_replace(array('#%name%#', '#%symbol%#', '#%code%#'),
                        array($wc_currencies[$currency], get_woocommerce_currency_symbol($currency), $currency), $format);

                    if ($currency == $woocommerce_wpml->multi_currency->get_client_currency()) {
                        $selected_html = '<a href="javascript: void(0)" class="wcml_selected_currency">' . $currency_format . '</a>';
                        break;
                    }
                }
            }

            echo '<div class="wcml_currency_switcher">';
            print_r($selected_html);
            echo '<ul>';

            foreach ($currencies as $currency) {
                if ($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1) {
                    $currency_format = preg_replace(array('#%name%#', '#%symbol%#', '#%code%#'),
                        array($wc_currencies[$currency], get_woocommerce_currency_symbol($currency), $currency), $format);
                    echo '<li rel="' . $currency . '" >' . $currency_format . '</li>';
                }
            }

            echo '</ul>';
            echo '</div>';
        } else if (class_exists('WOOCS') && class_exists('WooCommerce')) { /* Support WooCommerce Currency Switcher */
            global $WOOCS;
            $currencies = $WOOCS->get_currencies();
            if (!is_array($currencies)) {
                return;
            }
            ?>
            <div class="wcml_currency_switcher">
                <a href="javascript: void(0)"
                class="wcml_selected_currency"><?php echo esc_html($WOOCS->current_currency); ?></a>
                <ul>
                    <?php
                    foreach ($currencies as $key => $currency) {
                        $link = add_query_arg('currency', $currency['name']);
                        echo '<li rel="' . $currency['name'] . '"><a href="' . esc_url($link) . '">' . esc_html($currency['name']) . '</a></li>';
                    }
                    ?>
                </ul>
            </div>
            <?php
        } else {/* Demo html */
            ?>
            <div class="wcml_currency_switcher">
                <a href="javascript: void(0)" class="wcml_selected_currency"><?php echo esc_html('USD', 'corona'); ?></a>
                <ul>
                    <li rel="USD"><?php echo esc_html('Dollar (USD)', 'corona'); ?></li>
                    <li rel="EUR"><?php echo esc_html('Euro (EUR)', 'corona'); ?></li>
                </ul>
            </div>
            <?php
        }
    }
}

if (!function_exists('ftc_wpml_language_selector')) {
    function ftc_wpml_language_selector()
    {
        if (class_exists('SitePress')) {
            global $sitepress;
            if (method_exists($sitepress, 'get_mobile_language_selector')) {
                print_r($sitepress->get_mobile_language_selector());
            }
        } else { /* Demo html */
            ?>
            <div class="ftc_language">
                <ul>
                    <li>
                        <a href="#" class="lang_sel_sel icl-en"><?php echo esc_html('English', 'corona'); ?></a>
                        <ul style="visibility: hidden;">
                            <li class="icl-fr"><a rel="alternate" href="#"><span
                                class="icl_lang_sel_native"><?php echo esc_html('Francais', 'corona'); ?></span></a></li>
                                <li class="icl-de"><a rel="alternate" href="#"><span
                                    class="icl_lang_sel_native"><?php echo esc_html('Espanol', 'corona'); ?></span></a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <?php
                }
            }
        }
        ?>