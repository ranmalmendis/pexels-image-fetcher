<?php
/**
 * Plugin Name: Pexels Image Fetcher
 * Plugin URI: https://ranmalmendis.github.io/ranmal_mendis/
 * Description: Fetches images from Pexels based on a specified topic.
 * Version: 1.0
 * Author: Ranmal Mendis
 * Author URI: https://ranmalmendis.github.io/ranmal_mendis/
 * License: GPLv2 
 * Text Domain: pexels-image-fetcher
 */

// Prevent direct file access
defined('ABSPATH') or exit;

// Add menu item in admin panel
function pif_create_menu() {
    add_options_page(
        __('Pexels API Settings', 'pexels-image-fetcher'),
        __('Pexels Image Fetcher', 'pexels-image-fetcher'),
        'manage_options',
        'pexels-image-fetcher',
        'pif_options_page'
    );
}
add_action('admin_menu', 'pif_create_menu');

// Options page content
// Options page content
function pif_options_page() {
    ?>
    <div class="wrap">
        <h2><?php _e('Pexels API Settings', 'pexels-image-fetcher'); ?></h2>
        <form action="options.php" method="post">
            <?php
            settings_fields('pif_options');
            do_settings_sections('pif');
            submit_button();
            ?>
        </form>

        <div class="pif-instructions">
            <h3><?php _e('How to Use', 'pexels-image-fetcher'); ?></h3>
            <p><?php _e('To display images from Pexels on your site:', 'pexels-image-fetcher'); ?></p>
            <ol>
                <li><?php _e('Enter your Pexels API Key above and save the settings.', 'pexels-image-fetcher'); ?></li>
                <li><?php _e('Use the shortcode [pexels_images topic="your_topic" num_images="number"] in your posts or pages.', 'pexels-image-fetcher'); ?></li>
                <li><?php _e('Replace "your_topic" with the desired photo topic (e.g., nature, cars, city) and "number" with the number of images you want to display.', 'pexels-image-fetcher'); ?></li>
            </ol>
            <h3><?php _e('Limitations', 'pexels-image-fetcher'); ?></h3>
            <p><?php _e('Please note the following limitations:', 'pexels-image-fetcher'); ?></p>
            <ul>
                <li><?php _e('The plugin is subject to Pexels API rate limits and terms of use.', 'pexels-image-fetcher'); ?></li>
                <li><?php _e('The number of images displayed depends on your Pexels API plan.', 'pexels-image-fetcher'); ?></li>
                <li><?php _e('High numbers of image requests may affect page load times.', 'pexels-image-fetcher'); ?></li>
            </ul>
        </div>
    </div>
    <?php
}


// Register and define settings
function pif_register_settings() {
    register_setting('pif_options', 'pif_api_key');

    add_settings_section(
        'pif_api_key_section',
        __('API Key Settings', 'pexels-image-fetcher'),
        'pif_api_key_section_cb',
        'pif'
    );

    add_settings_field(
        'pif_field_api_key',
        __('API Key', 'pexels-image-fetcher'),
        'pif_field_api_key_cb',
        'pif',
        'pif_api_key_section'
    );
}
add_action('admin_init', 'pif_register_settings');

function pif_api_key_section_cb() {
    echo '<p>' . __('Enter your Pexels API Key here.', 'pexels-image-fetcher') . '</p>';
}

function pif_field_api_key_cb() {
    $api_key = get_option('pif_api_key');
    echo '<input type="text" name="pif_api_key" value="' . esc_attr($api_key) . '" />';
}

// Shortcode for displaying Pexels images
function pif_shortcode($atts) {
    $atts = shortcode_atts(
        array(
            'topic' => 'nature',
            'num_images' => 10,
        ),
        $atts,
        'pexels_images'
    );

    $topic = urlencode($atts['topic']);
    $num_images = intval($atts['num_images']);
    $api_key = get_option('pif_api_key');
    $url = "https://api.pexels.com/v1/search?query={$topic}&per_page={$num_images}";

    $response = wp_remote_get($url, array(
        'headers' => array('Authorization' => $api_key)
    ));

    if (is_wp_error($response)) {
        // Handle errors more gracefully
        return '<p>' . __('Error fetching images from Pexels:', 'pexels-image-fetcher') . ' ' . esc_html($response->get_error_message()) . '</p>';
    }

    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body, true);
    $output = '';

    if (!empty($data['photos'])) {
        foreach ($data['photos'] as $photo) {
            $image_url = esc_url($photo['src']['medium']);
            $output .= "<img src='{$image_url}' alt='" . esc_attr($topic) . "' style='padding: 10px;' />";
        }
    } else {
        $output = '<p>' . __('No images found for the specified topic.', 'pexels-image-fetcher') . '</p>';
    }

    return $output;
}

add_shortcode('pexels_images', 'pif_shortcode');

// Load plugin textdomain for internationalization
function pif_load_textdomain() {
    load_plugin_textdomain('pexels-image-fetcher', false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'pif_load_textdomain');
?>
