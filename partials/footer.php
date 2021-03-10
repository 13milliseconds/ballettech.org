<footer class="footer" style="height: 450px;" role="contentinfo" itemscope itemtype="http://schema.org/WPFooter">
                
                <div class="cf">
                <div class="d-1of3 t-all m-all" id="footer-menu">
                    <nav role="navigation">
						<?php wp_nav_menu(array(
    					'container' => 'div',                           // enter '' to remove nav container (just make sure .footer-links in _base.scss isn't wrapping)
    					'container_class' => 'footer-links cf',         // class of container (should you choose to use it)
    					'menu' => __( 'Footer Links', 'bonestheme' ),   // nav name
    					'menu_class' => 'nav footer-nav cf',            // adding custom nav class
    					'theme_location' => 'footer-links',             // where it's located in the theme
    					'before' => '',                                 // before the menu
    					'after' => '',                                  // after the menu
    					'link_before' => '',                            // before each link
    					'link_after' => '',                             // after each link
    					'depth' => 0,                                   // limit the depth of the nav
    					'fallback_cb' => 'bones_footer_links_fallback'  // fallback function
						)); ?>
					</nav>
                </div>
                
                
                
                <div class="d-1of3 t-1of2  m-all" id="footer-signup">
                    <h3>Parent Login</h3>
                    
                <?php
                        if ( ! is_user_logged_in() ) { // Display WordPress login form:
                            $args = array(
                                'redirect' => admin_url(), 
                                'form_id' => 'loginform-custom',
                                'label_remember' => __( 'Remember Me' ),
                                'label_log_in' => __( 'Go' ),
                                'remember' => true
                            );
                            wp_login_form( $args );
                        } else { // If logged in:
                            wp_loginout( home_url() ); // Display "Log Out" link.
                        }
                ?>
                    
                </div>
                
                
                <div class="d-1of3 t-1of2 m-all" id="footer-contact">
                    <h3>Ballet Tech</h3>
                <a href="https://www.google.com/maps/place/890+Broadway,+New+York,+NY+10003/@40.7385401,-73.9916742,17z/data=!3m1!4b1!4m5!3m4!1s0x89c259a22da5af0d:0x23fc5216f532a7c8!8m2!3d40.7385401!4d-73.9894855" target="_blank">890 Broadway<br>
                    New York, NY 10003</a><br>
                212.777.7110<br>
                <a href="mailto:schoolinfo@ballettech.org">schoolinfo@ballettech.org</a><br>
                <a href="https://www.facebook.com/ballettech/" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a>     <a href="https://www.youtube.com/user/BalletTechSchool" target="_blank"><i class="fa fa-youtube-play" aria-hidden="true"></i></a>
                </div>
                <div class="d-all">
                    <p class="source-org copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?>. All Rights Reserved. Website by <a href="http://13milliseconds.com" target="_blank">13Milliseconds</a></p>
                </div>
                    
                </div>


					

					


			</footer>
