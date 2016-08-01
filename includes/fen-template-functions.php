<?php
/*
* You should asign a function for each template.
*/

if( ! function_exists('fen_template_post_content') ){
  function fen_template_post_content(){
    include(get_template_directory() . '/templates/post-content.php');
  }
}

if( ! function_exists('fen_template_post_feed') ){
  function fen_template_post_feed(){
    include(get_template_directory() . '/templates/post-feed.php');
  }
}

