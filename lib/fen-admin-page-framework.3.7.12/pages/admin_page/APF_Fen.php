<?php
/* 
    Plugin Name: Admin Page Framework Tutorial 03 - Create a Page Group
    Plugin URI: http://en.michaeluno.jp/admin-page-framework
    Description: Creates a page group with Admin Page Framework v3
    Author: Michael Uno
    Author URI: http://michaeluno.jp
    Version: 1.0.0
    Requirements: PHP 5.2.4 or above, WordPress 3.3 or above. Admin Page Framework 3.0.0 or above
*/
    
// Extend the class
class APF_Fen extends fen_AdminPageFramework {
    
    // Define the setUp() method to set how many pages, page titles and icons etc.
    public function setUp() {

        // Create the root menu
        $this->setRootMenuPage(
            'FEN Theme',    // specify the name of the page group
            fen_AdminPageFramework_Registry::$sDirPath .'/assets/favicon.png'   // use 16 by 16 image for the menu icon.
        );

        // Add pages
        new APF_Fen_Settings_Section( $this ); 
    }
   
       
   
    // There are more available filters and actions! Please refer to Demo 06 - Hooks.
}
// Instantiate the class object.
if ( is_admin() ) {
    new APF_Fen;
}
    
// That's it!! See, it's very short and easy, huh?