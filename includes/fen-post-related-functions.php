<?php
/**
* Related Posts
*
* Using post tags, get related posts.
* @return echo unordered list with related posts.
* Usage: fen_related_posts();
*/
// Related Posts Function (call using fen_related_posts(); )
function fen_related_posts() {
  echo '<ul id="related-posts">';
  global $post;
  $tags = wp_get_post_tags( $post->ID );
  if($tags) {
    foreach( $tags as $tag ) { 
      $tag_arr .= $tag->slug . ',';
    }
    $args = array(
      'tag' => $tag_arr,
      'numberposts' => 5, /* you can change this to show more */
      'post__not_in' => array($post->ID)
    );
    $related_posts = get_posts( $args );
    if($related_posts) {
      foreach ( $related_posts as $post ) : setup_postdata( $post ); ?>
        <li class="related_post"><a class="entry-unrelated" href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
      <?php endforeach; }
    else { ?>
      <?php echo '<li class="no_related_post">' . __( 'No Related Posts Yet!', 'front-end-ninja' ) . '</li>'; ?>
    <?php }
  }
  wp_reset_query();
  echo '</ul>';
} /* end bones related posts function */

/**
* Paginate Links
* @return Archive pagination links.
* Usage: fen_paginate_links();
*/
function fen_paginate_links(){
  // DOCS: http://codex.wordpress.org/Function_Reference/paginate_links
  global $wp_query;

  $big = 999999999; // need an unlikely integer
  if ( $wp_query->max_num_pages <= 1 )
    return;

  $args = array(
    'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
    'format' => '?paged=%#%',
    'total' => $wp_query->max_num_pages,
    'current' => max( 1, get_query_var('paged') ),
    // 'show_all'     => False,
    'end_size'     => 1,
    'mid_size'     => 2,
    'prev_next'    => True,
    'prev_text'    => __('« Anterior'),
    'next_text'    => __('Siguiente »'),
    'type'         => 'list'
    // 'add_args'     => False,
    // 'add_fragment' => '',
    // 'before_page_number' => '',
    // 'after_page_number' => ''
  ); 

  echo '<nav class="pagination">';
    echo paginate_links($args);
  echo '</nav>';
}

/**
 * This is a modified the_author_posts_link() which just returns the link.
 * @return author's link
 */
function fen_get_the_author_link() {
  global $authordata;
  if ( !is_object( $authordata ) )
    return false;
  $link = sprintf(
    '<a href="%1$s" title="%2$s" rel="author">%3$s</a>',
    get_author_posts_url( $authordata->ID, $authordata->user_nicename ),
    esc_attr( sprintf( __( 'Posts by %s' ), get_the_author() ) ), // No further l10n needed, core will take care of this one
    get_the_author()
  );
  return $link;
}

/**
* Post Categories function
* 
* @param  $separator      string (optional)    Item's separator. Default: ', '
* @return Categories links.
* It's necesary to echo the function when using it, ex: echo fen_categories();
*/
function fen_categories($separator = ', '){
  $categories = get_the_category();
  if($categories):
    $category = '';
    foreach($categories as $category_meta):
      $category .= '<a href="'.get_category_link( $category_meta->term_id ).'" title="' . esc_attr( sprintf( __( "Ver todas las publicaciones en %s" ), $category_meta->name ) ) . '" itemprop="url"><span itemprop="title">'.$category_meta->cat_name.'</span></a>'.$separator; 
    endforeach;
    return trim($category, $separator);
  endif;

  return FALSE;
}

/**
* Post Tags function
* 
* @param  $separator      string (optional)    Item's separator. Default: ', '
* @return Post Tag links
* Its necesary to echo the function when using it, ex: echo fen_tags();
*/
function fen_tags($separator = ', '){
  $posttags = get_the_tags();
  if($posttags):
    $tag = '';
    foreach($posttags as $meta_tag):
      $tag .= '<a href="'.get_tag_link($meta_tag->term_id).'">'.$meta_tag->name .'</a>'.$separator; 
    endforeach;
    return trim($tag, $separator);
  else:
    $tag = FALSE;
    return $tag;
  endif; 
}
