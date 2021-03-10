



									

								<section class="post-top cf normal" itemprop="articleBody" style="background-color: <?php the_field('top_color');?>">
                                    <div id="inner-content" class="wrap cf">
                                    <div class="d-all">
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
                            

                            

