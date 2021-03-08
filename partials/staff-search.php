        <h3>
        <?php
            $cat = get_term_by('slug', $slug, 'department');
            echo $cat->name;
        ?></h3>
    
    <?php if ( $slug === 'board-of-directors') {
    echo '<div class="col-2">';
}?>
        <?php 
            global $wp_query;
            $args = array(
                    'post_type'     => 'staff',
                    'post_per_page' => -1,
                    'tax_query'=> array(
                        array(
                        'taxonomy'=>'department',
                        'field'=>'slug',
                        'terms'=>$slug
                    )));

                    $query = new WP_Query( $args );

                 if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); 

require( locate_template( 'partials/staff-name.php' ) );

endwhile; endif; wp_reset_query();?> 


    <?php if ( $slug === 'board-of-directors') {
    echo '</div>';
}?>
