<?php
/*
Author: Carlos González
Edited by Front End Ninja with references from: Eddie Machado htp://themble.com/bones/

Include needed files, enqueue scripts and styles, 
thumbnails, sidebars and custom functions.

To manage widgets, and admin pages use files beneath:
lib/fen-admin-page-framework.3.7.12/
*/

/************* INCLUDE NEEDED FILES ***************/

require_once( 'lib/ninja-support/admin.php' );

require_once( 'lib/ninja-support/theme_support.php' );


require_once( 'lib/fen-admin-page-framework.3.7.12/library/admin-page-framework/admin-page-framework.php' );
require_once( 'lib/fen-admin-page-framework.3.7.12/admin-page-fen-loader.php' );

// =======================================================
// Style & Javascript Enqueue
// =======================================================

function fen_enqueue_scripts(){
	wp_enqueue_style( 'fen_style', get_template_directory_uri(). '/assets/stylesheets/css/application.css' );
	wp_enqueue_script( "jquery" );
	wp_enqueue_script( 'fen-application',  get_template_directory_uri(). '/assets/javascripts/min/application-min.js' ); // Load Boostrap scripts with Codekit inside application.js for better performance.
}
add_action( 'wp_enqueue_scripts', 'fen_enqueue_scripts');


/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
// add_image_size( 'slide-1500-500', 1500, 500, true );
add_image_size( 'slide-1920-460', 1920, 460, true ); // default fullwith carousel slide

add_image_size( 'bg-thumbnail', 640, 480, true );
add_image_size( 'md-thumbnail', 360, 270, true );
add_image_size( 'sm-thumbnail', 203, 152, true );

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 640 x 480 sized image,
we would use the function:
<?php the_post_thumbnail( 'bg-thumbnail' ); ?>
for the 360 x 270 image:
<?php the_post_thumbnail( 'md-thumbnail' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'fen_custom_image_sizes' );

function fen_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bg-thumbnail' => __('640x480 px'),
    	// 'md-thumbnail' => __('360x270 px'),
    	// 'sm-thumbnail' => __('203x152 px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select 
the new images sizes you have just created from within the media manager 
when you add media to your content blocks. If you add more image sizes, 
duplicate one of the lines in the array and name it according to your 
new image size.
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function fen_register_sidebars() {
	// DOCS: http://codex.wordpress.org/Function_Reference/dynamic_sidebar

	register_sidebar(array(
		'id' => 'sidebar1', // Change the id
		'name' => 'Sidebar 1', // Change the name
		'description' => 'The first (primary) sidebar.',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	// register_sidebar(array(
	// 	'id' => 'sidebar2', // Change the id
	// 	'name' => 'Sidebar 2', // Change the name
	// 	'description' => 'The first (primary) sidebar.', // Better change description too!
	// 	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	// 	'after_widget' => '</div>',
	// 	'before_title' => '<h4 class="widgettitle">',
	// 	'after_title' => '</h4>',
	// ));

} // don't remove this bracket!


// ====================================
// Custom Support 
// ====================================

// -----------------------------------
// Return an image selector with variable url and attr.
// -----------------------------------

function image_selector( $url, $attr ){
    foreach ($attr as $key => $attribute) {
    	$attributes .= $key.'="'.strval($attribute).'" ';
    }
    $html .= '<img src="'.$url.'" '.$attributes.'>';

    return $html;
}

// -----------------------------------
// Add Page attribute "Page Order" to Posts.
// -----------------------------------

// add_action( 'admin_init', 'posts_order_wpse_91866' );

// function posts_order_wpse_91866() 
// {
//     add_post_type_support( 'post', 'page-attributes' );
// }

// -----------------------------------
// Add Post attribute to Page.
// -----------------------------------

// // Exceprt
// add_action( 'admin_init', 'fen_page_excerpt_init' );

// function fen_page_excerpt_init() {
//     add_post_type_support( 'page', 'excerpt' );
// }


// -----------------------------------
// Add Tag Support to Pages
// -----------------------------------

// // add tag support to pages
// function tags_support_all() {
// 	register_taxonomy_for_object_type('post_tag', 'page');
// }

// // ensure all tags are included in queries
// function tags_support_query($wp_query) {
// 	if ($wp_query->get('tag')) $wp_query->set('post_type', 'any');
// }

// // tag hooks
// add_action('init', 'tags_support_all');
// add_action('pre_get_posts', 'tags_support_query');


















