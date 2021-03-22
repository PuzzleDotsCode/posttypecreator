<?php
/**
 * @package Post Type Creator
 */
/*
 Plugin Name:   Post Type Creator
 Description:  A simple Post Type Creator!
 Author:       PuzzleDots
 Version:      0.1
 License:      GNU GPL
 License URI:  https://www.gnu.org/licenses/licenses.en.html
*/

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}


// if ( ! defined( 'PD_PTC_NAME' ) ){ define( 'PD_PTC_NAME' , 'Post Type Creator' ); }
// if ( ! defined( 'PD_PTC_SLUG' ) ){ define( 'PD_PTC_SLUG' , 'posttypecreator' ); }
// if ( ! defined( 'PD_PTC_DIR' ) ){ define( 'PD_PTC_DIR', dirname( __FILE__ ) ); }
if ( ! defined( 'PD_PTC_PLUGIN_DIR' ) ){ define( 'PD_PTC_PLUGIN_DIR', plugin_dir_path( __FILE__ ) ); }


// Let's call Class functionality files
require_once( PD_PTC_PLUGIN_DIR . 'class.ptc.php' );

// Include init method from our main class ('PostTypeCreator' in ./class.posttypecreator.php)
add_action( 'init' , array( 'PTC_MAIN' , 'init' ) );


// Fire Admin configuration when Admin is initiated
if ( is_admin() ){
  require_once( PD_PTC_PLUGIN_DIR . 'class.ptc-admin.php' );
  add_action( 'init' , array( 'PTC_ADMIN' , 'init' ) );
}









































?>
