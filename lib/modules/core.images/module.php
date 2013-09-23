<?php

/*
 * The Featured Images core options for the Shoestrap theme
 */
if ( !function_exists( 'shoestrap_module_featured_images_options' ) ) :
function shoestrap_module_featured_images_options( $sections ) {

  // Blog Options
  $section = array( 
    'title'     => __( 'Featured Images', 'shoestrap' ),
    'icon'      => 'elusive icon-picture icon-large',
  );

  $fields[] = array( 
    'id'        => 'help3',
    'title'     => __( 'Featured Images', 'shoestrap' ),
    'desc'      => __( 'Here you can select if you want to display the featured images in post archives and individual posts.
                    Please note that these apply to posts, pages, as well as custom post types.
                    You can select image sizes independently for archives and individual posts view.', 'shoestrap' ),
    'type'      => 'info',
    'fold'      => 'advanced_toggle'
  );

  $fields[] = array( 
    'title'     => __( 'Featured Images on Archives', 'shoestrap' ),
    'desc'      => __( 'Display featured Images on post archives ( such as categories, tags, month view etc ). Default: OFF.', 'shoestrap' ),
    'id'        => 'feat_img_archive',
    'default'   => 0,
    'type'      => 'switch',
    'customizer'=> array(),
    'fold'      => 'advanced_toggle'
  );


  $fields[] = array( 
    'title'     => __( 'Featured Images on Archives Full Width', 'shoestrap' ),
    'desc'      => __( 'Display featured Images on posts. Default: OFF.', 'shoestrap' ),
    'id'        => 'feat_img_archive_custom_toggle',
    'default'   => 0,
    'fold'      => 'feat_img_archive',
    'off'       => __( 'Full Width', 'shoestrap' ),
    'on'        => __( 'Custom Dimensions', 'shoestrap' ),
    'type'      => 'switch',
    'customizer'=> array(),
  );

  $fields[] = array( 
    'title'     => __( 'Archives Featured Image Width', 'shoestrap' ),
    'desc'      => __( 'Select the width of your featured images on single posts. Default: 550px', 'shoestrap' ),
    'id'        => 'feat_img_archive_width',
    'default'   => 550,
    'min'       => 100,
    'fold'      => 'feat_img_archive_custom_toggle',
    'step'      => 1,
    'max'       => 1000,
    'edit'      => 1,
    'type'      => 'slider'
  );

  $fields[] = array( 
    'title'     => __( 'Archives Featured Image Height', 'shoestrap' ),
    'desc'      => __( 'Select the height of your featured images on post archives. Default: 300px', 'shoestrap' ),
    'id'        => 'feat_img_archive_height',
    'fold'      => 'feat_img_archive_custom_toggle',
    'default'   => 300,
    'min'       => 50,
    'step'      => 1,
    'edit'      => 1,
    'max'       => 1000,
    'type'      => 'slider'
  );

  $fields[] = array( 
    'title'     => __( 'Featured Images on Posts', 'shoestrap' ),
    'desc'      => __( 'Display featured Images on posts. Default: OFF.', 'shoestrap' ),
    'id'        => 'feat_img_post',
    'default'   => 0,
    'type'      => 'switch',
    'customizer'=> array(),
    'fold'      => 'advanced_toggle'
  );

  $fields[] = array( 
    'title'     => __( 'Featured Images on Posts Full Width', 'shoestrap' ),
    'desc'      => __( 'Display featured Images on posts. Default: OFF.', 'shoestrap' ),
    'id'        => 'feat_img_post_custom_toggle',
    'default'   => 0,
    'fold'      => 'feat_img_post',
    'off'       => __( 'Full Width', 'shoestrap' ),
    'on'        => __( 'Custom Dimensions', 'shoestrap' ),
    'type'      => 'switch',
    'customizer'=> array(),
  );

  $fields[] = array( 
    'title'     => __( 'Posts Featured Image Width', 'shoestrap' ),
    'desc'      => __( 'Select the width of your featured images on single posts. Default: 550px', 'shoestrap' ),
    'id'        => 'feat_img_post_width',
    'default'   => 550,
    'min'       => 100,
    'fold'      => 'feat_img_post_custom_toggle',
    'step'      => 1,
    'max'       => 1000,
    'edit'      => 1,
    'type'      => 'slider'
  );

  $fields[] = array( 
    'title'     => __( 'Posts Featured Image Height', 'shoestrap' ),
    'desc'      => __( 'Select the height of your featured images on single posts. Default: 330px', 'shoestrap' ),
    'id'        => 'feat_img_post_height',
    'fold'      => 'feat_img_post_custom_toggle',
    'default'   => 330,
    'min'       => 50,
    'step'      => 1,
    'max'       => 1000,
    'edit'      => 1,
    'type'      => 'slider'
  );   

  $section['fields'] = $fields;

  $section = apply_filters( 'shoestrap_module_featured_images_options_modifier', $section );
  
  $sections[] = $section;
  return $sections;

}
endif;
add_filter( 'redux-sections-'.REDUX_OPT_NAME, 'shoestrap_module_featured_images_options', 90 );

if ( !function_exists( 'shoestrap_core_blog_comments_toggle' ) ) :
function shoestrap_core_blog_comments_toggle() {
  if ( shoestrap_getVariable( 'blog_comments_toggle' ) == 1 ) {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'post', 'trackbacks' );
    add_filter( 'get_comments_number', '__return_false', 10, 3 );
  }
}
endif;
add_action( 'init','shoestrap_core_blog_comments_toggle', 1 );

// Simply include our alternative functions for image resizing
include_once( dirname(__FILE__).'/resize.php' );
include_once( dirname(__FILE__).'/functions.images.php' );