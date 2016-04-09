<!Doctype html>
<!--[if lt IE 7]><html lang="es-mx" class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html lang="es-mx" class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html lang="es-mx" class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html lang="es-mx" class="no-js"><!--<![endif]-->

<html>
<head>
  
  <meta charset="UTF-8">
  
  <meta name="author" content="The NuevaWeb Team">
  <title><?php bloginfo('name'); ?> | <?php is_home() ? bloginfo('description') : wp_title(''); ?></title>

  <?php // Load styles and scripts from functions.php nw_enqueue_scripts() function ?>
  <?php
  // get data from Theme/Settings/Header
  $data_header = get_option( 'APF_Fen' )['header']['ace_html_header'];
  // get data from Theme/Settings/Apparience
  $data_apparience = get_option( 'APF_Fen' )['apparience']; 
  $da_logotype = $data_apparience['main-settings']['logotype'];
  $da_logotype_mobile = $data_apparience['main-settings']['logotype_mobile'];
  $da_logotype_tag_line_mobiles = $data_apparience['main-settings']['logotype_tag_line_mobiles'];
  $da_logotype_tag_line = $da_logotype_tag_line_mobiles ? $data_apparience['main-settings']['logotype_tag_line'] : false;
  $da_favicon = $data_apparience['main-settings']['favicon'];

  $da_color = $data_apparience['colors'];

  $da_font_size_number = $data_apparience['font_size']['size'];
  $da_font_size = $data_font_size_number ? $da_font_size_number.$data_apparience['font_size']['unit'] : '';
  $da_custom_css = $data_apparience['extra']['ace_css_custom']; ?>

  <link rel="apple-touch-icon" href="<?php bloginfo('template_url'); ?>/assets/images/apple-icon-touch.png">
  <link rel="icon" href="<?php echo $da_favicon ? $da_favicon : get_bloginfo('template_url').'/assets/images/favicon.png'; ?>">
  <!--[if IE]>
    <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/assets/images/favicon.ico">
  <![endif]-->
  <meta name="msapplication-TileColor" content="#be1e2d">
  <meta name="msapplication-TileImage" content="<?php bloginfo('template_url'); ?>/assets/images/win8-tile-icon.png">

  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

  <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

  <?php wp_head(); // wordpress admin-bar functions ?>

  <?php echo $data_header; ?>

</head>
<body>

  <header id="main-header">
    <nav role="navigation">
      <div class="container">
        <div class="row">
          <div class="col-xs-2 brand-logo">
            <a class="main-logo" href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">
              <?php
              $da_logotype_attr        = $da_logotype_mobile ? array( 'class' => 'hidden-xs') :'';
              $da_logotype_mobile_attr = $da_logotype_mobile ? array( 'class' => 'visible-xs-block') :'';

              echo $da_logotype ? image_selector( $da_logotype, $da_logotype_attr ) : '';
              echo $da_logotype_mobile ? image_selector( $da_logotype_mobile, $da_logotype_mobile_attr ) : ''; 
              
              echo $da_logotype_tag_line ? '<h1 class="visible-xs-block">'.$da_logotype_tag_line.'</h1>' : ''; ?>
            </a>
          </div>

          <div class="col-xs-10">
            <?php fen_main_nav(); ?>

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
        </div><!-- /.row -->

      </div><!-- /.container -->
    </nav><!-- /navbar -->
  </header><!-- /#main-header -->



