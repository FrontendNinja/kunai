<?php
/**
 * Front End Ninja
 * http://frontend.ninja
 */

/**
 * APF Fen Options
 * 
 * @date        08/03/2017
 * @since       1.0.0
 * @package     Front End Ninja
 */

class APF_Fen extends fen_AdminPageFramework {
    
    // Define the setUp() method to set how many pages, page titles and icons etc.
    public function setUp() {

        // Create the root menu
        $this->setRootMenuPage(
            'FEN',    // specify the name of the page group
            dirname( __FILE__ ) .'/assets/favicon.png'   // use 16 by 16 image for the menu icon.
        );

        // Add pages
        new APF_Fen_Settings( $this ); 
    }
   
   /**
     * Called when the admin pages added with this class get loaded.
     * 
     * Do some set-ups common in all the added pages and tabs.
     * 
     * Alternatively you can use load_{instantiated class name} hook.
     * @return      void
     */
    public function load() {
        
        // Disable the page heading tabs by passing false.
        $this->setPageHeadingTabsVisibility( false ); 
        
        // Set the tag used for in-page tabs. 
        $this->setInPageTabTag( 'h2' );     
                
    }  

   
    // There are more available filters and actions! Please refer to Demo 06 - Hooks.
}
// Instantiate the class object.
if ( is_admin() ) {
    new APF_Fen;
}
    
// That's it!! See, it's very short and easy, huh?