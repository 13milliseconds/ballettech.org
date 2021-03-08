<div id="top-sublinks">
        <?php  

        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();

        $segment_type = get_field('type_of_segment1');
        switch( $segment_type ){

        case 'content':
        $break = get_field('break');
        ?>

    <a class="sub-link <?php if ($break) { echo 'break';}?>" href="#<?php global $post; echo $post->post_name; ?>"><?php the_title(); ?></a>

        <?php 
        break;
        case 'tab':
        ?>

        </div>
            <a class="tab-link" href="#<?php global $post; echo $post->post_name; ?>"><?php the_title(); ?></a>
        <div id="top-sublinks">


        <?php 
        break;
        };
        ?> 

        <?php endwhile; endif; 
                wp_reset_postdata();
            ?>
</div>
