
<article role="article">
  <header><?php 
    the_title('<h1>','</h1>'); ?>
  </header><?php 

  the_content(); ?>

  <footer><?php 
    the_tags( '<span class="tags">' . __( 'Tags:', 'front-end-ninja' ) . '</span> ', ', ', '' ); ?>
  </footer>
</article>