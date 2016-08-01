<?php 
/*
* Sidebars & Widgetizes Areas
*/
function fen_register_sidebars() {
  // DOCS: http://codex.wordpress.org/Function_Reference/dynamic_sidebar

  register_sidebar(array(
    'id' => 'page-sidebar', // Change the id
    'name' => '[Page] Sidebar', // Change the name
    'description' => 'Add some widgets.',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'single-sidebar', // Change the id
    'name' => '[Single] Sidebar', // Change the name
    'description' => 'Add some widgets.',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

  register_sidebar(array(
    'id' => 'archive-sidebar', // Change the id
    'name' => '[Archive] Sidebar', // Change the name
    'description' => 'Add some widgets.',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="widgettitle">',
    'after_title' => '</h4>',
  ));

}