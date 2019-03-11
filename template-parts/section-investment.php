<?php 
global $mosacademy_options;
$title = $mosacademy_options['sections-investment-title'];
$content = $mosacademy_options['sections-investment-content'];
$page_details = array( 'id' => get_the_ID(), 'template_file' => basename( get_page_template() ));
do_action( 'action_avobe_investment', $page_details ); 
?>
<section id="section-investment">
	<div class="content-wrap">
		
		<?php do_action( 'action_before_investment', $page_details ); ?>
				<?php if ($title) : ?>				
					<div class="title-wrapper">
						<h2 class="title"><?php echo do_shortcode( $title ); ?></h2>				
					</div>
				<?php endif; ?>
				<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<?php if ($content) : ?>				
							<div class="content-wrapper"><?php echo do_shortcode( $content ) ?></div>
						<?php endif; ?>							
					</div>
				</div>				
				</div>
		<?php do_action( 'action_after_investment', $page_details ); ?>	
	</div>
</section>
<?php do_action( 'action_below_investment', $page_details  ); ?>