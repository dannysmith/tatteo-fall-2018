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
<?php foreach ($artists as $user):?>

    <div class="container">
      <div class="artist">
      <a href=" <?php echo get_author_posts_url($user->ID)?>">
      <div class="avatar" style="background-image:url(<?php echo esc_url(get_avatar_url($user->ID)); ?>);"></div>
      </a>
      </div>
      <li>
      <?php echo $user->display_name ?>
      </li> 
      <li>
      <?php echo $user->location ?>
      </li> 
      </div>
      </a>
       <?php endforeach ?>
       </section>

  <?php if(!(count($artists) <= 6)): ?>
	<section class="button"><button class="load-more-artists">Load more</button></section>
  <?php endif; ?>

  </main><!-- #main -->
</div><!-- #primary -->


<?php get_footer();?>