<?php 

get_header();

  if (have_posts()) : // Show latest posts as default

    while (have_posts()) : the_post();

      do_action('fen_post_content');

    endwhile;
    wp_reset_postdata();

    endif;

get_footer(); ?>