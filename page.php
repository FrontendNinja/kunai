<?php 

get_header(); 

  if(have_posts()) :

    while(have_posts()) : the_post(); 
      
      /**
      * fen_post_content hook.
      *
      * @hooked fen_template_post_content - 10
      */
      do_action('fen_post_content');

    endwhile;

  endif;

  get_sidebar('page');

get_footer();

