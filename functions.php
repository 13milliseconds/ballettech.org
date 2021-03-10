<?php
/*
Author: Eddie Machado
URL: http://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, etc.
*/

// LOAD BONES CORE (if you remove this, the theme will break)
require_once( 'library/bones.php' );

// CUSTOMIZE THE WORDPRESS ADMIN (off by default)
// require_once( 'library/admin.php' );

/*********************
LAUNCH BONES
Let's get everything up and running.
*********************/

function bones_ahoy() {

  //Allow editor style.
  add_editor_style( get_stylesheet_directory_uri() . '/library/css/editor-style.css' );

  // let's get language support going, if you need it
  load_theme_textdomain( 'bonestheme', get_template_directory() . '/library/translation' );

  // USE THIS TEMPLATE TO CREATE CUSTOM POST TYPES EASILY
  require_once( 'library/custom-post-type.php' );

  // launching operation cleanup
  add_action( 'init', 'bones_head_cleanup' );
  // A better title
  add_filter( 'wp_title', 'rw_title', 10, 3 );
  // remove WP version from RSS
  add_filter( 'the_generator', 'bones_rss_version' );
  // remove pesky injected css for recent comments widget
  add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
  // clean up comment styles in the head
  add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
  // clean up gallery output in wp
  add_filter( 'gallery_style', 'bones_gallery_style' );

  // enqueue base scripts and styles
  add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
  // ie conditional wrapper

  // launching this stuff after theme setup
  bones_theme_support();

  // adding sidebars to Wordpress (these are created in functions.php)
  add_action( 'widgets_init', 'bones_register_sidebars' );

  // cleaning up random code around images
  add_filter( 'the_content', 'bones_filter_ptags_on_images' );

} /* end bones ahoy */

// let's get this party started
add_action( 'after_setup_theme', 'bones_ahoy' );


/************* OEMBED SIZE OPTIONS *************/

if ( ! isset( $content_width ) ) {
	$content_width = 680;
}

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 100 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 150 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bones-thumb-600' => __('600px by 150px'),
        'bones-thumb-300' => __('300px by 100px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select
the new images sizes you have just created from within the media manager
when you add media to your content blocks. If you add more image sizes,
duplicate one of the lines in the array and name it according to your
new image size.
*/

/************* THEME CUSTOMIZE *********************/

/* 
  A good tutorial for creating your own Sections, Controls and Settings:
  http://code.tutsplus.com/series/a-guide-to-the-wordpress-theme-customizer--wp-33722
  
  Good articles on modifying the default options:
  http://natko.com/changing-default-wordpress-theme-customization-api-sections/
  http://code.tutsplus.com/tutorials/digging-into-the-theme-customizer-components--wp-27162
  
  To do:
  - Create a js for the postmessage transport method
  - Create some sanitize functions to sanitize inputs
  - Create some boilerplate Sections, Controls and Settings
*/

function bones_theme_customizer($wp_customize) {
  // $wp_customize calls go here.
  //
  // Uncomment the below lines to remove the default customize sections 

  // $wp_customize->remove_section('title_tagline');
  // $wp_customize->remove_section('colors');
  // $wp_customize->remove_section('background_image');
  // $wp_customize->remove_section('static_front_page');
  // $wp_customize->remove_section('nav');

  // Uncomment the below lines to remove the default controls
  // $wp_customize->remove_control('blogdescription');
  
  // Uncomment the following to change the default section titles
  // $wp_customize->get_section('colors')->title = __( 'Theme Colors' );
  // $wp_customize->get_section('background_image')->title = __( 'Images' );
}

add_action( 'customize_register', 'bones_theme_customizer' );

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!


/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
  <div id="comment-<?php comment_ID(); ?>" <?php comment_class('cf'); ?>>
    <article  class="cf">
      <header class="comment-author vcard">
        <?php
        /*
          this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
          echo get_avatar($comment,$size='32',$default='<path_to_url>' );
        */
        ?>
        <?php // custom gravatar call ?>
        <?php
          // create variable
          $bgauthemail = get_comment_author_email();
        ?>
        <img data-gravatar="https://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=40" class="load-gravatar avatar avatar-48 photo" height="40" width="40" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
        <?php // end custom gravatar call ?>
        <?php printf(__( '<cite class="fn">%1$s</cite> %2$s', 'bonestheme' ), get_comment_author_link(), edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ) ?>
        <time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>

      </header>
      <?php if ($comment->comment_approved == '0') : ?>
        <div class="alert alert-info">
          <p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
        </div>
      <?php endif; ?>
      <section class="comment_content cf">
        <?php comment_text() ?>
      </section>
      <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
    </article>
  <?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!






// Adding Quote Locations to the quick edit menu
// ***************************************************************************************************************
/*
// Add to our admin_init function
add_filter('manage_quote_posts_columns', 'quotes_add_post_columns');
 
function quotes_add_post_columns($columns) {
    $columns['location'] = 'Location';
    return $columns;
}

// Add to our admin_init function
add_action('manage_quote_posts_custom_column', 'quotes_render_post_columns', 10, 2);
 
function quotes_render_post_columns($column_name, $id) {
    switch ($column_name) {
    case 'location':
        // show widget set
        $terms = get_the_terms( get_the_ID(), 'location' );
                         
        if ( $terms && ! is_wp_error( $terms ) ) : 

            $locations = array();

            foreach ( $terms as $term ) {
                echo $term->name.'<br>';
            }

            else:
                echo 'None';
            endif;
        break;
    }
}*/


// Show type of segment on subpage post
// ***************************************************************************************************************

// Add to our admin_init function
add_filter('manage_subpage_posts_columns', 'subpages_segment_add_columns2');
 
function subpages_segment_add_columns2($columns) {
    $columns['type'] = 'Type';
    return $columns;
}


// Add to our admin_init function
add_action('manage_subpage_posts_custom_column', 'subpages_segment_render_post_columns', 10, 2);
 
function subpages_segment_render_post_columns($column_name, $id) {
    switch ($column_name) {
        case 'type':
        // show widget set
        $term = get_post_meta( get_the_ID(), 'type_of_segment1' );?>
        <span <?php if( $term[0] == 'tab'){?>style="color:red; text-transform: uppercase;"<?php } ?>><?php echo $term[0]; ?></span>
      <?php
                
        break;
    }
}

// Shortcodes
// ***************************************************************************************************************
function ballets_func( $atts ){ 
    
    $a = shortcode_atts( array(
        'type' => 'all',
        'col' => '3',
    ), $atts );

    $type = $a['type'];
    $col = $a['col'];
      
    $string = '<ul class="ballets col-'.$col.'">';
    
    switch ( $type ){
        case 'kidsdance':
            $args = array(
                'post_type' => 'ballet',
                'orderby'   => 'title',
                'order'     => 'ASC',
                'posts_per_page'    => -1,
                'tax_query'=> array(
                    array(
                    'taxonomy'=>'ballet-type',
                    'field'=>'slug',
                    'terms'=>'kidsdance'
                        )
                )
            );
            break;
        case 'other':
            $args = array(
                    'post_type' => 'ballet',
                    'orderby'   => 'title',
                    'order'     => 'ASC',
                    'posts_per_page'    => -1,
                    'tax_query'=> array(
                        array(
                        'taxonomy'=>'ballet-type',
                        'field'=>'slug',
                        'terms'=>'other'
                            )
                    )
            );
            break;
        default:
            $args = array(
                    'post_type' => 'ballet',
                    'orderby'   => 'title',
                    'order'     => 'ASC',
                    'posts_per_page'    => -1
            );
    } 

            $the_query = new WP_Query( $args );

            if ( $the_query->have_posts() ) {
                while ( $the_query->have_posts() ) {
                    $the_query->the_post();
                    $title = get_the_title();                                
                    
                    $string .=  '<li><a href="'. get_the_permalink() .'">' . $title . '</a></li>';

                }
                $string .=  '</ul>';
                return $string;
            }
}
add_shortcode( 'ballets', 'ballets_func' );


function button_func( $atts ){ 
    
    $a = shortcode_atts( array(
        'link' => '',
        'new_page' => 'true',
        'label' => '',
    ), $atts );

    $link = $a['link'];
    $label = $a['label'];
    $new_page = $a['new_page'];
      
    if ( $link != '' && $label != '' ){
        $string = '<a class="button" href="'.$link.'" ';
        if( $new_page != 'false'){
           $string .= 'target="_blank" ';
        }
        $string .= '>'.$label.'</a>';
        
    }
    
    return $string;
 
}
add_shortcode( 'button', 'button_func' );


// custom single template for specific category - Used to assign a segmented template to some posts
// ***************************************************************************************************************
function wpse_custom_category_single_template( $single_template ) {

    global $post;

    // get all categories of current post
    $categories = get_the_category( $post->ID );
    $top_categories = array();

    // get top level categories
    foreach( $categories as $cat ) {
        if ( $cat->parent != 0 ) {
            $top_categories[] = $cat->parent;
        } else {
            $top_categories[] = $cat->term_id;
        }
    }

    // check if specific category exists in array
    if ( in_array( '20', $top_categories ) ) {
        if ( file_exists( get_template_directory() . '/single-subpage.php' ) ) return get_template_directory() . '/single-subpage.php';
    }

    return $single_template;

}

add_filter( 'single_template', 'wpse_custom_category_single_template' );



// Admin Filters
// ***************************************************************************************************************

/**
 * Display a custom taxonomy dropdown in admin
 * @author Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
add_action('restrict_manage_posts', 'tsm_filter_post_type_by_teacher');

function tsm_filter_post_type_by_teacher() {
	global $typenow;
	$post_type = 'teacher_segment'; // change to your post type
	$taxonomy  = 'teacher'; // change to your taxonomy
	if ($typenow == $post_type) {
		$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
		$info_taxonomy = get_taxonomy($taxonomy);
		wp_dropdown_categories(array(
			'show_option_all' => __("Show All {$info_taxonomy->label}"),
			'taxonomy'        => $taxonomy,
			'name'            => $taxonomy,
			'orderby'         => 'name',
			'selected'        => $selected,
			'show_count'      => true,
			'hide_empty'      => true,
		));
	};
}

/**
 * Filter posts by taxonomy in admin
 * @author  Mike Hemberger
 * @link http://thestizmedia.com/custom-post-type-filter-admin-custom-taxonomy/
 */
add_filter('parse_query', 'tsm_convert_id_to_term_in_query');
function tsm_convert_id_to_term_in_query($query) {
	global $pagenow;
	$post_type = 'teacher_segment'; // change to your post type
	$taxonomy  = 'teacher'; // change to your taxonomy
	$q_vars    = &$query->query_vars;
	if ( $pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0 ) {
		$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
		$q_vars[$taxonomy] = $term->slug;
	}
}










/* DON'T DELETE THIS CLOSING TAG */ ?>
