<?php
/**
 *	Template Name: Footer Template Editor
 *  Template Post Type: ftc_footer
 */
global $smof_data, $post;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
	<?php global $smof_data; ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php 
	ftc_theme_favicon();
	wp_head(); 
	?>
</head>
<body <?php body_class(); ?>>
	<div id="page" class="site">
		<div class="site-content-contain">
			<div id="content" class="site-content-header">

				<div class="container">
					<div id="primary" class="content-area ftc-header-template"> 
							<main id="main" class="site-main">

								<?php
								/* Start the Loop */
								while ( have_posts() ) : the_post();
									?>
									<div class="entry-summary">
										<div class="full-content"><?php the_content(); ?></div>
										<?php wp_link_pages(); ?>
										
									</div>
									<?php
								endwhile; 
								?> 
							</main><!-- #main -->
					</div><!-- #primary -->
				</div><!-- .container -->
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>

</body>
</html>
<?php 

