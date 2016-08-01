<?php
  global $aFenOptions;

  $sFooter = !empty($aFenOptions['footer']) ? $aFenOptions['footer']['ace_html_footer'] : ''; ?>

  <footer id="main-footer">
    <?php // fen_footer_main_nav(); ?>

    <div class="legales">
      <div class="container">
        <div class="row">
          <div class="col-xs-6 copyright" itemscope itemtype="http://schema.org/Organization">
            <p><span itemprop="name"><?php bloginfo('name'); ?></span> © <?php echo date('Y'); ?></p>
          </div>
          <div class="col-xs-6 t-right" itemscope itemtype="http://schema.org/ProfessionalService">
            <p>Developed by <a href="http://frontend.ninja/?utm_source=Client%20Website&utm_medium=backlink&utm_campaign=Client%20Backlink" class="fen-website" target="_blank" itemprop="url">frontend<span>.ninja</span></a></p>
          </div>
        </div><!--.row-->
      </div><!--.container-->
    </div><!--.legales-->
  </footer><?php

  echo $sFooter;

  wp_footer(); ?>
</body>
</html>