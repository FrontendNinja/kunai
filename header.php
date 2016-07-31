<!Doctype html>
<!--[if lt IE 7]><html lang="es-mx" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html lang="es-mx" class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html lang="es-mx" class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html lang="es-mx" class="no-js"><!--<![endif]-->

<html>
<head>
  
  <meta charset="UTF-8">
  <meta name="author" content="Front End Ninja"><?php 
  $sHomeTitle = get_bloginfo('description') . " | " . get_bloginfo('name'); // Docs: https://moz.com/learn/seo/title-tag
  $sElseTitle = trim(wp_title('', false)) . " | " . get_bloginfo('name'); ?>

  <title><?php echo is_home() ? $sHomeTitle : $sElseTitle; ?></title>

  <?php 
  /*
  * Styles and scripts loaded from fen-scripts-n-style-enqueue.php
  */

  global $aFenOptions;

  $aMainSettings        = !empty($aFenOptions['apparience']['main-settings']) ? $aFenOptions['apparience']['main-settings'] : '';
  $aExtra               = !empty($aFenOptions['apparience']['extra']) ? $aFenOptions['apparience']['extra'] : '';
  $aAlerts              = !empty($aFenOptions['apparience']['alerts']) ? $aFenOptions['apparience']['alerts'] : '';

  $sHeader              = !empty($aFenOptions['apparience']['header']) ? $aFenOptions['apparience']['header']['ace_html_header'] : '';

  $sLogotypeHeader      = !empty($aMainSettings['logotype_header']) ? $aMainSettings['logotype_header'] : '';
  $sLogotypeHeaderAttr  = array( 'alt' => get_bloginfo('name'), 'title' => get_bloginfo('name') );
  $sFavicon             = !empty($aMainSettings['favicon']) ? $aMainSettings['favicon'] : '';

?>

  <link rel="icon" href="<?php echo !empty($sFavicon) ? $sFavicon : get_bloginfo('template_url').'/assets/images/favicon.png'; ?>">

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>"><?php 

  wp_head(); // wordpress admin-bar functions ?

  echo $sHeader;

  /**
  *  Schema.org
  * @see the_schema at fen-general-functions.php
  */
  the_schema();

  /**
  *  Page Styles
  * @see the_page_styles at fen-custom-functions.php
  */
  the_page_styles(); ?>

</head>
<body <?php body_class(); ?>>

  <pre><?php var_dump($aFenOptions); ?></pre>
  <pre><?php var_dump($aFenOptions['apparience']); ?></pre>
  <pre><?php var_dump($sHeader); ?></pre>

  <header id="main-header">
    <nav role="navigation">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-2 brand-logo">
            <a class="main-logo" href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><?php
              echo $sLogotypeHeader ? image_selector( $sLogotypeHeader, $sLogotypeHeaderAttr ) : ''; ?>
            </a>

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>

          <div class="col-xs-12 col-sm-10">
            <?php fen_main_nav(); ?>
          </div>
        </div><!-- /.row -->

      </div><!-- /.container -->
    </nav><!-- /navbar -->
  </header><!-- /#main-header -->



