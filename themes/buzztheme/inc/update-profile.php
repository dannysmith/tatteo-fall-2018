<?php
/* Recheck if user is logged in just to be sure, this should have been done already */
if( !is_user_logged_in() ) {
	wp_redirect( home_url() );
	exit;
}
if ( $_SERVER['REQUEST_METHOD'] == 'POST' && !empty( $_POST['action'] ) && $_POST['action'] == 'update-user' ) {
	$current_user = wp_get_current_user();
	/* Check nonce first to see if this is a legit request */
	if( !isset( $_POST['_wpnonce'] ) || !wp_verify_nonce( $_POST['_wpnonce'], 'update-user' ) ) {
		wp_redirect( get_permalink() . '?validation=unknown' );
		exit;
	}
	/* Check honeypot for autmated requests */
	if( !empty($_POST['honey-name']) ) {
		wp_redirect( get_permalink() . '?validation=unknown' );
		exit;
	}
    /* Update profile fields */
    
    if ( !empty( $_POST['nickname'] ) ) {
    	$display_name = esc_attr( $_POST['nickname'] );
        update_user_meta( $current_user->ID, 'nickname', esc_attr( $_POST['nickname'] ) );
    }
    if ( !empty( $_POST['location'] ) ) {
        update_user_meta( $current_user->ID, 'location', esc_attr( $_POST['location'] ) );
    }
    if ( !empty( $_POST['phone_number'] ) ) {
        update_user_meta( $current_user->ID, 'phone_number', esc_attr( $_POST['phone_number'] ) );
    }
    if ( !empty( $_POST['date_of_birth'] ) ) {
    	$display_name .= ' ' . esc_attr( $_POST['date_of_birth'] );
        update_user_meta( $current_user->ID, 'date_of_birth', esc_attr( $_POST['date_of_birth'] ) );
    }
    if ( !empty( $_POST['instagram'] ) ) {
        update_user_meta( $current_user->ID, 'instagram', esc_attr( $_POST['instagram'] ) );
    }
    if ( !empty( $_POST['facebook'] ) ) {
        update_user_meta( $current_user->ID, 'facebook', esc_attr( $_POST['facebook'] ) );
    }
    if ( !empty( $_POST['description'] ) ) {
        update_user_meta( $current_user->ID, 'description', esc_attr( $_POST['description'] ) );
    }
    /* Let plugins hook in, like ACF who is handling the profile picture all by itself. Got to love the Elliot */
    do_action('edit_user_profile_update', $current_user->ID);
    /* We got here, assuming everything went OK */
    wp_redirect( get_permalink() . '?updated=true' );
	exit;
}