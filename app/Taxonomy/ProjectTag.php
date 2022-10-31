<?php

namespace Rl\Taxonomy;

class ProjectTag
{
    private $slug;

    private $name;

    private $singular_name;

    private $post_type;

    private $labels;

    private $args;

    public function __construct()
    {
        $this->slug = 'project_tag';
        $this->post_type = 'project';
        $this->name = 'Skills';
        $this->singular_name = 'Skill';
    }

    public function project_tag()
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
            'hierarchical' => false,
            'show_in_rest' => true
        );
    }
}