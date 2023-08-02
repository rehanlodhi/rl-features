<?php

namespace Rl\Modules\Rest;

class Project
{
    public function __construct()
    {
        $this->namespace = 'rl/v1';
        $this->rest_base = 'projects';
    }


    public function register_routes()
    {
        register_rest_route($this->namespace, '/' . $this->rest_base, array(

            array(
                'methods' => \WP_REST_Server::READABLE,
                'callback' => array($this, 'get_items'),
                'permission_callback' => array($this, 'get_items_permissions_check'),
            )

        ));
    }

    public function get_items_permissions_check($request)
    {
        $allowed_ips = array( '127.0.0.1' );
        $request_server = $_SERVER['REMOTE_ADDR'];

        if( ! in_array( $request_server, $allowed_ips ) )
            return new \WP_Error(
                'rest_forbidden',
                esc_html__( 'Access denied from your IP address.', 'my-text-domain' ),
                array( 'status' => 401 )
            );

        return true;
    }

    public function get_items($request)
    {
        $data = get_posts(array(
            'post_type' => 'project'
        ));

        return $data;
    }
}