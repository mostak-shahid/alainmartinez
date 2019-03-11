
							<div class="card wrapper standard-post">
								<?php 
								if (has_post_thumbnail())
									$imgUrl = aq_resize(get_the_post_thumbnail_url(), 538, 300, true);
								else
									$imgUrl = get_template_directory_uri() .'/images/no_image_blog.jpg';; 
								?>
								<img src="<?php echo $imgUrl;?>" class="card-img-top" alt="<?php echo get_the_title() ?>">

								<div class="card-body">
									<div class="categories mb-3">
										<?php the_category(' '); ?>										
									</div>
									<h3 class="header"><?php echo get_the_title() ?></h3>
									<a class="btn btn-outline-light rounded-0 mt-3" href="<?php echo get_the_permalink(); ?>">
										Read More
										<span class="fa fa-arrow-circle-o-right"></span>
									</a>
								</div>
							</div>