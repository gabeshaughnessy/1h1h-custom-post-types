<?php add_action('init', 'make_testimonials_posts');
function make_testimonials_posts() 
{ 
$description = get_option('hh_testimonial_post_type_description');
$labels = array(
    'name' => _x('Testimonials', 'post type general name'),
    'singular_name' => _x('Testimonial', 'post type singular name'),
    'add_new' => _x('Add New', 'Testimonial'),
    'add_new_item' => __('Add New Testimonial'),
    'edit_item' => __('Edit Testimonial'),
    'new_item' => __('New Testimonial'),
    'view_item' => __('View Testimonial'),
    'search_items' => __('Search the Testimonial Catalog'),
    'not_found' =>  __('No Testimonials found'),
    'not_found_in_trash' => __('No Testimonials found in Trash'), 
    'parent_item_colon' => '',
    'description' => $description
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 22,
	'taxonomies' => array( 'post_tag', 'category '),
    'supports' => array('title','tags','thumbnail','editor','revisions','excerpt')
  ); 
  register_post_type('hh_testimonial',$args);//this is where the post type is created
  }
//add filter to insure the text testimonial, or testimonial, is displayed when user updates a testimonial 
add_filter('post_updated_messages', 'hh_testimonial_updated_messages');
function hh_testimonial_updated_messages( $messages ) {
  global $post, $post_ID;
  $messages['hh_testimonial'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('testimonial updated. <a href="%s">View the testimonial</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('testimonial updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('testimonial restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('testimonial published. <a href="%s">View testimonial</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('testimonial saved.'),
    8 => sprintf( __('testimonial submitted. <a target="_blank" href="%s">Preview testimonial</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('testimonial scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview testimonial</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('testimonial draft updated. <a target="_blank" href="%s">Preview testimonial</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
//display contextual help for testimonials
add_action( 'contextual_help', 'add_testimonial_help_text', 10, 3 );
function add_testimonial_help_text($contextual_help, $screen_id, $screen) { 
  //$contextual_help .= var_dump($screen); // use this to help determine $screen->id
  if ('hh_testimonial' == $screen->id ) {
    $contextual_help =
      '<p>' . __('Things to remember when adding or editing a testimonial:') . '</p>' .
      '<ul>' .
      '<li>' . __('Be sure to provide all the testimonial info.') . '</li>' .
      '<li>' . __('double check for clarity ') . '</li>' .
      '</ul>' .
      '<p>' . __('If you want to schedule the testimonial to be published in the future:') . '</p>' .
      '<ul>' .
      '<li>' . __('Under the Publish module, click on the Edit link next to Publish.') . '</li>' .
      '<li>' . __('Change the date to the date to actual publish this article, then click on Ok.') . '</li>' .
      '</ul>' .
      '<p><strong>' . __('For more information:') . '</strong></p>' .
      '<p>' . __('<a href="http://codex.wordpress.org/Posts_Edit_SubPanel" target="_blank">Edit Posts Documentation</a>') . '</p>' .
      '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>') . '</p>' . 
      '<p>' . __('Be Strong, Young Jedi!') . '</p>';
  } elseif ( 'edit-hh_testimonial' == $screen->id ) {
    $contextual_help = 
      '<p>' . __('This is the help screen displaying the table of testimonials.') . '</p>' ;
  }
  return $contextual_help;
  }

?>