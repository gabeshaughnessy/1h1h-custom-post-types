<?php
// Add to admin_init function to change SHOWS columns

add_filter('manage_edit-hh_artist_columns', 'add_new_hh_artist_columns');

function add_new_hh_artist_columns($hh_artist_columns) {
		$new_columns['cb'] = '<input type="checkbox" />';
 
		$new_columns['title'] = _x('Artist Name', 'column name');
		$new_columns['classification'] = __('Classification');
		$new_columns['website'] = __('Website');
 		$new_columns['description'] = __('Description');
		$new_columns['related_projects'] = __('Related Projects'); 
		$new_columns['related_services'] = __('Related Services');
		$new_columns['thumbnail'] = __('Thumbnail'); 

		return $new_columns;
	}//this function creates the custom columns for the post type hh_show
	
	
//now we need to pupulate those custom columns with the following:
	add_action( 'manage_posts_custom_column' , 'artist_columns' );
	function artist_columns( $column ) {
	global $post;
	switch ( $column )
	{
		case 'classification':
			$terms = get_the_term_list( $post->ID , 'hh_classification' , '' , ',' , '' );
			if ( is_string( $terms ) ) {
				echo $terms;
			}  
			else 
			{
				echo 'No classification has been set yet!';
			}
			break;
		
		case 'website':
			$website = get_post_meta( $post->ID , 'hh_website' , true );
				echo $website;
			break;
		case 'description':
			$description = get_post_meta( $post->ID , 'hh_description' , true );
				echo $description;
			break;
		
		case 'related_projects':
		$terms = get_the_term_list( $post->ID , 'hh_related_project' , '' , ',' , '' );
			if ( is_string( $terms ) ) {
				echo $terms;
			}
			else 
			{
				echo 'No Related Projects have been selected yet!';
			}
			break;
		
		case 'related_services':
		$terms = get_the_term_list( $post->ID , 'hh_related_service' , '' , ',' , '' );
			if ( is_string( $terms ) ) {
				echo $terms;
			}
			else 
			{
				echo 'No related service has been set yet!';
			}
			break;		
	}
}
?>