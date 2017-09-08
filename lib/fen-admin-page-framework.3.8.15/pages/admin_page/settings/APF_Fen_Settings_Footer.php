<?php
/**
 * Front End Ninja
 * http://frontend.ninja
 */

/**
 * Settings Apparience
 * 
 * @date        08/03/2017
 * @since       1.0.0
 * @package     Front End Ninja
 */

class APF_Fen_Settings_Footer {

  public function __construct( $oFactory, $sPageSlug, $sTabSlug ) {
  
    $this->oFactory     = $oFactory;
    $this->sClassName   = $oFactory->oProp->sClassName;
    $this->sPageSlug    = $sPageSlug; 
    $this->sTabSlug     = $sTabSlug;
    $this->sSectionID   = $this->sTabSlug;
         
    $this->_addTab();
  
  }
  
  private function _addTab() {
    
    $this->oFactory->addInPageTabs(    
      $this->sPageSlug, // target page slug
      array(
        'tab_slug'      => $this->sTabSlug,
        'title'         => __( 'Footer', 'front-end-ninja' ),
      )
    );  
    
    // load + page slug + tab slug
    add_action( 'load_' . $this->sPageSlug . '_' . $this->sTabSlug, array( $this, 'replyToLoadTab' ) );
  
  }
  
  /**
   * Triggered when the tab is loaded.
   */
  public function replyToLoadTab( $oAdminPage ) {
    
    
    $this->registerFieldTypes( $this->sClassName );
    
    add_action( 'do_' . $this->sPageSlug . '_' . $this->sTabSlug, array( $this, 'replyToDoTab' ) );
    
    // Section
    $oAdminPage->addSettingSections(    
      $this->sPageSlug, // the target page slug                
      array(
        'section_id'    => $this->sSectionID,
        'tab_slug'      => $this->sTabSlug,
        'title'         => __( 'Footer', 'front-end-ninja' ),
        'description'   => __( 'Agrega Javascript <strong>antes del cierre</strong> de la etiqueta <code>body</code>.', 'front-end-ninja' ),               
      )
    );        
    
    // Fields
    $oAdminPage->addSettingFields(
      $this->sSectionID, // the target section id
      array(
        'field_id'      => 'ace_html_footer',
        'type'          => 'ace',     
        'title'         => __( 'Html', 'front-end-ninja' ),
        'description'         => __( 'Agrega aquí javascript de ser necesario.', 'front-end-ninja' ),
        'default'       => '<!-- <script type="text/javascript">(function($) {})( jQuery );</script> -->',
        'attributes'    =>  array(
          'cols'        => 60,
          'rows'        => 12,
        ),                
        'options'   => array(
          'language'              => 'php',
          'theme'                 => 'monokai',
          'gutter'                => false,
          'readonly'              => false,
          'fontsize'              => 12,
        ),                
      )
    );             
    
  }
  
  /**
   * Registers the field types.
   */
  private function registerFieldTypes( $sClassName ) {
    new fen_AceCustomFieldType( $sClassName );                             
    
  }    
      
  
  public function replyToDoTab() {        
    submit_button();
  }
  
}