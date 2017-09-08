<?php 

$sSpanish = "<p>La página que buscas se ha movido de lugar, eliminado o posiblemente nunca existió.<p>" . 
            "<p>Utiliza el navegador o intenta con el buscador.</p>";
$sEnglish = "<p>The page you are looking for may have been moved, deleted, or possibly never existed.<p>" . 
            "<p>Use the nav menu or give a try with the search form.</p>";

/* check if qtranslate function exists */
if(class_exists('QTX_Translator')) {
  /* if language is English use this code */
  $sError404 = __("[:en]{$sEnglish} [:es]{$sSpanish} [:]", "front-end-ninja");
}else{
  $sError404 = $sSpanish;
}

get_header(); ?>

  <div id="error-404" class="main-content">
    <div class="container">
      <div class="row">
        <div id="error-content" class="col-xs-12 col-sm-4 col-md-4">
          <h1>Oh no! <span>Error:</span> 404</h1><?php

          echo $sError404;

          get_search_form(); /* searchform.php to customize form */ ?>
        </div>
      </div>
    </div>

  </div><?php 

get_footer();

