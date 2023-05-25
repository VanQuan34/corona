<?php 
$options = array();

$options[] = array(
				'id'		=> 'logo_url'
				,'label'	=> esc_html__('Logo URL', 'corona')
				,'desc'		=> ''
				,'type'		=> 'text'
			);
			
$options[] = array(
				'id'		=> 'logo_target'
				,'label'	=> esc_html__('Target', 'corona')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> array(
							'_self'		=> esc_html__('Self', 'corona')
							,'_blank'	=> esc_html__('New Window Tab', 'corona')
						)
			);
?>