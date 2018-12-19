<?php
/**
 * RED Starter Theme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package RED_Starter_Theme
 */

if (!function_exists('red_starter_setup')):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 */
    function red_starter_setup()
{
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        // Let WordPress manage the document title.
        add_theme_support('title-tag');

        // Enable support for Post Thumbnails on posts and pages.
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html('Primary Menu'),
        ));

        // Switch search form, comment form, and comments to output valid HTML5.
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

    }
endif; // red_starter_setup
add_action('after_setup_theme', 'red_starter_setup');

/**
 * Including jQuery
 */
function include_jquery_script()
{

    wp_deregister_script('jquery');
    wp_enqueue_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js', array(), null, true);

}
add_action('wp_enqueue_scripts', 'include_jquery_script');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * @global int $content_width
 */
function red_starter_content_width()
{
    $GLOBALS['content_width'] = apply_filters('red_starter_content_width', 640);
}
add_action('after_setup_theme', 'red_starter_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function red_starter_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html('Sidebar'),
        'id' => 'sidebar-1',
        'description' => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}
add_action('widgets_init', 'red_starter_widgets_init');

/**
 * Filter the stylesheet_uri to output the minified CSS file.
 */
function red_starter_minified_css($stylesheet_uri, $stylesheet_dir_uri)
{
    if (file_exists(get_template_directory() . '/build/css/style.min.css')) {
        $stylesheet_uri = $stylesheet_dir_uri . '/build/css/style.min.css';
    }

    return $stylesheet_uri;
}
add_filter('stylesheet_uri', 'red_starter_minified_css', 10, 2);

/**
 * Enqueue scripts and styles.
 */
function red_starter_scripts()
{
    wp_enqueue_style('red-starter-style', get_stylesheet_uri());

    wp_enqueue_script('red-starter-navigation', get_template_directory_uri() . '/build/js/navigation.min.js', array(), '20151215', true);
    wp_enqueue_script('red-starter-skip-link-focus-fix', get_template_directory_uri() . '/build/js/skip-link-focus-fix.min.js', array(), '20151215', true);
    wp_enqueue_style('font-awesome', 'https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_script('header', get_template_directory_uri() . '/build/js/header.min.js', array(), '20151215', true);
    if (function_exists("rest_url")) {

        wp_enqueue_script('sign-up', get_template_directory_uri() . '/build/js/sign-up.min.js', array(), false, true);
        wp_localize_script('sign-up', 'api_vars', array(
            'root_url' => esc_url_raw(rest_url()),
            'home_url' => esc_url_raw(home_url()),
            'nonce' => wp_create_nonce('wp_rest'),
            'success' => 'Thanks, your quote submission was received!',
            'failure' => 'Your submission could not be processed.',
        ));

        wp_enqueue_script('guestspot-util', get_template_directory_uri() . '/build/js/guestspot-util.min.js', array(), false, true);
        wp_localize_script('guestspot-util', 'api_vars', array(
            'root_url' => esc_url_raw(rest_url()),
            'home_url' => esc_url_raw(home_url()),
            'nonce' => wp_create_nonce('wp_rest'),
            // 'user_id' => get_current_user_id(),
            'user_id' => wp_get_current_user()->ID,
            'success' => 'Thanks, your quote submission was received!',
            'failure' => 'Your submission could not be processed.',
        ));

        wp_enqueue_script('guestspot-search', get_template_directory_uri() . '/build/js/guestspot-search.min.js', array(), false, true);
        wp_enqueue_script('myloadmore', get_template_directory_uri() . '/build/js/myloadmore.min.js', array(), false, true);
        wp_localize_script('myloadmore', 'api_vars', array(
            'root_url' => esc_url_raw(rest_url()),
            'home_url' => esc_url_raw(home_url()),
            'nonce' => wp_create_nonce('wp_rest'),
            'success' => 'Thanks, your quote submission was received!',
            'failure' => 'Your submission could not be processed.',
        ));
    }
}
add_action('wp_enqueue_scripts', 'red_starter_scripts');

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

// Add a custom user role

$result = add_role('artist', __('Artist'), array());

$result = add_role('studio', __('Studio'), array(
    'publish_guestspot' => true,
    'edit_guestspot' => true,
    'edit_others_guestspot' => true,
    'delete_guestspot' => true,
    'read_private_guestspot' => true,
    'edit_guestspot' => true,
    'delete_guestspot' => true,
    'read_guestspot' => true,
    'upload_files' => true,
    'edit_attachments' => true,
    'delete_attachments' => true,
    'publish_attachments' => true,
));

add_action('admin_init', 'allow_contributor_uploads');

function allow_contributor_uploads()
{
    $contributor = get_role('studio');
    $contributor->add_cap('upload_files');
    $admin = get_role('administrator');
    $admin->add_cap('edit_guestspot');
    $admin->add_cap('edit_others_guestspot');
    $admin->add_cap('delete_guestspot');
    $admin->add_cap('read_private_guestspot');
    $admin->add_cap('read_guestspot');
    $admin->add_cap('publish_guestspot');
}

add_action('edit_user_profile', 'wk_custom_user_profile_fields');

function modify_contact_methods($profile_fields)
{
    $profile_fields['location'] = 'Address';
    $profile_fields['phone'] = 'Phone Number';
    $profile_fields['date_of_birth'] = 'Date of Birth';
    $profile_fields['instagram'] = 'Instagram';
    $profile_fields['facebook'] = 'Facebook';
    $profile_fields['youtube'] = 'Youtube';

    return $profile_fields;
}
add_filter('user_contactmethods', 'modify_contact_methods');

function auto_login_new_user($user_id)
{
    if (isset($_POST['first_name'])) {
        update_user_meta($user_id, 'first_name', $_POST['first_name']);
    }
    $new_user = get_user_by('id', $user_id);
    $new_user->set_role($_POST['role']);

    wp_set_current_user($user_id);
    wp_set_auth_cookie($user_id);
    $user = get_user_by('id', $user_id);
    do_action('wp_login', $user->user_login);
    wp_redirect(home_url());
    exit;
}
add_action('user_register', 'auto_login_new_user');

add_action('user_register', 'registration', 10, 1);

function registration($user_id)
{
    //update_user_meta($user_id, 'first_name', 'test');

}

add_action('profile_update', 'registration', 10, 1);

// Adding menus in the footer

function register_my_menus()
{
    register_nav_menus(
        array(
            'links' => __('Links'),
            'social' => __('Social Media'),
        )
    );
}
add_action('init', 'register_my_menus');

require get_template_directory() . '/inc/api.php';


/*
 * Create a column. And maybe remove some of the default ones
 * @param array $columns Array of all user table columns {column ID} => {column Name}
 */
add_filter('manage_users_columns', 'rudr_modify_user_table');

function rudr_modify_user_table($columns)
{

    // unset( $columns['posts'] ); // maybe you would like to remove default columns
    $columns['registration_date'] = 'Registration date'; // add new
    
    return $columns;

}

/*
 * Fill our new column with the registration dates of the users
 * @param string $row_output text/HTML output of a table cell
 * @param string $column_id_attr column ID
 * @param int $user user ID (in fact - table row ID)
 */
add_filter('manage_users_custom_column', 'rudr_modify_user_table_row', 10, 3);

function rudr_modify_user_table_row($row_output, $column_id_attr, $user)
{

    $date_format = 'j M, Y H:i';

    switch ($column_id_attr) {
        case 'registration_date':
            return date($date_format, strtotime(get_the_author_meta('registered', $user)));
            break;
        default:
    }

    return $row_output;

}

/*
 * Make our "Registration date" column sortable
 * @param array $columns Array of all user sortable columns {column ID} => {orderby GET-param}
 */
add_filter('manage_users_sortable_columns', 'rudr_make_registered_column_sortable');

function rudr_make_registered_column_sortable($columns)
{
    return wp_parse_args(array('registration_date' => 'registered'), $columns);
}

function buzz_update_user_meta($user_login)
{
    //$user_id = $user->id;
    $user = get_user_by('login', $user_login);
    $description = $_POST['description'];
    $location = $_POST['location'];

    update_user_meta($user->id, "location", $location);
    update_user_meta($user->id, "description", $description);

}
add_action('wp_login', 'buzz_update_user_meta', 10, 1);