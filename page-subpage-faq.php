<?php get_header(); ?>

			<div id="content">


					<main id="main" class="d-all cf subpage" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                        
                            <section id="page-banner" data-parallax="scroll" data-image-src="<?php the_post_thumbnail_url('full'); ?>">
                        
                            </section>

							<section class="page-top cf normal" id="top" itemprop="articleBody" style="background-color: <?php the_field('top_color');?>">
                                    <div id="inner-content" class="wrap cf">
                                        <div class="d-all">
                                            <h1 class="page-title" style="background-color: <?php the_field('title_color');?>"><?php the_title(); ?></h1>    
                                        </div>
                                        
                                        
                                    
                                    </div>
								</section>
                        

						
                        
                        <section class="content" id="foundation" style="background-color:<?php the_field('color_foundation'); ?>">
                            <div class="wrap cf">
                                <h1>The Ballet Tech Foundation</h1>
                                <p><a href="<?php echo home_url(); ?>/about/#eliot-feld">Eliot Feld, <span class="italic">Artistic Director</span></a></p>
                                <?php 
                                    $slug = 'board-of-directors';
                                    require( locate_template( 'partials/staff-search.php' ) );
                                    ?>
                                
                                
                                <?php 
                                    $slug = 'trustees-emeriti';
                                    require( locate_template( 'partials/staff-search.php' ) );
                                    ?>
                                
                                
                                
                                
                            </div>
                        </section>
                        
                        
<?php endwhile; endif; ?>
                        <div class="back"><a href="#top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a></div>
					</main>


			</div>

<?php get_footer(); ?>
