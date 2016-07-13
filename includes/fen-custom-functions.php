<?php 
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