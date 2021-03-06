<?php 
/**
* Register wordpress menus
*/
function fen_register_menus(){
  // registering wp3+ menus
  register_nav_menus(
    array(
      'main-nav' => '[Header] Main Menu',
      'footer-main-nav' => '[Footer] Main Menu'
    )
  );
}

/**
* Fen Main Nav
* Echo the main-nav menu-
*/
function fen_main_nav(){
  wp_nav_menu(array(
    'theme_location' => 'main-nav',
    'menu'            => 'main-nav',
    // 'container'       => 'nav',
    'container_class' => '',
    'container_id'    => 'main-nav',
    'menu_id'         => 'main-nav-menu',
    'echo'            => true,
    'fallback_cb'     => false,
    'before'          => '',
    'after'           => '',
    'link_before'     => '',
    'link_after'      => '',
    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
    'depth'           => 0,
    'walker'          => ''
  ));
}

function fen_footer_main_nav(){
  wp_nav_menu(array(
    'theme_location' => 'footer-main-nav',
    'menu'            => 'footer-main-nav',
    'container'       => 'nav',
    'container_class' => 'footer-main-nav-container',
    'container_id'    => 'footer-main-nav',
    'menu_class'      => 'menu',
    'menu_id'         => 'footer-main-nav-menu',
    'echo'            => true,
    'fallback_cb'     => false,
    'before'          => '',
    'after'           => '',
    'link_before'     => '',
    'link_after'      => '',
    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
    'depth'           => -1, // no depth allowed
    'walker'          => ''
  ));
}

