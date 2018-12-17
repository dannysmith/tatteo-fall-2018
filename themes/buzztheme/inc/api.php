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
        'image',
        array(
            'get_callback' => 'buzz_get_avatar',
            'update_callback' => null,
            'schema' => null,
        )
    );
});

function buzz_get_avatar($user, $field_name, $request)
// function buzz_get_avatar($object, $field_name, $request)

{
    return get_wp_user_avatar_src($user['id'], 'original');
    // return get_wp_user_avatar_src(get_user_meta($user['id']), 'original');
    // return get_wp_user_avatar_src(get_user_meta($object['id'], $field_name, true));
    // return  get_wp_user_avatar(get_the_author_meta('ID'), 'large');
    // get_post_meta($object['id'], $field_name, true);
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