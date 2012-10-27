<?php 
function build_taxonomies() {
	register_taxonomy('hh_classification', array('hh_artist'), array(
	
	'hierarchical' => false,  'label' => 'Classification',
	
	'query_var' => true, 'rewrite' => true)); 
	
	register_taxonomy('hh_size', array('hh_project'), array(
	  
	  'hierarchical' => false,  'label' => 'Size',
	  
	  'query_var' => true, 'rewrite' => true)); 
	  
	register_taxonomy('hh_related_artist', array('hh_project', 'hh_client', 'hh_artist', 'hh_service', 'hh_portfolio', 'hh_resource', 'hh_testimonial', 'hh_case_study', 'hh_press'), array(
	  
	  'hierarchical' => false,  'label' => 'Related Artist',
	  
	  'query_var' => true, 'rewrite' => true)); 
	  
	register_taxonomy('hh_related_project', array('hh_project', 'hh_client', 'hh_artist', 'hh_service', 'hh_portfolio', 'hh_resource', 'hh_testimonial', 'hh_case_study', 'hh_press'), array(
	  
	  'hierarchical' => false,  'label' => 'Related Project',
	  
	  'query_var' => true, 'rewrite' => true)); 
	 
	register_taxonomy('hh_related_client', array('hh_project', 'hh_client', 'hh_artist', 'hh_service', 'hh_portfolio', 'hh_resource', 'hh_testimonial', 'hh_case_study', 'hh_press'), array(
	  
	  'hierarchical' => false,  'label' => 'Related Client',
	  
	  'query_var' => true, 'rewrite' => true)); 
	  
	register_taxonomy('hh_related_service', array('hh_project', 'hh_artist', 'hh_client', 'hh_service', 'hh_portfolio', 'hh_resource', 'hh_testimonial', 'hh_case_study'), array(
	  
	  'hierarchical' => false,  'label' => 'Related Service',
	  
	  'query_var' => true, 'rewrite' => true)); 
	  
	
	
  }
  add_action( 'init', 'build_taxonomies', 0 );
  ?>