<?php

/**
 * Fired during plugin deactivation
 *
 * @link       http://steam.me
 * @since      1.0.0
 *
 * @package    Inventory
 * @subpackage Inventory/includes
 */

/**
 * Fired during plugin deactivation.
 *
 * This class defines all code necessary to run during the plugin's deactivation.
 *
 * @since      1.0.0
 * @package    Inventory
 * @subpackage Inventory/includes
 * @author     Masood <peace.mhy@gmail.com>
 */
class Inventory_Deactivator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function deactivate() {
            echo __DIR__.'/salam.txt';
//            var_dump(file_put_contents(__DIR__.'/salam.txt', 'deactive'));
	}

}
