<!Doctype html>
<!--[if lt IE 7]><html lang="es-mx" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html lang="es-mx" class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html lang="es-mx" class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html lang="es-mx" class="no-js"><!--<![endif]-->
<html lang="es-mx">
<head prefix="og: http://ogp.me/ns#">
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

  <title><?php echo fen_title();  ?></title><?php 

  $sPostTypeName = array(get_current_post_type(), get_archive_title()['title']); 

  /* Wordpress head hook */
  wp_head(); ?>

</head>
<body <?php body_class($sPostTypeName); ?>><?php

  /* After Body Tag Hook */
  do_action('after_body_tag'); ?>

  <header id="main-header">
    <div class="container">
      <div class="row">
        <div class="col-12">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button><?php 

          /**
          * Fen Main Nav
          * @see fen-register-menus.php
          */
          fen_main_nav(); 

          /**
          * To Register or remove sidebars.
          * @see fen-register-sidebars.php
          */
          if (is_active_sidebar( 'utilities-nav' )) {
            /* Display utilities nav if sidevar is active. */
            dynamic_sidebar( 'utilities-nav' ); 
          } ?>
        </div>
      </div>
    </div>
  </header>



