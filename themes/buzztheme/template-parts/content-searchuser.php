<?php
/**
 * Template part for displaying results in search pages.
 *
 * @package RED_Starter_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
 
if ( isset($_GET["search_term"]) ) {
	$search_term = $_GET["search_term"];
} else {
	$search_term = "---";
}
  ?>
 
<div id="primary" class="content-area">
	<main id="main" class="site-main" role="main">
		
	<?php while ( have_posts() ) : the_post(); ?>
 
		<!-- <div class="page-header">
			<h1>User Search:</h1>
			<p><i class="fa fa-search"></i> Search Term = <strong><?php echo $search_term; ?></strong></p>
		</div> -->
		<!--/.page-header-->
 
		<!-- <div class="page-content">
			<form id="user-search-form">
                            <label>Search members by name or email:</label>
                            <input type="text" placeholder="Enter search term..." id="search-term" />
                            <input type="submit" value="Search" />
			</form> -->
			<!--/#user-search-form-->
 
			<?php
				// user search query arguments
				$user_search_args = array (
				    'order'      => 'ASC',
				    'orderby'    => 'display_name',
				    'search'     => '*' . esc_attr( $search_term ) . '*',
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
				            'key'     => 'user_email',
				            'value'   => $search_term ,
				            'compare' => 'LIKE'
				        )
				    )
				);
				// user query
				$user_search_query = new WP_User_Query( $user_search_args );
 
				// Get the results
				$users = $user_search_query->get_results();
 
				// Array of WP_User objects
				if ( !empty( $users ) ) :
			?>
				<ul>
					<?php foreach ( $users as $user ) : ?>
						<li>
							<h5><?php echo $user->first_name . ' ' . $user->last_name; ?></h5>
							<label><?php echo $user->user_email; ?></label>
						</li>
					<?php endforeach; ?>
				</ul>
			
			<?php else : ?>
 
				<div class="alert">
					<h3>No Results</h3>
					<hr/>
					<p>Sorry... there were no results found for this search term.</p>
				</div>
				<!--/.alert-->
 
			<?php endif; ?>
		</div>
		<!--/.page-content-->
 
	<?php endwhile; ?>	
 
	</main>
	<!--/.site-main-->
</div>
<!--/.content-area-->
 
<!-- Search jQuery -->
<script type="text/javascript">
$(document).ready(function(){
	// search form redirect
	$('.search-label').on('submit', function(e){
		e.preventDefault();
		var searchTerm = $('#search-term').val();
		window.location.href = 'https://yourwebsite.com/user-search/?search_term=' + searchTerm + '';
	});
});
</script>
 

	</div><!-- .entry-summary -->
</article><!-- #post-## -->
