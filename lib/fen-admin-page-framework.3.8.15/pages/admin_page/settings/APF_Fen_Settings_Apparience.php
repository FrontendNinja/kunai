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
        'title'         => __( 'Apariencia', 'front-end-ninja-apf' ),
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
        'section_id'  => $this->sSectionID,
        'tab_slug'    => $this->sTabSlug,
        'title'       => __( 'Apariencia', 'front-end-ninja-apf' ),
        'description' => __( 'Modifica la apariencia del tema.', 'front-end-ninja-apf' ),
        'content'     => array(
          array(
            'section_id'  => 'main_settings',
            'title'       => __( 'Principal', 'front-end-ninja-apf' ),
            'collapsible' => true,
          ),
          array(
            'section_id'  => 'extra',
            'title'       => __( 'Estilos', 'front-end-ninja-apf'),
            'collapsible' => true,
          ),
          array(
            'section_id'  => 'alerts',
            'title'       => __( 'Alertas', 'front-end-ninja-apf'),
            'collapsible' => true,
          )
        ),
      )
    );        
    
    $oAdminPage->addSettingFields(
      array( $this->sSectionID, 'main_settings' ), // the target section id
      array(
        'field_id'    => 'logotype',
        'type'        => 'image',
        'title'       => __( 'Logotipo', 'front-end-ninja-apf' ),
        'description' => __( 'Tamaño sugerido de 100x140px.', 'front-end-ninja-apf' ),
        'attributes'  => array(                
          'preview' => array(
            'style' => 'max-width: 180px;',
          ),                
        ),
      ),
      array(
        'field_id'    => 'favicon',
        'type'        => 'image',
        'title'       => __( 'Favicon', 'front-end-ninja-apf' ),
        'description' => __( 'Archivo .png, Tamaño 16x16px. <br> <small><a href="https://es.wikipedia.org/wiki/Favicon">¿Qué es un favicon?</a></small>', 'front-end-ninja-apf' ),
        'attributes'  => array(      
          'preview' => array(
            'style' => 'max-width: 16px;',
          ),                
        ),
        'default'       => get_bloginfo('template_url').'/assets/images/favicon.png',
      ),
      array(
        'field_id'    => 'default_image',
        'type'        => 'image',
        'title'       => __( 'Imagen predeterminada', 'front-end-ninja-apf' ),
        'description' => __( 'Esta imagen aparecerá de manera predeterminada en la cabecera de las categorías de productos.', 'front-end-ninja-apf' ),
        'attributes'  => array(      
          'preview' => array(
            'style' => 'max-width: 300px;',
          ),                
        ),
        'default'     => get_bloginfo('template_url').'/assets/images/default-thumbnail.jpg',
      ),
      array(
        'field_id'    => 'error_404',
        'type'        => 'image',
        'title'       => __( 'Error 404', 'front-end-ninja-apf' ),
        'description' => __( 'Tamaño sugerido 1200x900 px. Esta imagen aparecerá en el Error 404.', 'front-end-ninja-apf' ),
        'attributes'  => array(      
          'preview' => array(
            'style' => 'max-width: 300px;',
          ),                
        )
      )
    );

    $oAdminPage->addSettingFields(
      array( $this->sSectionID, 'extra' ), // the target section id
      array(
        'field_id'    => 'ace_css_custom',
        'type'        => 'ace',     
        'title'       => __( 'Custom Css', 'front-end-ninja-apf' ),
        'description' => __( 'Será agregado al header bajo una etiqueta style', 'front-end-ninja-apf' ),
        'default'     => '/*.test{ background-color: #f00; }*/',
        'attributes'  =>  array(
          'cols'  => 60,
          'rows'  => 12,
        ),                
        'options'   => array(
          'language'  => 'css',
          'theme'     => 'monokai',
          'gutter'    => false,
          'readonly'  => false,
          'fontsize'  => 12,
        ),                
      )
    );

    $oAdminPage->addSettingFields(
      array( $this->sSectionID, 'alerts' ), // the target section id
      array(
        'field_id'    => 'main_alert',
        'type'        => 'textarea',
        'title'       => __( '<strong>Alerta Principal:</strong>', 'front-end-ninja-apf' ),
        'description' => __( 'Agrega una alerta al header de la página.', 'front-end-ninja-apf' ),
        'tip'         => __( 'Incluye la etiqueta "< br>" para agregar un "enter" al título. <br>Deja vacío el campo para no mostrar nada.', 'front-end-ninja-apf' ),
        'attributes'  => array(
          'placeholder' => __( 'Some text', 'front-end-ninja-apf' ),
          'size'        => 90,
        ),
      ),
      array(
        'field_id'    => 'main_alert_url',
        'type'        => 'text',
        'title'       => __( '<strong>URL Alerta Principal:</strong>', 'front-end-ninja-apf' ),
        'description' => __( 'Agrega una url a la alerta.', 'front-end-ninja-apf' ),
        'tip'         => __( 'Incluye http:// al iniciar la url.' ),
        'attributes'  => array(
          'placeholder' => __( 'http://' ),
          'size'        => 61,
        ),
      ),
      array(
        'field_id' => 'type',
        'type'     => 'select',
        'title'    => __( 'Tipo de Alerta', 'front-end-ninja-apf' ),
        'tip'      => __( 'Dependiendo del tipo de alerta que selecciones, cambiará el color de la misma, p, ej: "Success" es color verde.' ),
        'label'    => array(
                  0 =>  '--- ' . __( 'Alert Type', 'front-end-ninja-apf' ) . ' ---',
          'primary' =>  'Primary',
          'success' =>  'Success',
          'info'    =>  'Info',
          'warning' =>  'Warning',
          'danger'  =>  'Danger',
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