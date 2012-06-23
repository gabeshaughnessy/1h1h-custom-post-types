<?php add_action('init', 'make_proposals_posts');
function make_proposals_posts() 
{ 
$labels = array(
    'name' => _x('Proposals', 'post type general name'),
    'singular_name' => _x('Proposal', 'post type singular name'),
    'add_new' => _x('Add New', 'Proposal'),
    'add_new_item' => __('Add New Proposal'),
    'edit_item' => __('Edit Proposal'),
    'new_item' => __('New Proposal'),
    'view_item' => __('View Proposal'),
    'search_items' => __('Search the Proposal Catalog'),
    'not_found' =>  __('No Proposals found'),
    'not_found_in_trash' => __('No Proposals found in Trash'), 
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
    'menu_position' => 28,
	'taxonomies' => array( 'post_tag', 'category '),
    'supports' => array('title','tags','thumbnail','editor','revisions','excerpt')
  ); 
  register_post_type('hh_proposal',$args);//this is where the post type is created
  }
//add filter to insure the text proposal, or proposal, is displayed when user updates a proposal 
add_filter('post_updated_messages', 'hh_proposal_updated_messages');
function hh_proposal_updated_messages( $messages ) {
  global $post, $post_ID;
  $messages['hh_proposal'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('proposal updated. <a href="%s">View the proposal</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('proposal updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('proposal restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('proposal published. <a href="%s">View proposal</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('proposal saved.'),
    8 => sprintf( __('proposal submitted. <a target="_blank" href="%s">Preview proposal</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('proposal scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview proposal</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('proposal draft updated. <a target="_blank" href="%s">Preview proposal</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
//display contextual help for proposals
add_action( 'contextual_help', 'add_proposal_help_text', 10, 3 );
function add_proposal_help_text($contextual_help, $screen_id, $screen) { 
  //$contextual_help .= var_dump($screen); // use this to help determine $screen->id
  if ('hh_proposal' == $screen->id ) {
    $contextual_help =
      '<p>' . __('Things to remember when adding or editing a proposal:') . '</p>' .
      '<ul>' .
      '<li>' . __('Be sure to provide all the proposal info.') . '</li>' .
      '<li>' . __('double check for clarity ') . '</li>' .
      '</ul>' .
      '<p>' . __('If you want to schedule the proposal to be published in the future:') . '</p>' .
      '<ul>' .
      '<li>' . __('Under the Publish module, click on the Edit link next to Publish.') . '</li>' .
      '<li>' . __('Change the date to the date to actual publish this article, then click on Ok.') . '</li>' .
      '</ul>' .
      '<p><strong>' . __('For more information:') . '</strong></p>' .
      '<p>' . __('<a href="http://codex.wordpress.org/Posts_Edit_SubPanel" target="_blank">Edit Posts Documentation</a>') . '</p>' .
      '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>') . '</p>' . 
      '<p>' . __('Be Strong, Young Jedi!') . '</p>';
  } elseif ( 'edit-hh_proposal' == $screen->id ) {
    $contextual_help = 
      '<p>' . __('This is the help screen displaying the table of proposals.') . '</p>' ;
  }
  return $contextual_help;
  }
?>