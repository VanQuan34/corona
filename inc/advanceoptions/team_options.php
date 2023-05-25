<?php 
$options = array();

$options[] = array(
	'id'		=> 'role'
	,'label'	=> esc_html__('Job', 'corona')
	,'desc'		=> 'Add job for Member'
	,'type'		=> 'text'
);	
		
$options[] = array(
	'id'		=> 'profile_link'
	,'label'	=> esc_html__('Profile Link', 'corona')
	,'desc'		=> ''
	,'type'		=> 'text'
);

$options[] = array(
	'id'		=> 'facebook_link'
	,'label'	=> esc_html__('Facebook Link', 'corona')
	,'desc'		=> ''
	,'type'		=> 'text'
);

$options[] = array(
	'id'		=> 'twitter_link'
	,'label'	=> esc_html__('Twitter Link', 'corona')
	,'desc'		=> ''
	,'type'		=> 'text'
);

$options[] = array(
	'id'		=> 'google_plus_link'
	,'label'	=> esc_html__('Google+ Link', 'corona')
	,'desc'		=> ''
	,'type'		=> 'text'
);

$options[] = array(
	'id'		=> 'linkedin_link'
	,'label'	=> esc_html__('LinkedIn Link', 'corona')
	,'desc'		=> ''
	,'type'		=> 'text'
);

$options[] = array(
	'id'		=> 'rss_link'
	,'label'	=> esc_html__('RSS Link', 'corona')
	,'desc'		=> ''
	,'type'		=> 'text'
);

$options[] = array(
	'id'		=> 'dribbble_link'
	,'label'	=> esc_html__('Dribbble Link', 'corona')
	,'desc'		=> ''
	,'type'		=> 'text'
);

$options[] = array(
	'id'		=> 'pinterest_link'
	,'label'	=> esc_html__('Pinterest Link', 'corona')
	,'desc'		=> ''
	,'type'		=> 'text'
);

$options[] = array(
	'id'		=> 'instagram_link'
	,'label'	=> esc_html__('Instagram Link', 'corona')
	,'desc'		=> ''
	,'type'		=> 'text'
);			

$options[] = array(
	'id'		=> 'custom_link'
	,'label'	=> esc_html__('Custom Link', 'corona')
	,'desc'		=> ''
	,'type'		=> 'text'
);

$options[] = array(
	'id'		=> 'custom_link_icon_class'
	,'label'	=> esc_html__('Custom Link Icon Class', 'corona')
	,'desc'		=> esc_html__('Use FontAwesome Class. Ex: fa-vimeo-square', 'corona')
	,'type'		=> 'text'
);
?>