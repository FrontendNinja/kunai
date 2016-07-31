<?php 

/**
* Admin Log In at fen-default-setup.php
* We're firing all out initial functions at the start
*
* @see fen_setup_theme
*/
add_action( 'after_setup_theme', 'fen_setup_theme', 16 );

/**
* Admin Log In at fen-admin-login.php
* Log in styles, url and title
*
* @see fen_login_css
* @see fen_login_url
* @see fen_login_title
*/
add_action( 'login_enqueue_scripts', 'fen_login_css', 10 );
add_filter( 'login_headerurl', 'fen_login_url' );
add_filter( 'login_headertitle', 'fen_login_title' );