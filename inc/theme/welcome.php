<?php 
$is_theme_active 		= '';
$active_button_txt 		= esc_html__('Activate Theme', 'corona');
$active_button_class 	= 'corona-activate-btn';
$input_attr 			= '';
$theme_activate 		= 'theme-deactivated';
$status_txt 			= esc_html__('No Activated', 'corona');
$purchase_code 			= '';
$readonly 				= 'false';
$status_activate_class 	= ' red';
if( $is_theme_active ){
	$purchase_code 			= corona_get_purchase_code();
	$active_button_txt 		= esc_html__('Deactivate Theme', 'corona');
	$active_button_class 	= 'corona-deactivate-btn';
	$input_attr 			= ' value="'.$purchase_code.'" readonly="true"';
	$readonly				= 'true';
	$theme_activate 		= 'theme-activated';
	$status_txt 			= esc_html__('Activated', 'corona');
	$status_activate_class 	= ' green';
}

?>
<div class="corona-content-body">
	<div class="row">
		<div class="col-12">
			<div class="corona-box theme-activate <?php echo esc_attr($theme_activate);?>">
				<div class="corona-box-header">
					<div class="title"> <?php esc_html_e('Purchase Code', 'corona')?></div>
					<div class="corona-button<?php echo esc_attr($status_activate_class);?>"> <?php echo esc_html( $status_txt );?></div>
				</div>
				<div class="corona-box-body">
					<form action="" method="post">
						<?php if( $is_theme_active ){ ?>
						<input name="purchase-code" class="purchase-code" type="text" placeholder="<?php esc_attr_e('Purchase code','corona');?>" value="<?php echo esc_attr($purchase_code); ?>" readonly = "true">
						<?php } else { ?>
						<input name="purchase-code" class="purchase-code" type="text" placeholder="<?php esc_attr_e('Purchase code','corona');?>">
						<?php } ?>
						<button type="button"  id="corona-activate-theme"  class="button action <?php echo esc_attr($active_button_class);?>"><?php echo esc_html( $active_button_txt );?></button>
						
					</form>
					<div class="purchase-desc">
						<?php echo wp_kses ( sprintf( __( 'You can learn how to find your purchase key <a href="%s" target="_blank"> here </a>', 'corona' ),'https://help.market.envato.com/hc/en-us/articles/202822600-Where-Is-My-Purchase-Code' ), 'corona' );?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>