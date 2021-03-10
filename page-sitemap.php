<?php get_header(); ?>

			<div id="content">

				

						<main id="main" class="d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
									

								<section class="content normal" itemprop="articleBody" style="background-color: <?php the_field('top_color');?>">
                                    <div id="inner-content" class="wrap cf">
                                    <div class="d-all">
                                        <h1 class="page-title"><?php the_title(); ?></h1>    
                                    </div>
                                    <div id="page-content">
                                        <?php wp_nav_menu(array(
    					         'menu' => __( 'Sitemap', 'bonestheme' ),  // nav name
    					         'menu_class' => 'nav sitemap cf',               // adding custom nav class
    					         'before' => '',                                 // before the menu
        			               'after' => '',                                  // after the menu
        			               'link_before' => '',                            // before each link
        			               'link_after' => '',                             // after each link
        			               'depth' => 0,                                   // limit the depth of the nav
    					         'fallback_cb' => ''                             // fallback function (if there is one)
						)); ?>
                                        </div>
                                    
                                    </div>
								</section>
                            
							<?php endwhile; endif; ?>
                            

						</main>




			</div>


<?php get_footer(); ?>
