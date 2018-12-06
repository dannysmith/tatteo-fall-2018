{

"test": "test"
}

<?php
/*
 * Create default user. If the user already exists, the user tables are
 * being shared among sites. Just set the role in that case.
 */
/*
$user_id = username_exists($user_name);
$user_password = trim($user_password);
$email_password = false;
if ( !$user_id && empty($user_password) ) {
$user_password = wp_generate_password( 12, false );
$message = __('<strong><em>Note that password</em></strong> carefully! It is a <em>random</em> password that was generated just for you.');
$user_id = wp_create_user($user_name, $user_password, $user_email);
update_user_option($user_id, 'default_password_nag', true, true);
$email_password = true;
} elseif ( ! $user_id ) {
// Password has been provided
$message = '<em>'.__('Your chosen password.').'</em>';
$user_id = wp_create_user($user_name, $user_password, $user_email);
} else {
$message = __('User already exists. Password inherited.');
}

$user = new WP_User($user_id);
$user->set_role('administrator');

wp_install_defaults($user_id);

wp_install_maybe_enable_pretty_permalinks();

flush_rewrite_rules();

wp_new_blog_notification($blog_title, $guessurl, $user_id, ($email_password ? $user_password : __('The password you chose during installation.') ) );

wp_cache_flush();
 */
?>