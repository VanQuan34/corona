<?php 
global $post, $wp_query, $smof_data;
$post_format = get_post_format(); /* Video, Audio, Gallery, Quote */
$post_class = 'post-item hentry ';
$show_blog_thumbnail = $smof_data['ftc_blog_thumbnail'];
?>
<article <?php post_class($post_class) ?>>

	<?php if( $post_format != 'quote' ): ?>

		<header class="post-img">
			<?php 
			
			if( $show_blog_thumbnail ){

				if( $post_format == 'gallery' || $post_format === false || $post_format == 'standard' ){
					?>
					<a class="thumbnail <?php echo esc_attr($post_format); ?> <?php echo esc_attr(($post_format == 'gallery')?'loading':''); ?>" href="<?php the_permalink() ?>">
						<?php 
						if( $post_format == 'gallery' ){
							$gallery = get_post_meta($post->ID, 'ftc_gallery', true);
							$gallery_ids = explode(',', $gallery);
							if( is_array($gallery_ids) && has_post_thumbnail() ){
								array_unshift($gallery_ids, get_post_thumbnail_id());
							}
							foreach( $gallery_ids as $gallery_id ){
								echo wp_get_attachment_image( $gallery_id, 'ftc_blog_thumb', 0, array('class' => 'thumbnail-blog') );
							}
							
							if( !has_post_thumbnail() && empty($gallery) ){ /* Fix date position */
								$show_blog_thumbnail = 0;
							}
						}

						if( $post_format === false || $post_format == 'standard' ){
							if( has_post_thumbnail() ){
								the_post_thumbnail('ftc_blog_thumb', array('class' => 'thumbnail-blog'));
							}
							else{ /* Fix date position */
								$show_blog_thumbnail = 0;
							}
						}
						?>
					</a>
					<?php
				}
				
				if( $post_format == 'video' ){
					$video_url = get_post_meta($post->ID, 'ftc_video_url', true);
					if( $video_url != '' ){
						print_r(do_shortcode('[ftc_video src="'.esc_url($video_url).'"]')) ;
					}
				}
				
				if( $post_format == 'audio' ){
					$audio_url = get_post_meta($post->ID, 'ftc_audio_url', true);
					if( strlen($audio_url) > 4 ){
						$file_format = substr($audio_url, -3, 3);
						if( in_array($file_format, array('mp3', 'ogg', 'wav')) ){
							print_r(do_shortcode('[audio '.$file_format.'="'.$audio_url.'"]')) ;
						}
						else{
							print_r(do_shortcode('[ftc_soundcloud url="'.$audio_url.'" width="100%" height="166"]')) ;
						}
					}
				}

			}
			?>
			<!-- Blog Date -->
			<?php if( isset($smof_data['ftc_blog_date']) && $smof_data['ftc_blog_date'] && $show_blog_thumbnail && ( $post_format == 'gallery' || $post_format === false || $post_format == 'standard' ) ): ?>
			<div class="date-time">
				<span><?php echo get_the_time('d'); ?></span>
				<span><?php echo get_the_time('M'); ?></span>
			</div>
		<?php endif; ?>
	</header>
	<div class="post-info">
		
		<div class="entry-info">
			<!-- Blog Title -->
			<?php if( isset($smof_data['ftc_blog_title']) && $smof_data['ftc_blog_title'] ): ?>
				<h3 class="heading-title entry-title">
					<a class="post-title heading-title" href="<?php the_permalink() ; ?>"><?php the_title(); ?></a>
					<?php if ( is_sticky() && is_home() && ! is_paged() ): {
						printf( '<span class="sticky-post">%s</span>', __( 'Featured', 'corona' ) );
					}?>

				<?php endif; ?>
			</h3>
		<?php endif; ?>

		<!-- Blog Categories -->
		<?php $categories_list = get_the_category_list(', ');
		if ( $categories_list && $smof_data['ftc_blog_categories'] && isset($smof_data['ftc_blog_categories'])  ): ?>
			<span class="caftc-link">
				<span><?php esc_html_e('Categories: ', 'corona'); ?></span>
				<span class="cat-links"><?php echo trim($categories_list); ?></span>
			</span>        
		<?php endif; ?>

		<!-- Blog Author -->
		<?php if( isset($smof_data['ftc_blog_author']) && $smof_data['ftc_blog_author'] ): ?>
			<span class="vcard author"><?php esc_html_e('Post by: ', 'corona'); ?><?php the_author_posts_link(); ?></span>
		<?php endif; ?>

		<!-- Blog Comment -->
		<?php if( isset($smof_data['ftc_blog_comment']) && $smof_data['ftc_blog_comment'] ): ?>
			<span class="comment-count">
				<i class="fa fa-comments-o"></i>
				<span class="number">
					<?php 
					$comments_count = wp_count_comments($post->ID); 
					$comment_number = $comments_count->approved;
					if( $comment_number > 0 ){
						echo zeroise($comment_number, 2); 
					}else{
						echo esc_html($comment_number); 
					} 
					?> Comments
				</span>
			</span>
		<?php endif; ?>

		<!-- Blog Date Time -->
		<?php if( isset($smof_data['ftc_blog_date'] ) && $smof_data['ftc_blog_date'] && ( !$show_blog_thumbnail || ( $post_format != 'gallery' && $post_format !== false && $post_format != 'standard' ) ) ) : ?>
		<div class="date-time date-time-meta">
			<i class="fa fa-calendar"></i> <?php echo get_the_time(get_option('date_format')); ?>
		</div>
	<?php endif; ?>

	<div class="clear"></div>
	<div class="entry-summary">

		<?php if( isset($smof_data['ftc_blog_excerpt']) && $smof_data['ftc_blog_excerpt'] ): ?>
			<div class="full-content"><?php the_content(); ?></div>
			<?php wp_link_pages(); ?>
		<?php endif; ?>

		<!-- Blog Read More Button -->
		<?php if( isset($smof_data['ftc_blog_read_more']) && $smof_data['ftc_blog_read_more'] ): ?>
			<a class="button-readmore" href="<?php the_permalink() ; ?>"><?php esc_html_e('Read More', 'corona'); ?></a>
		<?php endif; ?>

	</div>
</div>
</div>

<?php else: /* Post format is quote */ ?>
	
	<blockquote class="blockquote-bg">
		<?php 
		$quote_content = get_the_excerpt();
		if( !$quote_content ){
			$quote_content = get_the_content();
		}
		echo esc_html(do_shortcode($quote_content)) ;
		?>
	</blockquote>

	<div class="blockquote-meta">
		<!-- Blog Date -->
		<?php if( isset($smof_data['ftc_blog_date']) && $smof_data['ftc_blog_date'] ): ?>
			<span class="date-time">
				<i class="fa fa-calendar"></i>
				<?php echo get_the_time( get_option('date_format')); ?>
			</span>
		<?php endif; ?>

		<!-- Blog Author -->
		<?php if(isset( $smof_data['ftc_blog_author']) && $smof_data['ftc_blog_author'] ): ?>
			<span class="vcard author"><?php the_author_posts_link(); ?></span>
		<?php endif; ?>	
	</div>

<?php endif; ?>

</article>
