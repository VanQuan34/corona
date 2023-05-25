<?php 
$options = array();

$options[] = array(
				'id'		=> 'gravatar_email'
				,'label'	=> esc_html__('Gravatar Email Address', 'corona')
				,'desc'		=> esc_html__('Enter in an e-mail address, to use a Gravatar, instead of using the "Featured Image". You have to remove the "Featured Image".', 'corona')
				,'type'		=> 'text'
			);
			
$options[] = array(
				'id'		=> 'byline'
				,'label'	=> esc_html__('Byline', 'corona')
				,'desc'		=> esc_html__('Enter a byline for the customer giving this testimonial (for example: "CEO of ThemeFTC").', 'corona')
				,'type'		=> 'text'
			);
			
$options[] = array(
				'id'		=> 'url'
				,'label'	=> esc_html__('URL', 'corona')
				,'desc'		=> esc_html__('Enter a URL that applies to this customer (for example: http://themeftc.com/).', 'corona')
				,'type'		=> 'text'
			);
			
$options[] = array(
				'id'		=> 'rating'
				,'label'	=> esc_html__('Rating', 'corona')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> array(
						'-1'	=> esc_html__('no rating', 'corona')
						,'0'	=> esc_html__('0 star', 'corona')
						,'0.5'	=> esc_html__('0.5 star', 'corona')
						,'1'	=> esc_html__('1 star', 'corona')
						,'1.5'	=> esc_html__('1.5 star', 'corona')
						,'2'	=> esc_html__('2 stars', 'corona')
						,'2.5'	=> esc_html__('2.5 stars', 'corona')
						,'3'	=> esc_html__('3 stars', 'corona')
						,'3.5'	=> esc_html__('3.5 stars', 'corona')
						,'4'	=> esc_html__('4 stars', 'corona')
						,'4.5'	=> esc_html__('4.5 stars', 'corona')
						,'5'	=> esc_html__('5 stars', 'corona')
				)
			);
?>