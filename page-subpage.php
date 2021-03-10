<?php
/*
 Template Name: Subpage template
 *
*/
?>

<?php get_header(); ?>

			<div id="content">

				

						<main id="main" class="d-all cf subpage" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); 
                                    $slug = $post->post_name;
                                    $top = get_the_post_thumbnail_url(null, 'full');
                            ?>


                            <section id="page-banner" <?php if ( $top != '' ){ echo 'data-parallax="scroll" data-image-src="'.$top.'"'; } ?> >
                                
                            <?php if ( $top == '' ){
                                echo do_shortcode('[rev_slider alias="'.$slug.'"]'); 
                            }; ?>
                            
                            </section>
                            
                            
									

        <section class="page-top cf" itemprop="articleBody" style="background-color: <?php the_field('top_color');?>">
            
            <div id="inner-content" class="wrap cf">
            <div class="d-all">
                <h1 class="page-title" style="background-color: <?php the_field('title_color');?>"><?php the_title(); ?><a id="top"></a></h1>    
            </div>
            <?php 
                global $wp_query;
                $args = array(
                    'post_type'     => 'subpage',
                    'post_per_page' => -1,
                    'tax_query' => array(
                            array(
                             'taxonomy' => 'subpage',
                             'field' => 'slug',
                             'terms' => $slug,
                            )),
                );
                if ( $slug != 'faq' ) {
                    require( locate_template('partials/subpage-menu.php') );
                }; 
                ?>   
            </div>
        </section>
         <section class="default cf" style="background-color:<?php the_field('top_color');?>">
        <div class="wrap">
                 <div class="d-all content">                  
            <?php endwhile; endif; wp_reset_query(); ?>

            <?php 

                    $prev = '';   
                    $query = new WP_Query( $args );

                     if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

            $segment_type = get_field('type_of_segment1'); ?>

            <?php 
                     if ( $slug != 'faq' ) {
                        require( locate_template( 'partials/subpage-content.php' ) );
                } else {
                       require( locate_template( 'partials/subpage-content-faq.php' ) );  
                     };
         ?>






            <?php 
            endwhile; endif;?>
                        <a href="#top"><div class="back"><i class="fa fa-angle-double-up" aria-hidden="true"></i></div></a>
            </div></div></section>
        </main>




			</div>


<?php get_footer(); ?>
