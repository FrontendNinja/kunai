<?php
/**
 * Front End Ninja
 * http://frontend.ninja
 */

/**
 * FEN Loader
 * 
 * @date        08/03/2017
 * @since       1.0.0
 * @package     Front End Ninja
 */

class AdminPageFrameworkLoader_fen {
    
    public function __construct() {

        $this->_registerClasses();
        
        // $this->_loadCustomPostType();
        
        // $this->_loadPostMetaBoxes();
        
        // $this->_loadTaxonomyFields();
        
        $this->_loadAdminPaeges();
        
        // $this->_loadWidgets();
            
        // $this->_loadUserMeta();

    }
    
        private function _loadCustomPostType() {

        }
        
        /**
         * Post meta boxes
         */
        private function _loadPostMetaBoxes() {
           if ( ! is_admin() ) { 
                return; 
            }
        }
      
        /**
         * Taxonomy
         */
        private function _loadTaxonomyFields() {
            
        }
      
        private function _loadAdminPaeges() {
          if ( ! is_admin() ) { 
              return; 
          }
         
          // // Admin Pages
          include( dirname( __FILE__ ) . '/pages/admin_page/APF_Fen.php' );
        }
      
        private function _loadUserMeta() {
        }
        
        private function _loadWidgets() {   
        }      
      
        /**
         * Registers classes to be auto-loaded.
         * @return      void
         */
        private function _registerClasses() {

            $_aClassFiles = array();
            include( dirname( __FILE__ ) . '/class-file-list.php' );
            new fen_AdminPageFramework_RegisterClasses( 
                array(),              // scanning directory paths
                array(),              // autoloader options
                $_aClassFiles         // pre-generated class list
            );            
            
        }
 
}
new AdminPageFrameworkLoader_fen;