<?php 

// WP_User_Query arguments
$search_string = get_search_query();

// Create the WP_User_Query object
$wp_user_query = new WP_User_Query( array(
	'role' => 'Studio',
    'search'         => "*{$search_string}*",
    'search_columns' => array(
        'user_login',
        'user_nickname',
        'user_email',
        'user_url',
    ),
    'meta_query' => array(
        'relation' => 'OR',
        array(
            'key'     => 'nickname',
            'value'   => $search_string,
            'compare' => 'LIKE'
        ),
        array(
            'key'     => 'last_name',
            'value'   => $search_string,
            'compare' => 'LIKE'
		), 
		array(
			'key'     => 'first_name',
			'value'   => $search_string,
			'compare' => 'LIKE'
		)
    )
) );


// Get the results
$users = $wp_user_query->get_results();

// Check for results

if ( ! empty( $users ) ) {
    echo '<div>';
    // loop through each author
    foreach ( $users as $user ) {
        // get all the user's data
        
        $user_info = get_userdata( $user->ID );

        echo '<a href="'.get_author_posts_url($user->ID).'">
        '. get_avatar($user->ID, 120). '
        '. $user->display_name .'</a>';
    }
    echo '</div>';
} else {

	// get_template_part( 'template-parts/content', 'none' ); 


} ?>  