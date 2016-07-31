<?php
/*
* You should asign a function for each template.
*/

if( ! function_exists('fen_template_post_content') ){
  function fen_template_post_content(){
    include(get_template_directory() . '/templates/post-content.php');
  }
}

