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
                'title'         => __( 'Apparience', 'admin-page-framework-loader' ),
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
                        'description'   => __( 'Lo primero es cambiar el logotipo.' ),
                        'collapsible'   => true,
                    ),
                    // array(
                    //     'section_id'    => 'colors',
                    //     'title'         => __( 'Colores', 'admin-page-framework-loader'),
                    //     'description'   => __( 'Personaliza los colores del sitio web.' ),
                    //     'collapsible'   => true,
                    // ),
                    array(
                        'section_id'    => 'extra',
                        'title'         => __( 'Extra', 'admin-page-framework-loader'),
                        'description'   => __( 'Agrega custom CSS o cambia el tamaño general de la tipografía.' ),
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
                'field_id'      => 'logotype-mobile',
                'type'          => 'image',
                'title'         => __( 'Logotipo pequeño <small>(Opcional)</small>', 'admin-page-framework-loader' ),
                'description'   => __( 'Reemplazará al original y se mostrará en dispositivos móviles. Tamaño sugerido de 30px de alto x máximo 150px de ancho. <br> <small>Si no se elige, el logotipo principal se escalará para dispositivos móviles.</small>', 'admin-page-framework-loader' ),
                'attributes'    => array(                
                    'preview' => array(
                        'style' => 'max-width: 150px;',
                    ),                
                ),
            ),
            array(
                'field_id'      => 'logotype-tag-line',
                'type'          => 'text',
                'title'         => __( 'Tag line <small>(Opcional)</small>', 'admin-page-framework-loader' ),
                'description'   => __( 'Acompaña tu logotipo con el nombre de la empresa o algún otro texto.', 'admin-page-framework-loader' ),
                'attributes'    => array(                
                    'placeholder' => get_bloginfo('name'),                
                ),
            ),
            array(
                'field_id'      => 'logotype-tag-line-mobiles',
                'type'          => 'checkbox',
                'title'         => __( 'Mostrar el "Tag line" en móviles? <small>(Opcional)</small>', 'admin-page-framework-loader' ),
                'label'         => __( 'Sí.', 'admin-page-framework-loader' ),
                'default'       => true,
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
                'description'   => __( 'Esta imagen aparecerá de manera predeterminada en las páginas interiores a un lado del título.', 'admin-page-framework-loader' ),
                'attributes'    => array(      
                    'preview' => array(
                        'style' => 'max-width: 300px;',
                    ),                
                ),
                'default'       => get_bloginfo('template_url').'/assets/images/default-thumbnail.jpg',
            )
        );

        // Manage Website colors for templates
        // $oAdminPage->addSettingFields(
        //     array( $this->sSectionID, 'colors' ), // the target section id
        //     array(
        //         'field_id'      => 'main-color',
        //         'type'          => 'color',
        //         'title'         => __( 'Principal', 'admin-page-framework-loader' ),
        //         'description'   => __( 'Color de fondo para Header, Content y Footer.', 'admin-page-framework-loader' ),
        //         'default'       => '#ffffff',
        //     ),
        //     array(
        //         'field_id'      => 'main-contrast-color',
        //         'type'          => 'color',
        //         'title'         => __( 'Contraste principal', 'admin-page-framework-loader' ),
        //         'description'   => __( 'Color para textos, títulos en Header, Content y Footer.', 'admin-page-framework-loader' ),
        //         'default'       => '#000000',
        //     ),
        //     array(
        //         'field_id'      => 'link-color',
        //         'type'          => 'color',
        //         'title'         => __( 'Links', 'admin-page-framework-loader' ),
        //         'description'   => __( 'Color para los links en general. <br><small>(Excepto en Header y Footer)</small>', 'admin-page-framework-loader' ),
        //         'default'       => '#73734B',
        //     ),
        //     array(
        //         'field_id'      => 'footer-link-color',
        //         'type'          => 'color',
        //         'title'         => __( 'Footer Links', 'admin-page-framework-loader' ),
        //         'description'   => __( 'Color para los links que aparecen en el Footer.', 'admin-page-framework-loader' ),
        //         'default'       => '#737373',
        //     ),
        //     array(
        //         'field_id'      => 'secondary-color',
        //         'type'          => 'color',
        //         'title'         => __( 'Secundario', 'admin-page-framework-loader' ),
        //         'description'   => __( 'Color de fondo para el sitio web.', 'admin-page-framework-loader' ),
        //         'default'       => '#e6e6de',
        //     ),
        //     array(
        //         'field_id'      => 'credits-color',
        //         'type'          => 'color',
        //         'title'         => __( 'Créditos', 'admin-page-framework-loader' ),
        //         'description'   => __( 'Color de fondo para los créditos y legal.', 'admin-page-framework-loader' ),
        //         'default'       => '#344043',
        //     )
        // );

        $oAdminPage->addSettingFields(
            array( $this->sSectionID, 'extra' ), // the target section id
            array(
                'field_id'      => 'font_size',
                'type'          => 'size',
                'title'         => __( 'Font Size', 'admin-page-framework-loader' ),
                'description'   => __( 'El tamaño original es 14px.', 'admin-page-framework-loader' ),
            ),
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