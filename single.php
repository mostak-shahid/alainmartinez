<?php get_header() ?>
<section id="blogs" class="page-content">
	<div class="content-wrap">
		<div class="container">
			<?php if ( have_posts() ) :?>
				<?php while ( have_posts() ) : the_post(); ?>		

					<div class="card wrapper standard-post">
						<?php 
						if (has_post_thumbnail())
							$imgUrl = aq_resize(get_the_post_thumbnail_url(), 1108);
						else
							$imgUrl = get_template_directory_uri() .'/images/no_image_blog.jpg';; 
						?>
						<img src="<?php echo $imgUrl;?>" class="card-img-top" alt="<?php echo get_the_title() ?>">

						<div class="card-body">
							<div class="categories mb-3">
								<?php the_category(' '); ?>										
							</div>
							<h2 class="header"><?php echo get_the_title() ?></h2>
							<div class="desc">
								<?php the_content(); ?>
							</div>
							<?php 
							$gallery_images = get_post_meta( get_the_ID(), '_mosacademy_post_gallery_images', true );					
							$layout = ( get_post_meta( get_the_ID(), '_mosacademy_post_gallery_layout', true ) ) ? get_post_meta( get_the_ID(), '_mosacademy_gallery_layout', true ) : '6';
							$large_image_size =  get_post_meta( get_the_ID(), '_mosacademy_post_large_image_size', true );
							$image_width =  get_post_meta( get_the_ID(), '_mosacademy_post_image_width', true );
							$image_height =  get_post_meta( get_the_ID(), '_mosacademy_post_image_height', true );
							$image_per_page =  get_post_meta( get_the_ID(), '_mosacademy_post_image_per_page', true );
							?>
							<?php if($gallery_images) : ?>
								<div id="gallery" class="row">
									<?php foreach ( $gallery_images as $attachment_id => $attachment_url ) : ?>
										<?php $raw_url = wp_get_attachment_url( $attachment_id ) ?>	
										<div class="col-md-6 col-lg-<?php echo $layout ?> text-center">
											<div class="img-container">
												<a href="<?php if ($large_image_size == 'max') echo aq_resize($raw_url, 1920); elseif ($large_image_size == 'container') echo aq_resize($raw_url, 1140); else echo $raw_url ?>" data-fancybox="gallery" data-caption="">
													<?php 
													$attachment_alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ); 
													if ($image_width OR $image_height ) $img_url = aq_resize($raw_url, $image_width, $image_height, true);
													else $img_url = $raw_url;
													?>
													<img class="img-fluid img-gallery" src="<?php echo $img_url; ?>" alt="<?php echo $attachment_alt; ?>">
												</a>
											</div>
										</div>
									<?php endforeach; ?>
								</div>
								<div class="galleryHolder"></div>
							<?php endif; ?>

						</div>
					</div>
				<?php endwhile;?>	


			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif;?>
			<div class="post-linking">
				<div class="row">
					<div class="col-md-6 text-left">								
						<?php previous_post_link("%link", "Previous Post") ; ?>
					</div>
					<div class="col-md-6 text-right">
						<?php next_post_link("%link", "Next Post"); ?>
					</div>						
				</div>
			</div>
			<?php if (comments_open() || '0' != get_comments_number()) : comments_template(); endif;?>			
		</div>
	</div>
</section>
<?php get_footer() ?>
<?php if($gallery_images) : ?>
<script>
jQuery(document).ready(function($) {	
	$("div.galleryHolder").jPages({
        containerID: "gallery",
        perPage: <?php echo $image_per_page ?>,
        previous: "prev",
        next: "next",
    });
    if ($(".galleryHolder a").length <= 3){
    	$('.galleryHolder').hide();
    }
});	
</script>
<?php endif;?>