
<?php
/**
 * build content free shipping
 */
function ftc_content_free_shipping()
{
  global $smof_data;
  $text_left = 'to cart and get free shipping!';
  $text_success = 'Congrats! You are eligible for more to enjoy FREE Shipping';
  if(isset($smof_data['ftc_amount_left_text']) && trim($smof_data['ftc_amount_left_text']) != '' ){
    $text_left = $smof_data['ftc_amount_left_text'];
  }
  if(isset($smof_data['ftc_amount_left_success']) && trim($smof_data['ftc_amount_left_success']) != '' ){
    $text_left = $smof_data['ftc_amount_left_text'];
  }
  $min_price = ftc_check_exist_method_free_shipping();
  if (!$min_price) {
    return;
  }
  $percent = get_percent_total_and_shipping();
  $class_success = '';
  if ($percent >= 100) {
    $class_success = 'free-shipping-success shakeY';
  }

  echo '<div class="ftc-cart-goal-wrapper ' . $class_success . '">';
  if ($percent < 100) {
    echo '<div class="ftc-cart-goal-text">' . esc_html__('Buy', 'karo') . ' 
  		' . get_min_price_free_shipping() . '
  		<strong>' . __($text_left, 'karo') . '</strong>
  		<input type="hidden" name="ftc-cart-goal-percent" value="0" class="ftc-cart-goal-percent">
  		</div>';
  } else {
    echo '<div class="ftc-cart-goal-text">' . __($text_success, 'karo') . '
  		<input type="hidden" name="ftc-cart-goal-percent" value="100" class="ftc-cart-goal-percent">
  		</div>';
  }
  echo '<div class="ftc-free-shipping-progress">
  			<div class="ftc-progress-bar-wrap">
  				<div class="ftc-progress-bar" style="width:' . $percent . '%;">
  					<div class="ftc-progress-value">
  						<svg class="svgDeliveryReturn ftc-svg-icon" width="40.124px" height="40.124px" enable-background="new 0 0 512 512" version="1.1" viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><path d="m386.69 304.4c-35.587 0-64.538 28.951-64.538 64.538s28.951 64.538 64.538 64.538c35.593 0 64.538-28.951 64.538-64.538s-28.951-64.538-64.538-64.538zm0 96.807c-17.796 0-32.269-14.473-32.269-32.269s14.473-32.269 32.269-32.269 32.269 14.473 32.269 32.269c0 17.797-14.473 32.269-32.269 32.269z"></path><path d="m166.18 304.4c-35.587 0-64.538 28.951-64.538 64.538s28.951 64.538 64.538 64.538 64.538-28.951 64.538-64.538-28.951-64.538-64.538-64.538zm0 96.807c-17.796 0-32.269-14.473-32.269-32.269s14.473-32.269 32.269-32.269c17.791 0 32.269 14.473 32.269 32.269 0 17.797-14.473 32.269-32.269 32.269z"></path><path d="m430.15 119.68c-2.743-5.448-8.32-8.885-14.419-8.885h-84.975v32.269h75.025l43.934 87.384 28.838-14.5-48.403-96.268z"></path><rect x="216.2" y="353.34" width="122.08" height="32.269"></rect><path d="m117.78 353.34h-55.932c-8.912 0-16.134 7.223-16.134 16.134 0 8.912 7.223 16.134 16.134 16.134h55.933c8.912 0 16.134-7.223 16.134-16.134 0-8.912-7.223-16.134-16.135-16.134z"></path><path d="m508.61 254.71-31.736-40.874c-3.049-3.937-7.755-6.239-12.741-6.239h-117.24v-112.94c0-8.912-7.223-16.134-16.134-16.134h-268.91c-8.912 0-16.134 7.223-16.134 16.134s7.223 16.134 16.134 16.134h252.77v112.94c0 8.912 7.223 16.134 16.134 16.134h125.48l23.497 30.268v83.211h-44.639c-8.912 0-16.134 7.223-16.134 16.134 0 8.912 7.223 16.134 16.134 16.134h60.773c8.912 0 16.134-7.223 16.135-16.134v-104.87c0-3.582-1.194-7.067-3.388-9.896z"></path><path d="m116.71 271.6h-74.219c-8.912 0-16.134 7.223-16.134 16.134 0 8.912 7.223 16.134 16.134 16.134h74.218c8.912 0 16.134-7.223 16.134-16.134 1e-3 -8.911-7.222-16.134-16.133-16.134z"></path><path d="m153.82 208.13h-137.68c-8.911 0-16.134 7.223-16.134 16.135s7.223 16.134 16.134 16.134h137.68c8.912 0 16.134-7.223 16.134-16.134s-7.222-16.135-16.134-16.135z"></path><path d="m180.17 144.67h-137.68c-8.912 0-16.134 7.223-16.134 16.134 0 8.912 7.223 16.134 16.134 16.134h137.68c8.912 0 16.134-7.223 16.134-16.134 1e-3 -8.911-7.222-16.134-16.134-16.134z"></path></svg>		                </div>
  				</div>
  			</div>
  	     </div>';
  echo '</div>';
}

/**
 * get min-price for shipping from Woo
 */
function get_min_price_free_shipping()
{
  $min_price = ftc_check_exist_method_free_shipping();

  $cart = WC()->cart->subtotal;
  $remaining = $min_price - $cart;

  if ($min_price > $cart) {
    return wc_price($remaining);
  }
  return '';
}

/**
 * get percent total cart/ min_price
 */
function get_percent_total_and_shipping()
{
  $min_price = ftc_check_exist_method_free_shipping();
  if (!$min_price) {
    return;
  }
  $cart = WC()->cart->subtotal;
  $percent = ($cart /  $min_price) * 100;
  if ($percent > 100) {
    $percent == 100;
  }
  return $percent;
}

/**
 * display in site
 */
add_action('woocommerce_mini_cart_contents', 'ftc_display_content_shipping');
add_action('woocommerce_before_cart_table', 'ftc_display_content_shipping');
add_action('woocommerce_before_checkout_form', 'ftc_display_content_shipping');
if (!function_exists('ftc_display_content_shipping')) {
  function ftc_display_content_shipping()
  {
    ftc_content_free_shipping();
  }
}

// add_filter('woocommerce_add_to_cart_fragments', 'ftc_tiny_cart_free_shipping');

function ftc_tiny_cart_free_shipping($fragments) {
    $fragments['.ftc-cart-goal-wrapper'] = ftc_content_free_shipping();
    return $fragments;
}

function ftc_check_exist_method_free_shipping()
{
  $zone_ids = array_keys(array('') + WC_Shipping_Zones::get_zones());
  // Loop through shipping Zones IDs
  foreach ($zone_ids as $zone_id) {
    // Get the shipping Zone object
    $shipping_zone = new WC_Shipping_Zone($zone_id);
    // Get all shipping method values for the shipping zone
    $shipping_methods = $shipping_zone->get_shipping_methods(true, 'values');

    // Loop through each shipping methods set for the current shipping zone
    foreach ($shipping_methods as $instance_id => $shipping_method) {
      // The dump of protected data from the current shipping method
      $method =  $shipping_method->id;
      if ($method != 'free_shipping') {
        return false;
      }
      $amount =  $shipping_method->min_amount;
      if (!$amount || $amount == 0) {
        return false;
      }
      return $amount;
    }
  }
}
?>
