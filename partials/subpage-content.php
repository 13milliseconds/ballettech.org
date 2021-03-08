<?php if( $segment_type == 'content'):                               // IF CONTENT
                            
                                require( locate_template( 'partials/subpage-segment.php' ) );
                                        
                                        
                                        
                            
                            elseif( $segment_type == 'slider' ):                           // IF SLIDER
                                $type = get_field('type_of_picture');
                                if ( $type == 'image'){
                                $image = get_field('single_image');
                                if ( !empty($image) ){?>
                                    <section class="banner-image">
                                        <img src="<?php echo $image['url'] ?>" />
                                    </section>    
                                <?php }
                                     } elseif ( $type == 'slider'){
                                    $slider = get_field('slider_slug');
                                    if ( !empty($slider) ){?>
                                    <section class="banner-image">
                                        <?php echo do_shortcode('[rev_slider alias="'.$slider.'"]'); ?>
                                    </section>    
                                <?php }
                                }?>
                                        
                                        
                      <?php elseif( $segment_type == 'tab' ):                                // IF TAB
?>
                                </div></div></section>
                            <section class="chapter cf" style="background-color:<?php the_field('bg_color');?>">
                        <div class="wrap">
                                 <div class="d-all content">

                    
                                <a id="<?php echo $post->post_name; ?>"></a>
                                <h1 class="tab-title" style="background-color:<?php the_field('title_bg_color'); ?>"><?php the_title(); ?></h1>
                            <?php   $prev = 'yes';
                                        endif; ?>
