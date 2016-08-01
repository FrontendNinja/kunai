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
class APF_Fen_Settings_Apparience {

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
        'title'         => __( 'Apariencia', 'admin-page-framework-loader' ),
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
        'title'         => __( 'Apariencia', 'admin-page-framework-loader' ),
        'description'   => __( 'Modifica la apariencia del tema.', 'admin-page-framework-loader' ),
        'content'       => array(
          array(
            'section_id'    => 'main-settings',
            'title'         => __( 'Principal', 'admin-page-framework-loader' ),
            'collapsible'   => true,
          ),
          array(
            'section_id'    => 'extra',
            'title'         => __( 'Extra', 'admin-page-framework-loader'),
            'collapsible'   => true,
          ),
          array(
            'section_id'    => 'alerts',
            'title'         => __( 'Alertas', 'admin-page-framework-loader'),
            'collapsible'   => true,
          )
        ),
      )
    );        
    
    $oAdminPage->addSettingFields(
      array( $this->sSectionID, 'main-settings' ), // the target section id
      array(
        'field_id'      => 'logotype',
        'type'          => 'image',
        'title'         => __( 'Logotipo', 'admin-page-framework-loader' ),
        'description'   => __( 'Tamaño sugerido de 100x140px.', 'admin-page-framework-loader' ),
        'attributes'    => array(                
          'preview' => array(
            'style' => 'max-width: 180px;',
          ),                
        ),
      ),
      array(
        'field_id'      => 'favicon',
        'type'          => 'image',
        'title'         => __( 'Favicon', 'admin-page-framework-loader' ),
        'description'   => __( 'Archivo .png, Tamaño 16x16px. <br> <small><a href="https://es.wikipedia.org/wiki/Favicon">¿Qué es un favicon?</a></small>', 'admin-page-framework-loader' ),
        'attributes'    => array(      
          'preview' => array(
            'style' => 'max-width: 16px;',
          ),                
        ),
        'default'       => get_bloginfo('template_url').'/assets/images/favicon.png',
      ),
      array(
        'field_id'      => 'default-image',
        'type'          => 'image',
        'title'         => __( 'Imagen predeterminada', 'admin-page-framework-loader' ),
        'description'   => __( 'Esta imagen aparecerá de manera predeterminada en la cabecera de las categorías de productos.', 'admin-page-framework-loader' ),
        'attributes'    => array(      
          'preview' => array(
            'style' => 'max-width: 300px;',
          ),                
        ),
        'default'       => get_bloginfo('template_url').'/assets/images/default-thumbnail.jpg',
      )
    );

    $oAdminPage->addSettingFields(
      array( $this->sSectionID, 'extra' ), // the target section id
      array(
        'field_id'      => 'ace_css_custom',
        'type'          => 'ace',     
        'title'         => __( 'Custom Css', 'admin-page-framework-loader' ),
        'description'         => __( 'Será agregado al header bajo una etiqueta style', 'admin-page-framework-loader' ),
        'default'       => '/*.test{ background-color: #f00; }*/',
        'attributes'    =>  array(
          'cols'        => 60,
          'rows'        => 12,
        ),                
        'options'   => array(
          'language'              => 'css',
          'theme'                 => 'monokai',
          'gutter'                => false,
          'readonly'              => false,
          'fontsize'              => 12,
        ),                
      )
    );

    $oAdminPage->addSettingFields(
      array( $this->sSectionID, 'alerts' ), // the target section id
      array(
        'field_id'          => 'main-alert',
        'type'              => 'textarea',
        'title'             => __( '<strong>Alerta Principal:</strong>', 'admin-page-framework' ),
        'description'       => __( 'Agrega una alerta al header de la página.', 'admin-page-framework' ),
        'tip'               => __( 'Incluye la etiqueta "< br>" para agregar un "enter" al título. <br>Deja vacío el campo para no mostrar nada.', 'admin-page-framework' ),
        'attributes'    => array(
          'placeholder' => __( 'Some text', 'admin-page-framework' ),
          'size'      => 90,
        ),
      ),
      array(
        'field_id'          => 'main-alert-url',
        'type'              => 'text',
        'title'             => __( '<strong>URL Alerta Principal:</strong>', 'admin-page-framework' ),
        'description'       => __( 'Agrega una url a la alerta.', 'admin-page-framework' ),
        'tip'               => __( 'Incluye http:// al iniciar la url.' ),
        'attributes'    => array(
          'placeholder' => __( 'http://' ),
          'size'      => 61,
        ),
      ),
      array(
        'field_id' => 'type',
        'type'     => 'select',
        'title'    => __( 'Tipo de Alerta', 'admin-page-framework' ),
        'tip'               => __( 'Dependiendo del tipo de alerta que selecciones, cambiará el color de la misma, p, ej: "Success" es color verde.' ),
        'label'    => array(
          0    =>  '--- ' . __( 'Alert Type', 'admin-page-framework' ) . ' ---',
          'primary'   =>  'Primary',
          'success'   =>  'Success',
          'info'      =>  'Info',
          'warning'   =>  'Warning',
          'danger'    =>  'Danger',
        ),
        'default'  => 0,
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