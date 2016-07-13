<?php 
/**
* @author   Carlos González from Front End Ninja
* @version  1.0
* @param    none    Doesn't recieve any parameters.
* 
* @return   Post ancestors as breadcrumbs. It's necesary to echo this function when using it. 
* ex: echo get_breadcrumbs();
*/
function get_breadcrumbs(){
  global $post;
  $separator = ''; // »
  $i = 1;

  /** 
  * Breadcrumb Template
  * Function retrieve the list item template.
  * @param        $permalink = The list item permalink.
  * @param        $title = The list item title.
  * @param        $separator (Optional) = The list item separator, it will be used inside the li but outside the <a> tag. Default none.
  * @param        $classes (Optional) = The list item classes. Default none.
  * 
  * @return       string
  */
  function breadcrumb_template($permalink, $title, $i=0, $separator="", $classes=""){
    $breadcrumb_template =  '<li '.(!empty($classes) ? 'class="'.$classes.'" ':''). 
                                'itemprop="itemListElement" itemscope
                                itemtype="http://schema.org/ListItem">
                              <a itemprop="item" href="'.$permalink.'">
                                <span itemprop="name">'.$title.'</span></a>
                              <meta itemprop="position" content="'.$i.'" />'.
                              (!empty($separator) ? $separator:'').
                            '</li>';
    return $breadcrumb_template;
  }

  function term_ancestors($term_array, $n, $ancestors = ''){

    if($term_array->parent != 0){
      $parent = get_term($term_array->parent, 'product_cat');
      $parent_permalink = get_term_link( $parent->term_id, 'product_cat');
      $ancestors = breadcrumb_template($parent_permalink, $parent->name, $n, $separator) . $ancestors;
      $n++;

      return term_ancestors( $parent, $n, $ancestors);
    }
    
    return $ancestors;
  }
  
  /** 
  * Get Page Ancestors
  * Function retrieve post type ancestors inside an array.
  * @param        $n = The current ancestor number.
  * @param        $post_type = Current Post type, used to retrieve the matching variables for the template.
  *
  * @return       array()
  */
  function get_page_ancestors($n, $post_type){
    $n++;
    global $post;

    $post_type = get_post_type();

    switch ($post_type) {
      case 'post':
        $category_meta = get_the_category($post->ID)[0];
        $archive_title = get_the_category($post->ID)[0]->name;
        $archive_permalink = get_category_link($category_meta->term_id);
        $page_acenstors['ancestors'] = breadcrumb_template($archive_permalink,  $archive_title,  $n,  $separator );
        $n++;
        break;

      case 'page':
        $post_ancestors = array_reverse(get_post_ancestors($post->ID));
        $page_acenstors = array();

        foreach ($post_ancestors as $key => $ancestor):
          $page_acenstors['ancestors'] .= breadcrumb_template(get_permalink($ancestor), get_post($ancestor)->post_title, $n, $separator);
        $n++; endforeach;
        break;

      case 'tax':
        // Post Type
        $post_type_permalink = get_post_type_archive_link($post_type);
        $page_acenstors['ancestors'] = breadcrumb_template($post_type_permalink,  $post_type,  $n,  $separator );
        // $tax = get_taxonomy( get_queried_object()->taxonomy );
        // $tax_name = single_term_title("", false);
        // $tax_slug = $tax->rewrite['slug'];

        // $tax_permalink = get_term_link(get_term_by('name', $tax_name, $tax_slug)->term_id );
        break;
      case 'product':
        if(!is_tax()){
          $term = wp_get_post_terms( $post->ID, 'product_cat' )[0];
          $term_permalink = get_term_link( $term->term_id, 'product_cat');
          
          $page_acenstors['ancestors'] .= term_ancestors($term, $n);

          $page_acenstors['ancestors'] .= breadcrumb_template($term_permalink, $term->name, $n, $separator);
          

          $n++;
        }
        break;
      // case 'author':
      //   $author_ID        = $post->post_author;
      //   $author_data      = get_userdata($author_ID);
      //   $author_permalink = get_author_posts_url( $author_ID, $author_data->data->user_nicename );

      default:
        $archive_permalink = get_post_type_archive_link($post_type);
        $page_acenstors['ancestors'] = breadcrumb_template($archive_permalink,  $archive_title,  $n,  $separator );
        break;
    }

    $page_acenstors['counter'] = $n;
    return $page_acenstors;
  }



  $breadcrumb_opening = '<ol class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">';
  $breadcrumb_closing = '</ol>';

  // Breadcrumbs Opening
  $breadcrumbs .= $breadcrumb_opening.
                  breadcrumb_template(get_bloginfo("url"), __('Inicio', 'Front-End-Ninja'), $i, $separator);
  
  // Here we check which post_type are used on the current post to retrieve its ancestors information.
  $custom_post_type = get_post_type();

  // This is needed because sometimes the get_post_type is the same for single and taxonomies archive.
  $current_post_type = 
    is_page() ? 'page' : (
    is_single() ? 'single' : (
    is_category() ? 'category' : (
    is_tag() ? 'tag' : (
    is_author() ? 'author' : (
    is_day() ? 'day' : (
    is_month() ? 'month' : (
    is_year() ? 'year' : (
    is_post_type_archive() ? 'custom-post-type' : ( 
    is_tax() ? 'tax' : (
    is_search() ? 'search' : 'other')
    )))))))));

  // Execute get_page_ancestors();
  $ancestors_array = get_page_ancestors($i, $current_post_type);

  $post_type = array(
    'page' => array(
      'permalink'     => get_permalink($post->ID),
      'title'         => $post->post_title,
      'ancestors'     => $ancestors_array['ancestors'], // Return page ancestors
      'counter'       => $ancestors_array['counter'],
    ),
    'category' => array(
      'permalink'     => get_category_link(get_query_var('cat')),
      'title'         => get_category(get_query_var('cat'))->name,
      'ancestors'     => $ancestors_array['ancestors'], // We don't get any ancestors for categories.
      'counter'       => $ancestors_array['counter'],
    ),
    'single' => array(
      'permalink'     => get_permalink($post->ID),
      'title'         => $post->post_title,
      'ancestors'     => $ancestors_array['ancestors'], // Return first category
      'counter'       => $ancestors_array['counter'],
    ),
    'tag' => array(
      'permalink'     => get_tag_link(get_query_var('tag_id')),
      'title'         => get_tag(get_query_var('tag_id'))->name,
      'ancestors'     => $ancestors_array['ancestors'],
      'counter'       => $ancestors_array['counter'],
    ),
    'custom-post-type' => array(
      'permalink'     => get_post_type_archive_link(get_post_type()),
      'title'         => post_type_archive_title('',false),
      'ancestors'     => '',
      'counter'       => $ancestors_array['counter'],
    ),
    'tax' => array(
      'permalink'     => $tax_permalink,
      'title'         => single_term_title("", false),
      'ancestors'     => $ancestors_array['ancestors'],
      'counter'       => $ancestors_array['counter'],
    ),
    'author' => array(
      'permalink'     => $author_permalink,
      'title'         => get_the_author_meta('display_name', $author_ID),
      'ancestors'     => $ancestors_array['ancestors'],
      'counter'       => $ancestors_array['counter'],
    ),
    'day' => array(
      'permalink'     => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
      'title'         => __( 'Archivo: ', 'front-end-ninja' ).get_the_time('l, F j, Y'),
      'ancestors'     => $ancestors_array['ancestors'],
      'counter'       => $ancestors_array['counter'],
    ),
    'month' => array(
      'permalink'     => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
      'title'         => __( 'Archivo: ', 'front-end-ninja' ).get_the_time('F Y'),
      'ancestors'     => $ancestors_array['ancestors'],
      'counter'       => $ancestors_array['counter'],
    ),
    'year' => array(
      'permalink'     => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
      'title'         => __( 'Archivo: ', 'front-end-ninja' ).get_the_time('Y'),
      'ancestors'     => $ancestors_array['ancestors'],
      'counter'       => $ancestors_array['counter'],
    ),
    'search' => array(
      'permalink'     => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
      'title'         => __('Búsqueda', 'front-end-ninja'),
      'ancestors'     => '',
      'counter'       => '',
    ),
    'other' => array(
      'permalink'     => 'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . '://' . "{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}",
      'title'         => "Error: 404",
      'ancestors'     => $ancestors_array['ancestors'],
      'counter'       => $ancestors_array['counter'],
    )
  );

  // Breadcrumbs Middle Part
  $breadcrumbs .= $post_type[$current_post_type]['ancestors'];

  // Breadcrumbs Current Post
  $i = $post_type[$current_post_type]['counter'];
  $current_post .= breadcrumb_template( $post_type[$current_post_type]['permalink'], $post_type[$current_post_type]['title'], $i, '', 'current-post' );
  $breadcrumbs .= $current_post;

  // Breadcrumbs Closing
  $breadcrumbs .= $breadcrumb_closing;

  return $breadcrumbs;
}