
<?php
// Active Purchase Code
// Author: NamNT66
function check_theme_license_activate(){
    $theme_details		= wp_get_theme();
    $activate_page_link	= admin_url( 'admin.php?page=corona-theme' );

    ?>
    <div class="notice notice-error is-dismissible">
        <p>
            <?php 
                echo sprintf( esc_html__( ' %1$s Theme is not activated! Please activate your theme and enjoy all features of the %2$s theme', 'corona'), 'Corona','Corona' );
                ?>
        </p>
        <p>
            <strong style="color:red"><?php esc_html_e( 'Please activate the theme!', 'corona' ); ?></strong> -
            <a href="<?php echo esc_url(( $activate_page_link )); ?>">
                <?php esc_html_e( 'Activate Now','pressmart' ); ?> 
            </a> 
        </p>
    </div>
<?php
}
add_action( 'admin_notices', 'check_theme_license_activate', 90);

function theme_page_menu() {
    $menu_title = 'Corona';
    $menu_icon = 'http://localhost/wordpress/wp-content/themes/pressmart/inc/admin/assets/images/menu-icon.png';
    
    add_menu_page( $menu_title,
        $menu_title,
        'manage_options',
        'corona-theme',
        'corona_dashboard_page',$menu_icon,
        59
    );
    add_submenu_page( 'corona-theme',
        esc_html__( 'Welcome', 'corona' ),
        esc_html__( 'Welcome', 'corona' ),
        'manage_options',
        'corona-theme',
        'corona_dashboard_page'
    );		
}
add_action( 'admin_menu', 'theme_page_menu');
function corona_dashboard_page(){
    require(get_template_directory() . '/inc/theme/welcome.php');
}

/**
 * check exist purchase code in db
 */
function get_item_id_theme_active($code)
{
	$host = 'https://dev.themeftc.com/active';
	$url = $host.'/wp-json/wp/v2/posts/?search='.$code;
	$response = wp_remote_get($url);
 
	if (is_wp_error($response)) {
		$error_message = $response->get_error_message();
		return "Something went wrong: $error_message";
	} else {
		$reponse_success = wp_remote_retrieve_body($response);
		$results = json_decode($reponse_success);
		return count($results);
	}
}


/**
 * get old current domain actived
 */
function get_current_domain_activate($code){
  $host = 'https://dev.themeftc.com/active';
	$url = $host.'/wp-json/wp/v2/posts/?search='.$code;
	$response = wp_remote_get($url);
 
	if (is_wp_error($response)) {
		$error_message = $response->get_error_message();
		return "Something went wrong: $error_message";
	} else {
		$response = wp_remote_get($url);
    $body = json_decode($response['body']);
    foreach($body as $post) {
      return wp_strip_all_tags($post->content->rendered);
    }
	}
}

function get_path_plugin_saved($code){
  $host = 'https://dev.themeftc.com/active';
	$url = $host.'/wp-json/wp/v2/posts/?search='.$code;
	$response = wp_remote_get($url);
 
	if (is_wp_error($response)) {
		$error_message = $response->get_error_message();
		return "Something went wrong: $error_message";
	} else {
		$response = wp_remote_get($url);
    $body = json_decode($response['body']);
    foreach($body as $post) {
      return wp_strip_all_tags($post->path_plugin);
    }
	}
}

/**
 * save info activate in db
 */
function save_item_id_theme_active($code, $buyer, $item_id, $name, $path_plugin)
{
$login = 'admin';
// password aplication site save
$password = 'EMOC OEoA mus7 4WsD hZtz 0BWA';
$host = 'https://dev.themeftc.com/active';
$api = $host.'/wp-json/wp/v2/posts';
$site_url_active = get_site_url();
$request = wp_remote_post( $api,
		array(
			'headers' => array(
				'Authorization' => 'Basic ' . base64_encode( "$login:$password" )
			),
			'body' => array(
				'title' => $code,
				'excerpt' => $item_id,
				'name' => $buyer,
				'content' => $site_url_active,
				'categories' => 3,
				'status' => 'publish',
        'mime_type' => $name,
        'path_plugin' => $path_plugin
				
			)
		)
);
}

/**
 * check exist buyer sync purchase code after same purchase_code
 */
function check_exist_buyer_and_purchase_code($purchase_code){
	$current_site = get_site_url();
  $old_current_site_active = get_current_domain_activate($purchase_code);
  if(trim($current_site) != trim($old_current_site_active)){
    return false;
  }
  return true;
}

/**
 * get item_id if correct purchase code
 */
function get_item_id_of_purchase_code($purchase_code){
  $host = 'https://dev.themeftc.com/active';
	$url = $host.'/wp-json/wp/v2/posts/?search='.$purchase_code;
	$response = wp_remote_get($url);
 
	if (is_wp_error($response)) {
		$error_message = $response->get_error_message();
		return "Something went wrong: $error_message";
	} else {
		$response = wp_remote_get($url);
    $body = json_decode($response['body']);
    foreach($body as $post) {
      return wp_strip_all_tags($post->excerpt->rendered);
    }
	}
}

/**
 * call api return data purchase
 */
function call_api_check_purchase_code($purchase_code){
  $url = 'http://localhost/verify-envato-purchase-code-main/verification_details.php?purchase_code='.$purchase_code;
	$response = wp_remote_get($url);
	$body = json_decode($response['body']);
	return $data = array(
     'item_id' => $body->item_id,
     'buyer' => $body->buyer,
     'license' => $body->license,
     'path_plugin' => $body->path_plugin,
     'name' => $body->name,
     'theme' => $body->theme,
     'message' => $body->message
  );
}
add_action( 'rest_api_init', function() {
  if(strpos($_SERVER['REQUEST_URI'], '/wp-json/theme_active/') !== false){
    $host = 'https://dev.themeftc.com/active';
    $api = $host.'/wp-json/wp/v2/posts';
    $login = 'admin';
    $password = 'EMOC OEoA mus7 4WsD hZtz 0BWA';
    register_rest_route( 'theme_active/v1', 'get_service', array(
    'methods' => 'POST',
    'callback' => function(){
        $body = json_encode([
        'purchase_code' => isset($_POST['purchase_code']) ? $_POST['purchase_code'] : '',
        ]);
        $response = wp_remote_post( $api, [
          'headers' => array(
              'Authorization' => 'Basic ' . base64_encode( "$login:$password" )
            ),
          'body' => $body
        ]);
        $data = [];
        if(!is_wp_error($response) && $response['response']['code'] === 200){
        $data = [json_decode( $response['body'] ?? "", TRUE )];
        }
        return [
        'data' => $data,
        'status_code' => $response['response']['code']
        ];
      }
    ));
  }
});

?>