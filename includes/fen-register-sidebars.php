<?php 
/*
* Sidebars & Widgetizes Areas
*/
function fen_register_sidebars() {
  // DOCS: http://codex.wordpress.org/Function_Reference/dynamic_sidebar

  register_sidebar(array(
    'id'            => 'page-sidebar', // ID must be unique
    'name'          => '[Page] Sidebar', // Name must let the user know the location of the sidebar.
    'description'   => 'Add some widgets.',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widgettitle">',
    'after_title'   => '</h4>',
  ));

  register_sidebar(array(
    'id'            => 'single-sidebar', // ID must be unique
    'name'          => '[Single] Sidebar', // Name must let the user know the location of the sidebar.
    'description'   => 'Add some widgets.',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widgettitle">',
    'after_title'   => '</h4>',
  ));

  register_sidebar(array(
    'id'            => 'archive-sidebar', // ID must be unique
    'name'          => '[Archive] Sidebar', // Name must let the user know the location of the sidebar.
    'description'   => 'Add some widgets.',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widgettitle">',
    'after_title'   => '</h4>',
  ));

}