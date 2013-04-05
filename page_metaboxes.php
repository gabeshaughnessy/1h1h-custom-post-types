<?php 
/******************************
Edit meta box settings here
******************************/
$prefix = 'hh_'; // this prefix goes before the id of each meta field, like this: hh_project_name
$meta_boxes = array();

$meta_boxes[] = array(
	'id' => 'hh_page_meta_box',
	
	'title' => 'Media Box',
	'pages' => array('page'), // multiple post types -----edit this to change which post type the custom meta box appears on
	'context' => 'normal',
	'priority' => 'high',
	'show_names' => true, // Show field names on the left
	'fields' => array( //field declarations create the fields in the metabox then get content from the callback function below
		array(
			'name' => 'Vimeo Video',
			'desc' => 'If there is a video about this project, you can put full url (http: NOT https: of a video on Vimeo.com',
			'id' => $prefix . 'vimeo_video',
			'type' => 'text', // video
			'std' => ''
		),
		array(
			'name' => 'Youtube Video',
			'desc' => 'Same goes for YouTube, although vimeo is prefered, you can put the url of a video on youtube video here.',
			'id' => $prefix . 'youtube_video',
			'type' => 'text', // video
			'std' => ''
		)	
	)
);
$meta_boxes[] = array(
	'id' => 'hh_artist_meta_box',
	'title' => 'Media Players',
	'pages' => array('hh_artist'), // multiple post types -----edit this to change which post type the custom meta box appears on
	'context' => 'normal',
	'priority' => 'high',
	'show_names' => true,
	'fields' => array( //field declarations create the fields in the metabox then get content from the callback function below
		array(
			'name' => 'Skills',
			'desc' => 'What are they good at? What are they known for?',
			'id' => $prefix . 'skills',
			'type' => 'textarea', // skills
			'std' => ''
		),
		array(
			'name' => 'Interview',
			'desc' => 'Interview Questions go here',
			'id' => $prefix . 'interview',
			'type' => 'textarea', 
			'std' => ''
		),

		array(
			'name' => 'Playlist',
			'desc' => 'You can paste the embed code for a playlist on Soundcloud or another site here',
			'id' => $prefix . 'playlist',
			'type' => 'textarea', // playlist
			'std' => ''
		),
		array(
			'name' => 'Vimeo Video',
			'desc' => 'If there is a video about this project, you can put full url (http: NOT https: of a video on Vimeo.com',
			'id' => $prefix . 'vimeo_video',
			'type' => 'text', // video
			'std' => ''
		),
		array(
			'name' => 'Youtube Video',
			'desc' => 'Same goes for YouTube, although vimeo is prefered, you can put the url of a video on youtube video here.',
			'id' => $prefix . 'youtube_video',
			'type' => 'text', // video
			'std' => ''
		),
				array(
			'name' => 'Slideshow or Flash Movie',
			'desc' => 'You can paste the embed code for a slideshow or flash movie here',
			'id' => $prefix . 'slideshow',
			'type' => 'textarea', // other embeddable media
			'std' => ''
		),
		
	)
	);
	/*product link meta box
$meta_boxes[] = array(
	'id' => 'product_meta_box',
	'title' => 'Product Info',
	'pages' => array('hh_artist'), // multiple post types -----edit this to change which post type the custom meta box appears on
	'context' => 'normal',
	'priority' => 'high',
	'fields' => array( //field declarations create the fields in the metabox then get content from the callback function below
		
		array(
			'name' => 'Item Number',
			'desc' => 'Get the Item Number for the product(s) from phpurchase that you want to link this artist too. You can use multiple item numbers, just separate them with a comma.',
			'id' => $prefix . 'item_numbers',
			'type' => 'text', //product id
			'std' => ''
		)
								
	)
);	*/

// social meta box
$meta_boxes[] = array(
	'id' => 'hh_links_meta_box',
	'title' => 'Profile Links',
	'pages' => array('hh_artist'), // multiple post types -----edit this to change which post type the custom meta box appears on
	'context' => 'normal',
	'priority' => 'high',
	'show_names' => true, // Show field names on the left
	'fields' => array( //field declarations create the fields in the metabox then get content from the callback function below
		array(
			'name' => 'Email',
			'desc' => 'so we can get in contact, not shared with the public',
			'id' => $prefix . 'email',
			'type' => 'text', // text box
			'std' => ''
		),
		array(
			'name' => 'Website',
			'desc' => 'do they have their own site? if so, paste the url here',
			'id' => $prefix . 'website',
			'type' => 'text', // text box
			'std' => ''
		),
		array(
			'name' => 'Facebook Link',
			'desc' => 'do they have a facebook page? if so, paste the url here',
			'id' => $prefix . 'facebook',
			'type' => 'text', // text box
			'std' => ''
		),
		array(
			'name' => 'Twitter Link',
			'desc' => 'do they have a twitter profile? if so, paste the url here',
			'id' => $prefix . 'twitter',
			'type' => 'text', // text box
			'std' => ''
		),
		array(
			'name' => 'Myspace Link',
			'desc' => 'do they have a Myspace profile? if so, paste the url here',
			'id' => $prefix . 'myspace',
			'type' => 'text', // text box
			'std' => ''
		),
		array(
			'name' => 'SoundCloud Link',
			'desc' => 'are they on soundcloud? if so, paste the url here, or paste the url to a soundcloud set with their music in it if you want',
			'id' => $prefix . 'soundcloud',
			'type' => 'text', // text box
			'std' => ''
		),
		array(
			'name' => 'Bandcamp Link',
			'desc' => 'do they have a Bandcamp page? if so, paste the url here',
			'id' => $prefix . 'bandcamp',
			'type' => 'text', // text box
			'std' => ''
		),
			array(
			'name' => 'Vimeo Link',
			'desc' => 'Do they have a Vimeo profile or channel? Paste the URL here',
			'id' => $prefix . 'vimeo',
			'type' => 'text', // text box
			'std' => ''
		)
	)

);

$meta_boxes[] = array(
	'id' => 'hh_proposal_meta_box',
	'title' => 'proposal Details',
	'pages' => array('hh_proposal'), // multiple post types -----edit this to change which post type the custom meta box appears on
	'context' => 'normal',
	'priority' => 'high',
	'show_names' => true, // Show field names on the left
	'fields' => array( //field declarations create the fields in the metabox then get content from the callback function below
	
		array(
			'name' => 'Description',
			'desc' => 'project outline',
			'id' => $prefix . 'description',
			'type' => 'textarea', // text area
			'std' => ''
		),
		array(
			'name' => 'Timeline',
			'desc' => 'project timeline',
			'id' => $prefix . 'timeline',
			'type' => 'textarea', // text area
			'std' => ''
		),
		array(
			'name' => 'Budget',
			'desc' => 'project budget',
			'id' => $prefix . 'budget',
			'type' => 'textarea', // text area
			'std' => ''
		)					
	)
);

// first meta box
$meta_boxes[] = array(
	'id' => 'hh_case_study_meta_box',
	'title' => 'Case Study Details',
	'pages' => array('hh_case_study'), // multiple post types -----edit this to change which post type the custom meta box appears on
	'context' => 'normal',
	'priority' => 'high',
	'show_names' => true, // Show field names on the left
	'fields' => array( //field declarations create the fields in the metabox then get content from the callback function below
		array(
			'name' => 'Description',
			'desc' => 'case study description',
			'id' => $prefix . 'description',
			'type' => 'textarea', // text area
			'std' => ''
		),
		array(
			'name' => 'Challenges',
			'desc' => 'what were the challenges involved?',
			'id' => $prefix . 'challenges',
			'type' => 'textarea', // text area
			'std' => ''
		),
		array(
			'name' => 'Solutions',
			'desc' => 'How did One Hat One Hand overcome the challenges?',
			'id' => $prefix . 'challenges',
			'type' => 'textarea', // text area
			'std' => ''
		),
		array(
			'name' => 'Imagined By',
			'desc' => 'Who came up with this?',
			'id' => $prefix . 'imagined',
			'type' => 'textarea', // text area
			'std' => ''
		),
		array(
			'name' => 'Designed By',
			'desc' => 'Who figured out how to make this work?',
			'id' => $prefix . 'designed',
			'type' => 'textarea', // text area
			'std' => ''
		),
		array(
			'name' => 'Built By',
			'desc' => 'Who built this?',
			'id' => $prefix . 'built',
			'type' => 'textarea', // text area
			'std' => ''
		),
		array(
			'name' => 'Vimeo Video',
			'desc' => 'If there is a video about this project, you can put full url (http: NOT https: of a video on Vimeo.com',
			'id' => $prefix . 'vimeo_video',
			'type' => 'text', // video
			'std' => ''
		),
		array(
			'name' => 'Youtube Video',
			'desc' => 'Same goes for YouTube, although vimeo is prefered, you can put the url of a video on youtube video here.',
			'id' => $prefix . 'youtube_video',
			'type' => 'text', // video
			'std' => ''
		)		
	)
);


// first meta box
$meta_boxes[] = array(
	'id' => 'hh_client_meta_box',
	'title' => 'Client Details',
	'pages' => array('hh_client'), // multiple post types -----edit this to change which post type the custom meta box appears on
	'context' => 'normal',
	'priority' => 'high',
	'show_names' => true, // Show field names on the left
	'fields' => array( //field declarations create the fields in the metabox then get content from the callback function below
		/*array(
			'name' => 'client Name',
			'desc' => 'what is the name of the client?',
			'id' => $prefix . 'client_name',
			'type' => 'text', // text box
			'std' => ''
		),*/
		array(
			'name' => 'Description',
			'desc' => 'project outline',
			'id' => $prefix . 'client_description',
			'type' => 'textarea', // text area
			'std' => ''
		),
	array(
			'name' => 'Website',
			'desc' => 'link to the press coverage site',
			'id' => $prefix . 'website',
			'type' => 'text', // text
			'std' => ''
		)
	)
);
$meta_boxes[] = array(
	'id' => 'hh_tour_meta_box',
	'title' => 'Tour Settings',
	'pages' => array('page', 'hh_project', 'hh_service', 'hh_client'), // multiple post types -----edit this to change which post type the custom meta box appears on
	'context' => 'side',
	'priority' => 'high',
	'show_names' => true, // Show field names on the left
	'fields' => array( 
	array(
		'name' => 'Add to Tour',
		'desc' => 'Add this item to a tour page:',
		'id' => $prefix . 'tour',
		'type' => 'select', 
		'options' => array(
			array('name' => '-- select a tour --', 'value' => ''),
			array('name' => 'Shop Tour', 'value' => 'shop-tour')								
		)
	),
	)
	);
$meta_boxes[] = array(
	'id' => 'hh_content_meta_box',
	'title' => 'Content Settings',
	'pages' => array('page'), // multiple post types -----edit this to change which post type the custom meta box appears on
	'context' => 'side',
	'priority' => 'high',
	'show_names' => true, // Show field names on the left
	'fields' => array( 
		array(
			'name' => 'Content Post Type',
			'desc' => 'which post type should this page display?',
			'id' => $prefix . 'content_post_type',
			'type' => 'select', 
			'options' => array(
				array('name' => '-- select --', 'value' => ''),	
				array('name' => 'Artists', 'value' => 'hh_artist'),
				array('name' => 'Projects', 'value' => 'hh_project'),
				array('name' => 'Services', 'value' => 'hh_service'),
				array('name' => 'Case Studies', 'value' => 'hh_case_study'),
				array('name' => 'Clients', 'value' => 'hh_client'),
							
			)
		),
		array(
			'name' => 'Filter Taxonomy',
			'desc' => 'which taxonomy should this page filter by?',
			'id' => $prefix . 'filter_taxonomy',
			'type' => 'select', 
			'options' => array(
				
				array('name' => 'Classification', 'value' => 'hh_classification'),
				array('name' => 'Related Service', 'value' => 'hh_related_service'),
				array('name' => 'Related Project', 'value' => 'hh_related_project'),
				array('name' => 'Related Client', 'value' => 'hh_related_client'),
				array('name' => 'Related Artist', 'value' => 'hh_related_artist')				
			)
		),
		
			)
);


$meta_boxes[] = array(
	'id' => 'event_meta_box',
	'title' => 'event Information',
	'pages' => array('hh_event'), // multiple post types -----edit this to change which post type the custom meta box appears on
	'context' => 'normal',
	'priority' => 'high',
	'show_names' => true, // Show field names on the left
	'fields' => array( //field declarations create the fields in the metabox then get content from the callback function below
		
		array(
			'name' => 'Description',
			'desc' => 'What\'s the occasion? What\'s happening at the event?',
			'id' => $prefix . 'description',
			'type' => 'textarea', // text area
			'std' => ''
		),
		array(
			'name' => 'Related Post Link',
			'desc' => 'Paste the url to the post with more event info. Make sure it begins with http://',
			'id' => $prefix . 'related_post',
			'type' => 'text', // text box
			'std' => ''
		),
		array(
			'name' => 'Post Link Text',
			'desc' => 'What should the link to the event post say?',
			'id' => $prefix . 'link_text',
			'type' => 'text', // text box
			'std' => ''
		),
		array(
			'name' => 'Ticket Link',			
			'desc' => 'Put the url for ticket purchases here. Make sure it begins with http://',
			'id' => $prefix . 'ticket_link',
			'type' => 'text', // text box
		),
				array(
			'name' => 'Month',
			'id' => $prefix . 'month',
			'type' => 'text', // date box
			'std' => 'MM'
		),
		array(
			'name' => 'Day',
			'id' => $prefix . 'day',
			'type' => 'text', // date box
			'std' => 'DD'
		),

		array(
			'name' => 'Year',
			'id' => $prefix . 'year',
			'type' => 'text', // date box
			'std' => 'YYYY'
		),
		array(
			'name' => 'Time',
			'id' => $prefix . 'time',
			'type' => 'text', // time box
			'std' => ''
		),
		array(
			'name' => 'Address',
			'id' => $prefix . 'address',
			'type' => 'text', // address
			'std' => ''
		),

		array(
			'name' => 'Playlist',
			'desc' => 'paste the embed code for a playlist on soundcloud or another site here',
			'id' => $prefix . 'playlist',
			'type' => 'textarea', // playlist
			'std' => ''
		),
		array(
			'name' => 'Flyer',
			'desc' => 'upload a flyer',
			'id' => $prefix . 'flyer',
			'type' => 'image', // flyer image
			'std' => ''
		),
		
	)
);

$meta_boxes[] = array(
	'id' => 'hh_hhpress_meta_box',
	'title' => 'hhpress Details',
	'pages' => array('hh_hhpress'), // multiple post types -----edit this to change which post type the custom meta box appears on
	'context' => 'normal',
	'priority' => 'high',
	'show_names' => true, // Show field names on the left
	'fields' => array( //field declarations create the fields in the metabox then get content from the callback function below
		
		array(
			'name' => 'Description',
			'desc' => 'what is the press coverage? is it an article in the paper, a radio interview...?',
			'id' => $prefix . 'description',
			'type' => 'textarea', // text area
			'std' => ''
		),
		array(
			'name' => 'Source',
			'desc' => 'where did this press come from?',
			'id' => $prefix . 'source',
			'type' => 'text', // text
			'std' => ''
		),
		array(
			'name' => 'Webiste',
			'desc' => 'link to the press coverage site',
			'id' => $prefix . 'website',
			'type' => 'text', // text
			'std' => ''
		)
			
	)
);
$meta_boxes[] = array(
	'id' => 'hh_portfolio_meta_box',
	'title' => 'Portfolio Entry Details',
	'pages' => array('hh_portfolio'), // multiple post types -----edit this to change which post type the custom meta box appears on
	'context' => 'normal',
	'priority' => 'high',
	'show_names' => true, // Show field names on the left
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
$meta_boxes[] = array(
	'id' => 'hh_product_meta_box',
	'title' => 'product Details',
	'pages' => array('hh_product'), // multiple post types -----edit this to change which post type the custom meta box appears on
	'context' => 'normal',
	'priority' => 'high',
	'show_names' => true, // Show field names on the left
	'fields' => array( //field declarations create the fields in the metabox then get content from the callback function below
		/*array(
			'name' => 'product Name',
			'desc' => 'what is the name of the product?',
			'id' => $prefix . 'product_name',
			'type' => 'text', // text box
			'std' => ''
		),*/
		array(
			'name' => 'Description',
			'desc' => 'product description',
			'id' => $prefix . 'description',
			'type' => 'textarea', // text area
			'std' => ''
		)
						
	)
);
$meta_boxes[] = array(
	'id' => 'hh_project_meta_box',
	'title' => 'Project Details',
	'pages' => array('hh_project'), // multiple post types -----edit this to change which post type the custom meta box appears on
	'context' => 'normal',
	'priority' => 'high',
	'show_names' => true, // Show field names on the left
	'fields' => array( //field declarations create the fields in the metabox then get content from the callback function below
		array(
			'name' => 'Description',
			'desc' => 'A bit of background on the project',
			'id' => $prefix . 'description',
			'type' => 'textarea', // text area
			'std' => ''
		),	
		array(
			'name' => 'Vimeo Video',
			'desc' => 'If there is a video about this project, you can put full url (http: NOT https: of a video on Vimeo.com',
			'id' => $prefix . 'vimeo_video',
			'type' => 'text', // video
			'std' => ''
		),
		array(
			'name' => 'Youtube Video',
			'desc' => 'Same goes for YouTube, although vimeo is prefered, you can put the url of a video on youtube video here.',
			'id' => $prefix . 'youtube_video',
			'type' => 'text', // video
			'std' => ''
		)
	)
);
$meta_boxes[] = array(
	'id' => 'hh_rental_meta_box',
	'title' => 'Rental Details',
	'pages' => array('hh_rental'), // multiple post types -----edit this to change which post type the custom meta box appears on
	'context' => 'normal',
	'show_names' => true, // Show field names on the left
	'priority' => 'high',
	'fields' => array( //field declarations create the fields in the metabox then get content from the callback function below
		/*array(
			'name' => 'rental Name',
			'desc' => 'what is the name of the rental?',
			'id' => $prefix . 'rental_name',
			'type' => 'text', // text box
			'std' => ''
		),*/
		array(
			'name' => 'Description',
			'desc' => 'rental description',
			'id' => $prefix . 'description',
			'type' => 'textarea', // text area
			'std' => ''
		)
						
	)
);
$meta_boxes[] = array(
	'id' => 'hh_resource_meta_box',
	'title' => 'resource Details',
	'pages' => array('hh_resource'), // multiple post types -----edit this to change which post type the custom meta box appears on
	'context' => 'normal',
	'priority' => 'high',
	'show_names' => true, // Show field names on the left
	'fields' => array( //field declarations create the fields in the metabox then get content from the callback function below
		/*array(
			'name' => 'resource Name',
			'desc' => 'what is the name of the resource?',
			'id' => $prefix . 'resource_name',
			'type' => 'text', // text box
			'std' => ''
		),*/
		array(
			'name' => 'Description',
			'desc' => 'resource description',
			'id' => $prefix . 'description',
			'type' => 'textarea', // text area
			'std' => ''
		),
		array(
			'name' => 'Location',
			'desc' => 'where is the resource located',
			'id' => $prefix . 'address',
			'type' => 'textarea', // text area
			'std' => ''
		)
						
	)
);
$meta_boxes[] = array(
	'id' => 'hh_service_meta_box',
	'title' => 'Service Details',
	'pages' => array('hh_service'), // multiple post types -----edit this to change which post type the custom meta box appears on
	'context' => 'normal',
	'priority' => 'high',
	'show_names' => true, // Show field names on the left
	'fields' => array( //field declarations create the fields in the metabox then get content from the callback function below
		
		array(
			'name' => 'Description',
			'desc' => 'service description',
			'id' => $prefix . 'description',
			'type' => 'textarea', // text area
			'std' => ''
		)				
	)
);
$meta_boxes[] = array(
	'id' => 'hh_testimonial_meta_box',
	'title' => 'Testimonial Details',
	'pages' => array('hh_testimonial'), // multiple post types -----edit this to change which post type the custom meta box appears on
	'context' => 'normal',
	'priority' => 'high',
	'show_names' => true, // Show field names on the left
	'fields' => array( //field declarations create the fields in the metabox then get content from the callback function below
		
		array(
			'name' => 'Testimonial',
			'desc' => 'what did they have to say',
			'id' => $prefix . 'description',
			'type' => 'text', // testimonial content
			'std' => ''
		),
		array(
			'name' => 'Source',
			'desc' => 'Who said it?',
			'id' => $prefix . 'source',
			'type' => 'text', // testimonial source
			'std' => ''
		),
		array(
			'name' => 'Website',
			'desc' => 'link to the testimonial or another website',
			'id' => $prefix . 'website',
			'type' => 'text', // testimonial content
			'std' => ''
		)				
	)
);
//set up metaboxes 
require_once('metabox/init.php');//gets the metabox framework

?>