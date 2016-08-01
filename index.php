<?php 

get_header();

  if (have_posts()) : // Show latest posts as default

    while (have_posts()) : the_post();

      /**
      * fen_post_content hook.
      *
      * @hooked fen_template_post_feed - 10
      */
      do_action('fen_post_feed');

    endwhile;
    wp_reset_postdata();

    endif;

get_footer();

