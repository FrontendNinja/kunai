<?php 
/**
* Global Variable for fen options registered with APF_Fen
* @see fen-admin-page-framework.x/
* 
* Usage: 
*   Gobal $aFenOptions
*   
*   $aElement = $aFenOptions['element'];
*   $sValue   = $aElement['value'];
*
*   echo $sValue;
* 
* Where Element is the name of the array, and value is an string value inside the Element array.
*/

$aFenOptions = get_option('APF_Fen');

/**
* Schema.org
* Echo a json script with structured data. 
*
* @param none
*/
function the_schema(){
  global $aFenOptions;

  $aMainSettings        = !empty($aFenOptions['apparience']['main-settings']) ? $aFenOptions['apparience']['main-settings'] : '';

  $sLogotypeHeader      = !empty($aMainSettings['logotype_header']) ? $aMainSettings['logotype_header'] : '';
  $aSocialNetworks      = !empty($aFenOptions['social_networks']) ? $aFenOptions['social_networks'] : '';
  $aStructuredData      = !empty($aFenOptions['structured_data']) ? $aFenOptions['structured_data'] : '';
  $aSDSameAs            = !empty($aStructuredData['same-as']) ? $aStructuredData['same-as'] : '';

  $sSDSameAsPermalink   = !empty($aSDSameAs['permalink']) ? $aSDSameAs['permalink'] : '';
  $aSocialNetworks      = !empty($aSocialNetworks[0]['link_url']) ? $aSocialNetworks : (!empty($sSDSameAsPermalink) ? $sSDSameAsPermalink : '');
  $bHasSameAs           = !empty($aSocialNetworks[0]['link_url']) || !empty($aSDSameAs); 

  if($bHasSameAs): 
    $sSameAs  .= '"sameAs":[';

    foreach ($aSocialNetworks as $step => $aSameAs):
      $sSALink = !empty($aSocialNetworks[0]['link_url']) ? $aSameAs['link_url'] : $aSameAs;
      if(!empty($aSameAs)):
        $sSameAs .= '"'.$sSALink.'"';
        $sSameAs .= $step+1 != sizeof($aSocialNetworks) ? ',':'';
      else: 
        continue; 
      endif; 
    endforeach;
    $sSameAs  .= ']';
  endif; 

  $schema =
  '{
    "name":"'.get_bloginfo('name').'",
    "url":"'.get_bloginfo('url').'",'.
    (!empty($sLogotypeHeader ) ? '"logo":"'. $sLogotypeHeader . '",' : '' ) .
    '"@type":"Organization",
    "@context":"http://schema.org"'.
    (!empty($sSameAs) ? ','.$sSameAs : '').
  '}';
  ?>

  <script type="application/ld+json"><?php 
    echo $schema; ?>
  </script><?php
}

/**
* Image Selector
* Return an image selector with variable url and attr.
*
* @param    $url       string    (Required)    The image url.
* @param    $attr      array     (Optional)    Image attributes. (title, alt, etc.)
* @return   Html selector. If no url is passed, returns an alert error.
*/

function image_selector( $url, $attr ){
  if(!empty($url)){
    if(!empty($attr)){
      foreach ($attr as $key => $attribute) {
        $attributes .= $key.'="'.strval($attribute).'" ';
      }
    }
    $html .= '<img src="'.$url.'" '.$attributes.'>';    
  }else{
    $html .= '<div class="alert alert-danger">Error: La función image_selector necesita una URL para funcionar correctamente.</div>';
  }

  return $html;
}

/**
* Slugify
* Convert any string to its slug version.
*
* @param      $text      string    (Required)    String to convert to slug.
* @return     string     Converted to slug.
*/
function slugify($text){
  // replace non letter or digits by -
  $text = preg_replace('~[^\pL\d]+~u', '-', $text);
  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);
  // trim
  $text = trim($text, '-');
  // remove duplicate -
  $text = preg_replace('~-+~', '-', $text);
  // lowercase
  $text = strtolower($text);
  if (empty($text)) { return 'n-a'; }

  return $text;
}

/**
* Get Current Post Type
* Get any post type, archive, taxonomy.
* @param    none
* @return   string    Post type, archive or taxonomy.
*/

function get_current_post_type(){
  $current_post_type = 
      is_page() ? 'page' : (
      is_single() ? 'single' : (
      is_category() ? 'category' : (
      is_tag() ? 'tag' : (
      is_author() ? 'author' : (
      is_day() ? 'day' : (
      is_month() ? 'month' : (
      is_year() ? 'year' : (
      is_post_type_archive() ? 'custom-post-type' : ( 
      is_tax() ? 'tax' : (
      is_search() ? 'search' : (
      is_home() ? 'home' : 'other'  )
      ))))))))));

  return $current_post_type;
}

/**
* FEN Social Networks
* Return an Html with social networks registered at the admin panel.
* @return   string  HTML
*/
function fen_social_networks(){
  global $aFenOptions;

  $aSocialNetworks      = is_array($aFenOptions['social_networks']) ? $aFenOptions['social_networks'] : '';
  $bHasSocialNetworks   = is_array($aSocialNetworks) || is_object($aSocialNetworks) && !empty($aSocialNetworks);

  if($bHasSocialNetworks):
    $sBeforeNetworksList = '<ul class="social-meta">';
    $sAfterNetworksList = '</ul>';
    
    $sListHtml = $sBeforeNetworksList;

    foreach( $aSocialNetworks as $key => $aSNetwork):
      $bHasNetwork = !empty($aSNetwork['tab_title']) && !empty($aSNetwork['link_url']); 
      if($bHasNetwork):
        $sIcon       = $aSNetwork['custom_icon'] ? $aSNetwork['custom_icon'] : $aSNetwork['select'];
        $sIconSlug   = slugify($aSNetwork['tab_title']);
        $sUrl        = 'href="' . $aSNetwork['link_url'] . '"';
        $sTitle      = !empty($aSNetwork['title']) ? $aSNetwork['title'] : '';

        $sListHtml  .= '<li>
                        <a ' . $sUrl . '>
                          <i class="' . ($aSNetwork['select'] ? 'fa fa-' . $sIcon : $aSNetwork['custom_icon']) . '"></i>' .
                          $sTitle .
                        '</a>
                      </li>';
      else: 
        continue; 
      endif; 
    endforeach;

    $sListHtml .= $sAfterNetworksList;

  else:
    $sListHtml = '';
  endif;
  
  return $sListHtml;
}