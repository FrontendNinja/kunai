<?php 
/**
* We create a hook with each template function.
* add_action($sHookName, $sFunctionName, $nPriority)
*/

/**
 * Index Template Items.
 *
 * @see fen_template_post_content
 */

add_action( 'fen_post_content', 'fen_template_post_content', 10 );

