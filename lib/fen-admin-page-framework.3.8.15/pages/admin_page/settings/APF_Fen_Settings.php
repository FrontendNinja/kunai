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

class APF_Fen_Settings {

  public $oFactory;
  public $sClassName;
  public $sPageSlug;
  public $sPageTitle;
    
  public function __construct( $oFactory ) {
  
    $this->oFactory     = $oFactory;
    $this->sClassName   = $oFactory->oProp->sClassName;
    $this->sPageSlug    = 'apf_fen_settings';
    $this->sPageTitle   = __( 'Settings', 'front-end-ninja' );

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
        'header'            // tab slug 
      );   

      new APF_Fen_Settings_Footer(
        $this->oFactory,    // factory object
        $this->sPageSlug,   // page slug
        'footer'            // tab slug 
      );   

      new APF_Fen_Settings_Apparience(
        $this->oFactory,    // factory object
        $this->sPageSlug,   // page slug
        'apparience'        // tab slug 
      );   

      new APF_Fen_Settings_Structured_Data(
        $this->oFactory,    // factory object
        $this->sPageSlug,   // page slug
        'structured_data'   // tab slug 
      );

      new APF_Fen_Settings_Social_Networks(
        $this->oFactory,    // factory object
        $this->sPageSlug,   // page slug
        'social_networks'   // tab slug 
      );

      new APF_Fen_Settings_Credits(
        $this->oFactory,    // factory object
        $this->sPageSlug,   // page slug
        'credits'           // tab slug 
      );   
          
    }
  
    
}
