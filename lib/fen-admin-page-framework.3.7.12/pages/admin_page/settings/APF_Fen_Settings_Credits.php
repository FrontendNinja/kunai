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
                'title'         => __( 'Créditos', 'admin-page-framework-loader' ),
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
                'title'         => __( 'Créditos', 'admin-page-framework-loader' ),
                'description'   => array(
                     sprintf( 
                        __( 'Theme developed by <a href="%1$s">%2$s</a>.', 'admin-page-framework-loader' ),
                        ( is_ssl() ? 'https:' : 'http:' ) . '//nuevaweb.com.mx/#405',
                        __( 'NuevaWeb\'s team', 'admin-page-framework-loader' )
                    ),
                ),
                'content'       => array(
                    array(
                        'section_id'    => 'support',
                        'title'         => __( 'Soporte', 'admin-page-framework-loader' ),
                    ),
                    array(
                        'section_id'    => 'staff',
                        'title'         => __( 'Staff', 'admin-page-framework-loader' ),
                        'description'   => 'Equipo encargado del desarrollo.',
                    )
                )
            )
         );        
        
        // Fields
        $oAdminPage->addSettingFields(
            array( $this->sSectionID, 'support', ), // the target section id
            array(
                'field_id'          => 'tech_details',
                'title'             => __( 'Detalles técnicos', 'admin-page-framework-loader' ),
                'type'              => 'tech_details',
                'content'           => "<p>Tema desarrollado en diciembre de 2015 para Wordpress bajo la Versión 4.4.<br>
                                        Frameworks: Bootstrap 3.3.6, FontAwesome 4.5.0, Admin Page Framework 3.7.1</p>",
            ),
            array(
                'field_id'          => 'plugins',
                'title'             => __( 'Plugins necesarios', 'admin-page-framework-loader' ),
                'type'              => 'plugins',
                'content'           => "<p>
                                            <a href='".( is_ssl() ? 'https:' : 'http:' )."//es.wordpress.org/plugins/wc-shortcodes/' target='_blank'>Contact From 7</a>, 
                                            <a href='".( is_ssl() ? 'https:' : 'http:' )."//es.wordpress.org/plugins/contact-form-7/' target='_blank'>WP Canvas - Shortcodes</a></p>",
            )
        );
        $oAdminPage->addSettingFields(
            array( $this->sSectionID, 'staff', ), // the target section id
            array(
                'field_id'          => 'credits_1',
                'title'             => __( 'Project Manager', 'admin-page-framework-loader' ),
                'type'              => 'project_manager',
                'content'           => "<p>Juan José González.</p>",
            ),
            array(
                'field_id'          => 'credits_2',
                'title'             => __( 'Front End', 'admin-page-framework-loader' ),
                'type'              => 'front_end',
                'content'           => "<p>Eduardo Martínez.</p>",
            ),
            array(
                'field_id'          => 'credits_3',
                'title'             => __( 'Front End Assistant', 'admin-page-framework-loader' ),
                'type'              => 'front_end_assistant',
                'content'           => "<p>Libertad Madrigal.</p>",
            ),
            array(
                'field_id'          => 'credits_4',
                'title'             => __( 'Back End', 'admin-page-framework-loader' ),
                'type'              => 'back_end',
                'content'           => "<p>Carlos González.</p>",
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