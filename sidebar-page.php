<div id="page-sidebar" role="complementary"><?php 

  if ( is_active_sidebar( 'page-sidebar' ) ) :

    dynamic_sidebar( 'page-sidebar' );

  else:

  /* This content shows up if there are no widgets defined in the backend. */ ?>

    <div class="alert alert-help">
      <p><?php _e( 'Please activate some Widgets.', 'front-end-ninja' );  ?></p>
    </div><?php 
  endif; ?>

</div>