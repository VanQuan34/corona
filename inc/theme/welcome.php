<?php
$is_theme_active 		= get_option('corona_active_theme');
$active_button_txt 		= esc_html__('Activate Theme', 'corona');
$active_button_class 	= 'ftc-activate-btn';
$input_attr 			= '';
$theme_activate 		= 'theme-deactivated';
$status_txt 			= esc_html__('No Activated', 'corona');
$purchase_code 			= '';
$readonly 				= 'false';
$status_activate_class 	= ' red';
if ($is_theme_active) {
	$purchase_code 			= get_option('corona_purchase_code');
	$active_button_txt 		= esc_html__('Activate Theme', 'corona');
	$active_button_class 	= 'corona-deactivate-btn';
	$input_attr 			= ' value="' . $purchase_code . '" readonly="true"';
	$readonly				= 'true';
	$theme_activate 		= 'theme-activated';
	$status_txt 			= esc_html__('Activated', 'corona');
	$status_activate_class 	= ' green';
}

?>
<div class="ftc-importer-wrapper">
	<div class="note" style="width:100%">

		<?php $theme_obj = wp_get_theme(); ?>
		<div class="screen" style="background-image: url(<?php echo esc_url($theme_obj->get_screenshot()) ?>); background-size:cover; height:300px; position: relative;">
			<?php
			$ver = wp_get_theme();
			$version = $ver->get('Version');
			$domain = $ver->get('TextDomain');
			?>
			<h4><?php echo esc_attr($domain) . ': ' . esc_attr($version) ?></h4>
		</div>
		<div class="note_import">
			<div class="heading">
				<h2>ThemeFTC - Active Theme</h2>
				<p style="font-size: 15px;padding-left: 0; font-style: italic;">Thank you for purchasing our premium eCommerce theme.</p>
			</div>
			<div class="logo"><img src="<?php echo get_template_directory_uri().'/assets/images/favicon.ico'; ?>"></div>
      <p>Use the purchase code to activate the theme and use the full range of paid plugins including Revolution Slider, WPBakery, Mega Main Menu</p>
      <p>Enable FTC Importer on theme with one-button demo importer</p>
			<p>If you need support please contact our support team: <a href="https://themeftc.ticksy.com">https://themeftc.ticksy.com</a></p>

		</div>

	</div>
	<div class="ftc-content-active">
		<div class="row">
			<div class="col-12">
				<div class="corona-box theme-activate <?php echo esc_attr($theme_activate); ?>">
					<div class="ftc-active-header">
						<div class="title"> <?php esc_html_e('Purchase Code', 'corona') ?></div>
						<div class="ftc-corona-button<?php echo esc_attr($status_activate_class); ?>"> <?php echo esc_html($status_txt); ?></div>
					</div>
					<div class="ftc-active-body">
						<form action="" method="post">
							<?php if ($is_theme_active) { ?>
								<input name="purchase-code" class="ftc-purchase-code" type="text" placeholder="<?php esc_attr_e('Purchase code', 'corona'); ?>" value="<?php echo esc_attr($purchase_code); ?>" readonly="true">
							<?php } else { ?>
								<input name="purchase-code" class="ftc-purchase-code" type="text" placeholder="<?php esc_attr_e('Purchase code', 'corona'); ?>">
							<?php } ?>
							<button type="button" id="ftc-activate-theme" class="button action <?php echo esc_attr($active_button_class); ?>" <?php echo $is_theme_active ? 'disabled' : '' ?>><?php echo esc_html($active_button_txt); ?></button>

						</form>
						<div class="ftc-purchase-desc">
							<?php echo wp_kses(sprintf(__('You can learn how to find your purchase key <a href="%s" target="_blank"> here </a>', 'corona'), 'https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code'), 'corona'); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>