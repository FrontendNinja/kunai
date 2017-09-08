<?php

  global $aFenOptions;

  /* User can add HTML before </body> tag */
  $sHTMLbeforeBody = !empty($aFenOptions['footer']) ? $aFenOptions['footer']['ace_html_footer'] : ''; ?>

  <footer id="main-footer"><?php 
    /**
    * Fen Footer Nav
    * @see fen-register-menus.php
    */
    // fen_footer_main_nav(); ?>

    <div class="legales">
      <div class="container">
        <div class="row">
          <div class="col-xs-6 copyright">
            <p><span><?php bloginfo('name'); ?></span> © <?php echo date('Y'); ?></p>
          </div>
          <div class="col-xs-6 t-right">
            <p>Developed by <a class="fen-website" href="http://frontend.ninja/?utm_source=Client%20Website&utm_medium=backlink&utm_campaign=Client%20Backlink" target="_blank">frontend<span>.ninja</span></a></p>
          </div>
        </div><!--.row-->
      </div><!--.container-->
    </div><!--.legales-->
  </footer><?php

  /* HTML immediately after the <body> tag */
  echo $sHTMLbeforeBody;

  /* Wordpress footer hook */
  wp_footer(); ?>
</body>
</html>