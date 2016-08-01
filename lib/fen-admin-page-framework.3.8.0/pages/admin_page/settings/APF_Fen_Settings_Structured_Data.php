<?php
/**
 * Admin Page Framework Loader
 * 
 * Demonstrates the usage of Admin Page Framework.
 * 
 * http://en.michaeluno.jp/admin-page-framework/
 * Copyright (c) 2013-2015 Michael Uno; Licensed GPLv2
 * 
 */

/**
 * Adds a tab of the set page to the loader plugin.
 * 
 * @since       3.5.0    
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
        'title'         => __( 'Datos Estructurados', 'admin-page-framework-loader' ),
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
        'title'         => __( 'Datos Estructurados', 'admin-page-framework-loader' ),
        'description'   => __( 'Agrega la siguiente información para mejorar tu posicionamiento orgánico.', 'admin-page-framework-loader' ),
        'content'       => array(
          array(
            'section_id'    => 'social-networks',
            'title'         => __( 'Redes Sociales', 'admin-page-framework-loader' ),
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
        'title'         => __( 'URL Red Social', 'admin-page-framework-loader' ),
        'tip'           => __( 'Agrega la url de tus redes sociales, ej: http://facebook.com/NinjaFrontend. Lo que agregues no se mostrará en el diseño del sitio web.', 'admin-page-framework-loader' ),
        'repeatable'    => true,
        'sortable'      => true,
        'description'   => __( 'Un link por bloque.', 'admin-page-framework-loader' ),
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