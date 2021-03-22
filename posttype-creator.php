<?php


/*
 Plugin Name:   Post Type Creator
 Description:  A simple Post Type Creator!
 Author:       PuzzleDots
 Version:      0.1
 License:      GNU GPL
 License URI:  https://www.gnu.org/licenses/licenses.en.html
*/



if ( ! defined( 'PD_PTC_NAME' ) ){ define( 'PD_PTC_NAME' , 'Post Type Creator' ); }
if ( ! defined( 'PD_PTC_SLUG' ) ){ define( 'PD_PTC_SLUG' , 'posttypecreator' ); }
if ( ! defined( 'PD_PTC_DIR' ) ){ define( 'PD_PTC_DIR', dirname( __FILE__ ) ); }

// if ( ! defined( 'PD_PTC_POST_TYPE' ) ){ define( 'PD_PTC_POST_TYPE', PD_PTC_SLUG ); }


function pd_ptc_custom_post_type(){

  $labels = array(
    'name' => _x( PD_PTC_NAME , 'textdomain' ),
    'singular_name' => _x( PD_PTC_NAME , 'textdomain' ),
    'rewrite' => array( 'slug' => PD_PTC_SLUG )
  );

  // Post Type Creator
  register_post_type( PD_PTC_SLUG , array(
    'labels' => $labels,
    'public' => true,
    'has_archive' => true
  ) );

}
add_action('init', 'pd_ptc_custom_post_type');


function pd_ptc_home_query( $query ){

  /*
    * posttypecreator/ : $query->query['post_type'] => string(15) "posttypecreator" | is_archive
    * posttypecreator/loving/ : $query->query['post_type'] => none | is_single
  */
  // var_dump( $query );
  // var_dump( $query->query_vars );
  // var_dump( $query->query['post_type'] );
  var_dump( $query->query['name'] );


  if ( ! empty( $query->query['post_type'] ) &&  $query->query['post_type'] == PD_PTC_SLUG ){
    return true;
  }
  return false;

}


function pd_ptc_template_hierarchy( $template ) {

  var_dump( $template );

  global $wp_query;
  $query = $wp_query;
  pd_ptc_home_query( $query );
  if ( is_archive() && pd_ptc_home_query( $query ) ){
    return PD_PTC_DIR . '/includes/templates/' . PD_PTC_SLUG . '.php';
  }
  else { return $template; }

  // return $template;

}
add_filter( 'template_include', 'pd_ptc_template_hierarchy');





























?>
