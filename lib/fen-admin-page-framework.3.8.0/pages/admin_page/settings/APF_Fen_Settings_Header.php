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
                'title'         => __( 'Header', 'admin-page-framework-loader' ),
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
                'title'         => __( 'Header', 'admin-page-framework-loader' ),
                'description'   => __( 'Agrega Javascript antes del cierre de la etiqueta <code>head</code>.', 'admin-page-framework-loader' ),
            )
        );
        
        // Fields
        $oAdminPage->addSettingFields(
            $this->sSectionID, // the target section id
            array(
                'field_id'      => 'ace_html_header',
                'type'          => 'ace',     
                'title'         => __( 'HTML', 'admin-page-framework-loader' ),
                'description'         => __( 'Agrega aquí código de Google Analytics, Zopim, etc.', 'admin-page-framework-loader' ),
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