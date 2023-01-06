<?php 
/**
 * Plugin Name:  themeey-companion
 * Plugin URI:  http://themeey.com
 * Description:  This is themeey custom plugin
 * Version:  1.0   
 * Author:  provideworld    
 * Author URI:  http://provideworld.com
 * License:  GPL2
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  s_themeey
 * Domain Path:  /languages
 */

define('ACF_DIR_PATH', plugin_dir_path(__FILE__));
define('ACF_DIR_URL', plugin_dir_url(__FILE__));
define('VERSION', 1.0);


require_once ACF_DIR_PATH . 'elementor/elementor-register.php';


add_action( 'wp_enqueue_scripts', function(){
    wp_enqueue_style( 'custom_plugin', ACF_DIR_URL . 'style.css' );

//     wp_enqueue_script( 'bootstarp-style', plugins_url( 'assets/css/bootstrap-grid.min.css', __FILE__ ) );


},30);

