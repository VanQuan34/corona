<?php 
if ( ! defined( 'ABSPATH' ) ) { exit; }

/* Add param for vc_row */
vc_add_param('vc_row', array(
	'type' 			=> 'dropdown'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Layout', 'corona')
	,'param_name' 	=> 'layout'
	,'value' 		=> array(
				esc_html__('Wide', 'corona') 		=> 'ftc-row-wide'
				,esc_html__('Boxed', 'corona') 	=> 'ftc-row-boxed'
	)
	,'description' 	=> esc_html__('Only support Fullwidth Template', 'corona')
));

vc_add_param('vc_row', array(
	'type' 			=> 'dropdown'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Background Type', 'corona')
	,'param_name' 	=> 'bg_type'
	,'value' 		=> array(
					esc_html__('Default', 'corona')			=> 'no_bg'
					,esc_html__('Parallax', 'corona')			=> 'image'
					,esc_html__('Youtube Video', 'corona')		=> 'u_iframe'
					,esc_html__('Hosted Video', 'corona')		=> 'video'
	)
	,'group'		=> esc_html__('Background', 'corona')
	,'description' 	=> esc_html__('Note: Youtube Video does not work on mobile', 'corona')
));

vc_add_param('vc_row', array(
	'type' 			=> 'attach_image'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Background Image', 'corona')
	,'param_name' 	=> 'bg_image_new'
	,'value' 		=> ''
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('image'))
	,'group'		=> esc_html__('Background', 'corona')
));

vc_add_param('vc_row', array(
	'type' 			=> 'textfield'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Parallax Speed', 'corona')
	,'param_name' 	=> 'parallax_speed'
	,'value' 		=> '0.1'
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('image'))
	,'group'		=> esc_html__('Background', 'corona')
));

vc_add_param('vc_row', array(
	'type' 			=> 'textfield'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Youtube Video URL', 'corona')
	,'param_name' 	=> 'u_video_url'
	,'value' 		=> ''
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('u_iframe'))
	,'group'		=> esc_html__('Background', 'corona')
));

vc_add_param('vc_row', array(
	'type' 			=> 'textfield'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('MP4 Video URL', 'corona')
	,'param_name' 	=> 'video_url'
	,'value' 		=> ''
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('video'))
	,'group'		=> esc_html__('Background', 'corona')
));

vc_add_param('vc_row', array(
	'type' 			=> 'textfield'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('WebM / Ogg Video URL', 'corona')
	,'param_name' 	=> 'video_url_2'
	,'value' 		=> ''
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('video'))
	,'group'		=> esc_html__('Background', 'corona')
));

vc_add_param('vc_row', array(
	'type' 			=> 'attach_image'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Placeholder Image', 'corona')
	,'param_name' 	=> 'video_poster'
	,'value' 		=> ''
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('u_iframe', 'video'))
	,'group'		=> esc_html__('Background', 'corona')
));

vc_add_param('vc_row', array(
	'type' 			=> 'textfield'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Start Time', 'corona')
	,'param_name' 	=> 'u_start_time'
	,'value' 		=> ''
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('u_iframe'))
	,'description' 	=> esc_html__('In seconds', 'corona')
	,'group'		=> esc_html__('Background', 'corona')
));

vc_add_param('vc_row', array(
	'type' 			=> 'textfield'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Stop Time', 'corona')
	,'param_name' 	=> 'u_stop_time'
	,'value' 		=> ''
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('u_iframe'))
	,'description' 	=> esc_html__('In seconds', 'corona')
	,'group'		=> esc_html__('Background', 'corona')
));

vc_add_param('vc_row', array(
	'type' 			=> 'checkbox'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Extra Options', 'corona')
	,'param_name' 	=> 'video_opts'
	,'value' 		=> array(
					esc_html__('Loop', 'corona') 			=> 'loop'
					,esc_html__('Muted', 'corona') 		=> 'muted'
					,esc_html__('Auto Play', 'corona') 	=> 'auto_play'
	)
	,'dependency' 	=> array('element' => 'bg_type', 'value' => array('u_iframe', 'video'))
	,'group'		=> esc_html__('Background', 'corona')
));

vc_remove_param('vc_row', 'parallax');
vc_remove_param('vc_row', 'parallax_image');
vc_remove_param('vc_row', 'parallax_speed_bg');
vc_remove_param('vc_row', 'video_bg');
vc_remove_param('vc_row', 'video_bg_url');
vc_remove_param('vc_row', 'video_bg_parallax');
vc_remove_param('vc_row', 'parallax_speed_video');

/* Add param for vc_tabs */
vc_add_param('vc_tabs', array(
	'type' 			=> 'dropdown'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Style', 'corona')
	,'param_name' 	=> 'style'
	,'value' 		=> array(
					esc_html__('Default', 'corona') 							=> 'default'
					,esc_html__('Default - No Border', 'corona') 				=> 'default_no_border'
					,esc_html__('Tab Title With Background Color', 'corona') 	=> 'background_color'
					,esc_html__('Tab Title With Top Border', 'corona') 		=> 'top_border'
	)
));

vc_remove_param('vc_tta_accordion', 'style');
vc_remove_param('vc_tta_accordion', 'shape');
vc_remove_param('vc_tta_accordion', 'color');
vc_remove_param('vc_tta_accordion', 'no_fill');
vc_remove_param('vc_tta_accordion', 'spacing');
vc_remove_param('vc_tta_accordion', 'gap');
vc_remove_param('vc_tta_accordion', 'c_align');
vc_remove_param('vc_tta_accordion', 'c_position');

vc_remove_param('vc_tta_tour', 'style');
vc_remove_param('vc_tta_tour', 'shape');
vc_remove_param('vc_tta_tour', 'color');
vc_remove_param('vc_tta_tour', 'spacing');
vc_remove_param('vc_tta_tour', 'gap');
vc_remove_param('vc_tta_tour', 'no_fill_content_area');
vc_remove_param('vc_tta_tour', 'controls_size');
vc_remove_param('vc_tta_tour', 'pagination_style');
vc_remove_param('vc_tta_tour', 'pagination_color');
vc_remove_param('vc_tta_tour', 'alignment');

vc_remove_param('vc_tta_tabs', 'shape');
vc_remove_param('vc_tta_tabs', 'style');
vc_remove_param('vc_tta_tabs', 'color');
vc_remove_param('vc_tta_tabs', 'alignment');
vc_remove_param('vc_tta_tabs', 'no_fill_content_area');
vc_remove_param('vc_tta_tabs', 'spacing');
vc_remove_param('vc_tta_tabs', 'gap');
vc_remove_param('vc_tta_tabs', 'pagination_style');
vc_remove_param('vc_tta_tabs', 'pagination_color');

/* Add param for vc_tta_tabs */
vc_add_param('vc_tta_tabs', array(
	'type' 			=> 'dropdown'
	,'class' 		=> ''
	,'heading' 		=> esc_html__('Style', 'corona')
	,'param_name' 	=> 'ftc_style'
	,'value' 		=> array(
					esc_html__('Default', 'corona') 							=> 'default'
					,esc_html__('Default - No Border', 'corona') 				=> 'default_no_border'
					,esc_html__('Tab Title With Background Color', 'corona') 	=> 'background_color'
					,esc_html__('Tab Title With Top Border', 'corona') 		=> 'top_border'
	)
));
vc_add_param('vc_tta_section', array(
                                'type' => 'checkbox',
                                'param_name' => 'ftc_add_image',
                                'heading' => esc_html__( 'Add image?', 'corona' ),
                                'description' => esc_html__( 'Add image next to section title.', 'corona' ),
                        )
);
vc_add_param('vc_tta_section', array(
                                'type' 			=> 'attach_image'
				,'admin_label' 	=> true
				,'value' 		=> ''
                                ,'param_name' 	=> 'ftc_image_title'
                                ,'heading' 		=> esc_html__('Image', 'corona')
                                ,'dependency' => array(
                                        'element' => 'ftc_add_image',
                                        'value' => 'true',
                                )
                        )
);
?>