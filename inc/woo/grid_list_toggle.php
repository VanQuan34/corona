<?php 
if( !class_exists('Ftc_Grid_List') && ftc_has_woocommerce() ){
	class Ftc_Grid_List{
		function __construct(){
			/* Hooks */
			if( get_option('ftc_enable_glt', 'yes') == 'yes' ){
				add_action('wp', array($this, 'setup_gridlist'), 20);
			}

			/* Init settings */
			$this->settings = array(
				array(
					'name' => esc_html__( 'Default catalog view', 'corona' ),
					'type' => 'title',
					'id' => 'ftc_glt_options'
				),
				array(
					'name' 		=> esc_html__( 'Catalog view', 'corona' ),
					'desc_tip' 	=> '',
					'id' 		=> 'ftc_enable_glt',
					'type' 		=> 'checkbox',
					'desc' 		=> esc_html__('Display option to show product in grid or list view', 'corona'),
					'default' 	=> 'yes'
				),
				array(
					'name' 		=> esc_html__( 'Default catalog view', 'corona' ),
					'desc_tip' 	=> esc_html__( 'Display products in grid or list view by default', 'corona' ),
					'id' 		=> 'ftc_glt_default',
					'type' 		=> 'select',
					'options' 	=> array(
						'grid'  => esc_html__('Grid', 'corona'),
						'list' 	=> esc_html__('List', 'corona')
					)
				),
				array( 'type' => 'sectionend', 'id' => 'ftc_glt_options' ),
			);
			
			/* Default options */
			add_option( 'ftc_glt_default', 'grid' );
			
			/* Admin */
			add_action( 'woocommerce_settings_image_options_after', array( $this, 'admin_settings' ), 20 );
			add_action( 'woocommerce_update_options_catalog', array( $this, 'save_admin_settings' ) );
			add_action( 'woocommerce_update_options_products', array( $this, 'save_admin_settings' ) );
		}
		
		function admin_settings() {
			woocommerce_admin_fields( $this->settings );
		}

		function save_admin_settings() {
			woocommerce_update_options( $this->settings );
		}
		
		function setup_gridlist(){
			if( is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') ){
				add_action( 'wp_enqueue_scripts', array( $this, 'setup_scripts_script' ), 20);
				add_action( 'woocommerce_before_shop_loop', array( $this, 'gridlist_toggle_button' ), 10);
			}
		}
		
		function setup_scripts_script(){
			wp_enqueue_script('cookie', get_template_directory_uri() . '/assets/js/jquery.cookie.min.js', array( 'jquery' ), null, true );
			add_action('wp_footer', array(&$this, 'gridlist_set_default_view'));
		}
		
		function gridlist_set_default_view() {
			$default = get_option( 'ftc_glt_default', 'grid' );
			if( !$default ){
				$default = 'grid';
			}
			
			?>
			<script type="text/javascript">
				jQuery(document).ready(function(){
					"use strict";

					if (typeof jQuery.cookie == 'function' && jQuery.cookie('gridcookie') == null) {
                    jQuery('#main-content div.products').addClass('<?php echo esc_js($default); ?>');
                    jQuery('.gridlist-toggle #<?php echo esc_js($default); ?>').addClass('active');
                }

					if( typeof jQuery.cookie == 'function' ){
						jQuery('#grid').on('click',function() {
							if( jQuery(this).hasClass('active') ){
								return false;
							}
							jQuery(this).addClass('active');
							jQuery('#list').removeClass('active');
							jQuery('#columns4').removeClass('active');
							jQuery.cookie('gridcookie','grid', { path: '/' });
							jQuery('#main-content div.products').fadeOut(300, function() {
								jQuery(this).addClass('grid').removeClass('list').removeClass('columns4').fadeIn(300);
							});
							return false;
						});

						jQuery("#list").on('click',function() {
							if( jQuery(this).hasClass("active") ){
								return false;
							}
							jQuery(this).addClass("active");
							jQuery("#grid").removeClass("active");
							jQuery('#columns4').removeClass('active');
							jQuery.cookie("gridcookie","list", { path: "/" });
							jQuery("#main-content div.products").fadeOut(300, function() {
								jQuery(this).removeClass("grid").addClass("list").removeClass('columns4').fadeIn(300);
							});
							return false;
						});
						
						jQuery('#columns4').on('click',function() {
							if( jQuery(this).hasClass('active') ){
								return false;
							}
							jQuery(this).addClass('active');
							jQuery('#grid').removeClass('active');
							jQuery('#list').removeClass('active');
							jQuery.cookie('gridcookie','columns4', { path: '/' });
							jQuery('#main-content div.products').fadeOut(300, function() {
								jQuery(this).removeClass('list').addClass('columns4').fadeIn(300);
							});
							return false;
						});

						if( jQuery.cookie('gridcookie') ){
							jQuery('#main-content div.products, #gridlist-toggle').addClass(jQuery.cookie('gridcookie'));
						}

						if( jQuery.cookie('gridcookie') == 'grid' ){
							jQuery('.gridlist-toggle #grid').addClass('active');
							jQuery('.gridlist-toggle #list').removeClass('active');
							jQuery('.gridlist-toggle #columns4').removeClass('active');
						}

						if( jQuery.cookie('gridcookie') == 'list' ){
							jQuery('.gridlist-toggle #list').addClass('active');
							jQuery('.gridlist-toggle #grid').removeClass('active');
							jQuery('.gridlist-toggle #columns4').removeClass('active');
						}

						if( jQuery.cookie('gridcookie') == 'columns4' ){
							jQuery('.gridlist-toggle #columns4').addClass('active');
							jQuery('.gridlist-toggle #list').removeClass('active');
							jQuery('.gridlist-toggle #grid').removeClass('active');
						}

						jQuery('#gridlist-toggle a').on('click',function(event) {
							event.preventDefault();
						});
					}
				});
			</script>
			<?php

		
			
		}
		
		
		/* Toggle button */
		function gridlist_toggle_button() {
			?>
			<nav class="gridlist-toggle">
				<a href="#" id="grid" title="<?php echo esc_html_e('Grid view', 'corona'); ?>">&#8862; <span><?php echo esc_html__('Grid view', 'corona'); ?></span>
					<svg version="1.1" id="Layer_1" class="svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="19px" height="19px" viewBox="0 0 19 19" enable-background="new 0 0 19 19" xml:space="preserve"> <rect width="5" height="5"></rect> <rect x="7" width="5" height="5"></rect> <rect x="14" width="5" height="5"></rect> <rect y="7" width="5" height="5"></rect> <rect x="7" y="7" width="5" height="5"></rect> <rect x="14" y="7" width="5" height="5"></rect> <rect y="14" width="5" height="5"></rect> <rect x="7" y="14" width="5" height="5"></rect> <rect x="14" y="14" width="5" height="5"></rect> </svg>
				</a>
				<a href="#" id="columns4" title="<?php echo esc_html_e('Grid-4-columns', 'corona'); ?>">&#8863; <span><?php echo esc_html__('Grid 4 Columns', 'corona'); ?></span>
					<svg version="1.1" id="Layer_1" class="svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="19px" height="19px" viewBox="0 0 19 19" enable-background="new 0 0 19 19" xml:space="preserve"> <rect width="4" height="4"></rect> <rect x="5" width="4" height="4"></rect> <rect x="10" width="4" height="4"></rect> <rect x="15" width="4" height="4"></rect> <rect y="5" width="4" height="4"></rect> <rect x="5" y="5" width="4" height="4"></rect> <rect x="10" y="5" width="4" height="4"></rect> <rect x="15" y="5" width="4" height="4"></rect> <rect y="15" width="4" height="4"></rect> <rect x="5" y="15" width="4" height="4"></rect> <rect x="10" y="15" width="4" height="4"></rect> <rect x="15" y="15" width="4" height="4"></rect> <rect y="10" width="4" height="4"></rect> <rect x="5" y="10" width="4" height="4"></rect> <rect x="10" y="10" width="4" height="4"></rect> <rect x="15" y="10" width="4" height="4"></rect> </svg>
				</a>
				<a href="#" id="list" title="<?php echo esc_html_e('List view', 'corona'); ?>">&#8863; <span><?php echo esc_html__('List view', 'corona'); ?></span>
					<svg version="1.1" id="list-view" class="svg" width="24" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="18" height="18" viewBox="0 0 18 18" enable-background="new 0 0 18 18" xml:space="preserve">
						<rect x="0" width="3" height="2" ></rect>
						<rect x="5" width="18" height="2"></rect>
						<rect x="0" y="16" width="3" height="2" ></rect>
						<rect y="16" x="5" width="18" height="2"></rect>
						<rect x="0" y="8" width="3" height="2" ></rect>
						<rect y="8" x="5" width="18" height="2"></rect>
					</svg>
				</a>
			</nav>
			<?php
		}

	}
	new Ftc_Grid_List();
}
?>