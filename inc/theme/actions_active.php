<?php
/**
 * action control activate theme
 */

add_action( 'wp_ajax_active_theme_ftc', 'active_theme_ftc' );
add_action( 'wp_ajax_nopriv_active_theme_ftc', 'active_theme_ftc' );
function active_theme_ftc(){
    if( defined( 'DOING_AJAX' ) && DOING_AJAX ){
		$purchase_code = isset($_POST['purchase_code']) ? ($_POST['purchase_code']): '';
        $number_exist = get_item_id_theme_active($purchase_code);
        $current_theme = wp_get_theme()->get('TextDomain');
        if($number_exist == 0){
            $data_call_api = call_api_check_purchase_code($purchase_code);
            $item_id = $data_call_api['item_id'];
            $buyer = $data_call_api['buyer'];;
            $license = $data_call_api['license'];
            $path_plugin = $data_call_api['path_plugin'];
            $name = $data_call_api['name'];
            $theme = $data_call_api['theme'];
            check_item_id_theme($data_call_api, $purchase_code, $theme, $buyer, $item_id, $name, $path_plugin);
        }
        else{
            $is_exist = check_exist_buyer_and_purchase_code($purchase_code);
            // domain current === old domain active
            $path_plugin = get_path_plugin_saved($purchase_code);
            $current_theme = wp_get_theme()->get('TextDomain');
            if($is_exist){
                ftc_update_value_action_active($path_plugin, $purchase_code);
                echo 'success'; 
            }
            else{
                echo 'failed';
            }
        }
	}
	if( defined( 'DOING_AJAX' ) && DOING_AJAX ){
		die(ob_get_clean());
	}
}

function check_item_id_theme($data_call_api, $purchase_code, $theme, $buyer, $item_id, $name, $path_plugin){
    $item_id = $data_call_api['item_id'];
    $current_theme = wp_get_theme()->get('TextDomain');
    if(!$item_id || trim($theme) != trim($current_theme)){
        echo 'failed' . trim($theme) . trim($current_theme);
    }
    else{
        save_item_id_theme_active($purchase_code, $buyer, $item_id, $name, $path_plugin);
        //action ..... active success
        ftc_update_value_action_active($path_plugin, $purchase_code);
        echo 'success';
    }
}

function ftc_update_value_action_active($path_plugin, $purchase_code){
    update_option('ftc_active_theme', true);
    update_option('ftc_purchase_code', $purchase_code);
    update_option('ftc_path_install_plugin', $path_plugin);
}

/**
 * add column path plugin save
 */
require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
$row = $wpdb->get_results(  "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS 
WHERE table_name = 'wp_posts' AND column_name = 'path_plugin'"  );  
  
if(empty($row)){  
   $wpdb->query("ALTER TABLE wp_posts ADD path_plugin VARCHAR(255) NOT NULL DEFAULT ''");  
} 
?>