<?php 
/*
* You write all your custom functions here.
* Don't close the first php tag to avoid php issues.
*/

function the_page_styles(){
  echo get_page_styles();
}

/**
* Get Page Styles
* You can set inside this function all the args to create your custom css.
* @see create_page_styles at fen-create-page-styles.php
* 
* @param none
* You need to echo this function.
*/

function get_page_styles(){
  global $aFenOptions;

  $aExtra               = !empty($aFenOptions["apparience"]["extra"]) ? $aFenOptions["apparience"]["extra"] : '';

  $aExtraCSS = !empty($aExtra["ace_css_custom"]) ? array(
        'rules'     => $aExtra["ace_css_custom"],
        ) : '';

  $aSectionStyles = !empty($aExtra["ace_css_custom"]) ? array( $aExtraCSS ) : array();

  return !empty($aSectionStyles) ? create_page_styles($aSectionStyles) : '';
}

