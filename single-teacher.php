<?php get_header(); ?>

			<div id="content">


					<main id="main" class="d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<section class="post-top cf normal" itemprop="articleBody" style="background-color: <?php the_field('top_color');?>">
                                    <div id="inner-content" class="wrap cf">
                                    <div class="d-all">
                                        <h1 class="page-title"><?php the_title(); ?></h1>    
                                    </div>
                                    <div class="d-2of3" id="page-content">
                                        
                                        
                                        <?php 
                                        
                                        $slug = $post->post_name;
                                        global $wp_query;
                                        $args = array(
                                            'post_type'     => 'teacher_segment',
                                            'post_per_page' => -1,
                                            'tax_query' => array(
                                                    array(
                                                     'taxonomy' => 'teacher',
                                                     'field' => 'slug',
                                                     'terms' => $slug,
                                                    )),
                                        );
                                
                                    $prev = '';   
                                    $query = new WP_Query( $args );
                            
                                     if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
                            
                            

                            
                                require( locate_template( 'partials/subpage-segment.php' ) );
                            
                            
                            
                                        
                              
                



                            endwhile; endif; wp_reset_query();?>
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                     <a class="button" href="<?php echo get_site_url(); ?>/community/#teachers-pages">Back to all teachers' pages</a>   
                                        
                                    </div>
                                    <div class="d-1of3" id="page-picture">
                                        <img src="<?php the_post_thumbnail_url('large'); ?>" width="100%">
                                        <?php 
                                        $slug = $post->post_name;
                                        echo do_shortcode('[tribe_mini_calendar category="'.$slug.'"]') ?>
                                        <a class="button calendar" href="<?php echo get_site_url(); ?>/events#calendar"><i class="fa fa-calendar" aria-hidden="true"></i>View Full calendar</a>
                                    </div>
                                    
                                    </div>
								</section>

						<?php endwhile; ?>

						<?php else : ?>

							<article id="post-not-found" class="hentry cf">
									<header class="article-header">
										<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
									</header>
									<section class="entry-content">
										<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
									</section>
									<footer class="article-footer">
											<p><?php _e( 'This is the error message in the single.php template.', 'bonestheme' ); ?></p>
									</footer>
							</article>

						<?php endif; ?>

					</main>


			</div>

<?php get_footer(); ?>
