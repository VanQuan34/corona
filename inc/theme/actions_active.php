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
        if (!preg_match("/^([a-f0-9]{8})-(([a-f0-9]{4})-){3}([a-f0-9]{12})$/i", $purchase_code)) {
           echo 'failed';
        }
        else if($number_exist == 0){
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
        echo 'failed';
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

add_action('tgmpa_register', 'ftc_register_required_plugins_active');
function ftc_register_required_plugins_active(){
    $is_active_theme =  get_option('ftc_active_theme');
    $plugin_dir_path = get_option('ftc_path_install_plugin');
    $ver = wp_get_theme(); 
    $version = $ver->get('Version');
    if(!$is_active_theme){
        return;
    }

    $plugins = array(
        array(
            'name' => 'ThemeFTC', // The plugin name.
            'slug' => 'themeftc', // The plugin slug (typically the folder name).
            'source' => $plugin_dir_path . 'themeftc.zip', // The plugin source.
            'required' => true, // If false, the plugin is only 'recommended' instead of required.
            'version' => '1.1.2', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => '', // If set, overrides default API URL and points to an external URL.
        )
        ,array(
            'name' => 'ThemeFTC Elementor', // The plugin name.
            'slug' => 'themeftc-for-elementor', // The plugin slug (typically the folder name).
            'source' => $plugin_dir_path . 'themeftc-for-elementor.zip', // The plugin source.
            'required' => true, // If false, the plugin is only 'recommended' instead of required.
            'version' => '1.0.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => '', // If set, overrides default API URL and points to an external URL.
        )
        ,array(
            'name' => 'ThemeFTC GET', // The plugin name.
            'slug' => 'themeftc-get', // The plugin slug (typically the folder name).
            'source' => $plugin_dir_path . 'themeftc-get.zip', // The plugin source.
            'required' => true, // If false, the plugin is only 'recommended' instead of required.
            'version' => '1.0.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => '', // If set, overrides default API URL and points to an external URL.
        )
        ,array(
            'name' => 'FTC Importer', // The plugin name.
            'slug'  => 'ftc_importer', // The plugin slug (typically the folder name).
            'source'  => $plugin_dir_path.'/content/ftc-importer-corona-'.$version .'.zip', 
            'required'  => true, // If false, the plugin is only 'recommended' instead of required.
            'version'  => '1.2.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation'  => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url'       => '', // If set, overrides default API URL and points to an external URL.
        )
        , array(
            'name' => 'Revolution Slider', // The plugin name.
            'slug' => 'revslider', // The plugin slug (typically the folder name).
            'source' => 'http://demo.themeftc.com/plugins/revslider.zip', // The plugin source.
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
            'version' => '6.4.11', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => '', // If set, overrides default API URL and points to an external URL.
        )
        , array(
            'name' => 'WPBakery Visual Composer', // The plugin name.
            'slug' => 'js_composer', // The plugin slug (typically the folder name).
            'source' => 'http://demo.themeftc.com/plugins/js_composer.zip', // The plugin source.
            'required' => true, // If false, the plugin is only 'recommended' instead of required.
            'version' => '6.6.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => '', // If set, overrides default API URL and points to an external URL.
        )
        , array(
            'name' => 'Mega Main Menu', // The plugin name.
            'slug' => 'mega_main_menu', // The plugin slug (typically the folder name).
            'source' => 'http://demo.themeftc.com/plugins/mega_main_menu.zip', // The plugin source.
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
            'version' => '2.2.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher.
            'force_activation' => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
            'force_deactivation' => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
            'external_url' => '', // If set, overrides default API URL and points to an external URL.
        )
    );
    $config = array(
        'id' => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins', // Menu slug.
        'parent_slug' => 'themes.php',            // Parent menu slug.
        'capability' => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices' => true,                    // Show admin notices or not.
        'dismissable' => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message' => '',                      // Message to output right before the plugins table.
    );

    tgmpa($plugins, $config);
}

?>