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

class APF_Fen_Settings_Credits {

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
        'title'         => __( 'Créditos', 'front-end-ninja' ),
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
        'title'         => __( 'Créditos', 'front-end-ninja' ),
        'description'   => array(
           sprintf( 
            __( 'Theme developed by <a href="%1$s">%2$s</a>.', 'front-end-ninja' ),
            ( is_ssl() ? 'https:' : 'http:' ) . '//frontend.ninja/',
            __( 'Ninjas!', 'front-end-ninja' )
          ),
        ),
        'content'       => array(
          array(
            'section_id'    => 'support',
            'title'         => __( 'Soporte', 'front-end-ninja' ),
          ),
          array(
            'section_id'    => 'ninjas',
            'title'         => __( 'Ninjas', 'front-end-ninja' ),
            'description'   => __( 'Equipo ninja a cargo del desarrollo.', 'front-end-ninja'), //Developing Shinobi Squad
          )
        )
      )
     );        
    
    // Fields
    $oAdminPage->addSettingFields(
      array( $this->sSectionID, 'support', ), // the target section id
      array(
        'field_id'          => 'tech_details',
        'title'             => __( 'Detalles técnicos', 'front-end-ninja' ),
        'type'              => 'tech_details',
        'content'           => "<p>Tema desarrollado en 2017 para Wordpress bajo la versión 4.8.1<br>
                                <strong>Frameworks:</strong> Bootstrap 3.3.7, FontAwesome 4.7.0, Admin Page Framework 3.8.15</p>",
      ),
      array(
        'field_id'          => 'plugins',
        'title'             => __( 'Plugins sugeridos', 'front-end-ninja' ),
        'type'              => 'plugins',
        'content'           => "<p>
                      <a href='".( is_ssl() ? 'https:' : 'http:' )."//es.wordpress.org/plugins/wc-shortcodes/' target='_blank'>Contact From 7</a>, 
                      <a href='".( is_ssl() ? 'https:' : 'http:' )."//es.wordpress.org/plugins/contact-form-7/' target='_blank'>WP Canvas - Shortcodes</a></p>",
      )
    );
    $oAdminPage->addSettingFields(
      array( $this->sSectionID, 'ninjas', ), // the target section id
      array(
        'field_id'          => 'credits_1',
        'title'             => __( 'Front End Designer', 'front-end-ninja' ),
        'type'              => 'front_end_assistant',
        'content'           => "<p><a href=\"http://frontend.ninja/author/lima/\">Libertad Madrigal</a></p>",
      ),
      array(
        'field_id'          => 'credits_2',
        'title'             => __( 'Back End Developer', 'front-end-ninja' ),
        'type'              => 'back_end',
        'content'           => "<p><a href=\"http://frontend.ninja/author/xwazzo/\">Carlos González</a></p>",
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
    // submit_button();
  }
  
}