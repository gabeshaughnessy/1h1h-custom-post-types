<?php /*

**************************************************************************

Plugin Name:  1H1H Custom Post Types
Plugin URI:   http://onehatonehand.com
Description:  Custom Post Types for One Hat One Hand, kept separate from their theme.
Version:      1.0
Author:       Gabe Shaughnessy
Author URI:   http://gabesimagination.com/

**************************************************************************/
//set up meta boxes
global $meta_boxes;

//create custom post types
// prefix for the site is hh_
//artists
require_once('artist_creator.php');
//proposals
require_once('proposal_creator.php');

//projects
require_once('project_creator.php');
//service
require_once('service_creator.php');
//case_study
require_once('case_study_creator.php');

//clients
require_once('client_creator.php');
//press
require_once('hhpress_creator.php');
//testimonials
//require_once('testimonial_creator.php');
//events
//require_once(TEMPLATEPATH. '/custom/event_creator.php');
//tools
//require_once('resource_creator.php');

//products
//require_once(TEMPLATEPATH. '/custom/product_creator.php');
//portfolio entry
//require_once('portfolio_creator.php');
//rental equipment\
//require_once(TEMPLATEPATH. '/custom/rental_creator.php');

//Custom metabox on pages and posts too 
require_once('page_metaboxes.php');

//Set up taxonomies to relate everything
require_once('hh_taxonomies.php');

//pulls in the function to add columns to the admin views for custom post types
require_once('custom_columns.php');

// --------------- SET UP THE META VALUES
//function that gets the meta values from a post and assigns them to variables in an array
//run the function using $meta_values = hh_get_meta_values(); and then call up indivdual values like this: echo $meta_values['description'];
		
		function hh_get_meta_values($postid){
		$meta_values = array(
						 'description' => get_post_meta($postid, 'hh_description', true),
						 'skills' => get_post_meta($postid, 'hh_skills', true),
						 'interview' => get_post_meta($postid, 'hh_interview', true),
		 				 'post_excerpt' => get_post_meta($postid, 'post_excerpt', true),
		 				 'source' => get_post_meta($postid, 'hh_source', true),
		 				 'challenges' => get_post_meta($postid, 'hh_challenges', true),
		 				 'solutions' => get_post_meta($postid, 'hh_solutions', true),
					 
						 'year' => get_post_meta($postid, 'hh_year', true),
						 'month' => get_post_meta($postid, 'hh_month', true),
						 'day' => get_post_meta($postid, 'hh_day', true),
						 
		 				 'date' => get_post_meta($postid, 'full_date', true),
						 
						 'related_post' => get_post_meta($postid, 'hh_related_post', true),
						 'link_text' => get_post_meta($postid, 'hh_link_text', true),
						 'ticket_link' => get_post_meta($postid, 'hh_ticket_link', true),
						 'time' => get_post_meta($postid, 'hh_time', true),
						 'address' => get_post_meta($postid, 'hh_address', true),
						 'flyer' => get_post_meta($postid, 'hh_flyer', true),
		
		 				 'website' => get_post_meta($postid, 'hh_website', true),
						 
						 'playlist' => get_post_meta($postid, 'hh_playlist', true),
						 'slideshow' => get_post_meta($postid, 'hh_slideshow', true),
						 'vimeo_id' => get_post_meta($postid, 'hh_vimeo_video', true),
						 'youtube_id' => get_post_meta($postid, 'hh_youtube_video', true), 
						 
						 'vimeo_link' => get_post_meta($postid, 'hh_vimeo', true),
						 'youtube_link' => get_post_meta($postid, 'hh_youtube', true),
						 'soundcloud_link' => get_post_meta($postid, 'hh_soundcloud', true),
						 'bandcamp_link' => get_post_meta($postid, 'hh_bandcamp', true),
						 'facebook_link' => get_post_meta($postid, 'hh_facebook', true),
						 'twitter_link' => get_post_meta($postid, 'hh_twitter', true),
						 'linkedin_link' => get_post_meta($postid, 'hh_linkedin', true),
						 'myspace_link' => get_post_meta($postid, 'hh_myspace', true),
						 
		 				 'timeline' => get_post_meta($postid, 'hh_timeline', true),
		 				 'budget' => get_post_meta($postid, 'hh_budget', true),
						 );
						return $meta_values;
               }//end of meta values function ----- 

?>