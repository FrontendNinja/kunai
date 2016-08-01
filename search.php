<?php 

get_header(); ?>

  <h1><span>Resultados de búsqueda Para:</span> <?php echo esc_attr(get_search_query()); ?></h1><?php 

  if (have_posts()) :

    while (have_posts()) : the_post(); 

      /**
      * fen_post_content hook.
      *
      * @hooked fen_template_post_feed - 10
      */
      do_action('fen_post_feed');

    endwhile;

    if(function_exists('fen_paginate_links')) { 
      fen_paginate_links();
    } else { ?>
      <nav class="wp-prev-next">
        <ul class="clearfix">
          <li class="prev-link"><?php next_posts_link( __( '&laquo; Older Entries', 'front-end-ninja' )) ?></li>
          <li class="next-link"><?php previous_posts_link( __( 'Newer Entries &raquo;', 'front-end-ninja' )) ?></li>
        </ul>
      </nav><?php 
    }

  else:

  /* A 404 answer goes here */

  endif; 

  get_sidebar('archive');

get_footer();

