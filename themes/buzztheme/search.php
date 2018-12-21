<?php
/**
 * The template for displaying search results pages.
 *
 * @package RED_Starter_Theme
 */

get_header(); 

$search_string = get_search_query();

	//search artist 		
			$wp_artist_query = new WP_User_Query( array(
				'role' => 'Artist',
				'search' => "*{$search_string}*",
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
			$artists = $wp_artist_query->get_results();


	//search studio
			$wp_studio_query = new WP_User_Query( array(
				'role' => 'Studio',
				'search' => "*{$search_string}*",
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
					$studios = $wp_studio_query->get_results();


		// Guestspots Search	
		$guestspots = new WP_Query(array(
				'post_type' => 'guestspot',
				's'=> $search_string
			));
		
		
	// Count Variables 
		$hasGuestspot = $guestspots->found_posts > 0;
		$hasStudio = count($studios) > 0;
		$hasArtist = count($artists) > 0;
		?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		
		<div class="tab">
			<button class="tablinks <?php if($hasGuestspot) echo 'active'; ?>" id="defaultOpen" onclick="openSearch(event, 'posts')" >Guestspots</button>
			<button class="tablinks <?php if(!$hasGuestspot && $hasStudio) echo 'active'; ?>" onclick="openSearch(event, 'studio')">Studios</button>
			<button class="tablinks <?php if(!$hasGuestspot && !$hasStudio && $hasArtist) echo 'active'; ?>" onclick="openSearch(event, 'artist')">Artists</button>
			</div>
			
			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

	
			
		<!--GUESTSPOTS-->	
				
			<div class="tabcontent <?php if($hasGuestspot) echo 'visible'; ?>"  id="posts">

				<!-- search guestspots -->	
					<?php if ($guestspots->have_posts()): ?>
					<?php while ($guestspots->have_posts()): $guestspots->the_post();?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<img src="<?php echo CFS()->get('image'); ?>" />

				<div class="entry-summary">
				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

				<div class="entry-meta">
					<?php red_starter_posted_on(); ?> / <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?> / <?php red_starter_posted_by(); ?>
				</div><!-- .entry-meta -->
				<?php the_excerpt(); ?>
					</article>
				<?php endwhile; ?>
				<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		
				<?php endif; ?>
		
			</div>
			
	<!--ARTISTS-->	
			<div class="tabcontent <?php if(!$hasGuestspot && !$hasStudio && $hasArtist) echo 'visible'; ?>"  id="artist">


				<?php	if ( ! empty( $artists ) ) {
			echo '<div class="search-artist">';
			// loop through each author
			foreach ( $artists as $user ) {
				// get all the user's data
				
				$user_info = get_userdata( $user->ID );

				echo '<a href="'.get_author_posts_url($user->ID).'">
				'. get_avatar($user->ID, 120). '<p>

				'. $user->display_name .'</p></a>';
				}
				echo '</div>';
					} else {
					get_template_part( 'template-parts/content', 'none' ); 
				} ?>  


			</div>


		<!--STUDIO-->	
			<div class="tabcontent <?php if(!$hasGuestspot && $hasStudio) echo 'visible'; ?>"  id="studio">



				<?php 	if ( ! empty( $studios ) ) {
				echo '<div class="search-artist">';
				// loop through each author
				foreach ( $studios as $user ) {
					// get all the user's data
					
					$user_info = get_userdata( $user->ID );

					echo '<a href="'.get_author_posts_url($user->ID).'">
					'. get_avatar($user->ID, 120). '<p>

					'. $user->display_name .'</p></a>';
				}
				echo '</div>';
			} else { 
				get_template_part( 'template-parts/content', 'none' ); 
			}
			?>
			</div>
		



			<?php red_starter_numbered_pagination(); ?>

		

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>
