<?php get_header(); ?>

			<div id="content">

				

						<main id="main" class="d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


                            <section id="page-banner" data-parallax="scroll" data-position="top center" data-image-src="<?php the_post_thumbnail_url('full'); ?>">
                            <?php $get_description = get_post(get_post_thumbnail_id())->post_excerpt;
                              if(!empty($get_description)){
                              echo '<div class="featured_caption">Photo by' . $get_description . '</div>';
                              }
                            ?>
                            </section>
									

								<section class="page-top cf normal" itemprop="articleBody" style="background-color: <?php the_field('top_color');?>">
                                    <div id="inner-content" class="wrap cf">
                                    <div class="d-all">
                                        <h1 class="page-title" style="background-color: <?php the_field('title_color');?>"><?php the_title(); ?></h1>    
                                    </div>
                                    <div id="page-content">
                                    <?php the_content(); ?> 
                                        <div id="ways">
                                        <h2>Ways to Give</h2>
                                        <h3>Gifts of general support</h3>
                                        <div class="whitebox"><?php the_field('way1'); ?></div>
                                        <div class="whitebox"><?php the_field('way2'); ?></div>
                                        <div class="whitebox"><?php the_field('way3'); ?></div>
                                        <div class="whitebox"><?php the_field('way4'); ?></div>
                                        <div class="whitebox"><?php the_field('way5'); ?></div>
                                        <span class="giving-footer"><?php the_field('footer'); ?></span>
                                    </div>
                                        </div>
                                        
                                    
                                    
                                    </div>
								</section>
                            

                            
                            <section class="banner cf quotes" id="firstquotes"> 
                                 <?php 
                                        global $firstquote_query;
                                        $firstquote_args = array(
                                                'post_type'     => 'quote',
                                                'post_per_page' => 4,
                                                'tax_query' => array(
                                                    array(
                                                     'taxonomy' => 'subpage',
                                                     'field' => 'slug',
                                                     'terms' => 'giving'
                                                    )
                                                    ),
                                                'orderby'        => 'rand'
                                                );

                                                $firstquote_query = new WP_Query( $firstquote_args );

                                             if ( $firstquote_query->have_posts() ) : while ( $firstquote_query->have_posts() ) : $firstquote_query->the_post(); ?>
                            
                                <div class="quote">
                                <?php the_content(); ?>
                                <h5><?php the_title(); ?></h5>
                                <h6><?php the_field('subtitle'); ?></h6>
                                </div>
                            
                            
                        

                                    <?php 
                                    endwhile; endif; wp_reset_query();?>
                                <div id="firstquotes-nav" class="quotes-nav"></div>
                                
                            </section>
                            
                            
                            
                            
                            
							<?php endwhile; endif; ?>
                            
                            
  
                            

						</main>




			</div>


<?php get_footer(); ?>
