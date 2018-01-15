<?php
/**
* Set Up Page
* General Settings
*
* @author       xWaZzo @FrontendNinja
* @version      1.0.0
* @package      Advanced Custom Fields
* @subpackage   Front End Ninja
*/

if( ! function_exists('header_html_before_body') ){
  /**
  * Return "Header HTML Before" field
  * @return string|empty   Echo if the option has content
  */
  function header_html_before_body(){
    $html = get_field('header_html_before_body', 'options');
    
    echo $html ? $html : "";
  }
}

if( ! function_exists('favicon_link_tag') ){
  /**
  * Return "Header HTML Before" field
  * @return string|empty   Echo if the option has content
  */
  function favicon_link_tag(){
    $favicon = get_field('favicon', 'options');

    $favicon = $favicon ? $favicon : get_bloginfo('template_url').'/assets/images/favicon.png';

    echo "<link rel='icon' href='{$favicon}'>";
  }
}

if( ! function_exists('fen_main_alert') ){
  /**
  * Return "Header HTML Before" field
  * @return string|empty   Echo if the option has content
  */
  function fen_main_alert(){
    /* Alert Description */
    $alert_description  = get_field('alert_description', 'options');

    /* Return early if no description */
    if(!$alert_description) return;

    /**
    * Is this modal? 
    * @return bool
    */
    $alert_type = get_field('alert_type', 'options');

    /* Modal */
    if($alert_type){

      /* Alert Title */
      $alert_title = get_field('alert_title', 'options'); ?>

      <div class="modal fade" id="main-alert" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content"><?php 
            if($alert_title){ ?>
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?php echo $alert_title; ?></h4>
              </div><?php
            } ?>
            <div class="modal-body"><?php 
              echo apply_filters('the_content', $alert_description); ?>
            </div>
          </div>
        </div>
      </div><?php
    }else{
      /* Alert Url only for normal alert */
      $alert_url    = get_field('alert_url', 'options');
      
      /* Alert Type: success, info, warning, danger, primary, secondary */
      $alert_style  = get_field('alert_style', 'options');
      
      /* Add or remove click to Main Logo */
      $sOpenSelector   = $alert_url ? "div" : "a href='{$alert_url}'";
      $sCloseSelector  = $alert_url ? "div" : "a";
      
      $sAlertOpen   = "<{$sOpenSelector} id='main-alert' class='alert {$alert_style}'>";
      $sAlertClose  = "</{$sCloseSelector}>"; 

      echo $sAlertOpen; ?>
        <div class="container">
          <div class="row">
            <div class="col-xs-12"><?php 
              echo apply_filters('the_content', $alert_description); ?>
            </div>
          </div>
        </div><?php 
      echo $sAlertClose;
    }
  }
}

if( ! function_exists('fen_main_alert_modal_init') ){
  /**
  * Init Alert Modal
  * @return string   Echo init Javascript
  */
  function fen_main_alert_modal_init(){
    $isModal = get_field('alert_type', 'options'); 

    /* Return early if alert type is not a modal */
    if(!$isModal) return; ?>

    <script type="text/javascript">
      (function($){
        $('#main-alert').modal();
      })(jQuery);
    </script><?php
  }
}

if( ! function_exists('header_html_after_body') ){
  /**
  * Return "Header HTML After" field
  * @return string|empty   Echo if the option has content
  */
  function header_html_after_body(){
    $html = get_field('header_html_after_body', 'options');

    echo $html ? $html : "";
  }
}

if( ! function_exists('footer_html_before_body') ){
  /**
  * Return "Footer HTML Before" field
  * @return string|empty   Echo if the option has content
  */
  function footer_html_before_body(){
    $html = get_field('footer_html_before_body', 'options');
    
    echo $html ? $html : "";
  }
}

if( ! function_exists('fen_title') ){
  function fen_title(){
    $sHomeTitle = get_bloginfo('description') . " | " . get_bloginfo('name'); // Docs: https://moz.com/learn/seo/title-tag
    $sElseTitle = trim(wp_title('', false)) . " | " . get_bloginfo('name');

    return is_home() ? $sHomeTitle : $sElseTitle;
  }
}
if( ! function_exists('fen_seo') ){
  function fen_seo(){

    $sCurrentUrl          = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; 

    /*
    <meta name="author" content="<?php bloginfo('name'); ?>">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <link rel="alternate" hreflang="es-mx" href="<?php echo $sCurrentUrl; ?>">

    <!-- SEO -->
    <meta name="description" content="Exchange de Bitcoin y Ether en Mexico">
    <meta name="google" content="notranslate">
    <meta name="format-detection" content="telephone=no">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@omiex">
    <meta name="twitter:title" content="Exchange de Bitcoin y Ether en México">
    <meta name="twitter:description" content="Compra y vende Bitcoins y Ether en Mexico">
    <meta name="twitter:image" content="assets/images/twitter-omiex.jpg">
    <meta property="og:title" content="Exchange de Bitcoin y Ether en México">
    <meta property="og:description" content="Compra y vende Bitcoins y Ether en Mexico">
    <meta property="og:image" content="assets/images/open-graph-omiex.png">
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <link rel="apple-touch-icon" sizes="144x144" href="assets/images/apple-touch-icon-144x144-precomposed.png">
    <link rel="apple-touch-icon" sizes="114x114" href="assets/images/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" sizes="72x72" href="assets/images/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" sizes="57x57" href="assets/images/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" href="assets/images/apple-touch-icon-precomposed.png">
    <link rel="image_src" type="image/png" href="assets/images/icon-facebook.png">
    */
  }

}