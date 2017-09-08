<?php 

get_header(); ?>

  <h1><span>Resultados de búsqueda Para:</span> <?php echo esc_attr(get_search_query()); ?></h1><?php 

  /**
  * fen_archive_feed hook.
  *
  * @hooked fen_template_archive_feed - 10
  * @see archive-feed.php
  */
  do_action('fen_archive_feed');

get_footer();

