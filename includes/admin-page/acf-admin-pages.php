<?php
/**
* FEN Template Control Panel
* Add New Admin Pages here
*
* @author       xWaZzo @FrontendNinja
* @version      1.0.0
* @package      Advanced Custom Fields
* @subpackage   Front End Ninja
*/
if( function_exists('acf_add_options_page') ) {
  
  acf_add_options_page(array(
    'page_title'  => 'Theme Settings',
    'menu_title'  => 'Theme Settings',
    'menu_slug'   => 'theme-settings',
    'capability'  => 'edit_posts',
    'redirect'    => false,
    'icon_url'    => get_stylesheet_directory_uri() . '/includes/admin-page/images/fen-favicon.png'
  ));
  
  acf_add_options_page(array(
    'page_title'  => 'Set Up',
    'menu_title'  => 'Set Up',
    'parent_slug' => 'theme-settings',
  ));

  acf_register_form(array(
    'id'            => 'new-event',
    'post_id'       => 'new_post',
    'new_post'      => array(
      'post_type'   => 'event',
      'post_status' => 'publish'
    ),
    'post_title'    => true,
    'post_content'  => true,
  ));


}

/**
* Code Field Support
*/
require_once( __DIR__ . "/../admin-page/set-up/acf-set-up-control-panel.php" );



