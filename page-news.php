<?php
/*
 Template Name: News
 *
 * This is your custom page template. You can create as many of these as you need.
 * Simply name is "page-whatever.php" and in add the "Template Name" title at the
 * top, the same way it is here.
 *
 * When you create your page, you can just select the template and viola, you have
 * a custom page template to call your very own. Your mother would be so proud.
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/
?>

<?php get_header(); ?>

			<div id="content">

				

						<main id="main" class="d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


                            <section id="page-banner" data-parallax="scroll" data-position="top center" data-image-src="<?php the_post_thumbnail_url('full'); ?>">
                            <?php $get_description = get_post(get_post_thumbnail_id())->post_excerpt;
                              if(!empty($get_description)){
                              echo '<div class="featured_caption">Photo: ' . $get_description . '</div>';
                              }
                            ?>
                            </section>
									

								<section class="page-top cf normal" itemprop="articleBody" style="background-color: <?php the_field('top_color');?>">
                                    <div id="inner-content" class="wrap cf">
                                    <div class="d-all">
                                        <h1 class="page-title" style="background-color: <?php the_field('title_color');?>"><?php the_title(); ?></h1>    
                                    </div>
                                    <div id="page-content">
                                    <?php 
                                        global $wp_query;
                                        $args = array(
                                                'post_type'     => 'news',
                                                'post_per_page' => -1,
                                                );

                                                $query = new WP_Query( $args );

                                             if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
                                        
                                        <div id="news" class="d-1of2">     
                                                <h3><?php the_title(); ?></h3>
                                                <h4><?php the_date(); ?></h4>
                                                <?php the_content(); ?>
                                        </div>


                            <?php endwhile; endif; wp_reset_query();?>    
                                        <div style="clear: both"></div>
                                        </div>
                                        
                                    
                                    
                                    </div>
								</section>
                            
                            
                            
							<?php endwhile; endif; ?>
            
  

						</main>




			</div>


<?php get_footer(); ?>
