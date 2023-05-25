<?php
$options = array();
global $ftc_default_sidebars;
$sidebar_options = array();
foreach( $ftc_default_sidebars as $key => $_sidebar ){
	$sidebar_options[$_sidebar['id']] = $_sidebar['name'];
}

/* Get list menus */
$menus = array('0' => esc_html__('Default', 'corona'));
$nav_terms = get_terms( 'nav_menu', array( 'hide_empty' => true ) );
if( is_array($nav_terms) ){
	foreach( $nav_terms as $term ){
		$menus[$term->term_id] = $term->name;
	}
}

$options[] = array(
	'id'		=> 'page_layout_heading'
	,'label'	=> esc_html__('Page Layout', 'corona')
	,'desc'		=> ''
	,'type'		=> 'heading'
);

$options[] = array(
	'id'		=> 'layout_style'
	,'label'	=> esc_html__('Layout Style', 'corona')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'default'  	=> esc_html__('Default', 'corona')
		,'boxed' 	=> esc_html__('Boxed', 'corona')
		,'wide' 	=> esc_html__('Wide', 'corona')
	)
);

$options[] = array(
	'id'		=> 'page_layout'
	,'label'	=> esc_html__('Page Layout', 'corona')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'0-1-0'  => esc_html__('Fullwidth', 'corona')
		,'1-1-0' => esc_html__('Left Sidebar', 'corona')
		,'0-1-1' => esc_html__('Right Sidebar', 'corona')
		,'1-1-1' => esc_html__('Left & Right Sidebar', 'corona')
	)
);

$options[] = array(
	'id'		=> 'left_sidebar'
	,'label'	=> esc_html__('Left Sidebar', 'corona')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> $sidebar_options
);

$options[] = array(
	'id'		=> 'right_sidebar'
	,'label'	=> esc_html__('Right Sidebar', 'corona')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> $sidebar_options
);

$options[] = array(
	'id'		=> 'left_right_padding'
	,'label'	=> esc_html__('Left Right Padding', 'corona')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'1'		=> esc_html__('Yes', 'corona')
		,'0'	=> esc_html__('No', 'corona')
	)
	,'default'	=> '0'
);

$options[] = array(
	'id'		=> 'full_page'
	,'label'	=> esc_html__('Full Page', 'corona')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'1'		=> esc_html__('Yes', 'corona')
		,'0'	=> esc_html__('No', 'corona')
	)
	,'default'	=> '0'
);

$options[] = array(
	'id'		=> 'header_breadcrumb_heading'
	,'label'	=> esc_html__('Header - Breadcrumb', 'corona')
	,'desc'		=> ''
	,'type'		=> 'heading'
);

$options[] = array(
	'id'		=> 'header_layout'
	,'label'	=> esc_html__('Header Layout', 'corona')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'default'  	=> esc_html__('Default', 'corona'),
		'layout1'  	=> esc_html__('Header Layout Custom', 'corona'),
		'layout10' 	=> esc_html__('Header Layout 10', 'corona')
	)
);
$header_blocks = array('0' => '');

$args = array(
	'post_type'			=> 'ftc_header'
	,'post_status'	 	=> 'publish'
	,'posts_per_page' 	=> -1
);

$posts = new WP_Query($args);

if( !empty( $posts->posts ) && is_array( $posts->posts ) ){
	foreach( $posts->posts as $p ){
		$header_blocks[$p->ID] = $p->post_title;
	}
}
$options[] = array(
	'id'		=> 'page_header_template'
	,'label'	=> esc_html__('Header Template', 'corona')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> $header_blocks
);
$options[] = array(
	'id'		=> 'header_transparent'
	,'label'	=> esc_html__('Transparent Header', 'corona')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'1'		=> esc_html__('Yes', 'corona')
		,'0'	=> esc_html__('No', 'corona')
	)
	,'default'	=> '1'
);

$options[] = array(
	'id'		=> 'header_text_color'
	,'label'	=> esc_html__('Header Text Color', 'corona')
	,'desc'		=> esc_html__('Only available on transparent header', 'corona')
	,'type'		=> 'select'
	,'options'	=> array(
		'default'	=> esc_html__('Default', 'corona')
		,'light'	=> esc_html__('Light', 'corona')
	)
);

$options[] = array(
	'id'		=> 'menu_id'
	,'label'	=> esc_html__('Primary Menu', 'corona')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> $menus
);

$options[] = array(
	'id'		=> 'show_page_title'
	,'label'	=> esc_html__('Show Page Title', 'corona')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'1'		=> esc_html__('Yes', 'corona')
		,'0'	=> esc_html__('No', 'corona')
	)
);

$options[] = array(
	'id'		=> 'show_breadcrumb'
	,'label'	=> esc_html__('Show Breadcrumb', 'corona')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'1'		=> esc_html__('Yes', 'corona')
		,'0'	=> esc_html__('No', 'corona')
	)
);

$options[] = array(
	'id'		=> 'breadcrumb_layout'
	,'label'	=> esc_html__('Breadcrumb Layout', 'corona')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'default'  	=> esc_html__('Default', 'corona')
		,'v1'  		=> esc_html__('Breadcrumb Layout 1', 'corona')
		,'v2' 		=> esc_html__('Breadcrumb Layout 2', 'corona')
		,'v3' 		=> esc_html__('Breadcrumb Layout 3', 'corona')
	)
);

$options[] = array(
	'id'		=> 'breadcrumb_bg_parallax'
	,'label'	=> esc_html__('Breadcrumb Background Parallax', 'corona')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'options'	=> array(
		'default'  	=> esc_html__('Default', 'corona')
		,'1'		=> esc_html__('Yes', 'corona')
		,'0'		=> esc_html__('No', 'corona')
	)
);

$options[] = array(
	'id'		=> 'bg_breadcrumbs'
	,'label'	=> esc_html__('Breadcrumb Background Image', 'corona')
	,'desc'		=> ''
	,'type'		=> 'upload'
);	

$options[] = array(
	'id'		=> 'logo'
	,'label'	=> esc_html__('Logo', 'corona')
	,'desc'		=> ''
	,'type'		=> 'upload'
);

$options[] = array(
	'id'		=> 'logo_mobile'
	,'label'	=> esc_html__('Mobile Logo', 'corona')
	,'desc'		=> ''
	,'type'		=> 'upload'
);

$options[] = array(
	'id'		=> 'logo_sticky'
	,'label'	=> esc_html__('Sticky Logo', 'corona')
	,'desc'		=> ''
	,'type'		=> 'upload'
);

$revolution_exists = class_exists('RevSliderSlider');

$page_sliders = array();
$page_sliders[0] = esc_html__('No Slider', 'corona');
if( $revolution_exists ){
	$page_sliders['revslider'] = esc_html__('Revolution Slider', 'corona');
}
$options[] = array(
	'id' => 'page_slider'
	,'label' => esc_html__('Page Slider', 'corona')
	,'desc' => ''
	,'type' => 'select'
	,'options' => array(
		'1' => esc_html__('Yes', 'corona')
		,'0' => esc_html__('No', 'corona')
	)
	,'default' =>'0'
);


$options[] = array(
	'id' => 'page_slider_position'
	,'label' => esc_html__('Page Slider Position', 'corona')
	,'desc' => ''
	,'type' => 'select'
	,'options' => array(
		'before_header' => esc_html__('Before Header', 'corona')
		,'before_main_content' => esc_html__('Before Main Content', 'corona')
	)
	,'default' => 'before_main_content'
);

if( $revolution_exists ){
	global $wpdb;
	$revsliders = array();
	$revsliders[0] = esc_html__('Select a slider', 'corona');
	$sliders = $wpdb->get_results('SELECT * FROM '.$wpdb->prefix.'revslider_sliders');
	if( $sliders ) {
		foreach( $sliders as $slider ) {
			$revsliders[$slider->id] = $slider->title;
		}
	}

	$options[] = array(
		'id' => 'rev_slider'
		,'label' => esc_html__('Select Revolution Slider', 'corona')
		,'desc' => ''
		,'type' => 'select'
		,'options' => $revsliders
	);
}

$options[] = array(
	'id' => 'primary_color'
	,'label' => esc_html__('Primary color', 'corona')
	,'desc' => ''
	,'type' => 'colorpicker'
);


$options[] = array(
	'id' => 'secondary_color'
	,'label' => esc_html__('Secondary color', 'corona')
	,'desc' => ''
	,'type' => 'colorpicker'
);


$options[] = array(
	'id' => 'body_font_enable_google_font'
	,'label' => esc_html__('Enable Google Font', 'corona')
	,'desc' => ''
	,'type' => 'select'
	,'options' => array(
		'default' => esc_html__('Default', 'corona')
		,'1' => esc_html__('Yes', 'corona')
		,'0' => esc_html__('No', 'corona')
	)
);



$options[] = array(
	'id' => 'body_font_google'
	,'label' => esc_html__('Body Font Google', 'corona')
	,'desc' => ''
	,'type' => 'text'
);

$options[] = array(
	'id' => 'secondary_body_font_google'
	,'label' => esc_html__('Secondary Font Google', 'corona')
	,'desc' => ''
	,'type' => 'text'
);
$options[] = array(
	'id' => 'page_enable_popup'
	,'label' => esc_html__('Show popup newletter', 'corona')
	,'desc' => ''
	,'type' => 'select'
	,'default' => 0
	,'options' => array(
		'0' => esc_html__('No', 'corona')
		,'1' => esc_html__('Yes', 'corona')
	)
);
$options[] = array(
	'id'		=> 'page_revo_slider'
	,'label'	=> esc_html__('Revo Slider Header', 'corona')
	,'desc'		=> ''
	,'type'		=> 'select'
	,'default'  => 0
	,'options'	=> ftc_rev_slider_page_options()
);
function ftc_rev_slider_page_options() {
	if( class_exists( 'RevSlider' ) ){
		$slider = new \RevSlider();
		$revolution_sliders = $slider->getArrSliders();
		$slider_options     = ['0' => esc_html__( 'Select Slider', 'corona' ) ];
		if ( ! empty( $revolution_sliders ) && ! is_wp_error( $revolution_sliders ) ) {
			foreach ( $revolution_sliders as $revolution_slider ) {
			   $alias = $revolution_slider->getAlias();
			   $title = $revolution_slider->getTitle();
			   $slider_options[$alias] = $title;
			}
		}
	} else {
		$slider_options = ['0' => esc_html__( 'No Slider Found.', 'corona' ) ];
	}
	return $slider_options;
}

if( class_exists('ThemeFtc_GET') ){
	$footer_blocks = array('0' => '');

	$args = array(
		'post_type' => 'ftc_footer'
		,'post_status' => 'publish'
		,'posts_per_page' => -1
	);

	$posts = new WP_Query($args);

	if( !empty( $posts->posts ) && is_array( $posts->posts ) ){
		foreach( $posts->posts as $p ){
			$footer_blocks[$p->ID] = $p->post_title;
		}
	}

	wp_reset_postdata();

	$options[] = array(
		'id' => 'page_footer_heading'
		,'label' => esc_html__('Page Footer', 'corona')
		,'desc' => esc_html__('You also need to add the FTC - Footer widget into Footer widget', 'corona')
		,'type' => 'heading'
	);

	$options[] = array(
		'id' => 'footer_center'
		,'label' => esc_html__('Footer Center', 'corona')
		,'desc' => ''
		,'type' => 'select'
		,'options' => $footer_blocks
	);

	$options[] = array(
		'id' => 'footer_bottom'
		,'label' => esc_html__('Footer Bottom', 'corona')
		,'desc' => ''
		,'type' => 'select'
		,'options' => $footer_blocks
	);
}
?>