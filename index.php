<?php get_header() ?>
<section id="archive" class="page-content">
	<div class="content-wrap">
		<div class="container">
			<?php if ( have_posts() ) :?>
				<div id="blogs" class="row">
					<?php while ( have_posts() ) : the_post(); ?>
						<div class="col-lg-6">							
							<?php get_template_part( 'content', get_post_format() ) ?>
						</div>
					<?php endwhile;?>						
				</div>
				<div class="pagination-wrapper">
				<?php
					the_posts_pagination( array(
						'show_all' => false,
						'screen_reader_text' => " ",
						'prev_text'          => 'Prev',
						'next_text'          => 'Next',
					) );
				?>
				</div>
			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif;?>			
		</div>
	</div>
</section>
<?php get_footer() ?>