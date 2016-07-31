<?php
  global $aFenOptions;

  $sFooter              = !empty($aFenOptions['apparience']['footer']) ? $aFenOptions['apparience']['footer'] : ''; ?>

  <footer id="main-footer">
    <?php // fen_footer_main_nav(); ?>

    <div class="legales">
      <div class="container">
        <div class="row">
          <div class="col-xs-6 copyright" itemscope itemtype="http://schema.org/Organization">
            <p><span itemprop="name"><?php bloginfo('name'); ?></span> © <?php echo date('Y'); ?></p>
          </div>
          <div class="col-xs-6 t-right" itemscope itemtype="http://schema.org/ProfessionalService">
            <p>Developed by <a href="http://www.frontend.ninja" class="fen-website" target="_blank" itemprop="url">frontend<span>.ninja</span></a></p>
          </div>
        </div><!--.row-->
      </div><!--.container-->
    </div><!--.legales-->
  </footer>
          

  <?php $data_footer = get_option( 'APF_Fen' )['footer']['ace_html_footer']; 
  echo $data_footer; ?>

  <?php wp_footer(); // wordpress admin-bar functions
  // Load styles and scripts from functions.php nw_enqueue_scripts() function ?>
</body>
</html>