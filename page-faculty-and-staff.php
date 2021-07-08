<?php get_header(); ?>
<div id="content">
    <main id="main" class="d-all cf subpage" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

    <?php if(have_posts()): while(have_posts()) : the_post(); ?>
                
            <section id="page-banner" data-parallax="scroll" data-image-src="<?php the_post_thumbnail_url('full'); ?>"></section>

            <section class="page-top cf normal" id="top" itemprop="articleBody" style="background-color: <?php the_field('top_color');?>">
                <div id="inner-content" class="wrap cf">
                    <div class="d-all">
                        <h1 class="page-title" style="background-color: <?php the_field('title_color');?>"><?php the_title(); ?></h1>    
                    </div>            
                    <div class="" id="page-menu">
                        <p><a class='button' href="#foundation">The Ballet Tech Foundation</a></p>
                        <p><a class='button' href="#public-school">THE NEW YORK CITY PUBLIC SCHOOL FOR DANCE</a></p>
                        <p><a class='button' href="#performing-arts">PROFESSIONAL PERFORMING ARTS SCHOOL</a></p>
                    </div>                
                </div>
	        </section>
                        
            <section class="content" id="foundation" style="background-color:<?php the_field('color_foundation'); ?>">
                <div class="wrap cf">
                    <h1>The Ballet Tech Foundation</h1>
                    <p><a id="eliot" href="<?php echo home_url(); ?>/about/#eliot-feld">Eliot Feld, <span class="italic">Founder</span></a></p>
                    <?php 
                        $slug = 'board-of-directors';
                        require( locate_template( 'partials/staff-search.php' ) );
                        ?>
                    
                        <?php 
                            $slug = 'trustees-emeriti';
                            require( locate_template( 'partials/staff-search.php' ) );
                            ?>  
                        
                        <div class="d-1of2 t-1of2">
                            <?php 
                            $slug = 'administration';
                            require( locate_template( 'partials/staff-search.php' ) );
                            ?>
                            
                            <?php 
                            $slug = 'ballet-tech-dance-faculty-staff'; 
                            require( locate_template( 'partials/staff-search.php' ) );
                            ?>
                        </div>
                        
                        <div class="d-1of2 t-1of2">
                            <?php 
                            $slug = 'dance-faculty';
                            require( locate_template( 'partials/staff-search.php' ) );
                            ?>
                            
                            <?php 
                            $slug = 'dance-faculty-assistants';
                            require( locate_template( 'partials/staff-search.php' ) );
                            ?>
                            
                            <?php 
                            $slug = 'pianists';
                            require( locate_template( 'partials/staff-search.php' ) );
                            ?>
                        </div>
                    </div>
                </section>
                        
                <section class="content" id="public-school" style="background-color:<?php the_field('color_public'); ?>">
                    <div class="wrap cf">
                        <h1>The New York City Public School for Dance</h1>
                        <div class="d-1of2 t-1of2">
                            <?php 
                                $slug = 'academic-faculty-staff';
                                require( locate_template( 'partials/staff-search.php' ) );
                                ?>
                                
                        </div>
                        <div class="d-1of2 t-1of2">    
                            <?php 
                            $slug = 'academic-faculty';
                            require( locate_template( 'partials/staff-search.php' ) );
                            ?>
                                      
                        </div>
                    </div>
                </section>
                        
                <section class="content" id="performing-arts" style="background-color:<?php the_field('color_performing'); ?>">
                    <div class="wrap cf">
                        <h1>PROFESSIONAL PERFORMING ARTS SCHOOL</h1>
                                
                        <div class="d-1of2 t-1of2">
                            <?php 
                            $slug = 'professional-performing-arts-school-staff';
                            require( locate_template( 'partials/staff-search.php' ) );
                                    ?>  
                        </div>                
                    </div>
                </section>
            <?php endwhile; endif; ?>
            <div class="back"><a href="#top"><i class="fa fa-angle-double-up" aria-hidden="true"></i></a></div>
		</main>
</div>

<?php get_footer(); ?>
