<?php add_action('init', 'make_rentals_posts');
function make_rentals_posts() 
{ 
$labels = array(
    'name' => _x('Rentals', 'post type general name'),
    'singular_name' => _x('Rental', 'post type singular name'),
    'add_new' => _x('Add New', 'Rental'),
    'add_new_item' => __('Add New Rental'),
    'edit_item' => __('Edit Rental'),
    'new_item' => __('New Rental'),
    'view_item' => __('View Rental'),
    'search_items' => __('Search the Rental Catalog'),
    'not_found' =>  __('No rentals found'),
    'not_found_in_trash' => __('No rentals found in Trash'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true, 
    'show_in_menu' => true,
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 12,
	'taxonomies' => array( 'post_tag', 'category '),
    'supports' => array('title','tags','thumbnail','editor','revisions','excerpt')
  ); 
  register_post_type('hh_rental',$args);//this is where the post type is created
  }
//add filter to insure the text rental, or rental, is displayed when user updates a rental 
add_filter('post_updated_messages', 'hh_rental_updated_messages');
function hh_rental_updated_messages( $messages ) {
  global $post, $post_ID;
  $messages['hh_rental'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('rental updated. <a href="%s">View the rental</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('rental updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('rental restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('rental published. <a href="%s">View rental</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('rental saved.'),
    8 => sprintf( __('rental submitted. <a target="_blank" href="%s">Preview rental</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('rental scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview rental</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('rental draft updated. <a target="_blank" href="%s">Preview rental</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
//display contextual help for rentals
add_action( 'contextual_help', 'add_rental_help_text', 10, 3 );
function add_rental_help_text($contextual_help, $screen_id, $screen) { 
  //$contextual_help .= var_dump($screen); // use this to help determine $screen->id
  if ('hh_rental' == $screen->id ) {
    $contextual_help =
      '<p>' . __('Things to remember when adding or editing a rental:') . '</p>' .
      '<ul>' .
      '<li>' . __('Be sure to provide all the rental info.') . '</li>' .
      '<li>' . __('double check for clarity ') . '</li>' .
      '</ul>' .
      '<p>' . __('If you want to schedule the rental to be published in the future:') . '</p>' .
      '<ul>' .
      '<li>' . __('Under the Publish module, click on the Edit link next to Publish.') . '</li>' .
      '<li>' . __('Change the date to the date to actual publish this article, then click on Ok.') . '</li>' .
      '</ul>' .
      '<p><strong>' . __('For more information:') . '</strong></p>' .
      '<p>' . __('<a href="http://codex.wordpress.org/Posts_Edit_SubPanel" target="_blank">Edit Posts Documentation</a>') . '</p>' .
      '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>') . '</p>' . 
      '<p>' . __('Be Strong, Young Jedi!') . '</p>';
  } elseif ( 'edit-hh_rental' == $screen->id ) {
    $contextual_help = 
      '<p>' . __('This is the help screen displaying the table of rentals.') . '</p>' ;
  }
  return $contextual_help;
  }
?>