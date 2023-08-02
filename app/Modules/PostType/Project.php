<?php

namespace Rl\Modules\PostType;

class Project
{
    private $slug;

    private $name;

    private $labels = array();

    private $args = array();

    public function __construct()
    {
        $this->slug = 'project';
        $this->name = ucfirst($this->slug);
    }

    public function register_post()
    {
        register_post_type($this->slug, $this->get_args());
    }

    public function get_labels()
    {
        return $this->labels = array(
            'name'          => __($this->name . 's', 'rl'),
            'singular_name' => __($this->name, 'rl'),
            'add_new'       => __('Add '. $this->name)
        );
    }

    public function get_args()
    {
        return $this->args = array(
            'labels' => $this->get_labels(),
            'public' => true,
            'show_in_rest' => true,
            'has_archive' => true,
            'hierarchical' => true,
            'menu_position' => 4,
            'menu_icon' => 'dashicons-portfolio',
            'supports' => array('title', 'editor', 'thumbnail')
        );
    }
}