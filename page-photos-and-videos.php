<?php get_header(); ?>

			<div id="content">

				

						<main id="main" class="d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

									

				        <section class="post-top cf normal" itemprop="articleBody" style="background-color: <?php the_field('top_color');?>">
                                    <div id="inner-content" class="wrap cf">
                                    <div class="d-all">
                                        <h1 class="page-title" style="background-color: <?php the_field('title_color');?>">Photos</h1>    
                                    </div>
                                    <div id="page-content">
                                        <div class="d-full cf">
                                            <div class="text">
                                        <?php the_field('photo_text'); ?>
                                                </div>
                                        <?php if ( function_exists( 'soliloquy' ) ) { 
                                                soliloquy( 'photos', 'slug' ); 
                                                } ?>
                                        </div>
                                        </div>
                                    
                                    </div>
								</section>
                            <section class="post-top cf normal content" itemprop="articleBody" style="background-color: <?php the_field('top_color');?>">
                                    <div id="inner-content" class="wrap cf">
                                    <div class="d-all">
                                        <h1 class="page-title" style="background-color: <?php the_field('title_color');?>">Video</h1>    
                                    </div>
                                    <div class="d-all" id="page-content">
                                        <div class="d-full cf">
                                            <div class="text">
                                        <?php the_field('video_text'); ?>
                                            </div>
                                        <?php if ( function_exists( 'soliloquy' ) ) { 
                                                soliloquy( 'videos', 'slug' ); 
                                                } ?>
                                        </div>
                                        </div>
                                    
                                    </div>
								</section>
                            
							<?php endwhile; endif; ?>
                            

						</main>




			</div>


<?php get_footer(); ?>
