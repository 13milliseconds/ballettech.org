<?php
/*
 Template Name: Custom Page Example
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
									

								<section class="page-top cf" itemprop="articleBody" style="background-color: <?php the_field('top_color');?>">
                                    <div id="inner-content" class="wrap cf">
                                    <div class="d-all">
                                        <h1 class="page-title" style="background-color: <?php the_field('title_color');?>"><?php the_title(); ?></h1>     
                                    </div>
                                    <?php 
                                        $pagecontent = get_the_content();
                                        if ( $pagecontent != null ){
                                            require( locate_template ( 'partials/page-top.php' ) );   
                                        }; ?>
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
                                                     'terms' => 'about',
                                                    )
                                                    ),
                                                );

                                                $query = new WP_Query( $args );

                                             if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
                            
                                        
                              <?php require( locate_template( 'partials/page-segment.php' ) ); ?> 
                            
                            
                            
                            <?php if ( $count == 0 ){ ?>
                            
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
                                                     'terms' => 'about'
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
                            
                            
                            <?php } ?>
                            


                            <?php 
                            $count ++;
                            endwhile; endif; wp_reset_query();?>
                            
                            

						</main>




			</div>


<?php get_footer(); ?>
