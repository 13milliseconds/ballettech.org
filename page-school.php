<?php
/*
 Template Name: School page
 *
*/
?>

<?php get_header(); ?>

			<div id="content">

				

						<main id="main" class="cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

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
                            
            <?php       endwhile; 
                        endif; 
                            ?>
                            
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
                                                 'terms' => 'school',
                                                )
                                                ),
                                );

                                $query = new WP_Query( $args );

                                if ( $query->have_posts() ) : 
                                while ( $query->have_posts() ) : 
                                $query->the_post(); 
                            ?>
                            
                                        
                                <?php require( locate_template( 'partials/page-segment.php' ) ); ?> 
                            
                            
                            
                            <?php if ( $count == 2 ): 
                            wp_reset_query(); 
                            ?>
                            
                            <section class="banner cf quotes" id="firstquotes" style="background-color:<?php the_field('quote_color'); ?>" > 
                                 <?php  global $firstquote_query;
                                        $firstquote_args = array(
                                                'post_type'     => 'quote',
                                                'post_per_page' => 4,
                                                'tax_query' => array(
                                                    array(
                                                     'taxonomy' => 'subpage',
                                                     'field' => 'slug',
                                                     'terms' => 'school',
                                                    )
                                                    ),
                                                'orderby'        => 'rand',
                                                );

        $firstquote_query = new WP_Query( $firstquote_args );
        if ( $firstquote_query->have_posts() ) : 
        while ( $firstquote_query->have_posts() ) : 
        $firstquote_query->the_post(); 
                                ?>
                            
                                <div class="quote">
                                <?php the_content(); ?>
                                <h5><?php the_title(); ?></h5>
                                <h6><?php the_field('subtitle'); ?></h6>
                                </div>
                            
        <?php   endwhile; 
                endif; 
                wp_reset_query(); 
        ?>
                                
                                <div id="firstquotes-nav" class="quotes-nav"></div>
                                
                            </section>
                            
                            
                            <?php endif; ?>
                            
                            
                            <?php if ( $count == 5 ): 
                            wp_reset_query(); 
                            ?>
                            
                            <section class="banner cf quotes" id="secondquotes" style="background-color:<?php the_field('second_quote_color'); ?>"> 
                                
                                 <?php 
                                        global $secondquote_query;
                                        $secondquote_args = array(
                                                'post_type'     => 'quote',
                                                'post_per_page' => 4,
                                                'tax_query' => array(
                                                    array(
                                                     'taxonomy' => 'subpage',
                                                     'field' => 'slug',
                                                     'terms' => 'school-bottom',
                                                    )
                                                    ),
                                                'orderby'        => 'rand',
                                                );

    $secondquote_query = new WP_Query( $secondquote_args );

    if ( $secondquote_query->have_posts() ) : 
    while ( $secondquote_query->have_posts() ) : 
    $secondquote_query->the_post(); 
                                ?>
                            
                                <div class="quote">
                                <?php the_content(); ?>
                                <h5><?php the_title(); ?></h5>
                                <h6><?php the_field('subtitle'); ?></h6>
                                </div>
                            
    <?php endwhile; 
          endif; 
          wp_reset_query(); 
        ?>
                                
                                <div id="secondquotes-nav" class="quotes-nav"></div>
                            </section>
                            
                            <?php endif; ?>


                            <?php   $count ++;
                                    endwhile; 
                                    endif; 
                            ?>
                            
                            

						</main>
                

			</div>


<?php get_footer(); ?>
