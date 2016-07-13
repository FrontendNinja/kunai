<?php 
function fen_setup_theme() {
  
  /* WP Menus */
  add_theme_support( 'menus' );
  fen_register_menus();

  add_theme_support( 'post-thumbnails' ); // wp thumbnails (sizes handled in functions.php)
  add_theme_support('automatic-feed-links'); // rss thingy
  // to add header image support go here: http://themble.com/support/adding-header-background-image-support/
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
  ); // adding post format support

  /* Setup Filterss */
  add_filter( 'the_content', 'fen_filter_ptags_on_images' );
  add_filter( 'excerpt_more', 'fen_excerpt_more' );

  /* Widget Areas Init */
  add_action( 'widgets_init', 'fen_register_sidebars' ); // adding sidebars to Wordpress
}

/**
* Filter      Remove the p from around imgs
* Docs: http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/
*/
function fen_filter_ptags_on_images($content){
  return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

/*
* Filter      Excerpts Read more
* Change […] to a Read More link
*/
// This removes the annoying […] to a Read More link
function fen_excerpt_more($more) {
  global $post;
  // edit here if you like
  return '...  <a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __( 'Leer', 'front-end-ninja' ) . get_the_title($post->ID).'">'. __( 'Leer Más &raquo;', 'front-end-ninja' ) .'</a>';
}