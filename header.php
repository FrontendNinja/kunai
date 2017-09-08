<!Doctype html>
<!--[if lt IE 7]><html lang="es-mx" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html lang="es-mx" class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html lang="es-mx" class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html lang="es-mx" class="no-js"><!--<![endif]-->
<html lang="es-mx">
<head>
  
  <meta charset="UTF-8">
  <meta name="author" content="<?php bloginfo('name'); ?>"><?php 
  $sHomeTitle = get_bloginfo('description') . " | " . get_bloginfo('name'); // Docs: https://moz.com/learn/seo/title-tag
  $sElseTitle = trim(wp_title('', false)) . " | " . get_bloginfo('name'); ?>

  <title><?php echo is_home() ? $sHomeTitle : $sElseTitle; ?></title>

  <?php 
  /*
  * Styles and scripts loaded from fen-scripts-n-style-enqueue.php
  */

  global $aFenOptions;

  /* Settings personlized by the admin */
  $aMainSettings        = !empty($aFenOptions['apparience']['main_settings']) ? $aFenOptions['apparience']['main_settings'] : '';
  $aExtra               = !empty($aFenOptions['apparience']['extra']) ? $aFenOptions['apparience']['extra'] : '';
  $aAlerts              = !empty($aFenOptions['apparience']['alerts']) ? $aFenOptions['apparience']['alerts'] : '';

  /* User can add HTML before or immediately after the <body> tag */
  $sHTMLBeforeBody      = !empty($aFenOptions['header']) ? $aFenOptions['header']['html_before_body'] : '';
  $sHTMLAfterBody       = !empty($aFenOptions['header']) ? $aFenOptions['header']['html_after_body'] : '';

  $sLogotypeHeader      = !empty($aMainSettings['logotype']) ? $aMainSettings['logotype'] : '';
  $sLogotypeHeaderAttr  = array( 'alt' => get_bloginfo('name'), 'title' => get_bloginfo('name') );
  $sFavicon             = !empty($aMainSettings['favicon']) ? $aMainSettings['favicon'] : '';

  $sCurrentUrl          = 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"; 
  $sPostTypeName        = array(get_current_post_type(), get_archive_title()['title']); 

  /* Add or remove click to Main Logo */
  $sBefore_MainLogoSelector = is_home() ? "div" : "a href='" . get_bloginfo('url') . "'";
  $sAfter_MainLogoSelector  = is_home() ? "div" : "a";
  $sMainLogo =  "<{$sBefore_MainLogoSelector} class='main-logo' title='" . get_bloginfo('name') . "'>" .
                  (!empty($sLogotypeHeader) ? image_selector( $sLogotypeHeader, $sLogotypeHeaderAttr ) : get_bloginfo('name')) .
                "</{$sAfter_MainLogoSelector}>"; ?>

  <link rel="alternate" hreflang="es-mx" href="<?php echo $sCurrentUrl; ?>">
  <link rel="icon" href="<?php echo !empty($sFavicon) ? $sFavicon : get_bloginfo('template_url').'/assets/images/favicon.png'; ?>">

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"><?php 

  /* Wordpress head hook */
  wp_head();

  /**
  *  Page Styles
  * @see the_page_styles at fen-custom-functions.php
  */
  the_page_styles();

  /**
  *  Schema.org
  * @see the_schema at fen-general-functions.php
  */
  the_schema();

  /* HTML before the <body> tag */
  echo $sHTMLBeforeBody; ?>

</head>
<body <?php body_class($sPostTypeName); ?>><?php
  
  /* HTML immediately after the <body> tag */
  echo $sHTMLAfterBody;

  /**
  * Main Alert can be managed by the admin at FEN > Settings > Apparience / Alert
  * @see APF_Fen_Settings_Apparience.php
  */
  main_alert(); ?>

  <header id="main-header">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 col-sm-2 brand-logo">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button><?php 

          echo $sMainLogo; ?>
        </div>

        <div class="col-xs-12 col-sm-10"><?php 

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
      </div><!-- /.row -->

    </div><!-- /.container -->
  </header><!-- /#main-header -->



