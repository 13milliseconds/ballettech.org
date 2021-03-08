<section class="segment cf">
    <div class="segment-wrap">
                                <div class="d-all t-all background" style="background-color:<?php the_field('background_color');?>">
                                    
                                    
                                    <?php if ( $count  % 2 != 0 ){ ?><div class="d-3of7 t-1of2 m-all background-color" style="background-color:<?php the_field('background_color');?>">&nbsp</div><?php } ?>
                                    
                                    <div class="d-4of7 t-1of2 m-all background-image" style="background-image: url(<?php echo get_field("picture")['url']; ?>)" >
                                    </div>
                                    
                                    
                                    <?php if ( $count  % 2 == 0 ){ ?><div class="d-3of7 t-1of2 m-all background-color" style="background-color:<?php the_field('background_color');?>">&nbsp</div><?php } ?>
                                    
                                </div>
                                 <div class="d-all t-all content">
                                <?php if ( $count  % 2 == 0 ){ ?><div class="d-4of7 t-1of2 m-all half segment-illu">&nbsp</div><?php } ?>
                                     
                                <div class="d-3of7 t-1of2 m-all half segment-content">
                                    <a id="<?php global $post; echo $post->post_name; ?>" class="anchor"></a>
                                        <h2 class="page-title"><?php the_title(); ?></h2>    
                                    <?php   $subtitle = get_field('subtitle');
                                            if( $subtitle != null ) { ?>
                                            <h3><?php the_field("subtitle"); ?></h3>
                                    <?php } ?>
                                        <p><?php the_field("text"); ?></p>
                                    <?php   $button = get_field('button');
                                            if( $button != null ) { ?>
                                    <a href="<?php the_field("link"); ?>" class="button"><?php the_field("button"); ?></a>
                                    <?php } ?>
                                </div>
                                    
                                <?php if ( $count  % 2 != 0 ){ ?><div class="d-4of7 t-1of2 m-all half segment-illu">&nbsp</div><?php } ?>
                                     
                                </div>
        <div class="clear"></div>
        </div>
                            
                            </section>
