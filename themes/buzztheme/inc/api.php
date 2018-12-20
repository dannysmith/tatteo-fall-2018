<?php
/**
 * Add studio name, location, dates and image fields to API request
 */
add_action('rest_api_init', function () {

    register_rest_field(
        'guestspot',
        'studio_name',
        array(
            'get_callback' => 'buzz_get_guestspot_meta_fields',
            'update_callback' => 'buzz_update_guestspot_meta_fields',
            'schema' => null,
        )
    );

    register_rest_field(
        'guestspot',
        'location',
        array(
            'get_callback' => 'buzz_get_guestspot_meta_fields',
            'update_callback' => 'buzz_update_guestspot_meta_fields',
            'schema' => null,
        )
    );

    register_rest_field(
        'guestspot',
        'start_date',
        array(
            'get_callback' => 'buzz_get_guestspot_meta_fields',
            'update_callback' => 'buzz_update_guestspot_meta_fields',
            'schema' => null,
        )
    );

    register_rest_field(
        'guestspot',
        'finish_date',
        array(
            'get_callback' => 'buzz_get_guestspot_meta_fields',
            'update_callback' => 'buzz_update_guestspot_meta_fields',
            'schema' => null,
        )
    );

    register_rest_field(
        'guestspot',
        'image',
        array(
            'get_callback' => 'buzz_get_guestspot_meta_fields',
            'update_callback' => 'buzz_update_guestspot_meta_fields',
            'schema' => null,
        )
    );
});

/**
 * Add  API request
 */
add_action('rest_api_init', function () {

    register_rest_field(
        'user',
        'user_email',
        array(
            'get_callback' => 'buzz_get_email',
            'update_callback' => null,
            'schema' => null,
        )
    );

    register_rest_field(
        'user',
        'avatar',
        array(
            'get_callback' => 'buzz_get_avatar',
            'update_callback' => null,
            'schema' => null,
        )
    );

    register_rest_field(
        'user',
        'location',
        array(
            'get_callback' => 'buzz_get_location',
            'update_callback' => null,
            'schema' => null,
        )
    );
});
function buzz_get_location($user, $field_name, $request)
{
    return get_user_meta($user['id'], 'location');
}

// function add_user_bookmarks($user, $meta_value)
// {
//     $bookmarks = get_user_meta($user->ID, 'location', false);
//     if ($bookmarks) {
//         update_user_meta($user->ID, 'location', $meta_value);
//     } else {
//         add_user_meta($user->ID, 'location', $meta_value, true);
//     }
// }

function buzz_get_avatar($user, $field_name, $request)
{
    return get_wp_user_avatar_src($user['id'], 'original');
}

function buzz_get_email($user, $field_name, $request)
{
    return get_userdata($user['id'])->user_email;
}

function buzz_get_guestspot_meta_fields($object, $field_name, $request)
{
    return CFS()->get($field_name, $object['id']);
}
/**
 * Handler for updating custom field data.
 */
function buzz_update_guestspot_meta_fields($value, $object, $field_name)
{
    if (!$value || !is_string($value)) {
        return;
    }

    $field_data = array($field_name => $value);
    $post_data = array('ID' => $object->ID); // the ID is required

    CFS()->save($field_data, $post_data);
}

// Extend the `WP_REST_Posts_Controller` class
class Artist_Custom_Controller extends WP_REST_Users_Controller
{
    public function register_routes()
    {
        register_rest_route($this->namespace, '/artist_users', [
            [
                'methods' => WP_REST_Server::READABLE,
                'callback' => array($this, 'get_items'),
                'permission_callback' => array($this, 'get_items_permissions_check'),
                'args' => $this->get_collection_params(),
            ],
            'schema' => array($this, 'get_public_item_schema'),
        ]);
    }

    public function get_items_permissions_check($request)
    {

        if (true) {

            $role = $request->get_param('roles');
            $orderby = $request->get_param('orderby');

            $request->set_param('roles', "");
            $request->set_param('orderby', "");

            $result = parent::get_items_permissions_check($request);

            $request->set_param('roles', $role);
            $request->set_param('orderby', $orderby);
        } else {
            $result = parent::get_items_permissions_check($request);
        }
        return $result;

    }

}

add_action('rest_api_init', function () {
    $myProductController = new Artist_Custom_Controller();
    $myProductController->register_routes();
});