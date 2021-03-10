<?php
/**
 * Template Name: Calendar Template
 *
 */
?>

<?php get_header(); ?>

			<div id="content">

				

						<main id="main" class="d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


                                <section id="page-banner" data-parallax="scroll" data-position="bottom center" data-image-src="<?php echo get_site_url(); ?>/wp-content/uploads/2016/09/DottyUmbrellas.jpg">
                            <?php $get_description = get_post(get_post_thumbnail_id())->post_excerpt;
                              if(!empty($get_description)){
                              echo '<div class="featured_caption">Photo by' . $get_description . '</div>';
                              }
                            ?>
                            </section>
									

								<section class="page-top cf" itemprop="articleBody" style="padding-bottom: 0;">
                                    <div id="inner-content" class="wrap cf">
                                    <div class="d-all">
                                        <h1 class="page-title" style="background-color: #fd4e2c">Events</h1>     
                                    </div>
                                    </div>
								</section>
                            
                            
                            <section id="calendar">
                                <div id="inner-content" class="wrap cf">
                            <?php the_content(); ?>
                                </div>
                            </section>
                            
							<?php endwhile; endif; wp_reset_query();?>
                            
                            
     

						</main>




			</div>


<?php get_footer(); ?>
