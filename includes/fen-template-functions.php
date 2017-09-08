<?php
/**
* Template functions used by hooks
* @see fen-template-hooks.php
*/
/**
* Post Content Function
* Used for single.php and page.php to display the same template
*/
if( ! function_exists('fen_template_post_content') ){
  function fen_template_post_content(){
    include(get_template_directory() . '/template-parts/content/post-content.php');
  }
}

/**
* Post Feed Function
* Used for archives and index to display the post feed
*/
if( ! function_exists('fen_template_post_feed') ){
  function fen_template_post_feed(){
    include(get_template_directory() . '/template-parts/content/post-feed.php');
  }
}

/**
* Archive Feed template function
*/
if( ! function_exists('fen_template_archive_feed') ){
  function fen_template_archive_feed(){
    include(get_template_directory() . '/template-parts/archive/archive-feed.php');
  }
}