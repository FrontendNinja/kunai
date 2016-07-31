<?php 
/*
* You write all your custom functions here.
* Don't close the first php tag to avoid php issues.
*/

function the_page_styles(){
  global $aFenOptions;

  $aMainSettings        = !empty($aFenOptions['apparience']['main-settings']) ? $aFenOptions['apparience']['main-settings'] : '';
  $aExtra               = !empty($aFenOptions['apparience']['extra']) ? $aFenOptions['apparience']['extra'] : '';
  $aAlerts              = !empty($aFenOptions['apparience']['alerts']) ? $aFenOptions['apparience']['alerts'] : '';

  $aHeader              = !empty($aFenOptions['apparience']['header']) ? $aFenOptions['apparience']['header']['ace_html_header'] : '';
  $aFooter              = !empty($aFenOptions['apparience']['footer']) ? $aFenOptions['apparience']['footer'] : '';

  $sLogotypeHeader      = !empty($aMainSettings['logotype_header']) ? $aMainSettings['logotype_header'] : '';
  $sLogotypeHeaderAttr  = array( 'alt' => get_bloginfo('name'), 'title' => get_bloginfo('name') );
  $sFavicon             = !empty($aMainSettings['favicon']) ? $aMainSettings['favicon'] : '';

  $aExtraCSS = !empty($aExtra['ace_css_custom']) ? array(
        'rules'     => $aExtra['ace_css_custom'],
        ) : '';

  $aSectionStyles = !empty($aExtra['ace_css_custom']) ? array( $aExtra ) : array();

  echo is_array($aSectionStyles) ? get_page_styles($aSectionStyles) : '';
}