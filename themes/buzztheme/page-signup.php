<?php
/**
 * WordPress User Page
 *
 * Handles authentication, registering, resetting passwords, forgot password,
 * and other user handling.
 *
 * @package WordPress
 */

/** Make sure that the WordPress bootstrap has run before continuing. */
// /Applications/MAMP/htdocs/buzz/wp-login.php
// /Applications/MAMP/htdocs/buzz/wp-content/themes/buzztheme/page-signup.php
require dirname(__FILE__) . '/../../../wp-load.php';

// Redirect to https login if forced to use SSL
if (force_ssl_admin() && !is_ssl()) {
    if (0 === strpos($_SERVER['REQUEST_URI'], 'http')) {
        wp_safe_redirect(set_url_scheme($_SERVER['REQUEST_URI'], 'https'));
        exit();
    } else {
        wp_safe_redirect('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        exit();
    }
}

/**
 * Output the login page header.
 *
 * @param string   $title    Optional. WordPress login Page title to display in the `<title>` element.
 *                           Default 'Log In'.
 * @param string   $message  Optional. Message to display in header. Default empty.
 * @param WP_Error $wp_error Optional. The error to pass. Default is a WP_Error instance.
 */
function login_header($title = 'Log In', $message = '', $wp_error = null)
{
    global $error, $interim_login, $action;

    // Don't index any of these forms
    add_action('login_head', 'wp_sensitive_page_meta');

    add_action('login_head', 'wp_login_viewport_meta');

    if (!is_wp_error($wp_error)) {
        $wp_error = new WP_Error();
    }

    // Shake it!
    $shake_error_codes = array('empty_password', 'empty_email', 'invalid_email', 'invalidcombo', 'empty_username', 'invalid_username', 'incorrect_password');
    /**
     * Filters the error codes array for shaking the login form.
     *
     * @since 3.0.0
     *
     * @param array $shake_error_codes Error codes that shake the login form.
     */
    $shake_error_codes = apply_filters('shake_error_codes', $shake_error_codes);

    if ($shake_error_codes && $wp_error->get_error_code() && in_array($wp_error->get_error_code(), $shake_error_codes)) {
        add_action('login_head', 'wp_shake_js', 12);
    }

    $login_title = get_bloginfo('name', 'display');

    /* translators: Login screen title. 1: Login screen name, 2: Network or site name */
    $login_title = sprintf(__('%1$s &lsaquo; %2$s &#8212; WordPress'), $title, $login_title);

    /**
     * Filters the title tag content for login page.
     *
     * @since 4.9.0
     *
     * @param string $login_title The page title, with extra context added.
     * @param string $title       The original page title.
     */
    $login_title = apply_filters('login_title', $login_title, $title);

    ?>
<!DOCTYPE html>
<!--[if IE 8]>
		<html xmlns="http://www.w3.org/1999/xhtml" class="ie8" <?php language_attributes();?>>
	<![endif]-->
<!--[if !(IE 8) ]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes();?>>
<!--<![endif]-->

<head>
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type');?>; charset=<?php bloginfo('charset');?>" />
  <title>
    <?php echo $login_title; ?>
  </title>
  <?php

    wp_enqueue_style('login');

    /*
     * Remove all stored post data on logging out.
     * This could be added by add_action('login_head'...) like wp_shake_js(),
     * but maybe better if it's not removable by plugins
     */
    if ('loggedout' == $wp_error->get_error_code()) {
        ?>
  <script>if("sessionStorage" in window){try{for(var key in sessionStorage){if(key.indexOf("wp-autosave-")!=-1){sessionStorage.removeItem(key)}}}catch(e){}};</script>
  <?php
}

    /**
     * Enqueue scripts and styles for the login page.
     *
     * @since 3.1.0
     */
    do_action('login_enqueue_scripts');

    /**
     * Fires in the login page header after scripts are enqueued.
     *
     * @since 2.1.0
     */
    do_action('login_head');

    if (is_multisite()) {
        $login_header_url = network_home_url();
        $login_header_title = get_network()->site_name;
    } else {
        $login_header_url = __('https://wordpress.org/');
        $login_header_title = __('Powered by WordPress');
    }

    /**
     * Filters link URL of the header logo above login form.
     *
     * @since 2.1.0
     *
     * @param string $login_header_url Login header logo URL.
     */
    $login_header_url = apply_filters('login_headerurl', $login_header_url);

    /**
     * Filters the title attribute of the header logo above login form.
     *
     * @since 2.1.0
     *
     * @param string $login_header_title Login header logo title attribute.
     */
    $login_header_title = apply_filters('login_headertitle', $login_header_title);

    /*
     * To match the URL/title set above, Multisite sites have the blog name,
     * while single sites get the header title.
     */
    if (is_multisite()) {
        $login_header_text = get_bloginfo('name', 'display');
    } else {
        $login_header_text = $login_header_title;
    }

    $classes = array('login-action-register', 'wp-core-ui');
    if (is_rtl()) {
        $classes[] = 'rtl';
    }

    if ($interim_login) {
        $classes[] = 'interim-login';
        ?>
  <style type="text/css">
    html {
      background-color: transparent;
    }
  </style>
  <?php

        if ('success' === $interim_login) {
            $classes[] = 'interim-login-success';
        }

    }
    $classes[] = ' locale-' . sanitize_html_class(strtolower(str_replace('_', '-', get_locale())));

    /**
     * Filters the login page body classes.
     *
     * @since 3.5.0
     *
     * @param array  $classes An array of body classes.
     */
    $classes = apply_filters('login_body_class', $classes, 'register');

    ?>
</head>

<body class="login <?php echo esc_attr(implode(' ', $classes)); ?>">
  <?php
/**
     * Fires in the login page header after the body tag is opened.
     *
     * @since 4.6.0
     */
    do_action('login_header');
    ?>
  <div id="login">
    <h1><a href="<?php echo esc_url($login_header_url); ?>" title="<?php echo esc_attr($login_header_title); ?>"
        tabindex="-1">
        <?php echo $login_header_text; ?></a></h1>
    <?php

    unset($login_header_url, $login_header_title);

    /**
     * Filters the message to display above the login form.
     *
     * @since 2.1.0
     *
     * @param string $message Login message text.
     */
    $message = apply_filters('login_message', $message);
    if (!empty($message)) {
        echo $message . "\n";
    }

    // In case a plugin uses $error rather than the $wp_errors object
    if (!empty($error)) {
        $wp_error->add('error', $error);
        unset($error);
    }

    if ($wp_error->get_error_code()) {
        $errors = '';
        $messages = '';
        foreach ($wp_error->get_error_codes() as $code) {
            $severity = $wp_error->get_error_data($code);
            foreach ($wp_error->get_error_messages($code) as $error_message) {
                if ('message' == $severity) {
                    $messages .= '	' . $error_message . "<br />\n";
                } else {
                    $errors .= '	' . $error_message . "<br />\n";
                }

            }
        }
        if (!empty($errors)) {
            /**
             * Filters the error messages displayed above the login form.
             *
             * @since 2.1.0
             *
             * @param string $errors Login error message.
             */
            echo '<div id="login_error">' . apply_filters('login_errors', $errors) . "</div>\n";
        }
        if (!empty($messages)) {
            /**
             * Filters instructional messages displayed above the login form.
             *
             * @since 2.5.0
             *
             * @param string $messages Login messages.
             */
            echo '<p class="message">' . apply_filters('login_messages', $messages) . "</p>\n";
        }
    }
} // End of login_header()

/**
 * Outputs the footer for the login page.
 *
 * @param string $input_id Which input to auto-focus
 */
function login_footer($input_id = '')
{
    global $interim_login;

    // Don't allow interim logins to navigate away from the page.
    if (!$interim_login): ?>
    <p id="backtoblog"><a href="<?php echo esc_url(home_url('/')); ?>">
        <?php
/* translators: %s: site title */
    printf(_x('&larr; Back to %s', 'site'), get_bloginfo('title', 'display'));
    ?></a></p>
    <?php the_privacy_policy_link('<div class="privacy-policy-page-link">', '</div>');?>
    <?php endif;?>

  </div>

  <?php if (!empty($input_id)): ?>
  <script type="text/javascript">
    try {
      document.getElementById('<?php echo $input_id; ?>').focus();
    } catch (e) {}
    if (typeof wpOnload == 'function') wpOnload();
  </script>
  <?php endif;?>

  <?php
/**
     * Fires in the login page footer.
     *
     * @since 3.1.0
     */
    do_action('login_footer');?>
  <div class="clear"></div>
</body>

</html>
<?php
}

/**
 * @since 3.0.0
 */
function wp_shake_js()
{
    ?>
<script type="text/javascript">
  addLoadEvent = function(func) {
    if (typeof jQuery != "undefined") jQuery(document).ready(func);
    else if (typeof wpOnload != 'function') {
      wpOnload = func;
    } else {
      var oldonload = wpOnload;
      wpOnload = function() {
        oldonload();
        func();
      }
    }
  };

  function s(id, pos) {
    g(id).left = pos + 'px';
  }

  function g(id) {
    return document.getElementById(id).style;
  }

  function shake(id, a, d) {
    c = a.shift();
    s(id, c);
    if (a.length > 0) {
      setTimeout(function() {
        shake(id, a, d);
      }, d);
    } else {
      try {
        g(id).position = 'static';
        wp_attempt_focus();
      } catch (e) {}
    }
  }
  addLoadEvent(function() {
    var p = new Array(15, 30, 15, 0, -15, -30, -15, 0);
    p = p.concat(p.concat(p));
    var i = document.forms[0].id;
    g(i).position = 'relative';
    shake(i, p, 20);
  });
</script>
<?php
}

/**
 * @since 3.7.0
 */
function wp_login_viewport_meta()
{
    ?>
<meta name="viewport" content="width=device-width" />
<?php
}

/**
 * Handles sending password retrieval email to user.
 *
 * @return bool|WP_Error True: when finish. WP_Error on error
 */
function retrieve_password()
{
    $errors = new WP_Error();

    if (empty($_POST['user_login']) || !is_string($_POST['user_login'])) {
        $errors->add('empty_username', __('<strong>ERROR</strong>: Enter a username or email address.'));
    } elseif (strpos($_POST['user_login'], '@')) {
        $user_data = get_user_by('email', trim(wp_unslash($_POST['user_login'])));
        if (empty($user_data)) {
            $errors->add('invalid_email', __('<strong>ERROR</strong>: There is no user registered with that email address.'));
        }

    } else {
        $login = trim($_POST['user_login']);
        $user_data = get_user_by('login', $login);
    }

    /**
     * Fires before errors are returned from a password reset request.
     *
     * @since 2.1.0
     * @since 4.4.0 Added the `$errors` parameter.
     *
     * @param WP_Error $errors A WP_Error object containing any errors generated
     *                         by using invalid credentials.
     */
    do_action('lostpassword_post', $errors);

    if ($errors->get_error_code()) {
        return $errors;
    }

    if (!$user_data) {
        $errors->add('invalidcombo', __('<strong>ERROR</strong>: Invalid username or email.'));
        return $errors;
    }

    // Redefining user_login ensures we return the right case in the email.
    $user_login = $user_data->user_login;
    $user_email = $user_data->user_email;
    $key = get_password_reset_key($user_data);

    if (is_wp_error($key)) {
        return $key;
    }

    if (is_multisite()) {
        $site_name = get_network()->site_name;
    } else {
        /*
         * The blogname option is escaped with esc_html on the way into the database
         * in sanitize_option we want to reverse this for the plain text arena of emails.
         */
        $site_name = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);
    }

    $message = __('Someone has requested a password reset for the following account:') . "\r\n\r\n";
    /* translators: %s: site name */
    $message .= sprintf(__('Site Name: %s'), $site_name) . "\r\n\r\n";
    /* translators: %s: user login */
    $message .= sprintf(__('Username: %s'), $user_login) . "\r\n\r\n";
    $message .= __('If this was a mistake, just ignore this email and nothing will happen.') . "\r\n\r\n";
    $message .= __('To reset your password, visit the following address:') . "\r\n\r\n";
    $message .= '<' . network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . ">\r\n";

    /* translators: Password reset email subject. %s: Site name */
    $title = sprintf(__('[%s] Password Reset'), $site_name);

    /**
     * Filters the subject of the password reset email.
     *
     * @since 2.8.0
     * @since 4.4.0 Added the `$user_login` and `$user_data` parameters.
     *
     * @param string  $title      Default email title.
     * @param string  $user_login The username for the user.
     * @param WP_User $user_data  WP_User object.
     */
    $title = apply_filters('retrieve_password_title', $title, $user_login, $user_data);

    /**
     * Filters the message body of the password reset mail.
     *
     * If the filtered message is empty, the password reset email will not be sent.
     *
     * @since 2.8.0
     * @since 4.1.0 Added `$user_login` and `$user_data` parameters.
     *
     * @param string  $message    Default mail message.
     * @param string  $key        The activation key.
     * @param string  $user_login The username for the user.
     * @param WP_User $user_data  WP_User object.
     */
    $message = apply_filters('retrieve_password_message', $message, $key, $user_login, $user_data);

    if ($message && !wp_mail($user_email, wp_specialchars_decode($title), $message)) {
        wp_die(__('The email could not be sent.') . "<br />\n" . __('Possible reason: your host may have disabled the mail() function.'));
    }

    return true;
}

/**
 * Handles registering a new user.
 *
 * @param string $user_login User's username for logging in
 * @param string $user_email User's email address to send password and add
 * @return int|WP_Error Either user's ID or error on failure.
 */
function register_new_user_with_password($user_login, $user_email, $user_pass)
{
    $errors = new WP_Error();

    $sanitized_user_login = sanitize_user($user_login);
    /**
     * Filters the email address of a user being registered.
     *
     * @since 2.1.0
     *
     * @param string $user_email The email address of the new user.
     */
    $user_email = apply_filters('user_registration_email', $user_email);

    // Check the username
    if ($sanitized_user_login == '') {
        $errors->add('empty_username', __('<strong>ERROR</strong>: Please enter a username.'));
    } elseif (!validate_username($user_login)) {
        $errors->add('invalid_username', __('<strong>ERROR</strong>: This username is invalid because it uses illegal characters. Please enter a valid username.'));
        $sanitized_user_login = '';
    } elseif (username_exists($sanitized_user_login)) {
        $errors->add('username_exists', __('<strong>ERROR</strong>: This username is already registered. Please choose another one.'));

    } else {
        /** This filter is documented in wp-includes/user.php */
        $illegal_user_logins = array_map('strtolower', (array) apply_filters('illegal_user_logins', array()));
        if (in_array(strtolower($sanitized_user_login), $illegal_user_logins)) {
            $errors->add('invalid_username', __('<strong>ERROR</strong>: Sorry, that username is not allowed.'));
        }
    }

    // Check the email address
    if ($user_email == '') {
        $errors->add('empty_email', __('<strong>ERROR</strong>: Please type your email address.'));
    } elseif (!is_email($user_email)) {
        $errors->add('invalid_email', __('<strong>ERROR</strong>: The email address isn&#8217;t correct.'));
        $user_email = '';
    } elseif (email_exists($user_email)) {
        $errors->add('email_exists', __('<strong>ERROR</strong>: This email is already registered, please choose another one.'));
    }

    /**
     * Fires when submitting registration form data, before the user is created.
     *
     * @since 2.1.0
     *
     * @param string   $sanitized_user_login The submitted username after being sanitized.
     * @param string   $user_email           The submitted email.
     * @param WP_Error $errors               Contains any errors with submitted username and email,
     *                                       e.g., an empty field, an invalid username or email,
     *                                       or an existing username or email.
     */
    do_action('register_post', $sanitized_user_login, $user_email, $errors);

    /**
     * Filters the errors encountered when a new user is being registered.
     *
     * The filtered WP_Error object may, for example, contain errors for an invalid
     * or existing username or email address. A WP_Error object should always returned,
     * but may or may not contain errors.
     *
     * If any errors are present in $errors, this will abort the user's registration.
     *
     * @since 2.1.0
     *
     * @param WP_Error $errors               A WP_Error object containing any errors encountered
     *                                       during registration.
     * @param string   $sanitized_user_login User's username after it has been sanitized.
     * @param string   $user_email           User's email.
     */
    $errors = apply_filters('registration_errors', $errors, $sanitized_user_login, $user_email);

    if ($errors->get_error_code()) {
        return $errors;
    }

    $user_id = wp_create_user($sanitized_user_login, $user_pass, $user_email);
    if (!$user_id || is_wp_error($user_id)) {
        $errors->add('registerfail', sprintf(__('<strong>ERROR</strong>: Couldn&#8217;t register you&hellip; please contact the <a href="mailto:%s">webmaster</a> !'), get_option('admin_email')));
        return $errors;
    }

    /**
     * Fires after a new user registration has been recorded.
     *
     * @since 4.4.0
     *
     * @param int $user_id ID of the newly registered user.
     */
    do_action('register_new_user', $user_id);

    return $user_id;
}
//
// Main
//

$errors = new WP_Error();

nocache_headers();

// TODO: replace with json
header('Content-Type: ' . get_bloginfo('html_type') . '; charset=' . get_bloginfo('charset'));

if (defined('RELOCATE') && RELOCATE) { // Move flag is set
    if (isset($_SERVER['PATH_INFO']) && ($_SERVER['PATH_INFO'] != $_SERVER['PHP_SELF'])) {
        $_SERVER['PHP_SELF'] = str_replace($_SERVER['PATH_INFO'], '', $_SERVER['PHP_SELF']);
    }

    $url = dirname(set_url_scheme('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']));
    if ($url != get_option('siteurl')) {
        update_option('siteurl', $url);
    }

}

//Set a cookie now to see if they are supported by the browser.
$secure = ('https' === parse_url(wp_login_url(), PHP_URL_SCHEME));
setcookie(TEST_COOKIE, 'WP Cookie check', 0, COOKIEPATH, COOKIE_DOMAIN, $secure);
if (SITECOOKIEPATH != COOKIEPATH) {
    setcookie(TEST_COOKIE, 'WP Cookie check', 0, SITECOOKIEPATH, COOKIE_DOMAIN, $secure);
}

/**
 * Fires when the login form is initialized.
 *
 * @since 3.2.0
 */
do_action('login_init');

/**
 * Fires before a specified login form action.
 *
 * The dynamic portion of the hook name, `$action`, refers to the action
 * that brought the visitor to the login form. Actions include 'postpass',
 * 'logout', 'lostpassword', etc.
 *
 * @since 2.8.0
 */
do_action("login_form_register");

$http_post = ('POST' == $_SERVER['REQUEST_METHOD']);
$interim_login = isset($_REQUEST['interim-login']);

/**
 * Filters the separator used between login form navigation links.
 *
 * @since 4.9.0
 *
 * @param string $login_link_separator The separator used between login form navigation links.
 */
$login_link_separator = apply_filters('login_link_separator', ' | ');

if (is_multisite()) {
    /**
     * Filters the Multisite sign up URL.
     *
     * @since 3.0.0
     *
     * @param string $sign_up_url The sign up URL.
     */
    wp_redirect(apply_filters('wp_signup_location', network_site_url('wp-signup.php')));
    exit;
}

if (!get_option('users_can_register')) {
    wp_redirect(site_url('wp-login.php?registration=disabled'));
    exit();
}

$user_login = '';
$user_email = '';
$user_password = '';
$user_description = '';

if ($http_post) {
    if (isset($_POST['user_login']) && is_string($_POST['user_login'])) {
        $user_login = $_POST['user_login'];
    }

    if (isset($_POST['user_email']) && is_string($_POST['user_email'])) {
        $user_email = wp_unslash($_POST['user_email']);
    }

    if (isset($_POST['password']) && is_string($_POST['password'])) {
        $user_password = wp_unslash($_POST['password']);
    }
    if (isset($_POST['description']) && is_string($_POST['description'])) {
        $user_description = wp_unslash($_POST['description']);
    }

    // $user_id = username_exists( $user_name );
    // if ( !$user_id and email_exists($user_email) == false ) {
    //     $random_password = wp_generate_password( $length=12, $include_standard_special_chars=false );
    //     $user_id = wp_create_user( $user_name, $random_password, $user_email );
    // } else {
    //     $random_password = __('User already exists.  Password inherited.');
    // }

    //$errors = register_new_user($user_login, $user_email);
    $errors = register_new_user_with_password($user_login, $user_email, $user_password);
    if (!is_wp_error($errors)) {
        $user_id = $errors;
        update_user_meta($user_id, 'description', $user_description);
        $redirect_to = !empty($_POST['redirect_to']) ? $_POST['redirect_to'] : 'wp-login.php?checkemail=registered';
        wp_safe_redirect($redirect_to);
        exit();
    }
}

login_header(__('Registration Form'), '<p class="message register">' . __('Register For This Site') . '</p>', $errors);
?>