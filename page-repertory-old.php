<?php
/*
 Template Name: Repertory
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


                            <section id="page-banner" data-position="top center" data-parallax="scroll" data-image-src="<?php the_post_thumbnail_url('full'); ?>">
                            
                            </section>
									

								<section class="page-top cf normal angled" itemprop="articleBody" style="background-color:<?php the_field('bg_main') ?>">
                                    <div id="inner-content" class="wrap cf">
                                    <div class="d-all">
                                        <h1 class="page-title" style="background-color: <?php the_field('title_color');?>"><?php the_title(); ?></h1>    
                                    </div>
                                    <div id="page-content">
                                    <?php the_content(); ?>    
                                    
                                        
                                    
                                        <div class="index-menu">
                                        <?php $args = array(
                                                'post_type' => 'ballet',
                                                'orderby'   => 'title',
                                                'order'     => 'ASC',
                                                'posts_per_page'    => -1,
                                                'tax_query'=> array(
                                                    'relation' => 'AND',
                                                    array(
                                                    'taxonomy'=>'ballet-type',
                                                    'field'=>'slug',
                                                    'terms'=>'other',
                                                    'operator' => 'NOT IN'
                                                        )
                                                )
                                        ); 
                                        
                                        $lastinit = '';
                                        
                                        $the_query = new WP_Query( $args );
                                        
                                        if ( $the_query->have_posts() ) {
                                            while ( $the_query->have_posts() ) { $the_query->the_post();
                                            $title = get_the_title();                                
                                                $initial = strtoupper(substr($title, 0, 1));
                                                if ( $lastinit != $initial){
                                                    echo '<a href="#'. $initial .'">'. $initial .'</a>';
                                                    $lastinit = $initial;   
                                                }                                   
                                        }; ?>
                                        </div>
                                        <div class="index">
                                            
                                            <?php $lastinit = '';
                                            echo '<ul>';
                                            while ( $the_query->have_posts() ) {$the_query->the_post();
                                                $title = get_the_title();                                
                                                $initial = strtoupper(substr($title, 0, 1));
                                                if ( $lastinit != $initial){
                                                    echo '<li class="letter" id="'. $initial .'">'. $initial .'</li>';
                                                    $lastinit = $initial;   
                                                }
                                                echo '<li><a href="'. get_the_permalink() .'">' . $title . '</a></li>';
                                                                                
                                            }
                                            echo '</ul>';
                                            /* Restore original Post Data */
                                            wp_reset_postdata();
                                        } else {
                                            // no posts found
                                        }
                                        ?>
                                        </div>    
                                        </div>
                                    
                                    </div>
								</section>
                                <section id="other-chor" class="angled" style="background-color:<?php the_field('bg_other') ?>">
                                    <div id="inner-content" class="wrap cf">
                                    <h1>REPERTORY BY OTHER CHOREOGRAPHERS</h1>
                                        
                                   <?php $otherargs = array(
                                                'post_type' => 'ballet',
                                                'orderby'   => 'title',
                                                'order'     => 'ASC',
                                                'posts_per_page'    => -1,
                                                'tax_query'=> array(
                                                    'relation' => 'AND',
                                                    array(
                                                    'taxonomy'=>'ballet-type',
                                                    'field'=>'slug',
                                                    'terms'=>'other'
                                                        )
                                                )
                                        ); 
                                        
                                        $other_query = new WP_Query( $otherargs );
                                        
                                        if ( $other_query->have_posts() ) {
                                            echo '<ul>';
                                            while ( $other_query->have_posts() ) {$other_query->the_post();
                                                echo '<li><a href="'. get_the_permalink() .'">' . get_the_title() . '</a></li>';       
                                            }
                                            echo '</ul>';
                                            /* Restore original Post Data */
                                            wp_reset_postdata();
                                        } else {
                                            // no posts found
                                        }
                                        ?> 
                                        
                                        
                                    </div>
                                </section>
                            
							<?php endwhile; endif; ?>
                            

						</main>




			</div>


<?php get_footer(); ?>
