<?php
/**
 * Admin Page Framework Loader
 * 
 * http://en.michaeluno.jp/admin-page-framework/
 * Copyright (c) 2013-2015 Michael Uno; Licensed GPLv2
 * 
 */

/**
 * Adds the Custom Field Type page to the loader plugin.
 * 
 * @since       3.5.0  
 * @package     AdminPageFramework
 * @subpackage  Example 
 */
class APF_Fen_Settings_Section {

    public $oFactory;
    public $sClassName;
    public $sPageSlug;
    public $sPageTitle;
        
    public function __construct( $oFactory ) {
    
        $this->oFactory     = $oFactory;
        $this->sClassName   = $oFactory->oProp->sClassName;
        $this->sPageSlug    = 'apf_fen_settings';
        $this->sPageTitle   = __( 'Settings', 'admin-page-framework-loader' );

        $this->_addPage();
               
    }
        
        /**
         * Adds an admin page.
         */
        private function _addPage() {
            
            $this->oFactory->addSubMenuItems( 
                array(
                    'title'         => $this->sPageTitle,
                    'page_slug'     => $this->sPageSlug,    // page slug
                )
            );

            // Tabs
            new APF_Fen_Settings_Header(
                $this->oFactory,    // factory object
                $this->sPageSlug,   // page slug
                'header'       // tab slug 
            );   

            new APF_Fen_Settings_Footer(
                $this->oFactory,    // factory object
                $this->sPageSlug,   // page slug
                'footer'       // tab slug 
            );   

            new APF_Fen_Settings_Apparience(
                $this->oFactory,    // factory object
                $this->sPageSlug,   // page slug
                'apparience'       // tab slug 
            );   

            new APF_Fen_Settings_Credits(
                $this->oFactory,    // factory object
                $this->sPageSlug,   // page slug
                'credits'       // tab slug 
            );   
                    
        }
  
        
}
