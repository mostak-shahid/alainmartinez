<?php 
global $mosacademy_options;
$title = $mosacademy_options['sections-feature-title'];
$content = $mosacademy_options['sections-feature-content'];
$slides = $mosacademy_options['sections-feature-slides'];


include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'mos-image-alt/mos-image-alt.php' ) ) {
	$alt_tag = mos_alt_generator(get_the_ID());
} 
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_feature', $page_details ); 
?>
<section id="section-feature">
	<div class="content-wrap">
		<?php if ($title) : ?>				
			<div class="title-wrapper">
				<h2 class="title"><?php echo do_shortcode( $title ); ?></h2>				
			</div>
		<?php endif; ?>
		<div class="slider-part">
			<div class="container">
				<?php if ($content) : ?>				
					<div class="content-wrapper"><?php echo do_shortcode( $content ) ?></div>
				<?php endif; ?>
				<?php if (sizeof($slides) > 2) : ?>
					<div id="section-feature-owl" class="owl-carousel owl-theme">
						<?php foreach ($slides as $slide) : ?>
							<div class="wrapper">
								<div class="item">
									
									<?php if ($slide["image"]) : ?>
										<?php 
										if ($slide["height"] > 465 AND $slide["width"] > 310) {
											$imgUrl = aq_resize($slide["image"], 310, 465, '', true );
										} else {
											$imgUrl = $slide["image"];
										} 
										?>
									<?php else : ?>
										<?php 
										$imgUrl = get_template_directory_uri() . '/images/no_image_work.jpg'; 
										//$imgUrl = get_template_directory_uri() . '/images/no_image_available.jpeg'; 
										?>
									<?php endif; ?>
									<?php list($width, $height) = getimagesize($imgUrl); ?>
									<img class="img-fluid" src="<?php echo  esc_url( $imgUrl ); ?>" alt="<?php echo strip_tags($slide['title']) ?>">										
									<h3 class="heading"><?php echo do_shortcode( $slide['title']); ?></h3>
									<date><?php echo do_shortcode( $slide['link_title']); ?></date>								

									<?php if ($slide["link_url"]) : ?>
									<a class="hidden-link" href="<?php echo esc_url( do_shortcode( $slide["link_url"] ) ); ?>" <?php if ($slide['target']) echo ' target="_blank"' ?>>Read More</a>	
									<?php endif; ?>		
									
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>
			</div>			
		</div>
	
	</div>
</section>
<?php do_action( 'action_below_feature', $page_details  ); ?>