<?php
/**
* Control Panel
* Create and manage Theme Set up for the website.
*
* @author       xWaZzo @FrontendNinja
* @version      1.0.0
* @package      Advanced Custom Fields
* @subpackage   Front End Ninja
*/

/**
* Import Advanced Custom Fields Library
*/
require_once( __DIR__ . '/library/advanced-custom-fields-pro/acf.php' );

/**
* Update the plugin directory url
*/
if( function_exists('acf_update_setting') ) {
  function dir_url() {
    acf_update_setting('dir', get_stylesheet_directory_uri() . "/includes/admin-page/library/advanced-custom-fields-pro/");
  }

  add_action('acf/init', 'dir_url');
}

/**
* Code Field Support
*
* Original file edited by xWaZzo @FrontEndNinja to fix plugin paths
*
* @see acf-code-field-v5.php:190
* $dir = get_template_directory_uri() . "/lib/acf-code-field/";
*
* @see acf-code-field-v5.php:146
* $dir = get_template_directory_uri() . "/lib/acf-code-field/";
*/
require_once( __DIR__ . "/library/acf-code-field/acf-code-field.php" );

/**
* Admin Pages
*/
require_once( "acf-admin-pages.php" );

/**
* Control Panel Functions and Hooks
*/
require_once( "fen-control-panel-functions.php" );
require_once( "fen-control-panel-hooks.php" );








