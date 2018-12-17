<?php
/**
 * The template for displaying archive pages.
 *
 * @package RED_Starter_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

<section class="artist-users">
<h1>Artists</h1>	
<?php
$args1 = array(
 'role' => 'artist',
 'orderby' => 'registered',
 'order' => 'ASC', 
 'number' => '6'
);
 $artists = get_users($args1);
 foreach ($artists as $user) {
echo '<div class="container"><div class="artist">' .
	'<a href="'.get_author_posts_url($user->ID).'">'
	. get_avatar($user->ID, 120) .
	'</div><li>'
	. $user->display_name .
	'</li> <li>'
	. $user->user_email .
	'</li> <li>'
	. $user->user_description .
	'</li> </div></a>';
 }
?>
	<button class="load-more">Load more</button>
</section>
	
		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>

