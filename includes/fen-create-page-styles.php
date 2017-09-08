<?php
/**
* Function create_page_styles($aPageStyles)
* Create CSS with PHP! Easy and fast!
* @version    1.0.0 // 13/01/2017
* @author     xWaZzo @ Front End Ninja
* @changelog  Loop verify that $sCssValue is not empty.
* @param      array     (Required)      $aPageStyles.       Options from APF_Fen_OnePager
* @return     string     Page styles within <style> selector.
*
* Example:
* $aPageStyles = array(
*   array(
*     'selector'  => '#selectorId .selectorClass',
*     'rules'     => array(
*         'background-image' => "url(\"" . $variable['bg_image'] . "\")",
*       ),
*     ),
*   array(
*     'selector'  => false,
*     'rules'     => $variable['ace_css_custom'],
*     ),
*   );
*
*  echo create_page_styles($aPageStyles);
**/

function create_page_styles($aPageStyles){

  $bHasPageStyles = is_array($aPageStyles) || is_object($aPageStyles) && !empty($aPageStyles);

  if($bHasPageStyles){
    $sPageStyles = '';

    foreach ( $aPageStyles as $aCssVariables ) :
      $sPageStyles .= !empty($aCssVariables['selector']) ? $aCssVariables['selector'] . '{' : '';

      if(!empty($aCssVariables['rules']) && is_array($aCssVariables['rules'])):
        foreach ($aCssVariables['rules'] as $sCssRule => $sCssValue) {
          if(!empty($sCssValue)){
            $sPageStyles .= $sCssRule . ':' . $sCssValue . ';';
          }
        }
      else:
        $sPageStyles .= !empty($aCssVariables['rules']) ? $aCssVariables['rules'] : '';
      endif;

      $sPageStyles .= !empty($aCssVariables['selector']) ? '}' : '';

    endforeach;

    $sPageStyles = !empty($sPageStyles) ? '<style type="text/css">' . $sPageStyles . '</style>' : '';
  }else{
    $sPageStyles = 'No Page Styles found. $aPageStyles is not an array or is empty.';
  }

  return $sPageStyles;
}
