<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://steam.me
 * @since             1.0.0
 * @package           Inventory
 *
 * @wordpress-plugin
 * Plugin Name:       mytest
 * Plugin URI:        http://test.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Masood
 * Author URI:        http://steam.me
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       inventory
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

add_action( 'init', 'steam_inventory_wpse26388_rewrites_init' );
function steam_inventory_wpse26388_rewrites_init(){
    add_rewrite_rule(
        '^inventory/(.*)/?',
        'index.php?wpinventory_action=$matches[1]',
        'top' );		
}

add_action('generate_rewrite_rules', 'wpinventory_steamapp_rewrite_rule' );
function wpinventory_steamapp_rewrite_rule($wp_rewrite) {
	$keytag = '%wpinventory_action%';
	$wp_rewrite->add_rewrite_tag($keytag, '([^/]*)', 'wpinventory_action=');
}

function wpinventory_add_query_vars_filter( $vars ){
  $vars[] = "wpinventory_action";
  return $vars;
}
add_filter( 'query_vars', 'wpinventory_add_query_vars_filter' );



/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-inventory-activator.php
 */
function activate_inventory() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-inventory-activator.php';
	Inventory_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-inventory-deactivator.php
 */
function deactivate_inventory() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-inventory-deactivator.php';
	Inventory_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_inventory' );
register_deactivation_hook( __FILE__, 'deactivate_inventory' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-inventory.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_inventory() {
	$plugin = new Inventory();
	$plugin->run();

}

add_action( 'wp', 'run_inventory' );