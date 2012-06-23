<?php add_action('init', 'make_case_studys_posts');
function make_case_studys_posts() 
{ 
$description = get_option('hh_case_post_type_description');
$labels = array(
    'name' => _x('Case Studies', 'post type general name'),
    'singular_name' => _x('Case Study', 'post type singular name'),
    'add_new' => _x('Add New', 'Case Study'),
    'add_new_item' => __('Add New Case Study'),
    'edit_item' => __('Edit Case Study'),
    'new_item' => __('New Case Study'),
    'view_item' => __('View Case Study'),
    'search_items' => __('Search the Case Studies Catalog'),
    'not_found' =>  __('No Case Studies found'),
    'not_found_in_trash' => __('No Case Studies found in Trash'), 
    'parent_item_colon' => '',
    'description' => $description
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
    'menu_position' => 18,
	'taxonomies' => array( 'post_tag', 'category '),
    'supports' => array('title','tags','thumbnail','editor','revisions','excerpt')
  ); 
  register_post_type('hh_case_study',$args);//this is where the post type is created
  }
//add filter to insure the text case_study, or case_study, is displayed when user updates a case_study 
add_filter('post_updated_messages', 'hh_case_study_updated_messages');
function hh_case_study_updated_messages( $messages ) {
  global $post, $post_ID;
  $messages['hh_case_study'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('case_study updated. <a href="%s">View the case_study</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('case_study updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('case_study restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('case_study published. <a href="%s">View case_study</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('case_study saved.'),
    8 => sprintf( __('case_study submitted. <a target="_blank" href="%s">Preview case_study</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('case_study scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview case_study</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('case_study draft updated. <a target="_blank" href="%s">Preview case_study</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
//display contextual help for case_studys
add_action( 'contextual_help', 'add_case_study_help_text', 10, 3 );
function add_case_study_help_text($contextual_help, $screen_id, $screen) { 
  //$contextual_help .= var_dump($screen); // use this to help determine $screen->id
  if ('hh_case_study' == $screen->id ) {
    $contextual_help =
      '<p>' . __('Things to remember when adding or editing a case_study:') . '</p>' .
      '<ul>' .
      '<li>' . __('Be sure to provide all the case_study info.') . '</li>' .
      '<li>' . __('double check for clarity ') . '</li>' .
      '</ul>' .
      '<p>' . __('If you want to schedule the case_study to be published in the future:') . '</p>' .
      '<ul>' .
      '<li>' . __('Under the Publish module, click on the Edit link next to Publish.') . '</li>' .
      '<li>' . __('Change the date to the date to actual publish this article, then click on Ok.') . '</li>' .
      '</ul>' .
      '<p><strong>' . __('For more information:') . '</strong></p>' .
      '<p>' . __('<a href="http://codex.wordpress.org/Posts_Edit_SubPanel" target="_blank">Edit Posts Documentation</a>') . '</p>' .
      '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>') . '</p>' . 
      '<p>' . __('Be Strong, Young Jedi!') . '</p>';
  } elseif ( 'edit-hh_case_study' == $screen->id ) {
    $contextual_help = 
      '<p>' . __('This is the help screen displaying the table of case_studys.') . '</p>' ;
  }
  return $contextual_help;
  }
?>