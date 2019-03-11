<?php 
global $mosacademy_options;
$title = $mosacademy_options['sections-blog-title'];
$content = $mosacademy_options['sections-blog-content'];
$layout = $mosacademy_options['sections-blog-layout'];
 
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_blog', $page_details ); 
?>
<section id="section-blog">
	<div class="content-wrap">
		
		<?php do_action( 'action_before_blog', $page_details ); ?>
		<?php if ($title) : ?>				
			<div class="title-wrapper">
				<h2 class="title"><?php echo do_shortcode( $title ); ?></h2>				
			</div>
		<?php endif; ?>
		<div class="container">
			<?php if ($content) : ?>				
				<div class="content-wrapper"><?php echo do_shortcode( $content ) ?></div>
			<?php endif; ?>
			<?php 
			$n = 1;
			$args = array(
				'posts_per_page'=> 4,
				'post_type'=>'post'
			);
			$query = new WP_Query($args); 
			?>
			<?php if ($query -> have_posts()) : ?>
				<div id="blogs" class="row">
					<?php while ( $query -> have_posts() ) : $query -> the_post(); ?>
						<div class="col-lg-6">
							<div class="card">
								<?php 
								if (has_post_thumbnail())
									$imgUrl = aq_resize(get_the_post_thumbnail_url(), 538, 300, true);
								else
									$imgUrl = get_template_directory_uri() .'/images/no_image_blog.jpg';; 
								?>
								<img src="<?php echo $imgUrl;?>" class="card-img-top" alt="<?php echo get_the_title() ?>">

								<div class="card-body">
									<h3 class="header"><?php echo get_the_title() ?></h3>
									<a class="btn btn-outline-light rounded-0 mt-3" href="<?php echo get_the_permalink(); ?>">
										Read More
										<span class="fa fa-arrow-circle-o-right"></span>
									</a>
								</div>
							</div>
						</div>
						<?php if ($n%2 == 0) : ?>
							<div class="w-100"></div>
						<?php endif; ?>
					<?php $n++; endwhile;?>					
				</div>
				<?php wp_reset_postdata();?>
			<?php endif;?>
		</div>	

		<?php do_action( 'action_after_blog', $page_details ); ?>	
	</div>
</section>
<?php do_action( 'action_below_blog', $page_details  ); ?>