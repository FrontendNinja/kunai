<?php 
  
  if (have_posts()) : $i=1; 

    while (have_posts()) : the_post(); ?>
      <div class="col-xs-6 col-md-4"><?php 

        /**
        * fen_post_content hook.
        *
        * @hooked fen_template_post_feed - 10
        */
        do_action('fen_post_feed'); ?>
        
      </div><?php

    
      $i++; 
    endwhile;
    
    if ( function_exists( 'fen_paginate_links' ) ) {
      fen_paginate_links();
    } else { ?>
      <nav class="wp-prev-next">
        <ul class="clearfix">
          <li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'front-end-ninja' )) ?></li>
          <li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'front-end-ninja' )) ?></li>
        </ul>
      </nav>
    <?php }

  else : 

    not_found_text();

  endif;


  