<?php 

// Thumbnail sizes
// add_image_size( 'slide-1500-500', 1500, 500, true );
add_image_size( 'slide-1920-460', 1920, 460, true ); // default fullwith carousel slide

add_image_size( 'bg-thumbnail', 640, 480, true );
add_image_size( 'md-thumbnail', 360, 270, true );
add_image_size( 'sm-thumbnail', 203, 152, true );

/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 640 x 480 sized image,
we would use the function:
<?php the_post_thumbnail( 'bg-thumbnail' ); ?>
for the 360 x 270 image:
<?php the_post_thumbnail( 'md-thumbnail' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'fen_custom_image_sizes' );

function fen_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(
        'bg-thumbnail' => __('640x480 px'),
      // 'md-thumbnail' => __('360x270 px'),
      // 'sm-thumbnail' => __('203x152 px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select 
the new images sizes you have just created from within the media manager 
when you add media to your content blocks. If you add more image sizes, 
duplicate one of the lines in the array and name it according to your 
new image size.
*/