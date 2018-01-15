<?php
/**
* Set Up Page
* General Settings
*
* @author       xWaZzo @FrontendNinja
* @version      1.0.0
* @package      Advanced Custom Fields
* @subpackage   Front End Ninja
*/

/**
 * Hooks Before </head>
 *
 * @see favicon_link_tag
 * @see header_html_before_body
 * @see fen_main_alert
 */
add_action( 'wp_head', 'favicon_link_tag',        1 );
add_action( 'wp_head', 'the_page_styles',         100 );
add_action( 'wp_head', 'the_schema',              100 );
add_action( 'wp_head', 'header_html_before_body', 100 );
add_action( 'wp_head', 'fen_main_alert',          100 );

/**
 * Hooks After <body>
 *
 * @see header_html_after_body
 */
add_action( 'storefront_before_site', 'header_html_after_body', 100 );

 /**
 * Hooks Before </body>
 *
 * @see footer_html_before_body
 */
add_action( 'wp_footer',      'footer_html_before_body',    100 );
add_action( 'wp_footer',      'fen_main_alert_modal_init',  100 );



