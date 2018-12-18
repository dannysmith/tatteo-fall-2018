<?php // The search term
// $search_term = '';

// WP_User_Query arguments
$args = array (
    'role__not_in' => 'Administrator',
    'order'      => 'ASC',
    'orderby'    => 'display_name',
    // 'search'     => '*' . esc_attr( $search_term ) . '*',
    'meta_query' => array(
        'relation' => 'OR',
        array(
			'key'     => 'first_name',
            'value'   => $search_term,
            'compare' => 'LIKE'
        ),
        array(
            'key'     => 'last_name',
            'value'   => $search_term,
            'compare' => 'LIKE'
        ),
        array(
            'key'     => 'description',
            'value'   => $search_term ,
            'compare' => 'LIKE'
        )
    )
);

// Create the WP_User_Query object
$wp_user_query = new WP_User_Query( $args );

// Get the results
$authors = $wp_user_query->get_results();

// Check for results
if ( ! empty( $authors ) ) {
    echo '<div>';
    // loop through each author
    foreach ( $authors as $user ) {
		// get all the user's data
		

		$user_info = get_userdata( $user->ID );
		
		echo '<a href="'.get_author_posts_url($user->ID).'">
		'. get_avatar($user->ID, 120). '
		'. $user->display_name .'</a>';
    }
    echo '</div>';
} else {
    echo 'No authors found';
} ?>