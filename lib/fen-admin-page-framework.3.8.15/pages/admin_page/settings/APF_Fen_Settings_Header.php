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

class APF_Fen_Settings_Header {

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
        'title'         => __( 'Header', 'front-end-ninja' ),
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
        'title'         => __( 'Header', 'front-end-ninja' ),
        'description'   => __( 'Agrega Javascript antes del cierre de la etiqueta <code>head</code>.', 'front-end-ninja' ),
      )
    );
    
    // Fields
    $oAdminPage->addSettingFields(
      $this->sSectionID, // the target section id
      array(
        'field_id'      => 'html_before_body',
        'type'          => 'ace',     
        'title'         => __( 'HTML Before Body Tag', 'front-end-ninja' ),
        'description'         => __( 'Add code that has to be before the <body> tag (Google Analytics, Zopim, etc.)', 'front-end-ninja' ),
        'default'       => '<!-- <script type="text/javascript">(function($) {})( jQuery );</script> -->',
        'attributes'    =>  array(
          'cols'        => 60,
          'rows'        => 12,
        ),                
        'options'   => array(
          'language'              => 'html',
          'theme'                 => 'monokai',
          'gutter'                => false,
          'readonly'              => false,
          'fontsize'              => 12,
        ),                
      ),
      array(
        'field_id'      => 'html_after_body',
        'type'          => 'ace',     
        'title'         => __( 'HTML After Body Tag', 'front-end-ninja' ),
        'description'         => __( 'Add code that has to be after the <body> tag.', 'front-end-ninja' ),
        'default'       => '<!-- <script type="text/javascript">(function($) {})( jQuery );</script> -->',
        'attributes'    =>  array(
          'cols'        => 60,
          'rows'        => 12,
        ),                
        'options'   => array(
          'language'              => 'html',
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
  private function registerFieldTypes( $sClassName ){
    new fen_AceCustomFieldType( $sClassName );
  }

  public function replyToDoTab() {        
    submit_button();
  }
  
}