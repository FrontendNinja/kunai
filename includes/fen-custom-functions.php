<?php 
/*
* You write all your custom functions here.
* Don't close the first php tag to avoid php issues.
*/

function the_page_styles(){
  echo get_page_styles();
}

/**
* @author xWaZzo @FrontEndNinja
* @version 1.0.1    2017/04/16  Better organization.
*
* Get Page Styles
* You can set inside this function all the args to create your custom css.
* You need to echo this function.
* @see create_page_styles at fen-create-page-styles.php
* 
* @param none
*/
function get_page_styles(){
  global $aFenOptions;

  $aExtra     = !empty($aFenOptions["apparience"]["extra"]) ? $aFenOptions["apparience"]["extra"] : '';
  $sError404  = !empty($aFenOptions["apparience"]["main_settings"]["error_404"])  ? $aFenOptions["apparience"]["main_settings"]["error_404"]  : '';

  /* Error 404 */
  if(!empty($sError404)){
    $aError404CSS = array(
          'selector'  => "#error-404",
          'rules'     => array(
            'background-image'  => "url(" . $sError404 .")" 
            )
          );

    $aStyles[] = $aError404CSS;
  }

  /* Custom CSS */
  if(!empty($aExtra["ace_css_custom"])){
    $aExtraCSS = array(
          'rules'     => $aExtra["ace_css_custom"]
          );

    $aStyles[] = $aExtraCSS;
  }

  /**
  * Create the Page Styles 
  * @see fen-create-page-styles.php
  */
  return !empty($aStyles) ? create_page_styles($aStyles) : '';
}

