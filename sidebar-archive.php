<div id="archive-sidebar" role="complementary"><?php 

  if ( is_active_sidebar( 'archive-sidebar' ) ) :

    dynamic_sidebar( 'archive-sidebar' );

  else:

  /* This content shows up if there are no widgets defined in the backend. */ ?>

    <div class="alert alert-help">
      <p><?php _e( 'Please activate some Widgets.', 'front-end-ninja' );  ?></p>
    </div><?php 
  endif; ?>

</div>

