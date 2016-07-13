<?php 
/**
* Style & Javascript Enqueue
*/

function fen_enqueue_scripts(){
  wp_enqueue_style( 'fen_style', get_template_directory_uri(). '/assets/stylesheets/css/application.css' );
  wp_enqueue_style( 'swiper-css', get_template_directory_uri(). '/lib/Swiper-3.3.1/dist/css/swiper.min.css' );
  wp_enqueue_script( "jquery" );
  wp_enqueue_script( 'fen-application',  get_template_directory_uri(). '/assets/javascripts/min/application-min.js' ); // Load Boostrap scripts with Codekit inside application.js for better performance.
  wp_enqueue_script( 'swiper-js',  get_template_directory_uri(). '/lib/Swiper-3.3.1/dist/js/swiper.min.js', 'jquery' ); 
}
add_action( 'wp_enqueue_scripts', 'fen_enqueue_scripts');