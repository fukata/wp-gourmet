<?php
/*
Plugin Name: wp-gourmet
Plugin URI: http://fukata.org/dev/wp-plugin/wp-gourmet/
Description: Quoted the diet information shop. 
Version: 0.0.1 
Author: Tatsuya Fukata
Author URI: http://fukata.org
*/

// Fix for symlinked plugins from
// http://wordpress.stackexchange.com/questions/15202/plugins-in-symlinked-directories
$wp_gourmet_file;
$wp_gourmet_file = __FILE__;
if ( isset( $mu_plugin ) ) { 
    $wp_gourmet_file = $mu_plugin;
}
if ( isset( $network_plugin ) ) { 
    $wp_gourmet_file = $network_plugin;
}

if ( ! file_exists(dirname($wp_gourmet_file) . 'lib/gnavi/Gnavi.php') ) {
	$wp_gourmet_file = __FILE__;
}


global $wp_gourmet_dir;
$wp_gourmet_dir = plugin_dir_path($wp_gourmet_file);

require_once($wp_gourmet_dir . 'lib/gnavi/Gnavi.php');
require_once($wp_gourmet_dir . 'lib/Gourmet.php');

$gourmet = new Gourmet();
$gourmet->initEvent();
