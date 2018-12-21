<?php
/**
 * The template for displaying archive pages.
 *
 * @package RED_Starter_Theme
 */

get_header();?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <section class="title">
      <h1>Artists</h1>
    </section>
    <section class="artist-users">

    <?php
$args1 = array(
    'role' => 'artist',
    'orderby' => 'registered',
    'order' => 'desc',
    'number' => '6',
);
$artists = get_users($args1);
foreach ($artists as $user) {
    echo '<div class="container"><div class="artist">' .
    '<a href="' . get_author_posts_url($user->ID) . '">'
    . get_avatar($user->ID, 120) .
    '</div><li>'
    . $user->display_name .
    '</li> <li>'
    . $user->location .
        '</li> </div></a>';
}
?>
       </section>

  <?php// if(!(count($artists) <= 6)): ?>
	<section class="button"><button class="load-more-artists">Load more</button></section>
  <?php// endif; ?>

  </main><!-- #main -->
</div><!-- #primary -->


<?php get_footer();?>