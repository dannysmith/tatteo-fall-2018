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
            'update_callback' => 'buzz_update_location',
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

function buzz_update_location($value, $user, $field_name)
{
    error_log('**value**');
    error_log($value);
    error_log('**user**');
    error_log(print_r($user));
    error_log('**fieldname**');
    error_log($field_name);
    update_user_meta($user['id'], 'location', esc_attr($user['location']));
    update_user_meta($user['id'], 'location', 'value');
    update_user_meta($user['id'], 'nickname', 'value');
    update_user_meta($user['id'], 'phone_number', 'value');
    update_user_meta($user['id'], 'date_of_birth', 'value');
    update_user_meta($user['id'], 'instagram', 'value');
    update_user_meta($user['id'], 'facebook', 'value');
    update_user_meta($user['id'], 'description', 'value');
    // update_user_meta($user['id'], 'location', '$value');

}

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

    //return update_post_meta($object->ID, $field_name, strip_tags($value));
}