<?php
/**
 * Plugin Name: Search And Replace
 * Plugin URI: https://www.direct-leadz.com/
 * Description: Search And Replace Data
 * Version: 1.0
 * Author: Nirav Kaneriya
 **/

defined('ABSPATH') or die('Hey, You cant access this file, you silly human!');
add_filter( 'option_page_capability_custom_settings_group', 'simple_custom_settings_group_capability' );
function simple_custom_settings_group_capability( $cap ) {
    return 'edit_theme_options';
}
class simple_settings_page {
    /**
     * Array of custom settings/options
     **/
    private $options;

    /**
     * Constructor
     */
    public function __construct() {
        add_action( 'admin_menu', array( $this, 'add_settings_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add settings page
     * The page will appear in Admin menu
     */
    public function add_settings_page() {
        add_menu_page(
            'Search And Replace', // Page title
            'Search And Replace', // Title
            'edit_pages', // Capability
            'custom-settings-page', // Url slug
            array( $this, 'create_admin_page' ) // Callback
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page() {
        // Set class property
        $this->options = get_option( 'custom_settings' );
        ?>
        <div class="wrap">
            <form method="post" action="options.php">
                <?php
                // This prints out all hidden setting fields
                settings_fields( 'custom_settings_group' );
                do_settings_sections( 'custom-settings-page' );
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * Register and add settings
     */
    public function page_init() {
        register_setting(
            'custom_settings_group', // Option group
            'custom_settings', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'custom_settings_section', // ID
            'Search And Replace', // Title
            array( $this, 'custom_settings_section' ), // Callback
            'custom-settings-page' // Page
        );

        add_settings_field(
            'custom_setting_1', // ID
            'Old Value', // Title
            array( $this, 'custom_setting1_html' ), // Callback
            'custom-settings-page', // Page
            'custom_settings_section'
        );

        add_settings_field(
            'custom_setting_2',
            'New Value',
            array( $this, 'custom_setting2_html' ),
            'custom-settings-page',
            'custom_settings_section'
        );
    }

    /**
     * Sanitize POST data from custom settings form
     *
     * @param array $input Contains custom settings which are passed when saving the form
     */
    public function sanitize( $input ) {
        $sanitized_input= array();
        if( isset( $input['custom_setting_1'] ) )
            $sanitized_input['custom_setting_1'] = sanitize_text_field( $input['custom_setting_1'] );

        if( isset( $input['custom_setting_2'] ) )
            $sanitized_input['custom_setting_2'] = sanitize_text_field( $input['custom_setting_2'] );

        return $sanitized_input;
    }

    /**
     * Custom settings section text
     */
    public function custom_settings_section() {

    }

    /**
     * HTML for custom setting 1 input
     */
    public function custom_setting1_html() {
        printf(
            '<input type="text" id="custom_setting_1" name="custom_settings[custom_setting_1]" value="" />',
            isset( $this->options['custom_setting_1'] ) ? esc_attr( $this->options['custom_setting_1']) : ''
        );
    }

    /**
     * HTML for custom setting 2 input
     */
    public function custom_setting2_html() {
        printf(
            '<input type="text" id="custom_setting_2" name="custom_settings[custom_setting_2]" value="" />',
            isset( $this->options['custom_setting_2'] ) ? esc_attr( $this->options['custom_setting_2']) : ''
        );
        global $wpdb;
        $custom_settings = get_option( 'custom_settings' );
        $custom_setting_1 = $custom_settings['custom_setting_1'];
        $custom_setting_2 = $custom_settings['custom_setting_2'];

        $query = "UPDATE wp_options SET option_value = replace(option_value, '$custom_setting_1', '$custom_setting_2');";
        $query1 = "UPDATE wp_posts SET guid = replace(guid, '$custom_setting_1', '$custom_setting_2');";
        $query2 = "UPDATE wp_posts SET post_content = replace(post_content, '$custom_setting_1', '$custom_setting_2');";
        $query3 = "UPDATE wp_postmeta SET meta_value = replace(meta_value, '$custom_setting_1', '$custom_setting_2');";

        $wpdb->get_var($query);
        $wpdb->get_var($query1);
        $wpdb->get_var($query2);
        $wpdb->get_var($query3);

    }
}
if (class_exists('simple_settings_page')) {
    $simple_settings_page = new simple_settings_page();
}

register_activation_hook( __file__, array( $simple_settings_page , 'activate'));

register_deactivation_hook( __file__, array( $simple_settings_page , 'deactivate'));

register_uninstall_hook( __file__, array( $simple_settings_page , 'uninstall'));