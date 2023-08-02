<?php
/**
 * Plugin Name:       Rl Features
 * Plugin URI:        https://rehanlodhi.com
 * Description:       Enables features like projects, project taxonomies and rest
 * Version:           1.0
 * Author:            Rehan Lodhi
 * License:           Rehan Lodhi
 * Text Domain:       rl
 * Namespace:         Rl
 * GitHub Plugin URI: https://github.com/rehanlodhi/rl-reatures
 * Requires at least: 6.2
 * Requires PHP:      8.2
 */

include_once plugin_dir_path(__FILE__) . "/vendor/autoload.php";

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Plugin Initialization
add_action('init', 'Rl\App::run');