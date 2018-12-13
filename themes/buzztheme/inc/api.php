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