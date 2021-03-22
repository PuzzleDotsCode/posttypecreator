<?php



class PTC_ADMIN {

  private static $initiated = false;
  private static $name = 'Post Type Creator';
  private static $slug = 'posttypecreator';

  public static function init(){
    if ( ! self::$initiated ){
      self::init_hooks();
    }
  }

  private static function init_hooks(){

    self::$initiated = true;

    add_action( 'admin_menu' , array( 'PTC_ADMIN' , 'admin_menu' )  );

  }

  public static function admin_menu(){

    /*
      add_submenu_page(
        string $parent_slug, // 'edit.php?post_type=' . PD_PTC_SLUG
        string $page_title, // Window title
        string $menu_title, // Submenu title
        string $capability,
        string $menu_slug,
        callable $function = '',
        int $position = null
      )
    */

    add_submenu_page( 'edit.php?post_type=' . self::$slug , self::$name, self::$name . ' Config', 'manage_options', self::$slug . '-submenu-page', array( 'PTC_ADMIN' , 'view_display_submenu_page' ) );

  }
  public static function view_display_submenu_page(){
    include_once( PD_PTC_PLUGIN_DIR . '/includes/views/backend/main_menu.php' );
  }


}









































?>
