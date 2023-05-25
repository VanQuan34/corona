<?php 
/**
 *	Template Name: Blank Page Template
 */	
?>
<?php get_header(); ?>
<div class="container">
	<div id="primary" class="content-area">
		<div class="row">
			<main id="main" class="site-main col-sm-12">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php 
					if( have_posts() ){ 
						the_post();
						the_content();
					}
					?>
				</article>
			</main>
		</div>
	</div>
</div>
<?php get_footer(); ?>