<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package WordPress
 * @subpackage corona
 * @since 1.0
 * @version 1.0
 */

get_header( $smof_data['ftc_header_layout'] ); ?>

<div class="container">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" >

			<section class="error-404 not-found">
				<header class="page-header">
					<?php 
					$allowed_html = array(
						'h1'	=> array()
						,'h2'	=> array()
						,'p'	=> array()
						,'br'	=> array()
						,'a'	=> array( 'href' => array(), 'title' => array() )
					);
					echo sprintf( wp_kses( __( '<h1>404</h1><h2 class="page-title">erroooor page!</h2>
					<p>Something&rsquo;s not quite right here...</p>
					<a href="%s">Back to homepage</a>'
					, 'corona' ), $allowed_html ), esc_url( home_url('/') ) );
					?>
					</header>
			</section><!-- .error-404 -->
		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer();
