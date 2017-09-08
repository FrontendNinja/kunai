<?php

/**
*
* General Functions
*
* @see globa_fen_options                Global APF_Fen Options
* @see the_schema                       Structured Data
* @see array_to_json_string             Used for the_schema
* @see image_selector                   Create easily an image selector with attributes
* @see slugify                          String to slug
* @see get_current_post_type            Let you know the Post Type, Custom tax, Archive or WooCommerce
* @see get_archive_title                Return an array with Archive Type and Title.
* @see get_term_thumbnail               HTML img element representing an image term thumbnail. (Categories)
* @see fen_social_networks              Nav registered in the admin panel 'Settings > Social Networks'
*/

if ( ! function_exists( 'globa_fen_options' ) ) {
  /**
  * Global Variable for APF_FEN Options
  * @see APF_Fen.php
  * 
  * Usage: 
  *   Gobal $aFenOptions
  *   
  *   $aElement = $aFenOptions['section-array'];
  *   $sValue   = $aElement['value'];
  *
  *   echo $sValue;
  * 
  * Where "section-array" is the name of the array, and value is an string inside the "section-array" array.
  */

  add_action( 'init', 'globa_fen_options' );
  function globa_fen_options(){
    global $aFenOptions;

    $aFenOptions = get_option('APF_Fen');

    return $aFenOptions;
  }
}

/**
* Schema.org
* Echo a json script with structured data. 
* @author     Carlos González from Front End Ninja
*
* @version    1.1
* @date       2016/08/26
*
* @param      none
* @return     echo string
*/
function the_schema(){
  global $aFenOptions, $wp_query, $post;

  /* WooCommerce Product Support */
  if(function_exists('wc_get_product')){
    $product = wc_get_product( $post->ID );
  }else{
    $product = false;
  }

  $aMainSettings        = !empty($aFenOptions['apparience']['main_settings']) ? $aFenOptions['apparience']['main_settings'] : '';
  $sLogotypeHeader      = !empty($aMainSettings['logotype']) ? $aMainSettings['logotype'] : '';
  $aSocialNetworks      = !empty($aFenOptions['social_networks']) ? $aFenOptions['social_networks'] : '';
  $aStructuredData      = !empty($aFenOptions['structured_data']) ? $aFenOptions['structured_data'] : '';
  $aSDSameAs            = !empty($aStructuredData['same-as']) ? $aStructuredData['same-as'] : '';
  $aSDContactPoint      = !empty($aStructuredData['contact-point']) ? $aStructuredData['contact-point'] : '';
  $aSDGeneral           = !empty($aStructuredData['general']) ? $aStructuredData['general'] : '';

  $sSDSameAsPermalink   = !empty($aSDSameAs['permalink']) ? $aSDSameAs['permalink'] : '';
  $aSocialNetworks      = !empty($aSocialNetworks[0]['link_url']) ? $aSocialNetworks : (!empty($sSDSameAsPermalink) ? $sSDSameAsPermalink : '');
  $bHasSameAs           = !empty($aSocialNetworks[0]['link_url']) || !empty($aSDSameAs); 

  $featured_image_link  = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
  $bIsSearchboxActive   = !empty($aSDGeneral['has_search']) ? (int) $aSDGeneral['has_search'] : 0;

  $post_type = get_post_type();

  $isSingleProduct = is_object($product);

  /* Same As */
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

  /* Default Structured Data */
  $sBrandName       = get_bloginfo('name');
  $sBrandName       = "\"name\": \"$sBrandName\"";

  $urlLink          = get_bloginfo('url');
  $url              = ",\"url\":\"$urlLink\"";

  $logo             = ",\"logo\":\"$sLogotypeHeader\"";
  $telephone        = !empty($aSDContactPoint['telephone']) ? $aSDContactPoint['telephone'] : "";

  $contactPoint     = !empty($telephone) ? ",\"contactPoint\": [{
                        \"@type\": \"ContactPoint\",
                        \"telephone\": \"$telephone\",
                        \"contactType\": \"customer service\"
                      }]" : "";

  $sSameAs          = !empty($sSameAs) ? ",$sSameAs" : "";

  /* Product Structured Data */
  $name             = get_the_title($post->ID);
  $name             = "\"name\": \"$name\"";

  $imageContent     = ",\"image\": \"$featured_image_link\"";
  $image            = has_post_thumbnail() ? $imageContent : "";

  $description      = $wp_query->post->post_content;
  $description      = ",\"description\": \"$description\"";

  $brand            = ",\"brand\": {
                        \"@type\": \"Thing\",
                        $sBrandName
                      }";
  $search           = ",\"potentialAction\": {
                        \"@type\": \"SearchAction\",
                        \"target\": \"$urlLink/?q={search_term_string}\",
                        \"query-input\": \"required name=search_term_string\"
                      }";

  if($isSingleProduct && function_exists('fen_comments_count_number')){
    $bNoRatings       = get_option( 'woocommerce_enable_review_rating' ) === 'no' || $product == null;
    $reviewCount      = fen_comments_count_number();

    $comments         = get_comments('post_id=' . $product->id . '');
    $rating           = !$bNoRatings ? $product->get_average_rating() : 0;
    $aggregateRating  = ",\"aggregateRating\": {
                            \"@type\": \"AggregateRating\",
                            \"ratingValue\": \"$rating\",
                            \"reviewCount\": \"$reviewCount\"
                          }";
    $aggregateRating  = $rating > 0 ? $aggregateRating : "";
  }

  /*
  * Future support - OFFERS
  * DOCS: https://developers.google.com/search/docs/data-types/products
  *
  * 'offers': {
  *   '@type': 'Offer',
  *   'priceCurrency': 'USD',
  *   'price': '119.99',
  *   'priceValidUntil': '2020-11-05',
  *   'itemCondition': 'http://schema.org/UsedCondition',
  *   'availability': 'http://schema.org/InStock',
  *   'seller': {
  *     '@type': 'Organization',
  *     'name': 'Executive Objects'
  *   }
  * }
  * ------------------
  * "offers": {
  *   "@type": "AggregateOffer",
  *   "lowPrice": "119.99",
  *   "highPrice": "199.99",
  *   "priceCurrency": "USD"
  * }
  *
  * Future support - Address, Geo and OpeningHours 
  * DOCS:   https://developers.google.com/search/docs/data-types/local-businesses
  * Notes:  Loop as [{ first }, { secondt }, { ... }]
  *
  *  {
  *    "@context": "http://schema.org",
  *    "@type": "Restaurant",
  *    "image": "http://www.example.com/image.jpg",
  *    "@id": "http://davessteakhouse.example.com",
  *    "name": "Dave's Steak House",
  *    "address": {
  *      "@type": "PostalAddress",
  *      "streetAddress": "148 W 51st St",
  *      "addressLocality": "New York",
  *      "addressRegion": "NY",
  *      "postalCode": "10019",
  *      "addressCountry": "US"
  *    },
  *    "geo": {
  *      "@type": "GeoCoordinates",
  *      "latitude": 40.761293,
  *      "longitude": -73.982294
  *    },
  *    "url": "http://www.example.com/restaurant-locations/manhattan",
  *    "telephone": "+12122459600",
  *    "openingHoursSpecification": [
  *      {
  *        "@type": "OpeningHoursSpecification",
  *        "dayOfWeek": [
  *          "Monday",
  *          "Tuesday"
  *        ],
  *        "opens": "11:30",
  *        "closes": "22:00"
  *      },
  *      {
  *        "@type": "OpeningHoursSpecification",
  *        "dayOfWeek": [
  *          "Wednesday",
  *          "Thursday",
  *          "Friday"
  *        ],
  *        "opens": "11:30",
  *        "closes": "23:00"
  *      },
  *      {
  *        "@type": "OpeningHoursSpecification",
  *        "dayOfWeek": "Saturday",
  *        "opens": "16:00",
  *        "closes": "23:00"
  *      },
  *      {
  *        "@type": "OpeningHoursSpecification",
  *        "dayOfWeek": "Sunday",
  *        "opens": "16:00",
  *        "closes": "22:00"
  *      }
  *    ],
  *    "menu": "http://www.example.com/menu",
  *    "acceptsReservations": "True"
  *  }
  *
  */ 

  /* Default */
  $aSchema[] = "{
      \"@context\":\"http://schema.org\",
      \"@type\":\"Organization\",
      $sBrandName
      $url
      $logo
      $contactPoint
      $sSameAs
    }";

  if($bIsSearchboxActive){
    /* Search */
    $aSchema[] = "{
      \"@context\": \"http://schema.org\",
      \"@type\": \"WebSite\"
      $url
      $search
    }";
  }

  /* Reviews */ // DOCS: https://developers.google.com/search/docs/data-types/reviews
  if($reviewCount > 0){
    $comments         = get_comments('post_id=' . $product->id . '');

    foreach ($comments as $key => $comment) {
      $comment_ID     = $comment->comment_ID;

      $rating         = intval( get_comment_meta( $comment_ID, 'rating', true ) );
      $headline       = get_comment_meta( $comment_ID, 'headline', true );
      $author         = $comment->comment_author;
      $reviewBody     = get_comment_text($comment_ID);
      $datePublished  = get_comment_date( 'c', $comment_ID ); 

      $aReviews[] = "{
          \"@context\": \"http://schema.org/\",
          \"@type\": \"Review\",
          \"datePublished\": \"$datePublished\",
          \"itemReviewed\": {
            \"@type\": \"Thing\",
            $name
            $image
          },
          \"reviewRating\": {
            \"@type\": \"Rating\",
            \"bestRating\": \"5\",
            \"ratingValue\": \"$rating\",
            \"worstRating\": \"1\"
          },
          \"name\": \"$headline\",
          \"author\": {
            \"@type\": \"Person\",
            \"name\": \"$author\"
          },
          \"reviewBody\": \"$reviewBody\"
        }";
    }

    $sSchemaComments = array_to_json_string($aReviews, ", \"review\" : [");

  }

  /* Products */
  if($isSingleProduct && $exact_post_type == "single"){
    $aSchema[] = "{
        \"@context\": \"http://schema.org/\",
        \"@type\": \"Product\",
        $name
        $image
        $description
        $brand
        $aggregateRating
        $sSchemaComments
      }";
  }

  $schema       = array_to_json_string($aSchema);

  /* Minify json */
  $schema = trim(preg_replace('/\s\s+/', ' ', $schema)); ?>

  <script type="application/ld+json"><?php 
    echo $schema; ?>
  </script><?php
}

/**
* Array to json String
*
* Convert an array to a json string.
*
* @param      array         $array                  (required)        Array to convert to json string.
* @param      string        $before_string          (optional)        String to begin json string, default is "[".
* @param      string        $after_string           (optional)        String to end json string, default is "]".
*
* @return     string        $jsonString     output            Json string.
*/
function array_to_json_string($array, $before_string = "[", $after_string = "]"){
  $jsonString = "";
  if(!is_array($array)) return;

  $iArraySize     = sizeof($array);

  /* Create Schema Json */
  foreach ($array as $iKey => $sJsonString) {
    $jsonString .= $iArraySize > 1 && $iKey == 0 ? $before_string : "";
    $jsonString .= $iArraySize > 1 && $iKey > 0  ? "," : "";

    $jsonString .= $sJsonString;

    $iKey++;
    $jsonString .= $iArraySize > 1 && $iKey == $iArraySize ? $after_string : "";
  }

  return $jsonString;
}

/**
* Image Selector
* Return an image selector with variable url and attr.
* @version  1.0.2      2017/03/29 Fix: Dont add attr if attribute value is empty.
*
* @param    $url       string    (Required)    The image url.
* @param    $attr      array     (Optional)    Image attributes. (title, alt, etc.)
* @return   Html selector. If no url is passed, returns an alert error.
*/
function image_selector( $url, $attr ){
  if(!empty($url)){
    if(!empty($attr)){
      $attributes = "";
      foreach ($attr as $key => $attr_val) {
        if(!empty($attr_val)){
          $attributes .= $key.'="'.strval($attr_val).'" ';
        }
      }
    }
    $html = "<img src='{$url}' {$attributes}>";
  }else{
    $html = "<div class='alert alert-danger'>Error: La función image_selector necesita una URL para funcionar correctamente.</div>";
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
* @version  v1.0 (2016/11/24) Woocommerce support.
*/

function get_current_post_type(){

  if (function_exists('is_woocommerce')) {
    $is_woocommerce = is_woocommerce();
  }else{
    $is_woocommerce = false;
  }

  $current_post_type = 
      is_page() ? 'page' : (
      is_single() ? 'single' : (
      is_category() ? 'category' : (
      is_tag() ? 'tag' : (
      is_author() ? 'author' : (
      is_day() ? 'day' : (
      is_month() ? 'month' : (
      is_year() ? 'year' : (
      $is_woocommerce ? 'woocommerce' : (
      is_tax() ? 'tax' : (
      is_search() ? 'search' : (
      is_post_type_archive() ? 'custom-post-type' : ( 
      is_home() ? 'home' : 'other'  )
      )))))))))));

  return $current_post_type;
}

/**
* Get Archive Title
* Return an array with the archive title and an after title text.
* @return       array       $sArchiveType         An array with $sArchiveType['title'] and $sArchiveType['after'].
* @version  v1.0 (2016/11/24) Woocommerce support.
*/
if( ! function_exists('get_archive_title') ){

  function get_archive_title(){
    /** 
    * @see get_current_post_type at fen-general-functions.php
    */
    $sArchiveType   = get_current_post_type();
    $aArchiveValues = array();

    switch ($sArchiveType) {
      case 'category':
        $sArchiveType   = __( 'Categoría', 'front-end-ninja' );
        $sArchiveTitle  = single_cat_title('', false);
        break;
      case 'tag':
        $sArchiveType   = __( 'Tag', 'front-end-ninja' );
        $sArchiveTitle  = single_tag_title('', false);
        break;
      case 'author':
        global $post; 
        $iAuthorId = $post->post_author;

        $sArchiveType   = __( 'Publicado por', 'front-end-ninja' );
        $sArchiveTitle  = get_the_author_meta('display_name', $iAuthorId);
        break;
      case 'day':@
        $day    = 'l, F j, Y';
        $sTimeType      = __( 'Archivos por día', 'front-end-ninja' );
        $sTimeFormat    = $day;
      case 'month':
        $month  = 'F Y';
        $sTimeType      = empty($sTimeType)  ? __( 'Archivos por mes', 'front-end-ninja' ) : $sTimeType;
        $sTimeFormat    = empty($sTimeFormat) ?  $month : $sTimeFormat;
      case 'year':
        $year   = 'Y';
        $sTimeType      = empty($sTimeType)  ? __( 'Archivos por año', 'front-end-ninja' ) : $sTimeType;
        $sTimeFormat    = empty($sTimeFormat) ?  $year : $sTimeFormat;

        $sArchiveType   = $sTimeType;
        $sArchiveTitle  = get_the_time($sTimeFormat);
        break;
      case 'woocommerce':

        $sArchiveType   = "";
        $sArchiveTitle  = woocommerce_page_title(false);
        break;
      case 'tax':
        $sArchiveType   = __( 'Tax', 'front-end-ninja' );
        $sArchiveTitle  = single_term_title( '', false );
        break;
      
      default:
        $sArchiveType   = __( 'Archive', 'front-end-ninja' );
        $sArchiveTitle  = "";
        break;
    }

    $aArchiveValues['type'] = $sArchiveType;
    $aArchiveValues['title'] = $sArchiveTitle;

    return $aArchiveValues;
  }
}
/**
/**
* Get Term Thumbnail
* Get an HTML img element representing an image term thumbnail.
*
* @author       xWaZzo @FrontEndNinja
* @param        (number)          $term_id 
* @return       (string)          HTML img element or empty string on failure.
*
* @version      1.0.1       2017/03/29    Support for given $term_id
*/
if( ! function_exists('get_term_thumbnail') ){
  function get_term_thumbnail($term_id = null){
    global $wp_query, $wpdb;

    $term_id      = $term_id ? $term_id : (!empty($wp_query->queried_object->term_id) ? $wp_query->queried_object->term_id : $wp_query->queried_object->ID);

    /* Find term id */
    $image_id     = function_exists( 'get_term_meta' ) ? get_term_meta( $term_id, 'thumbnail_id', true ) : get_metadata( 'woocommerce_term', $term_id, 'thumbnail_id', true );

    /* Custom Thumb can be created by APF */
    $term_options = get_option( 'APF_Fen_TaxonomyField');
    $custom_thumb = $term_options[$term_id]['term_thumbnail'];

    /* Check what type of thumb we need */
    $image_src    = !empty($custom_thumb) ? $custom_thumb : wp_get_attachment_url( $image_id );

    /* Check what type of thumb we need */
    $image_query  = "SELECT ID FROM {$wpdb->posts} WHERE guid='{$image_src}'";
    $image_id     = !empty($image_id) ? $image_id : $wpdb->get_var($image_query);

    /* Get alt text of the image */
    $image_alt    = get_post_meta( $image_id, '_wp_attachment_image_alt', true);
    $aImageAttr   = array('alt'=> $image_alt);

    if(empty($image_src)) return;

    $term_image   = image_selector($image_src, $aImageAttr);

    return $term_image;
  }
}
/**
* FEN Social Networks
* Return an Html with social networks registered at the admin panel.
* @return   string  HTML
*/
if( ! function_exists('fen_social_networks') ){
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
}

if( ! function_exists('main_alert') ){
  function main_alert(){
    global $aFenOptions;

    $aAlerts              = !empty($aFenOptions['apparience']['alerts']) ? $aFenOptions['apparience']['alerts'] : '';

    if (!empty($aAlerts['main_alert'])): 
      $sAlertId      = 'id="main-alert" ';
      $sAlertClass   = 'class="alert alert-';
      $sAlertClass  .= is_string($aAlerts['type']) ? $aAlerts['type'] : 'secondary';
      $sAlertClass  .= '"'; 

      $sAlertOpen    = (!empty($aAlerts['main_alert_url']) ? '<a href="' . $aAlerts['main_alert_url'] . '" ' : '<div ' ) . $sAlertId . $sAlertClass . ' >';
      $sAlertClose   = !empty($aAlerts['main_alert_url']) ? '</a>' : '</div>'; 

      echo $sAlertOpen; ?>
        <div class="container">
          <div class="row">
            <div class="col-xs-12"><?php 
              echo apply_filters('the_content', $aAlerts['main_alert']); ?>
            </div>
          </div>
        </div><?php 
      echo $sAlertClose;
    endif;
  }
}
if (!function_exists('fen_alert')) {
  /**
   * FEN Alert
   * 
   * @see fen_get_alert
   */

  function fen_alert($sMessage, $sType ="warning", $sPermalink = ""){

    echo fen_get_alert($sMessage, $sType, $sPermalink);
    
  }
}

if (!function_exists('fen_get_alert')) {
  /**
   * FEN Get Alert
   * 
   * @param $sMessage     string  (Required)  Alert message.
   * @param $sType        string  (Optional)  Alert type. Normally: success, info, warning, danger.
   * @param $sPermalink   string  (Optional)  Permalink for the alert.
   * 
   * @return html  Alert message.
   */

  function fen_get_alert($sMessage, $sType ="warning", $sPermalink = ""){
    $sAlertClass   = "class='alert alert-{$sType}'";

    $sAlertOpen    = (!empty($sPermalink) ? "<a href='{$sPermalink}'" : "<div" ) . " $sAlertClass>";
    $sAlertClose   = !empty($sPermalink) ? '</a>' : '</div>'; 

    return "{$sAlertOpen}{$sMessage}{$sAlertClose}";
  }
}
if (!function_exists('fen_get_alert')) {
  /**
  * Not Found text
  * Echo default not foud txt.
  */
  function not_found_text(){
    /* check if qtranslate function exists */
    $sSpanish = "No se encontró nada con los términos señalados.";
    $sEnglish = "Nothing found under the given terms.";

    if(class_exists('QTX_Translator')) {
      /* Support for Spanish and English */
      $s404 = __("[:en]{$sEnglish}[:es]{$sSpanish}[:]", "front-end-ninja");
    }else{

      $s404 = $sSpanish;
      
    } ?>
    <p><?php echo $s404; ?></p><?php 
  }
}











