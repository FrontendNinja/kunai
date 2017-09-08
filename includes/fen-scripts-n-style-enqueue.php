<?php 
/**
* Style & Javascript Enqueue
*/

function fen_enqueue_scripts(){
  wp_enqueue_style( 'fen_style', get_template_directory_uri(). '/assets/stylesheets/css/application.css', array(), null );
  wp_enqueue_script( "jquery" );
  wp_enqueue_script( 'fen-application',  get_template_directory_uri(). '/assets/javascripts/min/application-min.js', array(), null ); // Load Boostrap scripts with Codekit inside application.js for better performance.
}
add_action( 'wp_enqueue_scripts', 'fen_enqueue_scripts');