<?php
/**
 * Plugin Name:       Rest API
 * Plugin URI:        https://rehanlodhi.com
 * Description:       Enables REST API for my vue based theme
 * Version:           1.0
 * Author:            Rehan Lodhi
 * License:           Rehan Lodhi
 * Domain Path:       /languages
 * Text Domain:       rl
 * Namespace:         Rl
 * GitHub Plugin URI: https://github.com/
 * GitHub Languages:  https://github.com/
 * Requires at least: 5.2
 * Requires PHP:      7.2
 */

include_once plugin_dir_path(__FILE__) . "/vendor/autoload.php";

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Plugin Initialization
add_action('init', 'Rl\App::run');