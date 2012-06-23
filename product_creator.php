<?php add_action('init', 'make_products_posts');
function make_products_posts() 
{ 
$labels = array(
    'name' => _x('Products', 'post type general name'),
    'singular_name' => _x('Product', 'post type singular name'),
    'add_new' => _x('Add New', 'Product'),
    'add_new_item' => __('Add New Product'),
    'edit_item' => __('Edit Product'),
    'new_item' => __('New Product'),
    'view_item' => __('View Product'),
    'search_items' => __('Search the product Catalog'),
    'not_found' =>  __('No products found'),
    'not_found_in_trash' => __('No products found in Trash'), 
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
    'menu_position' => 14,
	'taxonomies' => array( 'post_tag', 'category '),
    'supports' => array('title','tags','thumbnail','editor','revisions','excerpt')
  ); 
  register_post_type('hh_product',$args);//this is where the post type is created
  }
//add filter to insure the text product, or product, is displayed when user updates a product 
add_filter('post_updated_messages', 'hh_product_updated_messages');
function hh_product_updated_messages( $messages ) {
  global $post, $post_ID;
  $messages['hh_product'] = array(
    0 => '', // Unused. Messages start at index 1.
    1 => sprintf( __('product updated. <a href="%s">View the product</a>'), esc_url( get_permalink($post_ID) ) ),
    2 => __('Custom field updated.'),
    3 => __('Custom field deleted.'),
    4 => __('product updated.'),
    /* translators: %s: date and time of the revision */
    5 => isset($_GET['revision']) ? sprintf( __('product restored to revision from %s'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
    6 => sprintf( __('product published. <a href="%s">View product</a>'), esc_url( get_permalink($post_ID) ) ),
    7 => __('product saved.'),
    8 => sprintf( __('product submitted. <a target="_blank" href="%s">Preview product</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
    9 => sprintf( __('product scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview product</a>'),
      // translators: Publish box date format, see http://php.net/date
      date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
    10 => sprintf( __('product draft updated. <a target="_blank" href="%s">Preview product</a>'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
  );
  return $messages;
}
//display contextual help for products
add_action( 'contextual_help', 'add_product_help_text', 10, 3 );
function add_product_help_text($contextual_help, $screen_id, $screen) { 
  //$contextual_help .= var_dump($screen); // use this to help determine $screen->id
  if ('hh_product' == $screen->id ) {
    $contextual_help =
      '<p>' . __('Things to remember when adding or editing a product:') . '</p>' .
      '<ul>' .
      '<li>' . __('Be sure to provide all the product info.') . '</li>' .
      '<li>' . __('double check for clarity ') . '</li>' .
      '</ul>' .
      '<p>' . __('If you want to schedule the product to be published in the future:') . '</p>' .
      '<ul>' .
      '<li>' . __('Under the Publish module, click on the Edit link next to Publish.') . '</li>' .
      '<li>' . __('Change the date to the date to actual publish this article, then click on Ok.') . '</li>' .
      '</ul>' .
      '<p><strong>' . __('For more information:') . '</strong></p>' .
      '<p>' . __('<a href="http://codex.wordpress.org/Posts_Edit_SubPanel" target="_blank">Edit Posts Documentation</a>') . '</p>' .
      '<p>' . __('<a href="http://wordpress.org/support/" target="_blank">Support Forums</a>') . '</p>' . 
      '<p>' . __('Be Strong, Young Jedi!') . '</p>';
  } elseif ( 'edit-hh_product' == $screen->id ) {
    $contextual_help = 
      '<p>' . __('This is the help screen displaying the table of products.') . '</p>' ;
  }
  return $contextual_help;
  }

?>