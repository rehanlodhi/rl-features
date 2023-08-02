<?php

namespace Rl\Modules\Taxonomy;

class ProjectCategory
{
    private $slug;

    private $name;

    private $singular_name;

    private $post_type;

    private $labels;

    private $args;

    public function __construct()
    {
        $this->slug = 'project_cat';
        $this->post_type = 'project';
        $this->name = 'Categories';
        $this->singular_name = 'Category';
    }

    public function project_category()
    {
        register_taxonomy($this->slug, $this->post_type, $this->get_args());
    }

    public function get_labels()
    {
        return $this->labels = array(
            'name' => __($this->name, 'rl'),
            'singular_name' => __($this->singular_name, 'rl')
        );
    }

    public function get_args()
    {
        return $this->args = array(
            'labels'       => $this->get_labels(),
            'hierarchical' => true,
            'show_in_rest' => true
        );
    }
}