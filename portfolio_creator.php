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


/******************************
Edit meta box settings here
******************************/
$prefix = 'hh_'; // this prefix goes before the id of each meta field, like this: hh_portfolio_name
$meta_boxes = array();
// first meta box
$meta_boxes[] = array(
	'id' => 'hh_portfolio_meta_box',
	'title' => 'Portfolio Entry Details',
	'pages' => array('hh_portfolio'), // multiple post types -----edit this to change which post type the custom meta box appears on
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array( //field declarations create the fields in the metabox then get content from the callback function below
	
		array(
			'name' => 'Description',
			'desc' => 'Describe the Portfolio Entry',
			'id' => $prefix . 'description',
			'type' => 'textarea', // text area
			'std' => ''
		)
						
	)
);
/*********************************
You should not edit the code below
*********************************/
foreach ($meta_boxes as $meta_box) {
	$my_box = new portfolio_meta_box($meta_box);
}
class portfolio_meta_box {
	protected $_meta_box;
	// create meta box based on given data
	function __construct($meta_box) {
		if (!is_admin()) return;
		$this->_meta_box = $meta_box;
		// fix upload bug: http://www.hashbangcode.com/blog/add-enctype-wordpress-post-and-page-forms-471.html
		$current_page = substr(strrchr($_SERVER['PHP_SELF'], '/'), 1, -4);
		if ($current_page == 'page' || $current_page == 'page-new' || $current_page == 'post' || $current_page == 'post-new') {
			add_action('admin_head', array(&$this, 'add_post_enctype'));
		}
		add_action('admin_menu', array(&$this, 'add'));
		add_action('save_post', array(&$this, 'save'));
	}
	function add_post_enctype() {
		echo '
		<script type="text/javascript">
		jQuery(document).ready(function(){
			jQuery("#post").attr("enctype", "multipart/form-data");
			jQuery("#post").attr("encoding", "multipart/form-data");
		});
		</script>';
	}
	/// Add meta box for multiple post types
	function add() {
		foreach ($this->_meta_box['pages'] as $page) {
			add_meta_box($this->_meta_box['id'], $this->_meta_box['title'], array(&$this, 'show'), $page, $this->_meta_box['context'], $this->_meta_box['priority']);
		}
	}
	// Callback function to show fields in meta box +++++++++++++This is where the content of the metabox is created from the above field declarations
	function show() {
		global $post;
		// Use nonce for verification
		echo '<input type="hidden" name="mytheme_meta_box_nonce" value="', wp_create_nonce(basename(__FILE__)), '" />';
		echo '<table class="form-table">';
		foreach ($this->_meta_box['fields'] as $field) {
			// get current post meta data
			$meta = get_post_meta($post->ID, $field['id'], true);
			echo '<tr>',
					'<th style="width:20%"><label for="', $field['id'], '">', $field['name'], '</label></th>',
					'<td>';
			switch ($field['type']) {
				case 'text':
					echo '<input type="text" name="', $field['id'], '" id="', $field['id'], '" value="', $meta ? $meta : $field['std'], '" size="30" style="width:97%" />',
						'<br />', $field['desc'];
					break;
				case 'textarea':
					echo '<textarea name="', $field['id'], '" id="', $field['id'], '" cols="60" rows="4" style="width:97%">', $meta ? $meta : $field['std'], '</textarea>',
						'<br />', $field['desc'];
					break;
				case 'select':
					echo '<select name="', $field['id'], '" id="', $field['id'], '">';
					foreach ($field['options'] as $option) {
						echo '<option', $meta == $option ? ' selected="selected"' : '', '>', $option, '</option>';
					}
						echo '</select>';
										break;
				case 'radio':
					foreach ($field['options'] as $option) {
						echo '<input type="radio" name="', $field['id'], '" value="', $option['value'], '"', $meta == $option['value'] ? ' checked="checked"' : '', ' />', $option['name'];
					}
					break;
				case 'checkbox':
					echo '<input type="checkbox" name="', $field['id'], '" id="', $field['id'], '"', $meta ? ' checked="checked"' : '', ' />';
					break;
				case 'file':
					echo $meta ? "$meta<br />" : '', '<input type="file" name="', $field['id'], '" id="', $field['id'], '" />',
						'<br />', $field['desc'];
					break;
				case 'image':
	echo $meta ? "<img src=\"$meta\" width=\"150\" height=\"150\" /><br />$meta<br />" : '', '<input type="file" name="', $field['id'], '" id="', $field['id'], '" />',
						'<br />', $field['desc'];
					break;
			}
			echo 	'<td>',
				'</tr>';
		}
		echo '</table>';
	}
	// Save data from meta box
	function save($post_id) {
		// verify nonce
		if (!wp_verify_nonce($_POST['mytheme_meta_box_nonce'], basename(__FILE__))) {
			return $post_id;
		}
		// check autosave
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return $post_id;
		}
		// check permissions
		if ('page' == $_POST['post_type']) {
			if (!current_user_can('edit_page', $post_id)) {
				return $post_id;
			}
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
		}
		foreach ($this->_meta_box['fields'] as $field) {
			$name = $field['id'];
			$old = get_post_meta($post_id, $name, true);
			$new = $_POST[$field['id']];
			if ($field['type'] == 'file' || $field['type'] == 'image') {
				$file = wp_handle_upload($_FILES[$name], array('test_form' => false));
				$new = $file['url'];
			}
			if ($new && $new != $old) {
				update_post_meta($post_id, $name, $new);
			} elseif ('' == $new && $old && $field['type'] != 'file' && $field['type'] != 'image') {
				delete_post_meta($post_id, $name, $old);
			}
		}
	}
}
 ?>