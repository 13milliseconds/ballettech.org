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


                                <section id="page-banner" data-parallax="scroll" data-position="bottom center" data-image-src="<?php the_post_thumbnail_url('full'); ?>">
                            <?php $get_description = get_post(get_post_thumbnail_id())->post_excerpt;
                              if(!empty($get_description)){
                              echo '<div class="featured_caption">Photo: ' . $get_description . '</div>';
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
                            <?php echo do_shortcode('[tribe_events]'); ?>
                                </div>
                            </section>
                            
							<?php endwhile; endif; ?>
                            
                            <?php 
                                        global $wp_query;
                                        $count = 0;
                                        $args = array(
                                                'post_type'     => 'main_segment',
                                                'post_per_page' => -1,
                                                'tax_query' => array(
                                                    array(
                                                     'taxonomy' => 'subpage',
                                                     'field' => 'slug',
                                                     'terms' => 'events',
                                                    )
                                                    ),
                                                );

                                                $query = new WP_Query( $args );

                                             if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
                            
                                        
                              <?php require( locate_template( 'partials/page-segment.php' ) ); ?> 
                            
                            
                            


                            <?php 
                            $count ++;
                            endwhile; endif; wp_reset_query();?>
                            
                            
     

						</main>




			</div>


<?php get_footer(); ?>
