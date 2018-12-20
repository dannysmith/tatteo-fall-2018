<?php
/**
 * Template part for displaying page content in author.php.
 *
 * @package RED_Starter_Theme
 */

?>

<article class="studio-profile" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<section class="single-studio">
	<?php
    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
    ?>
	<div class="avatar" style="background-image: url(<?php echo get_avatar_url($user->ID)?>);"></div>
	<div class="studioname"><h2><?php echo $curauth->nickname; ?></h2></div>
	<div class="studiodescription"><p><?php echo $curauth->user_description; ?></p></div>
	</section>

	<section class="previous-guestspots">
	<h2>Previous Guestspots</h2>
	<div class="grid-container">
	<?php
		 $current_user = wp_get_current_user();
		 
		 
		?>
	</div>
	</section>

	<section class="instagram">
	<h2>Instagram</h2>
	<div class="grid container"></div>
	</section>


	<section class="studio-location">
	<h2>Location</h2>
	<p><?php echo $curauth->location; ?></p>
	</section>

</article><!-- #post-## -->
