
<article role="article">
  <header>
    <h3><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
        <?php the_title(); ?>
    </a></h3>
  </header><?php 

  if(has_post_thumbnail()):
    the_post_thumbnail( 'medium' );
  endif;

  the_excerpt(); ?>

  <footer><?php 
    the_tags( '<span class="tags">' . __( 'Tags:', 'front-end-ninja' ) . '</span> ', ', ', '' ); ?>
  </footer>
</article>