<?php if( $segment_type == 'content'):                               // IF CONTENT ?>
                            
    <div class="question">
<?php $text = get_the_content(); ?>
        <div class="triangle"><i class="fa fa-caret-right" aria-hidden="true"></i></div>
<p><span class="person"><?php the_title(); ?></span></p>
        <div class='texte'>
            <?php the_field("content1"); ?>
        </div>
    
</div>



<?php
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


<?php endif; ?>
