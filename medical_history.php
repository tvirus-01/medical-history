<?php

/*
Plugin Name:  Medical History
Description:  This is Medical History plugin.Where you can save your customers data from bookly plugin database
Version:      1.0.0
Author:       saadnan
Author URI:   https://www.saadnan.portfoliobox.net
License:      GPL2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html

{Medical History} is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
{Medical History} is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with {Medical History}.
*/
global $wpdb;
//Activate plugin
function pluginprefix_setup_post_type() {
    // register the "book" custom post type
    register_post_type( 'book', ['public' => 'true'] );
}
add_action( 'init', 'pluginprefix_setup_post_type' );
 
function pluginprefix_install() {
    // trigger our function that registers the custom post type
    pluginprefix_setup_post_type();
 
    // clear the permalinks after the post type has been registered
    flush_rewrite_rules();
}
register_activation_hook( __FILE__, 'pluginprefix_install' );

//Deactivate plugin
function pluginprefix_deactivation() {
    // unregister the post type, so the rules are no longer in memory
    unregister_post_type( 'book' );
    // clear the permalinks to remove our post type's rules from the database
    flush_rewrite_rules();
}
register_deactivation_hook( __FILE__, 'pluginprefix_deactivation' );

//Include scripts file
require_once(plugin_dir_path(__FILE__).'/includes/function.php');

function wporg_options_page_html()
{
    // check user capabilities
    if (!current_user_can('manage_options')) {
        return;
    }
    
    require_once(plugin_dir_path(__FILE__).'/includes/history.php');
    

}

function wporg_options_page()
{
    add_menu_page(
        'Medical History Plugin',
        'Medical History',
        'manage_options',
        'medical-history',
        'wporg_options_page_html',
        'dashicons-smiley'    
    );
}
add_action('admin_menu', 'wporg_options_page');

// 