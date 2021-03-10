<?php get_header(); ?>

			<div id="content">


					<main id="main" class="d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<section class="post-top cf normal" itemprop="articleBody" style="background-color: <?php the_field('top_color');?>">
                                    <div id="inner-content" class="wrap cf">
                                    <div class="d-all" id="single-top">
                                        <h1 class="page-title" style="background-color: <?php the_field('title_color');?>"><?php the_title(); ?></h1>    
                                    </div>
                                    <div class="d-1of2" id="page-content">
                                    <?php the_content(); ?>    
                                        </div>
                                        <div class="d-1of2" id="page-picture">
                                            <img src="<?php the_post_thumbnail_url('large'); ?>" width="100%">
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
