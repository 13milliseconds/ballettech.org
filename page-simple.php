<?php
/*
 Template Name: Simple page
 *
*/
?>

<?php get_header(); ?>

			<div id="content">

				

						<main id="main" class="d-all cf simple" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
									

								<section class="page-top cf normal" itemprop="articleBody" style="background-color: <?php the_field('top_color');?>">
                                    <div id="inner-content" class="wrap cf">
                                    <div class="d-all">
                                        <h1 class="page-title" style="background-color: <?php the_field('title_color');?>"><?php the_title(); ?></h1>    
                                    </div>
                                    <div id="page-content">
                                    <?php the_content(); ?>    
                                        </div>
                                    
                                    </div>
								</section>
                            
							<?php endwhile; endif; ?>
                            

						</main>




			</div>


<?php get_footer(); ?>
