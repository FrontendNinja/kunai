<?php 

get_header(); 

  /** 
  * @see get_current_post_type at fen-general-functions.php
  */
  $sArchiveType   = get_current_post_type();

  switch ($sArchiveType) {
    case 'category':
      $sArchiveTitle  = __( 'Categoría:', 'front-end-ninja' );
      $sArchiveElse   = single_cat_title('', false);
      break;
    case 'tag':
      $sArchiveTitle  = __( 'Tag:', 'front-end-ninja' );
      $sArchiveElse   = single_tag_title('', false);
      break;
    case 'author':
      global $post; 
      $iAuthorId = $post->post_author;

      $sArchiveTitle  = __( 'Publicado por:', 'front-end-ninja' );
      $sArchiveElse   = get_the_author_meta('display_name', $iAuthorId);
      break;
    case 'day':
      $day    = 'l, F j, Y';
      $sTimeTitle     = __( 'Archivos por día:', 'front-end-ninja' );
      $sTimeFormat    = $day;
    case 'month':
      $month  = 'F Y';
      $sTimeTitle     = empty($sTimeTitle) ? __( 'Archivos por mes:', 'front-end-ninja' ) : $sTimeTitle;
      $sTimeFormat    = empty($sTimeFormat) ?  $month : $sTimeFormat;
    case 'year':
      $year   = 'Y';
      $sTimeTitle     = empty($sTimeTitle) ? __( 'Archivos por año:', 'front-end-ninja' ) : $sTimeTitle;
      $sTimeFormat    = empty($sTimeFormat) ?  $year : $sTimeFormat;

      $sArchiveTitle  = $sTimeTitle;
      $sArchiveElse   = get_the_time($sTimeFormat);

      break;
    case 'tax':
      $sArchiveTitle  = __( 'Tax:', 'front-end-ninja' );
      $sArchiveElse   = single_term_title( '', false );
      break;
    
    default:
      break;
  } ?>

    <h1>
      <span><?php echo $sArchiveTitle; ?></span> <?php echo $sArchiveElse; ?>
    </h1><?php 
    if (have_posts()) :
      while (have_posts()) : the_post(); 

        /**
        * fen_post_content hook.
        *
        * @hooked fen_template_post_feed - 10
        */
        do_action('fen_post_feed');

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

    else : ?>
      <p>No se encontró nada.</p><?php 
    endif;

get_footer();

