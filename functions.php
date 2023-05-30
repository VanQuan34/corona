<?php
/**
 * corona functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage corona
 * @since 1.0
 */

/**
 * corona only works in WordPress 4.7 or later.
 */
if( ! function_exists( 'ftc_get_header_template' ) ) {
    function ftc_get_header_template( $new = false ) {
        global $header_blocks;
        $args = array(
            'post_type' => 'ftc_header'
            ,'post_status' => 'publish'
            ,'posts_per_page' => -1
        );

        $posts = new WP_Query($args);

        if( !empty( $posts->posts ) && is_array( $posts->posts ) ){
            foreach( $posts->posts as $p ){
                $header_blocks[$p->ID] = $p->post_title;
            }
        }
        return $header_blocks;

    }
}
if (version_compare($GLOBALS['wp_version'], '4.7-alpha', '<')) {
    require get_template_directory() . '/inc/back-compat.php';
    return;
}

/*** Include TGM Plugin Activation ***/
require_once get_template_directory() . '/inc/includes/class-tgm-plugin-activation.php';

/* * * Theme Options ** */
require_once get_template_directory() . '/inc/register_sidebar.php';
require_once get_template_directory() . '/admin/base_options.php';
require_once get_template_directory() . '/admin/theme_options.php';

/**activate theme */
require_once get_template_directory() . '/inc/theme/activate.php';
require_once get_template_directory() . '/inc/theme/actions_active.php';

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
/* * * Logo Mobile** */
if (!function_exists('ftc_theme_mobile_logo')) {

    function ftc_theme_mobile_logo() {
        global $smof_data;
        $logo_image = isset($smof_data['ftc_logo_mobile']['url']) ? esc_url($smof_data['ftc_logo_mobile']['url']) : '';
        $logo_text = isset($smof_data['ftc_text_logo']) ? stripslashes(esc_attr($smof_data['ftc_text_logo'])) : '';
        ?>
        <div class="logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <!-- Main logo mobile -->
                <?php if (strlen($logo_image) > 0): ?>
                    <img src="<?php echo esc_url($logo_image); ?>" alt="<?php echo!empty($logo_text) ? esc_attr($logo_text) : get_bloginfo('name'); ?>" title="<?php echo!empty($logo_text) ? esc_attr($logo_text) : get_bloginfo('name'); ?>" class="normal-logo-mobile" />
                <?php endif; ?>

                <!-- Logo Text -->
                <?php
                if (strlen($logo_image) == 0) {
                    echo esc_html($logo_text);
                }
                ?>
            </a>
        </div>
        <?php
    }

}

/* Wishlist */
if( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_ajax_update_count' ) ){
    function yith_wcwl_ajax_update_count(){
        wp_send_json( array(
            'count' => yith_wcwl_count_all_products()
        ) );
    }
    add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
    add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
}

if(class_exists('YITH_WCWL')){
    add_filter('body_class', function($classes){
        return array_merge( $classes, array( 'yith-wishlist' ) );
    });
}


/* * * back ground top ** */

function rocket_lazyload_exclude_class( $attributes ) {
    $attributes[] = 'class="thumbnail-blog"';
    $attributes[] = 'class="attachment-yith-woocompare-image size-yith-woocompare-image"';

    return $attributes;
}
add_filter( 'rocket_lazyload_excluded_attributes', 'rocket_lazyload_exclude_class' );

function is_elementor(){
    global $post;
    if(class_exists('Elementor\Plugin')){
        return \Elementor\Plugin::$instance->documents->get($post->ID)->is_built_with_elementor();
    }
}
/* Ajax nonce*/
add_action('wp_enqueue_scripts', 'ftc_ajax_platform_script_enqueue');
function ftc_ajax_platform_script_enqueue () {
    wp_enqueue_script(
        'platform',
        get_template_directory_uri(). '/assets/js/platform.js',
        array('jquery'), '1.0', true);

    wp_localize_script('platform', 'ftc_platform', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'ajax_nonce' => wp_create_nonce('platform_security')
    ));
}
// Disable widget live editor

add_filter( 'gutenberg_use_widgets_block_editor', 'ftc_class_editor_widget' );
add_filter( 'use_widgets_block_editor', 'ftc_class_editor_widget' );
function ftc_class_editor_widget(){
    global $smof_data;
    if(isset($smof_data['ftc_widget_classic_editor']) && $smof_data['ftc_widget_classic_editor'] == 1 ) {
        return false;
    }
    else{
      return true;
    }
}


/*Ajax add to cart single product*/

add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');

function woocommerce_ajax_add_to_cart() {

    $product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
    $quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
    $variation_id = absint($_POST['variation_id']);
    $passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
    $product_status = get_post_status($product_id);

    if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {

        do_action('woocommerce_ajax_added_to_cart', $product_id);

        if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
            wc_add_to_cart_message(array($product_id => $quantity), true);
        }

        WC_AJAX :: get_refreshed_fragments();
    } else {

        $data = array(
            'error' => true,
            'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

        echo wp_send_json($data);
    }

    wp_die();
}

add_action( 'wp_footer', 'ftc_nofication_added_to_cart');

function ftc_nofication_added_to_cart(){
    echo '<span class="ftc-single-added">'.esc_html__('Added to cart','corona').'</span>';
}

/*Setting role in WPbakery*/
add_action( 'vc_before_init', 'Use_wpBakery' );
function Use_wpBakery() {
    $vc_list = array('page','ftc_footer');
    vc_set_default_editor_post_types($vc_list);
}
/* Header Mobile Navigation */
if( ! function_exists( 'ftc_header_mobile_navigation' ) ) {
    function ftc_header_mobile_navigation() {
        global $smof_data;
        ?>
        <?php if( !is_page_template('page-blank.php') ): ?>
            <div class="ftc-mobile-wrapper">

                <?php if( isset($smof_data['ftc_enable_search']) && $smof_data['ftc_enable_search'] ): ?>
                    <?php ftc_get_search_form_by_category(); ?>
                <?php endif; ?>
                <?php if( isset($smof_data['ftc_enable_search']) && $smof_data['ftc_enable_search'] ): ?>
                    <?php ftc_get_search_form_not_category(); ?>
                <?php endif; ?>
                <div class= "menu-text"> 
                    <button type="button" class="btn btn-toggle-canvas btn-danger" data-toggle="offcanvas">
                        <i class="fa fa-close"></i>
                    </button>
                    <i class="fa fa-bars"></i>
                    <?php echo esc_html('Menu', 'corona') ?>
                </div>

                <div class="mobile-menu-wrapper">
                 <?php 
                 wp_nav_menu( array( 'theme_location' => 'mobile', 'menu' => 'mobile', 'menu_id' => 'main-menu', 'menu_class' => 'ftc-smartmenu ftc-simple') ); 
                 ?>
             </div>
             <div class="mobile-wishlist">
                <?php if( class_exists('YITH_WCWL')): ?>
                    <div class="ftc-my-wishlist"><?php print_r(ftc_tini_wishlist()); ?></div>
                <?php endif; ?>
            </div>
            <div class="mobile-account">
             <?php 
             $_user_logged = is_user_logged_in();
             ob_start();
             ?>
             <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php echo esc_html('Login','corona'); ?>">
                <i class="fa fa-user"></i>

                <?php echo esc_html('Login','corona'); ?>

            </a>
        </div>
        <div class="header-mobile-social">
            <ul>
                <li class="hd-facebook">
                    <a href="https://www.facebook.com/sharer.php?u=<?php echo esc_url(get_permalink()); ?>">
                        <i class="fa fa-facebook"></i>.
                    </a>
                </li>
                <li class="hd-twitter">
                    <a href="https://twitter.com/share?url=<?php echo esc_url(get_permalink()); ?>">
                        <i class="fa fa-twitter"></i>.
                    </a>
                </li>
                <li class="hd-youtube">
                    <a href="https://www.youtube.com/share?url=<?php echo esc_url(get_permalink()); ?>">
                        <i class="fa fa-youtube"></i>.
                    </a>
                </li>
                <li class="hd-instagram">
                    <a href="https://plus.google.com/share?url=<?php echo esc_url(get_permalink()); ?>">
                        <i class="fa fa-instagram"></i>.
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <?php
endif;
}
}

/* Update Widget Price */

function update_woocommerce_version() {
    if(class_exists('WooCommerce')) {
        global $woocommerce;

        if(version_compare(get_option('woocommerce_db_version', null), $woocommerce->version, '!=')) {
            update_option('woocommerce_db_version', $woocommerce->version);

            if(! wc_update_product_lookup_tables_is_running()) {
                wc_update_product_lookup_tables();
            }
        }   
    }   
}
add_action('init', 'update_woocommerce_version');

/* Popup Newsletter */
if ( ! function_exists( 'corona_popup_newsletter' ) ) {
    function corona_popup_newsletter() {
       global $smof_data; 
       if(isset($smof_data['ftc_bg_popup_image']['url']) && !empty($smof_data['ftc_bg_popup_image']['url']))
        echo '<div class="popupshadow" style="display:none"></div>';
    echo '<div class="newsletterpopup" style="display:none; background-image: url('. esc_url($smof_data['ftc_bg_popup_image']['url']) .')">';
    echo '<span class="close-popup"></span>
    <div class="wp-newletter">';
    dynamic_sidebar('popup-newletter');
    echo '</div>';
    echo '<span class="dont_show_popup"><input id="ftc_dont_show_again" type="checkbox"><label for="ftc_dont_show_again">' .esc_attr__('Don\'t show popup again', 'corona'). '</label></span>';
    echo '</div>';
}
}
/*** Is Active WooCommmerce ***/
if (!function_exists('ftc_has_woocommerce')) {
    function ftc_has_woocommerce()
    {
        $_actived = apply_filters('active_plugins', get_option('active_plugins'));
        if (in_array("woocommerce/woocommerce.php", $_actived) || class_exists('WooCommerce')) {
            return true;
        }
        return false;
    }
}

if(isset($smof_data['ftc_prod_advanced_zoom']) && $smof_data['ftc_prod_advanced_zoom'] == 'type_2'){
  add_filter('body_class', function($classes){
      return array_merge( $classes, array( 'ftc-single-grid' ) );
  });
}
        
/*** Include files in woo folder ***/
$file_names = array('functions', 'term', 'quickshop', 'grid_list_toggle', 'hooks', 'extend');
foreach ($file_names as $file) {
    $file_path = get_template_directory() . '/inc/woo/' . $file . '.php';
    if (file_exists($file_path)) {
        require_once $file_path;
    }
}
/* Custom Sidebar */
add_action('sidebar_admin_page', 'ftc_custom_sidebar_form');
function ftc_custom_sidebar_form()
{
    ?>
    <form action="<?php echo admin_url('widgets.php'); ?>" method="post" id="ftc-form-add-sidebar">
        <input type="text" name="sidebar_name" id="sidebar_name"
        placeholder="<?php echo esc_html('Custom Sidebar Name', 'corona') ?>"/>
        <button class="button-primary" id="ftc-add-sidebar"><?php echo esc_html('Add Sidebar', 'corona') ?></button>
    </form>
    <?php
}

function ftc_get_custom_sidebars()
{
    $option_name = 'ftc_custom_sidebars';
    $custom_sidebars = get_option($option_name);
    return is_array($custom_sidebars) ? $custom_sidebars : array();
}

add_action('wp_ajax_ftc_add_custom_sidebar', 'ftc_add_custom_sidebar');
function ftc_add_custom_sidebar(){
    check_ajax_referer( 'platform_security', 'security' );

    if (isset($_POST['sidebar_name'])) {
        $option_name = 'ftc_custom_sideftcbars';
        if (!get_option($option_name) || get_option($option_name) == '') {
            delete_option($option_name);
        }

        $sidebar_name = sanitize_text_field($_POST['sidebar_name']);

        if (get_option($option_name)) {
            $custom_sidebars = ftc_get_custom_sidebars();
            if (!in_array($sidebar_name, $custom_sidebars)) {
                $custom_sidebars[] = $sidebar_name;
            }
            $result1 = update_option($option_name, $custom_sidebars);
        } else {
            $custom_sidebars = array();
            $custom_sidebars[] = $sidebar_name;
            $result2 = add_option($option_name, $custom_sidebars);
        }

        if ($result1) {
            wp_die('Updated');
        } elseif ($result2) {
            wp_die('Added');
        } else {
            wp_die('Error');
        }
    }
    wp_die('');
}

add_action('wp_ajax_ftc_delete_custom_sidebar', 'ftc_delete_custom_sidebar');
function ftc_delete_custom_sidebar(){
    check_ajax_referer( 'platform_security', 'security' );

    if (isset($_POST['sidebar_name'])) {
        $option_name = 'ftc_custom_sidebars';
        $del_sidebar = trim($_POST['sidebar_name']);
        $custom_sidebars = ftc_get_custom_sidebars();
        foreach ($custom_sidebars as $key => $value) {
            if ($value == $del_sidebar) {
                unset($custom_sidebars[$key]);
                break;
            }
        }
        $custom_sidebars = array_values($custom_sidebars);
        update_option($option_name, $custom_sidebars);
        wp_die('Deleted');
    }
    wp_die('');
}

/*** Require Advance Options ***/
require_once get_template_directory() . '/inc/register_sidebar.php';
require_once get_template_directory() . '/inc/theme_control.php';
require_once get_template_directory() . '/inc/filter_by_color_options.php';
/**

/** Include widget files **/
$file_names = array('feedburner_subscription', 'products', 'blogs', 'blogs_tabs', 'recent_comments', 'product_categories','product_filter_bycolor');
foreach ($file_names as $file) {
    $file_path = get_template_directory() . '/inc/widgets/' . $file . '.php';
    if (file_exists($file_path)) {
        include_once $file_path;
    }
}

function ftc_setup(){
    add_theme_support( 'wc-product-gallery-lightbox' );
    /*Custom Gutenberg*/
    add_editor_style('editor-styles');
    add_editor_style( 'assets/css/style-editor.css' );
    add_theme_support( 'dark-editor-style' );
    add_theme_support( 'responsive-embeds' );
  // Add support for default block styles.
    add_theme_support( 'wp-block-styles' );
    // Add support for full and wide align images.
    add_theme_support( 'align-wide' );

    add_theme_support( 'editor-font-sizes', array(
        array(
            'name' => __( 'Small', 'corona' ),
            'size' => 12,
            'slug' => 'small'
        ),
        array(
            'name' => __( 'Normal', 'corona' ),
            'size' => 14,
            'slug' => 'normal'
        ),
        array(
            'name' => __( 'Large', 'corona' ),
            'size' => 36,
            'slug' => 'large'
        ),
        array(
            'name' => __( 'Huge', 'corona' ),
            'size' => 48,
            'slug' => 'huge'
        )
    ) );

    add_theme_support( 'editor-color-palette', array(
        array(
            'name' => __( 'strong magenta', 'corona' ),
            'slug' => 'strong-magenta',
            'color' => '#a156b4',
        ),
        array(
            'name' => __( 'light grayish magenta', 'corona' ),
            'slug' => 'light-grayish-magenta',
            'color' => '#d0a5db',
        ),
        array(
            'name' => __( 'very light gray', 'corona' ),
            'slug' => 'very-light-gray',
            'color' => '#eee',
        ),
        array(
            'name' => __( 'very dark gray', 'corona' ),
            'slug' => 'very-dark-gray',
            'color' => '#444',
        ),
    ) );

    /*
     * Make theme available for translation.
     * Translations can be filed at WordPress.org. See: https://translate.wordpress.org/projects/wp-themes/ftc
     * If you're building a theme based on corona, use a find and replace
     * to change 'corona' to the name of your theme in all the template files.
     */
    load_theme_textdomain('corona');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support('title-tag');

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    add_image_size('ftc-featured-image', 2000, 1200, true);

    add_image_size('ftc-thumbnail-avatar', 100, 100, true);

    // Set the default content width.
    $GLOBALS['content_width'] = 1200;

    /* Translation */
    load_theme_textdomain('corona', get_template_directory() . '/languages');

    $locale = get_locale();
    $locale_file = get_template_directory() . "/languages/$locale.php";
    if (is_readable($locale_file)) {
        require_once($locale_file);
    }

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus(array(
        'primary' => esc_html__('Primary Navigation', 'corona'),
        'vertical' => esc_html__('Vertical Navigation', 'corona'),
        'mobile' => esc_html__('Mobile Navigation', 'corona'),
    ));

    /*
     * Switch default core markup for search form, comment form, and comments
     * to output valid HTML5.
     */
    add_theme_support('html5', array(
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    /*
     * Enable support for Post Formats.
     *
     * See: https://codex.wordpress.org/Post_Formats
     */
    add_theme_support('post-formats', array(
        'aside',
        'image',
        'video',
        'quote',
        'link',
        'gallery',
        'audio',
    ));


     // Add theme support for Custom Background
    $defaults = array(
        'default-color' => ''
        , 'default-image' => ''
    );
    add_theme_support('custom-background', $defaults);

    // Add theme support for Custom Logo.
    add_theme_support('custom-logo', array(
        'width' => 250,
        'height' => 250,
        'flex-width' => true,
    ));

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    add_theme_support('woocommerce');

    if (!isset($content_width)) {
        $content_width = 1200;
    }

    /*
     * This theme styles the visual editor to resemble the theme style,
     * specifically font, colors, and column width.
      */
    add_editor_style(array('assets/css/editor-style.css', ftc_fonts_url()));
}

add_action('after_setup_theme', 'ftc_setup');

if(isset($smof_data['ftc_prod_advanced_zoom']) && $smof_data['ftc_prod_advanced_zoom'] != 'type_2'){
    add_action('after_setup_theme', 'ftc_setup_main_image');

    function ftc_setup_main_image(){
        add_theme_support( 'wc-product-gallery-zoom' );
        add_theme_support( 'wc-product-gallery-slider' );
    }
}
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ftc_content_width()
{

    $content_width = $GLOBALS['content_width'];

    // Get layout.
    $page_layout = get_theme_mod('page_layout');

    // Check if layout is one column.
    if ('one-column' === $page_layout) {
        if (ftc_is_frontpage()) {
            $content_width = 644;
        } elseif (is_page()) {
            $content_width = 740;
        }
    }

    // Check if is single post and there is no sidebar.
    if (is_single() && !is_active_sidebar('sidebar-1')) {
        $content_width = 740;
    }

    /**
     * Filter corona content width of the theme.
     *
     * @since corona 1.0
     *
     * @param $content_width integer
     */
    $GLOBALS['content_width'] = apply_filters('ftc_content_width', $content_width);
}

add_action('template_redirect', 'ftc_content_width', 0);

/**
 * Register custom fonts.
 */
function ftc_fonts_url()
{
    $fonts_url = '';

    /**
     * Translators: If there are characters in your language that are not
     * supported by Libre Franklin, translate this to 'off'. Do not translate
     * into your own language.
     */
    $dosis = _x('on', 'Open Sans font: on or off', 'corona');

    if ('off' !== $dosis) {
        $font_families = array();

        $font_families[] = 'Open Sans:400,600,700,700i,800';

        $query_args = array(
            'family' => urlencode(implode('|', $font_families))
        );

        $fonts_url = add_query_arg($query_args, 'https://fonts.googleapis.com/css');
    }

    return esc_url_raw($fonts_url);
}

/**
 * Add preconnect for Google Fonts.
 *
 * @since corona 1.0
 *
 * @param array $urls URLs to print for resource hints.
 * @param string $relation_type The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function ftc_resource_hints($urls, $relation_type)
{
    if (wp_style_is('ftc-fonts', 'queue') && 'preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }

    return $urls;
}

add_filter('wp_resource_hints', 'ftc_resource_hints', 10, 2);

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... and
 * a 'Continue reading' link.
 *
 * @since corona 1.0
 *
 * @return string 'Continue reading' link prepended with an ellipsis.
 */
function ftc_excerpt_more($link)
{
    if (is_admin()) {
        return $link;
    }

    $link = sprintf('<p class="link-more"><a href="%1$s" class="more-link">%2$s</a></p>',
        esc_url(get_permalink(get_the_ID())),
        /* translators: %s: Name of current post */
        sprintf(esc_html__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'corona'), get_the_title(get_the_ID()))
    );
    return ' &hellip; ' . $link;
}

add_filter('excerpt_more', 'ftc_excerpt_more');

/**
 * Handles JavaScript detection.
 *
 * Adds a `js` class to the root `<html>` element when JavaScript is detected.
 *
 * @since corona 1.0
 */
function ftc_javascript_detection()
{
    echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
}

add_action('wp_head', 'ftc_javascript_detection', 0);

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function ftc_pingback_header()
{
    if (is_singular() && pings_open()) {
        printf('<link rel="pingback" href="%s">' . "\n", get_bloginfo('pingback_url'));
    }
}

add_action('wp_head', 'ftc_pingback_header');

/**
 * Display custom color CSS.
 */
function ftc_colors_css_wrap(){
    if ('custom' !== get_theme_mod('colorscheme') && !is_customize_preview()) {
        return;
    }

    require_once(get_parent_theme_file_path('/inc/color-patterns.php'));
    $hue = absint(get_theme_mod('colorscheme_hue', 250));
    ?>
    <style type="text/css" id="custom-theme-colors" <?php if (is_customize_preview()) {
        echo 'data-hue="' . $hue . '"';
    } ?>>
    <?php print_r(ftc_custom_colors_css()) ; ?>
</style>
<?php }

add_action('wp_head', 'ftc_colors_css_wrap');

/**
 * Enqueue scripts and styles.
 */
function ftc_scripts()
{
    wp_enqueue_style('editor-styles', get_template_directory_uri() . '/assets/css/style-editor.css');
    wp_enqueue_style('pe-icon-7-stroke', get_template_directory_uri() . '/assets/css/pe-icon-7-stroke.css');
    global $smof_data, $ftc_page_datas;
    wp_enqueue_script( 'swipebox-min', get_template_directory_uri().'/assets/js/jquery.swipebox.min.js', array(), null, true);
    wp_enqueue_script( 'swipebox', get_template_directory_uri().'/assets/js/jquery.swipebox.js', array(), null, true);
    wp_deregister_style('font-awesome');
    wp_enqueue_script( 'infinite', get_template_directory_uri().'/assets/js/infinite-scroll.pkgd.min.js', array(), null, true);
    wp_deregister_style('yith-wcwl-font-awesome');
    wp_register_style('font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.css');
    wp_enqueue_style('font-awesome');
    wp_enqueue_script('cookie', get_template_directory_uri().'/assets/js/jquery.cookie.min.js', array( 'jquery' ), null, true );
    wp_register_style('owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.min.css');
    wp_enqueue_style('owl-carousel');
    wp_enqueue_script( 'quick-view', get_template_directory_uri().'/assets/js/quick_view.js', array(), null, true);

    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style('ftc-fonts', ftc_fonts_url(), array(), null);

    // Theme stylesheet.
    wp_enqueue_style('ftc-style', get_stylesheet_uri());

    // Load the dark colorscheme.
    if ('dark' === get_theme_mod('colorscheme', 'light') || is_customize_preview()) {
        wp_enqueue_style('ftc-colors-dark', get_theme_file_uri('/assets/css/colors-dark.css'), array('ftc-style'), '1.0');
    }

    // Load the Internet Explorer 9 specific stylesheet, to fix display issues in the Customizer.
    if (is_customize_preview()) {
        wp_enqueue_style('ftc-ie9', get_theme_file_uri('/assets/css/ie9.css'), array('ftc-style'), '1.0');
        wp_style_add_data('ftc-ie9', 'conditional', 'IE 9');
    }

    // Load the Internet Explorer 8 specific stylesheet.
    wp_enqueue_style('ftc-ie8', get_theme_file_uri('/assets/css/ie8.css'), array('ftc-style'), '1.0');
    wp_style_add_data('ftc-ie8', 'conditional', 'lt IE 9');

    wp_register_style('ftc-reset', get_template_directory_uri() . '/assets/css/default.css');
    wp_enqueue_style('ftc-reset');

    wp_register_style('ftc-responsive', get_template_directory_uri() . '/assets/css/responsive.css');
    wp_enqueue_style('ftc-responsive');

    wp_register_style('ftc-prettyphoto', get_template_directory_uri() . '/assets/css/prettyphoto.css');
    wp_enqueue_style('ftc-prettyphoto');

    wp_register_script('owl-carousel', get_theme_file_uri('/assets/js/owl.carousel.min.js'), array(), null, true);
    wp_enqueue_script('owl-carousel');

    // Load libraries.
    wp_enqueue_script( 'sticky', get_template_directory_uri() . '/assets/js/jquery.sticky.js' , array(), null, true );
    wp_enqueue_script( 'throttle', get_template_directory_uri() . '/assets/js/throttle.js' , array(), null, true );
    wp_enqueue_script( 'hover-intent', get_template_directory_uri() . '/assets/js/hover-intent.js' , array(), null, true );
    wp_enqueue_script( 'greensock', get_template_directory_uri() . '/assets/js/greensock.js' , array(), null, true );
    wp_enqueue_script( 'waypoints', get_template_directory_uri() . '/assets/js/waypoints.js' , array(), null, true );
    wp_enqueue_script( 'parallax', get_template_directory_uri() . '/assets/js/parallax.js' , array(), null, true );
    wp_enqueue_script( 'ytplayer', get_template_directory_uri() . '/assets/js/ytplayer.js' , array(), null, true );
    wp_enqueue_script( 'pretty-photo', get_template_directory_uri() . '/assets/js/pretty-photo.js' , array(), null, true );
    wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/js/isotope.js' , array(), null, true );
    wp_enqueue_script( 'countto', get_template_directory_uri() . '/assets/js/jquery.countto.js' , array(), null, true );
    wp_enqueue_script('smartmenus', get_template_directory_uri().'/assets/js/jquery.smartmenus.js', array(), null, true);
    

    // Load the html5 shiv.
    wp_enqueue_script('html5', get_theme_file_uri('/assets/js/html5.js'), array(), '3.7.3');
    wp_script_add_data('html5', 'conditional', 'lt IE 9');

    wp_enqueue_script('ftc-skip-link-focus-fix', get_theme_file_uri('/assets/js/skip-link-focus-fix.js'), array(), '1.0', true);

    $ftc_l10n = array(
        'quote' => ftc_get_svg(array('icon' => 'quote-right')),
    );

    if (has_nav_menu('top')) {
        wp_enqueue_script('ftc-navigation', get_theme_file_uri('/assets/js/navigation.js'), array(), '1.0', true);
        $ftc_l10n['expand'] = esc_html__('Expand child menu', 'corona');
        $ftc_l10n['collapse'] = esc_html__('Collapse child menu', 'corona');
        $ftc_l10n['icon'] = ftc_get_svg(array('icon' => 'angle-down', 'fallback' => true));
    }

    wp_enqueue_script('jquery-scrollto', get_theme_file_uri('/assets/js/jquery.scrollto.js'), array('jquery'), '2.1.2', true);

    wp_enqueue_script('ftc-global', get_theme_file_uri('/assets/js/custom.js'), array('jquery'), '1.0', true);

    wp_localize_script('ftc-skip-link-focus-fix', 'ftcScreenReaderText', $ftc_l10n);

    if (is_singular('product') && $smof_data['ftc_prod_cloudzoom'] && isset($smof_data['ftc_prod_cloudzoom'])) {
        wp_register_script('cloud-zoom', get_template_directory_uri() . '/assets/js/cloud-zoom.js', array('jquery'), null, true);
        wp_enqueue_script('cloud-zoom');
    }

    if (defined('ICL_LANGUAGE_CODE')) {
        $ajax_uri = admin_url('admin-ajax.php?lang=' . ICL_LANGUAGE_CODE, 'relative');
    } else {
        $ajax_uri = admin_url('admin-ajax.php', 'relative');
    }

    $data = array(
        'ajax_uri' => $ajax_uri,
        '_ftc_enable_responsive' => isset($smof_data['ftc_responsive']) ? (int)$smof_data['ftc_responsive'] : 1,
        '_ftc_enable_ajax_search' => isset($smof_data['ftc_ajax_search']) ? (int)$smof_data['ftc_ajax_search'] : 1,
        '_ftc_enable_sticky_header' => isset($smof_data['ftc_enable_sticky_header']) ? (int)$smof_data['ftc_enable_sticky_header'] : 1,
        'cookies_version' => isset($smof_data['cookies_version']) ? (int)$smof_data['cookies_version'] : 1,
    );
    wp_enqueue_script('magnific-popup', get_template_directory_uri() . '/assets/js/jquery.magnific-popup.min.js', array(), null, true);
    wp_enqueue_script('threesixty', get_template_directory_uri() . '/assets/js/threesixty.min.js', array(), null, true);
    wp_localize_script('ftc-global', 'ftc_shortcode_params', $data);


    if (is_singular('product') && isset($smof_data['ftc_prod_thumbnails_style']) && $smof_data['ftc_prod_thumbnails_style'] == 'vertical') {
        wp_register_script('jquery.caroufredsel', get_template_directory_uri() . '/assets/js/jquery.carou-fredsel-6.2.1.min.js', array(), null, true);
        wp_enqueue_script('jquery.caroufredsel');
    }
    
    wp_enqueue_script('wc-add-to-cart-variation');

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'ftc_scripts', 1000);

/**
 * Use front-page.php when Front page displays is set to a static page.
 *
 * @since corona 1.0
 *
 * @param string $template front-page.php.
 *
 * @return string The template to be used: blank if is_home() is true (defaults to index.php), else $template.
 */
function ftc_front_page_template($template)
{
    return is_home() ? '' : $template;
}

add_filter('frontpage_template', 'ftc_front_page_template');

/**
 * Implement the Custom Header feature.
 */
require get_parent_theme_file_path('/inc/custom-header.php');

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path('/inc/template-tags.php');

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path('/inc/template-functions.php');

/**
 * Customizer additions.
 */
require get_parent_theme_file_path('/inc/customizer.php');

/**
 * SVG icons functions and filters.
 */
require get_parent_theme_file_path('/inc/icon-functions.php');

/*** Visual Composer plugin ***/
if (class_exists('Vc_Manager') && class_exists('WPBakeryVisualComposerAbstract')) {
    $file_names = array('vc_map', 'update_param');
    foreach ($file_names as $file) {
        $file_path = get_template_directory() . '/inc/vc_extension/' . $file . '.php';
        if (file_exists($file_path)) {
            require_once $file_path;
        }
    }

    vc_set_shortcodes_templates_dir(get_template_directory() . '/inc/vc_extension/templates');

    /* Disable VC Frontend Editor */
    vc_disable_frontend();
}

/*** Save Of Options - Save Dynamic css ***/
add_action('of_save_options_after', 'ftc_update_dynamic_css', 10000);
if (!function_exists('ftc_update_dynamic_css')) {
    function ftc_update_dynamic_css($data = array())
    {

        if (!is_array($data)) {
            return -1;
        }
        if (is_array($data['data'])) {
            $data = $data['data'];
        } else {
            return -1;
        }

        $upload_dir = wp_upload_dir();
        $filename_dir = trailingslashit($upload_dir['basedir']) . strtolower(str_replace(' ', '', wp_get_theme()->get('Name'))) . '.css';
        ob_start();
        include get_template_directory() . '/inc/dynamic_style.php';
        $dynamic_css = ob_get_contents();
        ob_end_clean();

        global $wp_filesystem;
        if (empty($wp_filesystem)) {
            require_once(ABSPATH . '/wp-admin/includes/file.php');
            WP_Filesystem();
        }

        $creds = request_filesystem_credentials($filename_dir, '', false, false, array());
        if (!WP_Filesystem($creds)) {
            return false;
        }

        if ($wp_filesystem) {
            $wp_filesystem->put_contents(
                $filename_dir,
                $dynamic_css,
                FS_CHMOD_FILE
            );
        }
    }
}

function ftc_register_custom_css() {
    ob_start();
    include_once get_template_directory() . '/inc/dynamic_style.php';
    $dynamic_css = ob_get_contents();
    ob_end_clean();
    wp_add_inline_style('ftc-style', $dynamic_css);

}

add_action('wp_enqueue_scripts', 'ftc_register_custom_css', 9999);

/*** Register Back End Scripts ***/
function ftc_register_admin_scripts()
{
   wp_register_style('ftc-admin-style', get_template_directory_uri() . '/assets/css/admin-style.css');
   wp_enqueue_style('ftc-admin-style');
   wp_register_style('ftc-theme-options', get_template_directory_uri() . '/admin/css/options.css');
   wp_enqueue_style('ftc-theme-options');
   wp_register_script('ftc-admin-script', get_template_directory_uri() . '/assets/js/admin-main.js', array('jquery'), null, true);
   wp_enqueue_script('ftc-admin-script');
   wp_register_script('ftc-active-script', get_template_directory_uri() . '/assets/js/activate.js', array('jquery'), null, true);
   wp_enqueue_script('ftc-active-script');
}

add_action('admin_enqueue_scripts', 'ftc_register_admin_scripts');




/*** Favicon ***/
if (!function_exists('ftc_theme_favicon')) {
    function ftc_theme_favicon()
    {
        wp_site_icon();
    }
}
/* * * Product Search Form not Category ** */
if (!function_exists('ftc_get_search_form_not_category')) {

    function ftc_get_search_form_not_category() {
        $search_for_product = ftc_has_woocommerce();
        if ($search_for_product) {
            $taxonomy = 'product_cat';
            $post_type = 'product';
            $placeholder_text = esc_html__('Search ...', 'corona');
        }
        $rand = rand(0, 1000);
        $form = '<div class="ftc-search">
        <button type="submit" class="search-button">
        <span>Search</span>
        </button>
        <form method="get" id="searchform' . $rand . '" action="' . esc_url(home_url('/')) . '">

        <div class="ftc_search_ajax">
        <input type="text" value="' . get_search_query() . '" name="s" id="s' . $rand . '" placeholder="' . $placeholder_text . '" autocomplete="off" /> 
        <div class="icon_search"> </div>
        <input type="submit" title="' . esc_attr__('Search', 'corona') . '" id="searchsubmit' . $rand . '" value="' . esc_attr__('Search', 'corona') . '" />
        <input type="hidden" name="post_type" value="' . $post_type . '" />
        <input type="hidden" name="taxonomy" value="' . $taxonomy . '" />
        </div>
        </form></div>';

        print_r($form);
    }

}
/*** Logo ***/
if (!function_exists('ftc_theme_logo')) {
    function ftc_theme_logo()
    {
        global $smof_data;
        $logo_image = isset($smof_data['ftc_logo']['url']) ? esc_url($smof_data['ftc_logo']['url']) : '';
        $logo_text = isset($smof_data['ftc_text_logo']) ? stripslashes(esc_attr($smof_data['ftc_text_logo'])) : '';

        ?>
        <div class="logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <!-- Main logo -->
                <?php if (strlen($logo_image) > 0): ?>
                    <img src="<?php echo esc_url($logo_image); ?>"
                    alt="<?php echo !empty($logo_text) ? esc_attr($logo_text) : get_bloginfo('name'); ?>"
                    title="<?php echo !empty($logo_text) ? esc_attr($logo_text) : get_bloginfo('name'); ?>"
                    class="normal-logo"/>
                <?php endif; ?>

                <!-- Logo Text -->
                <?php
                if (strlen($logo_image) == 0) {
                    echo esc_html($logo_text);
                }
                ?>
            </a>
        </div>
        <?php
    }
}

/*** Product Search Form by Category ***/
if (!function_exists('ftc_get_search_form_by_category')) {
    function ftc_get_search_form_by_category()
    {
        $search_for_product = ftc_has_woocommerce();
        if ($search_for_product) {
            $taxonomy = 'product_cat';
            $post_type = 'product';
            $placeholder_text = esc_html__('Search ...', 'corona');
        } else {
            $taxonomy = 'category';
            $post_type = 'post';
            $placeholder_text = esc_html__('Search', 'corona');
        }

        $options = '<option value="">' . esc_html__('All categories', 'corona') . '</option>';
        $options .= ftc_search_by_category_get_option_html($taxonomy, 0, 0);
        global $sitepress;

        $rand = rand(0, 1000);
        $form = '<div class="ftc-search">
        <form method="get" id="searchform' . $rand . '" action="' . esc_url(home_url('/')) . '">
        <select class="select-category" name="term">' . $options . '</select>
        <div class="ftc_search_ajax">

        <input type="text" value="' . get_search_query() . '" name="s" id="s' . $rand . '" 
        placeholder="' . $placeholder_text . '" autocomplete="off" /> 
        <button type="submit" class="search-button"></button>
        <input type="hidden" name="post_type" value="' . $post_type . '" />
        <input type="hidden" name="taxonomy" value="' . $taxonomy . '" />

        </div>
        </form></div>';

        print_r($form);
    }
}

if (!function_exists('ftc_search_by_category_get_option_html')) {
    function ftc_search_by_category_get_option_html($taxonomy = 'product_cat', $parent = 0, $level = 0)
    {
        $options = '';
        $spacing = '';
        for ($i = 0; $i < $level * 3; $i++) {
            $spacing .= '&nbsp;';
        }

        $args = array(
            'number' => ''
            , 'hide_empty' => 1
            , 'orderby' => 'name'
            , 'order' => 'asc'
            , 'parent' => $parent
        );

        $select = '';
        $categories = get_terms($taxonomy, $args);
        if (is_search() && isset($_GET['term']) && $_GET['term'] != '') {
            $select = $_GET['term'];
        }
        $level++;
        if (is_array($categories)) {
            foreach ($categories as $cat) {
                $options .= '<option value="' . $cat->slug . '" ' . selected($select, $cat->slug, false) . '>' . $spacing . $cat->name . '</option>';
                $options .= ftc_search_by_category_get_option_html($taxonomy, $cat->term_id, $level);
            }
        }

        return $options;
    }
}

/* Ajax search */
add_action('wp_ajax_ftc_ajax_search', 'ftc_ajax_search');
add_action('wp_ajax_nopriv_ftc_ajax_search', 'ftc_ajax_search');
if (!function_exists('ftc_ajax_search')) {

    function ftc_ajax_search() {
        check_ajax_referer( 'platform_security', 'security' );
        
        global $wpdb, $post, $smof_data;

        $search_for_product = ftc_has_woocommerce();
        if ($search_for_product) {
            $taxonomy = 'product_cat';
            $post_type = 'product';
        } else {
            $taxonomy = 'category';
            $post_type = 'post';
        }

        $num_result = isset($smof_data['ftc_ajax_search_number_result']) ? (int) $smof_data['ftc_ajax_search_number_result'] : 10;

        $search_string = sanitize_text_field($_POST['search_string']);
        $category = isset($_POST['category']) ? $_POST['category'] : '';

        $args = array(
            'post_type' => $post_type
            , 'post_status' => 'publish'
            , 's' => $search_string
            , 'posts_per_page' => $num_result
            ,'tax_query'        => array()
        );

        if ($search_for_product) {
            $args['meta_query'] = WC()->query->get_meta_query();
            $args['tax_query'] = WC()->query->get_tax_query();
        }

        if ($category != '') {
            $args['tax_query'] = array(
                array(
                    'taxonomy' => $taxonomy
                    , 'terms' => $category
                    , 'field' => 'slug'
                )
            );
        }

        $results = new WP_Query($args);

        if ($results->have_posts()) {
            $extra_class = '';
            if (isset($results->post_count, $results->found_posts) && $results->found_posts > $results->post_count) {
                $extra_class = 'view-all-results';
            }

            $html = '<ul class="ftc_list_search ' . $extra_class . '">';
            while ($results->have_posts()) {
                $results->the_post();
                $link = get_permalink($post->ID);

                $image = '';
                if ($post_type == 'product') {
                    $product = wc_get_product($post->ID);
                    $image = $product->get_image();
                } else if (has_post_thumbnail($post->ID)) {
                    $image = get_the_post_thumbnail($post->ID, 'thumbnail');
                }

                $html .= '<li>';
                $html .= '<div class="ftc-search-image">';
                $html .= '<a href="' . esc_url($link) . '">' . $image . '</a>';
                $html .= '</div>';
                $html .= '<div class="ftc-search-meta item-description">';
                $html .= '<a href="' . esc_url($link) . '" class="product_title product-name">' . ftc_search_highlight_string($post->post_title, $search_string) . '</a>';
                if ($post_type == 'product') {
                    if ($price_html = $product->get_price_html()) {
                        $html .= '<span class="price">' . $price_html . '</span>';
                    }
                }
                $html .= '</div>';
                $html .= '</li>';
            }
            $html .= '</ul>';

            if (isset($results->post_count, $results->found_posts) && $results->found_posts > $results->post_count) {
                $view_all_text = sprintf(esc_html__('View all %d results', 'corona'), $results->found_posts);

                $html .= '<div class="view-all">';
                $html .= '<a href="/shop">' . $view_all_text . '</a>';
                $html .= '</div>';
            }

            wp_reset_postdata();

            $return = array();
            $return['html'] = $html;
            $return['search_string'] = $search_string;
            wp_die(json_encode($return));
        }
        else{
            $html = '<div class="eror-search"><span class="error">'.esc_html__('No item found.', 'corona').'</span></div>';
            $return = array();
            $return['html'] = $html;
            $return['search_string'] = $search_string;
            wp_die(json_encode($return));
        }

        wp_die('');
    }
}

if (!function_exists('ftc_search_highlight_string')) {

    function ftc_search_highlight_string($string, $search_string) {
        $new_string = '';
        $pos_left = stripos($string, $search_string);
        if ($pos_left !== false) {
            $pos_right = $pos_left + strlen($search_string);
            $new_string_right = substr($string, $pos_right);
            $search_string_insensitive = substr($string, $pos_left, strlen($search_string));
            $new_string_left = stristr($string, $search_string, true);
            $new_string = $new_string_left . '<span class="hightlight">' . $search_string_insensitive . '</span>' . $new_string_right;
        } else {
            $new_string = $string;
        }
        return $new_string;
    }

}

/* Match with ajax search results */
add_filter('woocommerce_get_catalog_ordering_args', 'ftc_woocommerce_get_catalog_ordering_args_filter');
if (!function_exists('ftc_woocommerce_get_catalog_ordering_args_filter')) {
    function ftc_woocommerce_get_catalog_ordering_args_filter($args)
    {
        global $smof_data;
        if (is_search() && !isset($_GET['orderby']) && get_option('woocommerce_default_catalog_orderby') == 'menu_order'
            && isset($smof_data['ftc_ajax_search']) && $smof_data['ftc_ajax_search']
        ) {
            $args['orderby'] = '';
        $args['order'] = '';
    }
    return $args;
}
}
/*** Page Layout Columns Class ***/
if (!function_exists('ftc_page_layout_columns_class')) {

    function ftc_page_layout_columns_class($page_column) {
        $data = array();

        if (empty($page_column)) {
            $page_column = '0-1-0';
        }

        $layout_config = explode('-', $page_column);
        $left_sidebar = (int) $layout_config[0];
        $right_sidebar = (int) $layout_config[2];
        $main_class = ($left_sidebar + $right_sidebar) == 2 ? 'col-sm-6 col-xs-12' : ( ($left_sidebar + $right_sidebar) == 1 ? 'col-sm-9 col-xs-12' : 'col-sm-12 col-xs-12' );

        $data['left_sidebar'] = $left_sidebar;
        $data['right_sidebar'] = $right_sidebar;
        $data['main_class'] = $main_class;
        $data['left_sidebar_class'] = 'col-sm-3 col-xs-12';
        $data['right_sidebar_class'] = 'col-sm-3 col-xs-12';

        return $data;
    }

}

/*** Social Sharing ***/
if (!function_exists('ftc_template_social_sharing')) {
    function ftc_template_social_sharing()
    {
        if (is_active_sidebar('product-detail-social-icon')) {
            dynamic_sidebar('product-detail-social-icon');
        }
    }
}
if (!function_exists('ftc_the_excerpt_max_words')) {
    function ftc_the_excerpt_max_words($word_limit = -1, $post = '', $strip_tags = true, $extra_str = '', $echo = true)
    {
        if ($post) {
            $excerpt = ftc_get_the_excerpt_by_id($post->ID);
        } else {
            $excerpt = get_the_excerpt();
        }

        if ($strip_tags) {
            $excerpt = wp_strip_all_tags($excerpt);
            $excerpt = strip_shortcodes($excerpt);
        }

        if ($word_limit != -1)
            $result = ftc_string_limit_words($excerpt, $word_limit);
        else
            $result = $excerpt;

        $result .= $extra_str;

        if ($echo) {
            print_r(do_shortcode($result)) ;
        }
        return $result;
    }
}

if (!function_exists('ftc_get_the_excerpt_by_id')) {
    function ftc_get_the_excerpt_by_id($post_id = 0)
    {
        global $wpdb;
        $query = "SELECT post_excerpt, post_content FROM $wpdb->posts WHERE ID = %d LIMIT 1";
        $result = $wpdb->get_results($wpdb->prepare($query, $post_id), ARRAY_A);
        if ($result[0]['post_excerpt']) {
            return $result[0]['post_excerpt'];
        } else {
            return $result[0]['post_content'];
        }
    }
}
/*** Get excerpt ***/
if (!function_exists('ftc_string_limit_words')) {
    function ftc_string_limit_words($string, $word_limit){
        $words = explode(' ', $string, ($word_limit + 1));
        if (count($words) > $word_limit) {
            array_pop($words);
        }
        return implode(' ', $words);
    }
}
/*** Array Attribute Compare ***/
if (!function_exists('ftc_array_atts')) {
    function ftc_array_atts($pairs, $atts)
    {
        $atts = (array)$atts;
        $out = array();
        foreach ($pairs as $name => $default) {
            if (array_key_exists($name, $atts)) {
                if (is_array($atts[$name]) && is_array($default)) {
                    $out[$name] = ftc_array_atts($default, $atts[$name]);
                } else {
                    $out[$name] = $atts[$name];
                }
            } else {
                $out[$name] = $default;
            }
        }
        return $out;
    }
}

/*** Breadcrumbs ***/
if (!function_exists('ftc_breadcrumbs')) {
    function ftc_breadcrumbs(){
        global $smof_data;

        $is_rtl = is_rtl() || (isset($smof_data['ftc_enable_rtl']) && $smof_data['ftc_enable_rtl']);

        if (ftc_has_woocommerce()) {
            if (function_exists('woocommerce_breadcrumb') && function_exists('is_woocommerce') && is_woocommerce()) {
                woocommerce_breadcrumb(array('wrap_before' => '<div class="breadcrumbs"><div class="breadcrumbs-container">', 'delimiter' => '<span>' . ($is_rtl ? '\\' : '/') . '</span>', 'wrap_after' => '</div></div>'));
                return;
            }
        }

        if (function_exists('bbp_breadcrumb') && function_exists('is_bbpress') && is_bbpress()) {
            $args = array(
                'before' => '<div class="breadcrumbs"><div class="breadcrumbs-container">'
                , 'after' => '</div></div>'
                , 'sep' => $is_rtl ? '\\' : '/'
                , 'sep_before' => '<span class="brn_arrow">'
                , 'sep_after' => '</span>'
                , 'current_before' => '<span class="current">'
                , 'current_after' => '</span>'
            );

            bbp_breadcrumb($args);
            /* Remove bbpress breadcrumbs */
            add_filter('bbp_no_breadcrumb', '__return_true', 999);
            return;
        }

        $delimiter = '<span class="brn_arrow">' . ($is_rtl ? '\\' : '/') . '</span>';

        $front_id = get_option('page_on_front');
        if (!empty($front_id)) {
            $home = get_the_title($front_id);
        } else {
            $home = esc_html__('Home', 'corona');
        }
        $ar_title = array(
            'search' => esc_html__('Search results for ', 'corona')
            , '404' => esc_html__('Error 404', 'corona')
            , 'tagged' => esc_html__('Tagged ', 'corona')
            , 'author' => esc_html__('Articles posted by ', 'corona')
            , 'page' => esc_html__('Page', 'corona')
            , 'portfolio' => esc_html__('Portfolio', 'corona')
        );

        $before = '<span class="current">'; /* tag before the current crumb */
        $after = '</span>'; /* tag after the current crumb */
        global $wp_rewrite;
        $rewriteUrl = $wp_rewrite->using_permalinks();
        if (!is_home() && !is_front_page() || is_paged()) {

            echo '<div class="breadcrumbs"><div class="breadcrumbs-container">';

            global $post;
            $homeLink = esc_url(home_url('/'));
            echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . ' ';

            if (is_category()) {
                global $wp_query;
                $cat_obj = $wp_query->get_queried_object();
                $thisCat = $cat_obj->term_id;
                $thisCat = get_category($thisCat);
                $parentCat = get_category($thisCat->parent);
                if ($thisCat->parent != 0) {
                    echo get_category_parents($parentCat, true, ' ' . $delimiter . ' ');
                }
                print_r($before); print_r(single_cat_title('', false)); print_r($after);
            } elseif (is_search()) {
                print_r($before); print_r($ar_title['search'] . '"' . get_search_query() . '"'); print_r($after);
            } elseif (is_day()) {
                echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
                echo '<a href="' . get_month_link(get_the_time('Y'), get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
                print_r($before); print_r(get_the_time('d')); print_r($after);
            } elseif (is_month()) {
                echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
                print_r($before); print_r(get_the_time('F')); print_r($after);
            } elseif (is_year()) {
                print_r($before); print_r(get_the_time('Y')); print_r($after);
            } elseif (is_single() && !is_attachment()) {
                if (get_post_type() != 'post') {
                    $post_type = get_post_type_object(get_post_type());
                    $slug = $post_type->rewrite;
                    $post_type_name = $post_type->labels->singular_name;
                    if (strcmp('Portfolio Item', $post_type->labels->singular_name) == 0) {
                        $post_type_name = $ar_title['portfolio'];
                    }
                    if ($rewriteUrl) {
                        echo '<a href="' . $homeLink . $slug['slug'] . '/">' . $post_type_name . '</a> ' . $delimiter . ' ';
                    } else {
                        echo '<a href="' . $homeLink . '?post_type=' . get_post_type() . '">' . $post_type_name . '</a> ' . $delimiter . ' ';
                    }

                    print_r($before); print_r(get_the_title()); print_r($after);
                } else {
                    $cat = get_the_category();
                    $cat = $cat[0];
                    echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                    print_r($before); print_r(get_the_title()); print_r($after);
                }
            } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                $post_type_name = $post_type->labels->singular_name;
                if (strcmp('Portfolio Item', $post_type->labels->singular_name) == 0) {
                    $post_type_name = $ar_title['portfolio'];
                }
                if (is_tag()) {
                    print_r($before); print_r($ar_title['tagged'] . '"'); print_r(single_tag_title('', false) . '"'); print_r($after);
                } elseif (is_taxonomy_hierarchical(get_query_var('taxonomy'))) {
                    if ($rewriteUrl) {
                        echo '<a href="' . $homeLink . $slug['slug'] . '/">' . $post_type_name . '</a> ' . $delimiter . ' ';
                    } else {
                        echo '<a href="' . $homeLink . '?post_type=' . get_post_type() . '">' . $post_type_name . '</a> ' . $delimiter . ' ';
                    }

                    $curTaxanomy = get_query_var('taxonomy');
                    $curTerm = get_query_var('term');
                    $termNow = get_term_by('name', $curTerm, $curTaxanomy);
                    $pushPrintArr = array();
                    if ($termNow !== false) {
                        while ((int) $termNow->parent != 0) {
                            $parentTerm = get_term((int) $termNow->parent, get_query_var('taxonomy'));
                            array_push($pushPrintArr, '<a href="' . get_term_link((int) $parentTerm->term_id, $curTaxanomy) . '">' . $parentTerm->name . '</a> ' . $delimiter . ' ');
                            $curTerm = $parentTerm->name;
                            $termNow = get_term_by('name', $curTerm, $curTaxanomy);
                        }
                    }
                    $pushPrintArr = array_reverse($pushPrintArr);
                    array_push($pushPrintArr, $before . get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'))->name . $after);
                    echo implode($pushPrintArr);
                } else {
                    print_r($before) ; print_r($post_type_name) ; print_r($after);
                }
            } elseif (is_attachment()) {
                if ((int) $post->post_parent > 0) {
                    $parent = get_post($post->post_parent);
                    $cat = get_the_category($parent->ID);
                    if (count($cat) > 0) {
                        $cat = $cat[0];
                        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                    }
                    echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a> ' . $delimiter . ' ';
                }
                print_r($before); print_r(get_the_title()); print_r($after);
            } elseif (is_page() && !$post->post_parent) {
                print_r($before); print_r(get_the_title()); print_r($after);
            } elseif (is_page() && $post->post_parent) {
                $parent_id = $post->post_parent;
                $breadcrumbs = array();
                while ($parent_id) {
                    $page = get_post($parent_id);
                    $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                    $parent_id = $page->post_parent;
                }
                $breadcrumbs = array_reverse($breadcrumbs);
                foreach ($breadcrumbs as $crumb)
                    print_r($crumb . ' '); print_r($delimiter . ' ');
                print_r($before); print_r(get_the_title()); print_r($after);
            } elseif (is_tag()) {
                print_r($before); print_r($ar_title['tagged'] . '"'); print_r(single_tag_title('', false) . '"'); print_r($after);
            } elseif (is_author()) {
                global $author;
                $userdata = get_userdata($author);
                print_r($before); print_r($ar_title['author']); print_r($userdata->display_name); print_r($after);
            } elseif (is_404()) {
                print_r($before); print_r($ar_title['404']); print_r($after);
            }

            if (get_query_var('paged')) {
                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() || is_post_type_archive() || is_archive()) {
                 print_r($before . ' (');
             }
             print_r($ar_title['page'] . ' '); print_r(get_query_var('paged'));
             if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() || is_post_type_archive() || is_archive()) {
                echo ')' . $after;
            }
        } else {
            if (get_query_var('page')) {
                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() || is_post_type_archive() || is_archive()) {
                    print_r($before . ' (');
                }
                print_r($ar_title['page'] . ' '); print_r(get_query_var('page'));
                if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() || is_page_template() || is_post_type_archive() || is_archive()) {
                    echo ')' . $after;
                }
            }
        }
        echo '</div></div>';

    }

    wp_reset_postdata();
}
}

/* Cookie Notice */
if( ! function_exists( 'ftc_cookies_popup' ) ) {
    add_action( 'wp_footer', 'ftc_cookies_popup');

    function ftc_cookies_popup() {
        global $smof_data;
        if( isset($smof_data['cookies_info']) && ! $smof_data['cookies_info'] ) return;

        if (isset($smof_data['cookies_title']) && $smof_data['cookies_title'] != '' || isset($smof_data['cookies_text']) && $smof_data['cookies_text'] != '' ) {
            ?>
            <div class="ftc-cookies-popup">
                <div class="ftc-cookies-inner">
                    <div class="cookies-info-text">
                        <a href="#" class="cookies-title">
                            <?php if( isset($smof_data['cookies_title']) && $smof_data['cookies_title'] != ''){
                                echo esc_html(do_shortcode($smof_data['cookies_title']));
                            }
                            ?>
                        </a>
                        <p>
                            <?php if( isset($smof_data['cookies_text']) && $smof_data['cookies_text'] != ''){
                                echo esc_html(do_shortcode($smof_data['cookies_text']));
                            }
                            ?>
                        </p>
                    </div>
                    <div class="cookies-buttons">
                        <a href="#" class="btn btn-size-small btn-color-primary cookies-accept-btn"><?php echo esc_html( "Yes, I Accept" , 'corona' ); ?></a>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}



function ftc_breadcrumbs_title($show_breadcrumb = false, $show_page_title = false, $page_title = '', $extra_class_title = ''){
    global $smof_data;
    if ($show_breadcrumb || $show_page_title) {
        $breadcrumb_bg = '';
        if ($smof_data['ftc_enable_breadcrumb_background_image'] && isset($smof_data['ftc_enable_breadcrumb_background_image']) ) {
            $breadcrumb_bg = esc_url($smof_data['ftc_bg_breadcrumbs']['url']);
        }

        $style = '';
        if ($breadcrumb_bg != '') {
            $style = 'style="background-image: url(' . $breadcrumb_bg . ')"';
            if (isset($smof_data['ftc_breadcrumb_bg_parallax']) && $smof_data['ftc_breadcrumb_bg_parallax']) {
                $extra_class .= ' ftc-breadcrumb-parallax';
            }
        }
        
        echo '<div class="breadcrumb-title-wrapper" ' . $style . '><div class="container">';
        if (isset($smof_data['ftc_enable_breadcrumb_background_image']) && $smof_data['ftc_enable_breadcrumb_background_image']) {
            echo '<div class="breadcrumb-title">';
        }
        else{
            echo '<div class="breadcrumb-title ftc-breadcrumb-title-noback">';
        }
        
        if ($show_page_title) {
            echo '<h1 class="heading-title page-title entry-title ' . $extra_class_title . '">' . $page_title . '</h1>';
        }
        if ($show_breadcrumb) {
            ftc_breadcrumbs();
        }

        if(is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') || is_singular('product')){
            if(isset($smof_data['ftc_enable_category_breadcrumb']) && $smof_data['ftc_enable_category_breadcrumb'] ){
                echo '<div class="ftc-breadcrumbs-category">';
                dynamic_sidebar('list-categories-breadcrumbs');
                echo '</div>';
            }
        }

        echo '</div></div></div>';
    }
}

/*** Add header dynamic css ***/
add_action('wp_head', 'ftc_add_header_dynamic_css', 1000);
if (!function_exists('ftc_add_header_dynamic_css')) {
    function ftc_add_header_dynamic_css($is_iframe = false){
        if (!$is_iframe) {
            return;
        }
        $upload_dir = wp_upload_dir();
        $filename_dir = trailingslashit($upload_dir['basedir']) . strtolower(str_replace(' ', '', wp_get_theme()->get('Name'))) . '.css';
        $filename = trailingslashit($upload_dir['baseurl']) . strtolower(str_replace(' ', '', wp_get_theme()->get('Name'))) . '.css';
        if (is_ssl()) {
            $filename = str_replace('http://', 'https://', $filename);
        }
        if (file_exists($filename_dir)) {
            wp_register_style('header_dynamic', $filename);
            wp_enqueue_style('header_dynamic');
        }
    }
}

/*** Register google font ***/
function ftc_register_google_font($iframe = false){
    global $smof_data;
    $fonts = array();

    if ($smof_data['ftc_body_font_enable_google_font'] && isset($smof_data['ftc_body_font_enable_google_font'])) {
        $fonts[] = array(
            'name' => $smof_data['ftc_body_font_google']['font-family']
            , 'bold' => '300,400,500,600,700,800,900'
        );
    }

    if ($smof_data['ftc_secondary_body_font_enable_google_font'] && isset($smof_data['ftc_secondary_body_font_enable_google_font']) ) {
        $fonts[] = array(
            'name' => $smof_data['ftc_secondary_body_font_google']['font-family']
            , 'bold' => '300,400,500,600,700,800,900'
        );
    }

    /* Default fonts */
    $fonts[] = array(
        'name' => 'Lato'
        , 'bold' => '300,400,500,600,700,800,900'
    );

    $fonts[] = array(
        'name' => 'Raleway'
        , 'bold' => '300,400,500,600,700,800,900'
    );

    foreach ($fonts as $font) {
        ftc_load_google_font($font['name'], $font['bold'], $iframe);
    }
}

function ftc_load_google_font($font_name = '', $font_bold = '300,400,500,600,700,800,900', $iframe = false){
    if (strlen($font_name) > 0) {
        $font_name_id = sanitize_title($font_name);

        $font_url = add_query_arg('family', urlencode($font_name . ':' . $font_bold . '&subset=latin,latin-ext'), '//fonts.googleapis.com/css');
        if (!$iframe) {
            wp_enqueue_style("gg-{$font_name_id}", $font_url);
        } else {
            echo '<link rel="stylesheet" type="text/css" id="gg_' . $font_name_id . '" media="all" href="' . $font_url . '" />';
        }
    }
}


/* Install Required Plugins */
$active_theme = get_option('activate_theme');

add_action('tgmpa_register', 'ftc_register_required_plugins');
function ftc_register_required_plugins()
{
    $plugin_dir_path = get_template_directory() . '/inc/plugins/';
    $ver = wp_get_theme(); 
    $version = $ver->get('Version');
    $domain = $ver->get('TextDomain');
    /**
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

         array(
            'name' => 'Redux Framework', // The plugin name.
            'slug' => 'redux-framework', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
        )
       
        , array(
            'name' => 'WooCommerce', // The plugin name.
            'slug' => 'woocommerce', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
        )
        , array(
            'name' => 'Elementor', // The plugin name.
            'slug' => 'elementor', // The plugin slug (typically the folder name)
            'required' => false , // If false, the plugin is only 'recommended' instead of required.
        )
        , array(
            'name' => 'Contact Form 7', // The plugin name.
            'slug' => 'contact-form-7', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
        )
        , array(
            'name' => 'YITH WooCommerce Wishlist', // The plugin name.
            'slug' => 'yith-woocommerce-wishlist', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
        )
        , array(
            'name' => 'YITH WooCommerce Compare', // The plugin name.
            'slug' => 'yith-woocommerce-compare', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
        )
        , array(
            'name' => 'MailChimp for WordPress', // The plugin name.
            'slug' => 'mailchimp-for-wp', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
        )
        , array(
            'name' => 'YITH WooCommerce Ajax Product Filter', // The plugin name.
            'slug' => 'yith-woocommerce-ajax-navigation', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
        )
        , array(
            'name' => 'Dokan Lite', // The plugin name.
            'slug' => 'dokan-lite', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
        )
        , array(
            'name' => 'Variation Swatches for WooCommerce', // The plugin name.
            'slug' => 'woo-product-variation-swatches', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
        )
        , array(
            'name' => 'Regenerate Thumbnails', // The plugin name.
            'slug' => 'regenerate-thumbnails', // The plugin slug (typically the folder name).
            'required' => false, // If false, the plugin is only 'recommended' instead of required.
        )
    );

    /*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
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