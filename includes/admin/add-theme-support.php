<?php 

/* 
* Admin Log In
* we're firing all out initial functions at the start
* - after_setup_theme
*/
add_action( 'after_setup_theme', 'fen_setup_theme', 16 );

/* 
* Admin Log In
* calling it only on the login page
* - login_enqueue_scripts
* - login_headerurl
* - login_headertitle
*/
add_action( 'login_enqueue_scripts', 'fen_login_css', 10 );
add_filter( 'login_headerurl', 'fen_login_url' );
add_filter( 'login_headertitle', 'fen_login_title' );