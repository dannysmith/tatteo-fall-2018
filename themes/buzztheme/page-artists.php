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
$artists = get_users($args1);?>

      <?php foreach ($artists as $user): ?>
      <div class="container">
        <div class="artist">
          <a href=" <?php echo get_author_posts_url($user->ID) ?>">
            <a href='<?php echo the_permalink() ?>'>
              <div class="avatar" style="background-image:url(<?php echo CFS()->get('image') ?>);">
              </div>
            </a>
        </div>
        <li>
          <?php echo $user->display_name ?>
        </li>
        <li>
          <?php echo $user->location ?>
        </li>
      </div></a>
    </section>
    <?php endforeach?>



    <section class="button <?php if (count($artists) < 6) {
    echo 'hidden';
}
?>"><button class="load-more-artists">Load
        more</button></section>

  </main><!-- #main -->
</div><!-- #primary -->


<?php get_footer();?>