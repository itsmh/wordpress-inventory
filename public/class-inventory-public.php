<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://steam.me
 * @since      1.0.0
 *
 * @package    Inventory
 * @subpackage Inventory/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Inventory
 * @subpackage Inventory/public
 * @author     Masood <peace.mhy@gmail.com>
 */
class Inventory_Public {

    CONST QUERY_VAR = 'wpinventory_action';

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Action to take based on url
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $action    The route of plugin
     */
    private $action;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version) {
        global $wp_query;
        $this->action = isset($wp_query->query_vars[self::QUERY_VAR]) ?
                $wp_query->query_vars[self::QUERY_VAR] : '';

        $this->plugin_name = $plugin_name;
        $this->version = $version;
        if ($this->action == '')
            return;
        add_filter('template_include', array($this, 'template_chooser'));
//        add_filter( 'template_redirect', array($this,'endpoint_map_template' ));
    }

    public function endpoint_map_template($template) {
        if ($wp_query->query_vars['pagename'] == 'inventory') {
            $wp_query->is_404 = false;
        } else {
            return $template;
        }
    }

    public function template_chooser($template) {
        global $wp_query;
        if ($this->action) {
            $wp_query->is_home = false;
            return (plugin_dir_path(__FILE__) . 'partials/' . $this->action . '.php');
        } else {
            return $template;
        }
    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Inventory_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Inventory_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/inventory-public.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Inventory_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Inventory_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */
        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/inventory-public.js', array('jquery'), $this->version, false);
    }

}
