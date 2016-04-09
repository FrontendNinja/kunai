<?php
/* Welcome to Bones :)
This is the core Bones file where most of the
main functions & features reside. If you have
any custom functions, it's best to put them
in the functions.php file.

Developed by: Eddie Machado
URL: http://themble.com/bones/
*/

/*********************
LAUNCH BONES
Let's fire off all the functions
and tools. I put it up here so it's
right up top and clean.
*********************/

// we're firing all out initial functions at the start
add_action( 'after_setup_theme', 'bones_ahoy', 16 );

function bones_ahoy() {

	// launching operation cleanup
	// add_action( 'init', 'bones_head_cleanup' );
	// remove WP version from RSS
	// add_filter( 'the_generator', 'bones_rss_version' );
	// remove pesky injected css for recent comments widget
	// add_filter( 'wp_head', 'bones_remove_wp_widget_recent_comments_style', 1 );
	// clean up comment styles in the head
	// add_action( 'wp_head', 'bones_remove_recent_comments_style', 1 );
	// clean up gallery output in wp
	// add_filter( 'gallery_style', 'bones_gallery_style' );

	// enqueue base scripts and styles
	// add_action( 'wp_enqueue_scripts', 'bones_scripts_and_styles', 999 );
	// ie conditional wrapper

	// launching this stuff after theme setup
	bones_theme_support();

	// adding sidebars to Wordpress (these are created in functions.php)
	add_action( 'widgets_init', 'fen_register_sidebars' );
	// adding the bones search form (created in functions.php)
	// add_filter( 'get_search_form', 'bones_wpsearch' );

	// cleaning up random code around images
	add_filter( 'the_content', 'bones_filter_ptags_on_images' );
	// cleaning up excerpt
	add_filter( 'excerpt_more', 'bones_excerpt_more' );

} /* end bones ahoy */

/*********************
WP_HEAD GOODNESS
The default wordpress head is
a mess. Let's clean it up by
removing all the junk we don't
need.
*********************/

function bones_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
	// remove WP version from css
	add_filter( 'style_loader_src', 'bones_remove_wp_ver_css_js', 9999 );
	// remove Wp version from scripts
	add_filter( 'script_loader_src', 'bones_remove_wp_ver_css_js', 9999 );

} /* end bones head cleanup */

// remove WP version from RSS
function bones_rss_version() { return ''; }

// remove WP version from scripts
function bones_remove_wp_ver_css_js( $src ) {
	if ( strpos( $src, 'ver=' ) )
		$src = remove_query_arg( 'ver', $src );
	return $src;
}

// remove injected CSS for recent comments widget
function bones_remove_wp_widget_recent_comments_style() {
	if ( has_filter( 'wp_head', 'wp_widget_recent_comments_style' ) ) {
		remove_filter( 'wp_head', 'wp_widget_recent_comments_style' );
	}
}

// remove injected CSS from recent comments widget
function bones_remove_recent_comments_style() {
	global $wp_widget_factory;
	if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
		remove_action( 'wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style') );
	}
}

// remove injected CSS from gallery
// function bones_gallery_style($css) {
// 	return preg_replace( "!<style type='text/css'>(.*?)</style>!s", '', $css );
// }


/*********************
SCRIPTS & ENQUEUEING
*********************/

// loading modernizr and jquery, and reply script
function bones_scripts_and_styles() {
	global $wp_styles; // call global $wp_styles variable to add conditional wrapper around ie stylesheet the WordPress way
	if (!is_admin()) {

		// modernizr (without media query polyfill)
		// wp_register_script( 'bones-modernizr', get_stylesheet_directory_uri() . '/library/js/libs/modernizr.custom.min.js', array(), '2.5.3', false );

		// register main stylesheet
		// wp_register_style( 'bones-stylesheet', get_stylesheet_directory_uri() . '/library/css/style.css', array(), '', 'all' );

		// ie-only style sheet
		// wp_register_style( 'bones-ie-only', get_stylesheet_directory_uri() . '/library/css/ie.css', array(), '' );

		// comment reply script for threaded comments
		if ( is_singular() AND comments_open() AND (get_option('thread_comments') == 1)) {
			wp_enqueue_script( 'comment-reply' );
		}

		//adding scripts file in the footer
		// wp_register_script( 'bones-js', get_stylesheet_directory_uri() . '/library/js/scripts.js', array( 'jquery' ), '', true );

		// enqueue styles and scripts
		// wp_enqueue_script( 'bones-modernizr' );
		// wp_enqueue_style( 'bones-stylesheet' );
		// wp_enqueue_style( 'bones-ie-only' );

		// $wp_styles->add_data( 'bones-ie-only', 'conditional', 'lt IE 9' ); // add conditional wrapper around ie stylesheet

		/*
		I recommend using a plugin to call jQuery
		using the google cdn. That way it stays cached
		and your site will load faster.
		*/
		// wp_enqueue_script( 'jquery' );
		// wp_enqueue_script( 'bones-js' );

	}
}

/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function bones_theme_support() {

	// wp thumbnails (sizes handled in functions.php)
	add_theme_support( 'post-thumbnails' );

	// wp custom background (thx to @bransonwerner for update)
	add_theme_support( 'custom-background',
		array(
		'default-image' => '',  // background image default
		'default-color' => '', // background color default (dont add the #)
		'wp-head-callback' => '_custom_background_cb',
		'admin-head-callback' => '',
		'admin-preview-callback' => ''
		)
	);

	// rss thingy
	add_theme_support('automatic-feed-links');

	// to add header image support go here: http://themble.com/support/adding-header-background-image-support/

	// adding post format support
	add_theme_support( 'post-formats',
		array(
			'aside',             // title less blurb
			'gallery',           // gallery of images
			'link',              // quick link to other site
			'image',             // an image
			'quote',             // a quick quote
			'status',            // a Facebook like status update
			'video',             // video
			'audio',             // audio
			'chat'               // chat transcript
		)
	);

	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus
	register_nav_menus(
		array(
			// 'utilities-nav' => '[Header] Utilities Menu',
			'main-nav' => '[Header] Main Menu',
			// 'secondary-nav' => '[Header] Secondary Menu',

			'footer-main-nav' => '[Footer] Main Menu',

			// 'footer-first-col-nav' => '[Footer] First Menu',
			// 'footer-second-col-nav' => '[Footer] Second Menu',
			// 'footer-third-col-nav' => '[Footer] Third Menu',
			// 'footer-fourth-col-nav' => '[Footer] Fourth Menu',

			// 'footer-legal-nav' => '[Footer] Legal Menu'
		)
	);
} /* end bones theme support */


/*********************
MENUS & NAVIGATION
*********************/

function fen_main_nav(){
	wp_nav_menu(array(
		'theme_location' => 'main-nav',
		'menu'            => 'main-nav', // The menu that is desired; accepts (matching in order) id, slug, name
		// 'container'       => 'nav',
		'container_class' => 'main-nav-container collapse navbar-collapse', // Bootstrap collapse needed classes
		'container_id'    => 'main-nav',
		'menu_class'      => 'nav navbar-nav', // Bootstrap collapse needed classes
		'menu_id'         => 'main-nav-menu',
		'echo'            => true,
		'fallback_cb'     => false,
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'           => 0,
		'walker'          => ''
	));
}


function fen_footer_main_nav(){
	wp_nav_menu(array(
		'theme_location' => 'footer-main-nav',
		'menu'            => 'footer-main-nav', // The menu that is desired; accepts (matching in order) id, slug, name
		'container'       => 'nav',
		'container_class' => 'footer-main-nav-container', // You can put the col-xs-X here
		'container_id'    => 'footer-main-nav',
		'menu_class'      => 'menu',
		'menu_id'         => 'footer-main-nav-menu',
		'echo'            => true,
		'fallback_cb'     => false,
		'before'          => '',
		'after'           => '',
		'link_before'     => '',
		'link_after'      => '',
		'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
		'depth'           => -1,
		'walker'          => ''
	));
}


/*********************
RELATED POSTS FUNCTION
*********************/

// Related Posts Function (call using bones_related_posts(); )
function bones_related_posts() {
	echo '<ul id="bones-related-posts">';
	global $post;
	$tags = wp_get_post_tags( $post->ID );
	if($tags) {
		foreach( $tags as $tag ) { 
			$tag_arr .= $tag->slug . ',';
		}
		$args = array(
			'tag' => $tag_arr,
			'numberposts' => 5, /* you can change this to show more */
			'post__not_in' => array($post->ID)
		);
		$related_posts = get_posts( $args );
		if($related_posts) {
			foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>
				<li class="related_post"><a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach; }
		else { ?>
			<?php echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'bonestheme' ) . '</li>'; ?>
		<?php }
	}
	wp_reset_query();
	echo '</ul>';
} /* end bones related posts function */

/*********************
PAGE NAVI
*********************/

function fen_paginate_links(){
	// DOCS: http://codex.wordpress.org/Function_Reference/paginate_links
	global $wp_query;

	$big = 999999999; // need an unlikely integer
	if ( $wp_query->max_num_pages <= 1 )
		return;

	$args = array(
		'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format' => '?paged=%#%',
		'total' => $wp_query->max_num_pages,
		'current' => max( 1, get_query_var('paged') ),
		// 'show_all'     => False,
		'end_size'     => 1,
		'mid_size'     => 2,
		'prev_next'    => True,
		'prev_text'    => __('« Anterior'),
		'next_text'    => __('Siguiente »'),
		'type'         => 'list'
		// 'add_args'     => False,
		// 'add_fragment' => '',
		// 'before_page_number' => '',
		// 'after_page_number' => ''
	); 

	echo '<nav class="pagination">';
		echo paginate_links($args);
	echo '</nav>';
}

/*********************
RANDOM CLEANUP ITEMS
*********************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function bones_filter_ptags_on_images($content){
	return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link
function bones_excerpt_more($more) {
	global $post;
	// edit here if you like
	return '...  <a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __( 'Leer', 'nuevaweb' ) . get_the_title($post->ID).'">'. __( 'Leer Más &raquo;', 'nuevaweb' ) .'</a>';
}

/*
 * This is a modified the_author_posts_link() which just returns the link.
 *
 * This is necessary to allow usage of the usual l10n process with printf().
 */
function bones_get_the_author_posts_link() {
	global $authordata;
	if ( !is_object( $authordata ) )
		return false;
	$link = sprintf(
		'<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
		get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
		esc_attr( sprintf( __( 'Posts by %s' ), get_the_author() ) ), // No further l10n needed, core will take care of this one
		get_the_author()
	);
	return $link;
}

// -----------------------------------
// Post Categories function
// -----------------------------------
// Return the post categories
// It's necesary to echo the function when using it, ex: echo fen_categories();
function fen_categories(){
	$categories = get_the_category();
	$separator = ', ';
	if($categories):
		$category = '';
		foreach($categories as $category_meta):
			$category .= '<a href="'.get_category_link( $category_meta->term_id ).'" title="' . esc_attr( sprintf( __( "Ver todas las publicaciones en %s" ), $category_meta->name ) ) . '" itemprop="url"><span itemprop="title">'.$category_meta->cat_name.'</span></a>'.$separator; 
		endforeach;
		return trim($category, $separator);
	endif;

	return FALSE;
}

// -----------------------------------
// Breadcrumbs function
// -----------------------------------
// Return the post ancestors as breadcrumbs
// It's necesary to echo the function when using it, ex: echo fen_breadcrumbs();
function fen_breadcrumbs(){
	global $post;

	$post_ancestors = array_reverse(get_post_ancestors($post->ID));
	$separator = ' » ';
	$current_post = '<div class="current_post" id="'.get_post($ancestor)->post_name.'-breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb" itemprop="child">'.
						'<a href="'.get_permalink($post->ID).'" itemprop="url">
							<span itemprop="title">'.$post->post_title.'</span>
						</a>
					</div>';

	$is_category = get_category(get_query_var('cat'))->slug.'-breadcrumb';
	$is_single = get_the_category($post->ID)[0]->slug.'-breadcrumb';
	$is_page = get_post($post_ancestors[0])->post_name.'-breadcrumb';
	$is_tag = get_tag(get_query_var('tag_id'))->slug.'-breadcrumb';

	$child_id = is_page() ? $is_page : (is_single() ? $is_single : (is_category() ? $is_category : $is_tag));

	$breadcrumb = '<div id="inicio" itemscope itemtype="http://data-vocabulary.org/Breadcrumb" itemref="'.$child_id.'">
						<a href="'.get_bloginfo("url").'" itemprop="url">
							<span itemprop="title">Inicio</span>
						</a>'.$separator.
					'</div>';

	$container_opening = '<div class="breadcrumbs">';
	$container_closing = '</div>';

	if(is_page()):
		
		foreach ($post_ancestors as $key => $ancestor):
			$breadcrumb_id = get_post($ancestor)->post_name.'-breadcrumb';
			$child_id = get_post($post_ancestors[$key+1])->post_name.'-breadcrumb';
			$breadcrumb .= '<div id="'.$breadcrumb_id.'" itemscope itemtype="http://data-vocabulary.org/Breadcrumb" itemprop="child" itemref="'.$child_id.'">
								<a href="'.get_permalink($ancestor).'" itemprop="url">
									<span itemprop="title">'.get_post($ancestor)->post_title.'</span>
								</a>'.$separator.
							'</div>';
		endforeach;
		$breadcrumb .= $current_post;
		$breadcrumb = $container_opening.$breadcrumb.$container_closing;

		return trim($breadcrumb, $separator);
	elseif(is_category()):

		$cat_permalink = get_category_link(get_query_var('cat'));

		$breadcrumb .= '<div class="current_post" id="'.get_category(get_query_var('cat'))->slug.'-breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb" itemprop="child">
							<a href="'.$cat_permalink.'" itemprop="url">
								<span itemprop="title">'.get_category(get_query_var('cat'))->name.'</span>
							</a>'.
						'</div>';

		$breadcrumb = $container_opening.$breadcrumb.$container_closing;

		return $breadcrumb;
	elseif(is_single()):
		$first_category = get_the_category($post->ID)[0];
		$cat_permalink = get_category_link($first_category->term_id);


		$breadcrumb .= '<div id="'.$first_category->slug.'-breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb" itemprop="child" itemref="'.$post->post_name.'-breadcrumb">
							<a href="'.$cat_permalink.'" itemprop="url">
								<span itemprop="title">'.$first_category->name.'</span>
							</a>'.$separator.
						'</div>';

		$breadcrumb .= $current_post;
		$breadcrumb = $container_opening.$breadcrumb.$container_closing;

		return $breadcrumb;
	else:

		$breadcrumb .= '<div class="current_post" id="'.get_tag(get_query_var('tag_id'))->slug.'-breadcrumb" itemscope itemtype="http://data-vocabulary.org/Breadcrumb" itemprop="child">
							<a href="'.get_tag_link(get_query_var('tag_id')).'" itemprop="url">
								<span itemprop="title">'.get_tag(get_query_var('tag_id'))->name.'</span>
							</a>'.
						'</div>';

		$breadcrumb = $container_opening.$breadcrumb.$container_closing;

		return $breadcrumb;
	endif;
	
	return $breadcrumb;
}

// -----------------------------------
// Post Tags function
// -----------------------------------
// Return the post tags
// Its necesary to echo the function when using it, ex: echo fen_tags();
function fen_tags(){
	$posttags = get_the_tags();
	$separator = ', ';
	if($posttags):
		$tag = '';
		foreach($posttags as $meta_tag):
			$tag .= '<a href="'.get_tag_link($meta_tag->term_id).'">'.$meta_tag->name .'</a>'.$separator; 
		endforeach;
		return trim($tag, $separator);
	else:
		$tag = FALSE;
		return $tag;
	endif; 
}

?>
