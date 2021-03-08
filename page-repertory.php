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
									

				<section class="page-top cf normal angled" itemprop="articleBody" style="background-color:<?php the_field('top_color') ?>">
                                    <div id="inner-content" class="wrap cf">
                                    <div class="d-all">
                                        <h1 class="page-title" style="background-color: <?php the_field('title_color');?>"><?php the_title(); ?></h1>    
                                    </div>
                                    </div>
								</section>
                            <section class='content' style="background-color:<?php the_field('top_color') ?>">
                                <div class="wrap cf">
                                <div class="d-all">
                                    <h3><?php the_content(); ?></h3>
                                    
                                        
                                    
                                        <?php $args = array(
                                                'post_type' => 'ballet',
                                                'posts_per_page'    => -1,
                                                'meta_key' => 'date',
                                                'orderby' => 'meta_value_num',
                                                'order' => 'ASC',
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
                                        

                                        
                                        $the_query = new WP_Query( $args );
                                        
                                        if ( $the_query->have_posts() ) { ?>

                                        <div class="index">
                                            
                                            <?php 
                                            echo '<ul><div>';
                                            $lastdate = '';
                                            while ( $the_query->have_posts() ) {$the_query->the_post();
                                                $title = get_the_title(); 
                                                $date = get_field('date');
                                                if( $date != $lastdate){
                                                    echo '</div><div class="year"><li class="ballet-date"><strong>'.$date.'</strong></li>';
                                                    $lastdate = $date;
                                                }
                                            ?>                                
                                                <li class='ballet-title'><?php echo $title; ?></li>
                                                                                
                                            <?php }
                                            echo '</div></ul>';
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
                            
							<?php endwhile; endif; ?>
                            

						</main>




			</div>


<?php get_footer(); ?>
