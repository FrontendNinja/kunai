<?php 

  get_header(); 

  $aArchiveValues   = get_archive_title();  ?>

  <div id="archive-container">
    <div class="container fluid">
      <div class="row">
        <div class="col-xs-12"><?php
          if(function_exists('get_breadcrumbs')):
            echo get_breadcrumbs();
          endif; ?>
        </div>
        
        <div class="clearfix"></div>

        <header class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
          <div class="t-center">
            <h1><?php 
              echo $aArchiveValues['title']; ?>
            </h1>
          </div>
        </header>

        <div class="clearfix"></div><?php 
          
          /**
          * fen_archive_feed hook.
          *
          * @hooked fen_template_archive_feed - 10
          * @see archive-feed.php
          */
          do_action('fen_archive_feed');  ?>

      </div>
    </div>
  </div><?php

  get_footer();


