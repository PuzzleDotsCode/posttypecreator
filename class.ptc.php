<?php

class PTC_MAIN {

  private static $initiated = false;
  private static $name = 'Post Type Creator';
  private static $slug = 'posttypecreator';


  // initiate class
  public static function init(){
    if ( ! self::$initiated ){
      self::init_hooks();
    }
  }

  // let's register our tools (custom filters and actions)
  private static function init_hooks(){

    // change state from private method to not expose class property
    self::$initiated = true;

    add_action( 'init' , array( 'PTC_MAIN' , 'create_custom_type' ) );
    add_filter( 'template_include' , array( 'PTC_MAIN' , 'template_hirarchy' ) );

  }

  /**
   * Main idea is create a placeholder custom post type that
   * it could be modified from Plugin Submenu
   * Here the Custom Post Type would be hardcoded
  */
  public static function create_custom_type(){

    $post_type = self::$slug;
    $post_name = self::$name;
    $labels = array(
      'name'              => _x( $post_name , $post_name . " general name" ),
      'singular_name'     => _x( $post_name , $post_name . " singular name" ),
      'search_items'      => __( "Search " . $post_name ),
      'all_items'         => __( "All " . $post_name ),
      'parent_item'       => __( "Parent " . $post_name ),
      'parent_item_colon' => __( "Parent " . $post_name ),
      'edit_item'         => __( "Edit " . $post_name ),
      'update_item'       => __( "Update " . $post_name ),
      'add_new_item'      => __( "Add New " . $post_name ),
      'new_item_name'     => __( "New " . $post_name . " Name" ),
      'menu_name'         => __( $post_name ),
    );
    $args = array(
      'hierarchical'      => true, // make it hierarchical (like categories)
      'labels'            => $labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => [ 'slug' => $post_type ],
      'has_archive' => true
    );

    // Post Type Register
    register_post_type( $post_type , $args );

  }

  public static function template_hirarchy( $template ){

    // Get Query Vars to filter URI resources
    global $wp_query;
    $query = $wp_query;
    if ( is_archive() && self::helper_template_query_home( $query ) ){
      return PD_PTC_PLUGIN_DIR . '/includes/templates/' . self::$slug . '.php';
    }
    else { return $template; }

  }


  public static function helper_template_query_home( $query ){

    /*
      * posttypecreator/ : $query->query['post_type'] => string(15) "posttypecreator" | is_archive
      * posttypecreator/loving/ : $query->query['post_type'] => none | is_single
    */
    // var_dump( $query );
    // var_dump( $query->query_vars );
    // var_dump( $query->query['post_type'] );
    // var_dump( $query->query['name'] );


    if ( ! empty( $query->query['post_type'] ) &&  $query->query['post_type'] == PD_PTC_SLUG ){
      return true;
    }
    return false;

  }


}








?>
