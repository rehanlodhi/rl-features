<?php

namespace Rl;

use Rl\Rest;
use Rl\PostType\ProjectPostType;
use Rl\Taxonomy\ProjectCategory;
use Rl\Taxonomy\ProjectTag;

class App
{
    /**
     * Addon Version
     *
     * @since 1.0.0
     * @var string The plugin version.
     */
    const VERSION = '1.0.0';

    /**
     * Minimum PHP Version
     *
     * @since 1.0.0
     * @var string Minimum PHP version required to run the plugin.
     */
    const MINIMUM_PHP_VERSION = '7.3';

    /**
     * Instance
     *
     * @since 1.0.0
     * @access private
     * @static
     * @var \Rl\App The single instance of the class.
     */
    private static $_instance = null;

    /**
     * Instance
     *
     * Ensures only one instance of the class is loaded or can be loaded.
     *
     * @return \Rl\App An instance of the class.
     * @since 1.0.0
     * @access public
     * @static
     */
    public static function run()
    {

        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;

    }

    /**
     * Constructor
     *
     * Perform some compatibility checks to make sure basic requirements are meet.
     * If all compatibility checks pass, initialize the functionality.
     *
     * @since 1.0.0
     * @access public
     */
    public function __construct()
    {
        if ($this->is_compatible()) {
            $this->rest_api();
            $this->post_type();
            $this->taxonomy_hooks();
        }
    }

    /**
     * Compatibility Checks
     *
     * Checks whether the site meets the plugin requirement.
     *
     * @since 1.0.0
     * @access public
     */
    public function is_compatible()
    {

        // Check for required PHP version
        if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
            add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
            return false;
        }

        return true;

    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have a minimum required PHP version.
     *
     * @since 1.0.0
     * @access public
     */
    public function admin_notice_minimum_php_version()
    {

        if (isset($_GET['activate'])) unset($_GET['activate']);

        $message = sprintf(
        /* translators: 1: Plugin name 2: PHP 3: Required PHP version */
            esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'rl'),
            '<strong>' . esc_html__('Rest Api Plugin', 'rl') . '</strong>',
            '<strong>' . esc_html__('PHP', 'rl') . '</strong>',
            self::MINIMUM_PHP_VERSION
        );

        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);

    }

    /**
     * Hook Rest Actions
     *
     * All rest routes hooks here.
     *
     * @since 1.0.0
     * @access public
     */
    public function rest_api() // TODO: Find appropriate name for this function
    {
        add_action('rest_api_init', array(new Rest\Post(), 'register_routes'));
        add_action('rest_api_init', array(new Rest\Project(), 'register_routes'));
    }

    /**
     * Hook Post Actions
     *
     * All custom post types hooks here.
     *
     * @since 1.0.0
     * @access public
     */
    public function post_type() // TODO: Find appropriate name for this function
    {
        add_action('wp_loaded', array(new ProjectPostType(), 'register_post'));
    }

    /**
     * Hook Taxonomy Actions
     *
     * All custom post types hooks here.
     *
     * @since 1.0.0
     * @access public
     */
    public function taxonomy_hooks()
    {
        add_action('wp_loaded', array(new ProjectCategory(), 'project_category'));
        add_action('wp_loaded', array(new ProjectTag(), 'project_tag'));
    }
}