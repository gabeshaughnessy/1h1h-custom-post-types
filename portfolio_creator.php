<?php add_action('init', 'make_portfolios_posts');
function make_portfolios_posts() 
{ 
$description = get_option('hh_portfolio_post_type_description');

$labels = array(
    'name' => _x('Portfolio Entries', 'post type general name'),
    'singular_name' => _x('Portfolio Entry', 'post type singular name'),
    'add_new' => _x('Add New', 'Portfolio Entry'),
    'add_new_item' => __('Add New Portfolio Entry'),
    'edit_item' => __('Edit Portfolio Entry'),
    'new_item' => __('New Portfolio Entry'),
    'view_item' => __('View Portfolio Entries'),
    'search_items' => __('Search the Portfolio Entries Catalog'),
    'not_found' =>  __('No Portfolio Entries found'),
    'not_found_in_trash' => __('No Portfolio Entries found in Trash'), 
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
    'menu_position' => 13,
	'taxonomies' => array( 'post_tag', 'category '),
    'supports' => array('title','tags','thumbnail','editor','revisions','excerpt')
  ); 
  register_post_type('hh_portfolio',$args);//this is where the post type is created
  }
//add filter to insure the text portfolio, or portfolio, is displayed when user updates a portfolio 
add_filter('post_updated_messages', 'hh_portfolio_updated_messages');
function hh_portfolio_updated_messages( $messages ) {
  global $post, $post_ID;
  $messages['hh_portfolio'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('portfolio updated. <a href="%s">View the portfolio</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('portfolio updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('portfolio restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('portfolio published. <a href="%s">View portfolio</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('portfolio saved.'),
    8 => sprintf( __('portfolio submitted. <a target="_blank" href="%s">Preview portfolio</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('portfolio scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview portfolio</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('portfolio draft updated. <a target="_blank" href="%s">Preview portfolio</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
//display contextual help for portfolios
add_action( 'contextual_help', 'add_portfolio_help_text', 10, 3 );
function add_portfolio_help_text($contextual_help, $screen_id, $screen) { 
  //$contextual_help .= var_dump($screen); // use this to help determine $screen->id
  if ('hh_portfolio' == $screen->id ) {
    $contextual_help =
      '<p>' . __('Things to remember when adding or editing a portfolio:') . '</p>' .
      '<ul>' .
      '<li>' . __('Be sure to provide all the portfolio info.') . '</li>' .
      '<li>' . __('double check for clarity ') . '</li>' .
      '</ul>' .
      '<p>' . __('If you want to schedule the portfolio to be published in the future:') . '</p>' .
      '<ul>' .
      '<li>' . __('Under the Publish module, click on the Edit link next to Publish.') . '</li>' .
      '<li>' . __('Change the date to the date to actual publish this article, then click on Ok.') . '</li>' .
      '</ul>' .
      '<p><strong>' . __('For more information:') . '</strong></p>' .
      '<p>' . __('<a href="http://codex.wordpress.org/Posts_Edit_SubPanel" target="_blank">Edit Posts Documentation</a>') . '</p>' .
      '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>') . '</p>' . 
      '<p>' . __('Be Strong, Young Jedi!') . '</p>';
  } elseif ( 'edit-hh_portfolio' == $screen->id ) {
    $contextual_help = 
      '<p>' . __('This is the help screen displaying the table of portfolios.') . '</p>' ;
  }
  return $contextual_help;
  }

?>