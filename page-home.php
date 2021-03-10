<?php get_header(); ?>

			<div id="content">

				

						<main id="main" class="d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">
<section id="reveal"></section>
							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

                            
<div id="fullpage">
            <div class="section" id="firstSlide">
                <div class="clickButton hidden"><i class="fa fa-play" aria-hidden="true"></i></div>
            </div>  
           <div class="section">
                                <div id="home-intro">
                                <div id="wrap-intro">
                                <p><?php the_field('intro_text'); ?></p> 
                                </div>
                                <div id="intro-background" style="background-color:<?php the_field('intro_color');?>"></div>
                                </div>
          </div>
            <div class="section" id="second-home">
                                    
                                 <div class="d-all t-all content" style="background-color:<?php the_field('right_color');?>;">
                                     
            <div class="d-1of2 t-1of2 half" id="home-glance" >
                <div class="background-color" style="background-color: <?php the_field("left_color") ?>">&nbsp</div>
                <div class="d-1of3" id="home-arrow">
                    &nbsp
                <img src="<?php echo get_template_directory_uri(); ?>/library/images/arrow-pink.png">
                </div>
                <div class="text d-2of3">
                <h2>At A Glance</h2>
                <?php the_field('at_a_glance'); ?>
                </div>
            </div>
                                     
            <div class="d-1of2 t-1of2 half" id="home-events" >
                <div class="text">
                    <h2>Upcoming Events</h2>
                <div id="events">
                    <?php
                    global $post;

                        // Retrieve the next 5 upcoming events
                        $events = tribe_get_events( array(
                            'posts_per_page' => 3,
                            'start_date' => date( 'Y-m-d' )
                        ) );

                        // Loop through the events
                        foreach ( $events as $post ) {
                            setup_postdata( $post );
                            $start = tribe_get_start_date( $post, true, 'M j' );
                            $end = tribe_get_end_date( $post, true,'M j' );
                            if ( tribe_event_is_all_day($post) ){
                                $endDisp = $end;
                                $startDisp = $start;
                            } else{
                                $startDisp = tribe_get_start_date( $post, true, 'M j, g:i a' );
                                $endDisp = tribe_get_end_date( $post, true,'M j, g:i a' );
                            }
                            ?>

                    <p><strong><?php 
                            echo $startDisp; 
                            if ( $start != $end){ echo ' - '.$endDisp; };
                        ?></strong><br>
                    <?php echo "$post->post_title"; ?></p>


                    <?php  } wp_reset_query(); ?>
                        
                </div>
                <a class="button" href='/events'>More Events</a>
                </div>
            </div>
                                     
                                     <div style="clear: both"></div>
                                     
                                </div>
                                    
                                
                                
          </div>                    
          <div class="section" id="home-photos">
                <?php echo do_shortcode('[rev_slider alias="home"]'); ?>    
          </div> 
          <div class="section fp-auto-height" id="home-footer">
             <?php require( locate_template( 'partials/footer.php' ) ); ?>
          </div>  
        
                
                            </div> <?php // End of Full Page ?>
                            
					<section class="" id="home-banner" style="background-image: url('<?php echo get_template_directory_uri(); ?>/library/images/landing-mobile.jpg')">
                                <video id="homevideo" preload="auto" muted autoplay loop class="fullscreen-bg__video mobile-hide" 
                                       data-webm="<?php the_field('video_webmhd'); ?>"
                                       data-mp4="<?php the_field('video_mp4'); ?>"
                                       data-ogg="<?php the_field('video_ogg'); ?>"
                                       poster="<?php the_field('video_placeholder'); ?>"
                                       >
                                </video>
                        <div id="home-top-slider">
                        <?php echo do_shortcode('[rev_slider alias="home-top"]'); ?>
                        </div>        
                            </section>
                            
                            <section id="home-logo">
                                <a><img src="<?php echo get_template_directory_uri(); ?>/library/images/logo-full.png" id="full-logo"/></a>
                            </section>	
                            
                            

                            
							<?php endwhile; endif; ?>
                            
            <div id='mute-btn'><i class="fa fa-volume-off" aria-hidden="true"></i></div>
						</main>




			</div>


<?php get_footer(); ?>
