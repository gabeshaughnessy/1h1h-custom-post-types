<?php /*

**************************************************************************

Plugin Name:  1H1H Custom Post Types
Plugin URI:   http://onehatonehand.com
Description:  Custom Post Types for One Hat One Hand, kept separate from their theme.
Version:      1.0
Author:       Gabe Shaughnessy
Author URI:   http://gabesimagination.com/

**************************************************************************/
//create custom post types
// prefix for the site is hh_
//proposals
require_once('proposal_creator.php');
//projects
require_once('project_creator.php');
//service
require_once('service_creator.php');
//case_study
require_once('case_study_creator.php');
//artists
require_once('artist_creator.php');
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

require_once('hh_taxonomies.php');



?>