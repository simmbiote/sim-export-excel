<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.jbsimms.co.za
 * @since      1.0.0
 *
 * @package    Sim_Export_Excel
 * @subpackage Sim_Export_Excel/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Sim_Export_Excel
 * @subpackage Sim_Export_Excel/admin
 * @author     John Simms <john@jbsimms.co.za>
 */
class Sim_Export_Excel_Admin
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $plugin_name The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string $version The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string $plugin_name The name of this plugin.
     * @param      string $version The version of this plugin.
     */
    public function __construct($plugin_name, $version)
    {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

        add_filter('query_vars',
            function ($vars) {
                $vars[] = "sim_export";
                return $vars;
            }
        );

        add_action('init', [$this, 'observer']);

        add_action('admin_menu', function () {
            global $submenu;

            $menus = [
                'flamingo' => 'flamingo_inbound',
                'edit.php?post_type=subscriber' => 'subscriber',
                'edit.php?post_type=enquiry' => 'enquiry',
                'edit.php?post_type=job' => 'job',
            ];

            foreach ($menus as $id => $pt) {
                $submenu[$id][] = ['Export to Excel', 'edit_pages', "edit.php?post_type={$pt}&sim_export=1"];
            }


        });

    }

    /**
     * Register the stylesheets for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Sim_Export_Excel_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Sim_Export_Excel_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/sim-export-excel-admin.css', array(), $this->version, 'all');

    }

    /**
     * Register the JavaScript for the admin area.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Sim_Export_Excel_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Sim_Export_Excel_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/sim-export-excel-admin.js', array('jquery'), $this->version, false);

    }

    public function display_plugin_setup_page()
    {
        include_once('partials/sim-export-excel-admin-display.php');
    }

    public function add_plugin_admin_menu()
    {

        add_options_page('Export Data',
            'Export Data',
            'manage_options',
            $this->plugin_name,
            [$this, 'display_plugin_setup_page']
        );


    }

    public function add_action_links($links)
    {
        /*
        *  Documentation : https://codex.wordpress.org/Plugin_API/Filter_Reference/plugin_action_links_(plugin_file_name)
        */
        $settings_link = [
            '<a href="' . admin_url('options-general.php?page=' . $this->plugin_name) . '">' . __('Settings', $this->plugin_name) . '</a>',
        ];
        return array_merge($settings_link, $links);

    }

    public function observer()
    {
        if (!is_admin() && !is_user_logged_in()) return false;

        if (isset($_GET['sim_export']) && $_GET['sim_export']) {
            $exporter = new App\Exporter();
            $exporter->post_type = $_GET['post_type'];
            $exporter->custom_field_prefix = 'rotpunkt_';
            $exporter->do_export();
        }
    }

}
