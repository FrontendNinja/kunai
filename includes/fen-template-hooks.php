<?php 
/**
* We create a hook with each template function.
* add_action($sHookName, $sFunctionName, $nPriority)
*/

/**
 * Post Content Items.
 *
 * @see fen_template_post_content
 */

add_action( 'fen_post_content', 'fen_template_post_content', 10 );

/**
 * Post Feed Items.
 *
 * @see fen_template_post_feed
 */
add_action( 'fen_post_feed', 'fen_template_post_feed', 10 );

