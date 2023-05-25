<?php 
/**
 *	Template Name: Fullwidth Template
 */
global $ftc_page_datas, $smof_data;
get_header( $smof_data['ftc_header_layout'] );

$extra_class = "";

$show_breadcrumb = ( !is_home() && !is_front_page() && isset($ftc_page_datas['ftc_show_breadcrumb']) && absint($ftc_page_datas['ftc_show_breadcrumb']) == 1 );
$show_page_title = ( !is_home() && !is_front_page() && absint($ftc_page_datas['ftc_show_page_title']) == 1 );

if($show_breadcrumb || $show_page_title){
	$extra_class = 'show_breadcrumb';
}
ftc_breadcrumbs_title($show_breadcrumb, $show_page_title, get_the_title());

?>
<div class="container-fluid <?php echo esc_attr($extra_class) ?>">
	<div id="primary" class="content-area full-width">
		<main id="main" class="site-main">
			<?php 
			if( ftc_has_woocommerce() ){
				wc_print_notices();
			}
			?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php 
				if( have_posts() ) the_post();
				the_content();
				wp_link_pages();
				?>
			</article>
		</main>
	</div>
</div>

<?php get_footer(); ?>