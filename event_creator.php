<?php add_action('init', 'my_custom_init');
function my_custom_init() 
{ 
 $labels = array(
    'name' => _x('Events', 'post type general name'),
    'singular_name' => _x('Event', 'post type singular name'),
    'add_new' => _x('Add New', 'Event'),
    'add_new_item' => __('Add New Event'),
    'edit_item' => __('Edit Event'),
    'new_item' => __('New Event'),
    'view_item' => __('View Event'),
    'search_items' => __('Search Events'),
    'not_found' =>  __('No Events found'),
    'not_found_in_trash' => __('No Events found in Trash'), 
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'Event_ui' => true, 
    'query_var' => true,
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => 7,
	'taxonomies' => array( 'post_tag', 'category '),
    'supports' => array('title', 'tags', 'thumbnail')
  ); 
  register_post_type('hh_event',$args);
}
//add filter to insure the text Event, or Event, is displayed when user updates a Event 
add_filter('post_updated_messages', 'Event_updated_messages');
function Event_updated_messages( $messages ) {
  global $post, $post_ID;
  $messages['Event'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('Event updated. <a href="%s">View Event</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('Event updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('Event restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('Event published. <a href="%s">View Event</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('Event saved.'),
    8 => sprintf( __('Event submitted. <a target="_blank" href="%s">Preview Event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('Event scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Event</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('Event draft updated. <a target="_blank" href="%s">Preview Event</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
//display contextual help for Events
add_action( 'contextual_help', 'add_help_text', 10, 3 );
function add_help_text($contextual_help, $screen_id, $screen) { 
  //$contextual_help .= var_dump($screen); // use this to help determine $screen->id
  if ('event' == $screen->id ) {
    $contextual_help =
      '<p>' . __('Things to remember when adding or editing a event:') . '</p>' .
      '<ul>' .
      '<li>' . __('Be sure to provide all the event info.') . '</li>' .
      '<li>' . __('double check for clarity ') . '</li>' .
      '</ul>' .
      '<p>' . __('If you want to schedule the event to be published in the future:') . '</p>' .
      '<ul>' .
      '<li>' . __('Under the Publish module, click on the Edit link next to Publish.') . '</li>' .
      '<li>' . __('Change the date to the date to actual publish this article, then click on Ok.') . '</li>' .
      '</ul>' .
      '<p><strong>' . __('For more information:') . '</strong></p>' .
      '<p>' . __('<a href="http://codex.wordpress.org/Posts_Edit_SubPanel" target="_blank">Edit Posts Documentation</a>') . '</p>' .
      '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>') . '</p>' ;
  } elseif ( 'edit-event' == $screen->id ) {
    $contextual_help = 
      '<p>' . __('This is the help screen displaying the table of events blah blah blah.') . '</p>' ;
  }
  return $contextual_help;
  }
//add input fields

//Add Taxonomies 
register_taxonomy('venue', 'hh_event', array(

'hierarchical' => false,  'label' => 'Venue',

'query_var' => true, 'rewrite' => true));

?>