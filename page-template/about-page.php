<?php /*Template Name: About Page Template*/ ?>
<?php get_header() ?>
<section id="page" class="page-content">
	<div class="content-wrap">
			<?php if ( have_posts() ) :?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php if (has_post_thumbnail()):?>
						<div class="page-img-container">
							<?php the_post_thumbnail('blog-image-full', array('class' => 'img-fluid img-blog img-centered'))?>
						</div>
					<?php endif;?>						
					<div class="container">
						<?php get_template_part( 'content', 'page' ) ?>
					</div>
				<?php endwhile;?>	


			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif;?>			
	</div>
</section>
<?php get_template_part( 'template-parts/section', 'about' ); ?>
<?php get_template_part( 'template-parts/section', 'team' ); ?>
<?php get_template_part( 'template-parts/section', 'investment' ); ?>
<?php get_footer() ?>