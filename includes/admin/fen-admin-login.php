<?php

/**
* Admin Log in and CSS
* calling your own login css so you can style it
*/
function fen_login_css(){
	wp_enqueue_style('fen_login_css', get_template_directory_uri().'/css/login.css', false);
}
// changing the logo link from wordpress.org to your site
function fen_login_url() {  return home_url(); }
// changing the alt text on the logo to show your site name
function fen_login_title() { return get_option( 'blogname' ); }