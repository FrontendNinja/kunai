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

class APF_Fen_Settings_Structured_Data {

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
        'title'         => __( 'Datos Estructurados', 'front-end-ninja' ),
      )
    );  
    
    // load + page slug + tab slug
    add_action( 'load_' . $this->sPageSlug . '_' . $this->sTabSlug, array( $this, 'replyToLoadTab' ) );
  
  }
  
  /**
   * Triggered when the tab is loaded.
   */
  public function replyToLoadTab( $oAdminPage ) {
    
    add_action( 'do_' . $this->sPageSlug . '_' . $this->sTabSlug, array( $this, 'replyToDoTab' ) );
    
    // Section
    $oAdminPage->addSettingSections(    
      $this->sPageSlug, // the target page slug                
      array(
        'section_id'    => $this->sSectionID,
        'tab_slug'      => $this->sTabSlug,
        'title'         => __( 'Datos Estructurados', 'front-end-ninja' ),
        'description'   => __( 'Agrega la siguiente información para mejorar tu posicionamiento orgánico.', 'front-end-ninja' ),
        'content'       => array(
          array(
            'section_id'    => 'social-networks',
            'title'         => __( 'Redes Sociales', 'front-end-ninja' ),
            'collapsible'   => true,
          ),
        ),
      )
    );        
    
    $oAdminPage->addSettingFields(
      array($this->sSectionID, 'social-networks'), // the target section id
      array(
        'field_id'      => 'permalink',
        'type'          => 'text',
        'title'         => __( 'URL Red Social', 'front-end-ninja' ),
        'tip'           => __( 'Agrega la url de tus redes sociales, ej: http://facebook.com/NinjaFrontend. Lo que agregues no se mostrará en el diseño del sitio web.', 'front-end-ninja' ),
        'repeatable'    => true,
        'sortable'      => true,
        'description'   => __( 'Un link por bloque.', 'front-end-ninja' ),
        'attributes'    => array(                
          'placeholder' => 'http://facebook.com/NinjaFrontend',
        ),
      )
    );
    
  }
  
  public function replyToDoTab() {        
    submit_button();
  }
  
}