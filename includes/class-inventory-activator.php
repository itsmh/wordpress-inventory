<?php

/**
 * Fired during plugin activation
 *
 * @link       http://steam.me
 * @since      1.0.0
 *
 * @package    Inventory
 * @subpackage Inventory/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Inventory
 * @subpackage Inventory/includes
 * @author     Masood <peace.mhy@gmail.com>
 */
class Inventory_Activator {

    CONST tblName = 'inventory';

    /**
     * Short Description. (use period)
     *
     * Long Description.
     *
     * @since    1.0.0
     */
    public static function activate() {
        global $wpdb;
        /* @var $wpdb wpdb */
        $table = $wpdb->prefix . tblName;
        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE `$table` (
            id int(11) NOT NULL AUTO_INCREMENT primary key,
            time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
            name tinytext NOT NULL,
            text text NOT NULL,
            url varchar(55) DEFAULT '' NOT NULL,
            PRIMARY KEY  (id)
          ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta($sql);
    }

}
