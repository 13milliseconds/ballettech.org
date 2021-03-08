<?php get_header(); ?>

<div id="content">

    <main id="main" class="d-all cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>


        <section id="page-banner" data-parallax="scroll" data-image-src="<?php the_post_thumbnail_url('full'); ?>">

        </section>


            <section class="page-top cf normal" itemprop="articleBody" style="background-color: <?php the_field('top_color');?>">
                <div id="inner-content" class="wrap cf">
                <div class="d-all">
                    <h1 class="page-title" style="background-color: <?php the_field('title_color');?>">Repertory</h1>    
                </div>
                <div id="page-content">
                    <h2><?php the_title(); ?></h2>
                    <div class="d-full cf">
                    <div class="ballet-info d-1of2">
                    <?php the_content(); ?>
                    </div>
                    <div class="ballet-cast d-1of4">
                    <?php the_field('cast') ?>    
                    </div>
                    <?php $cats = wp_get_post_terms($post->ID, 'ballet-type', array("fields" => "names")); 
                         if ( in_array( "Kids Dance", $cats) ) { ?>
                        
                    <div class="ballet-kidsdance d-1of4">
                        <img class="arrow" src="<?php echo get_template_directory_uri(); ?>/library/images/arrow-pink.png">
                        <img class="kids-logo" src="<?php echo get_template_directory_uri(); ?>/library/images/kidsdance.png" width="100%">
                    </div>
                        
                        <?php } ?>
                    
                    </div>

                    <a class="button" href="<?php echo get_site_url(); ?>/school/kids-dance#repertory"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Kids Dance</a>
                    </div>

                </div>
            </section>

        <?php endwhile; endif; ?>


    </main>


</div>


<?php get_footer(); ?>
