<?php
/**
 * The template for displaying archive pages.
 *
 * @package RED_Starter_Theme
 */

get_header();?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
    <section class="guestspot-section">
      <h1>My Guestspot</h1>
      <?php $args = array('post_type' => 'guestspot');
$guestspots = new WP_Query($args); /* $args set above*/?>
      <?php if ($guestspots->have_posts()): ?>
      <?php while ($guestspots->have_posts()): $guestspots->the_post();?>
      <div class="guestspot">
        <h1>
          <?php echo CFS()->get('studio_name'); ?>
        </h1>
        <p>
          <?php echo CFS()->get('location'); ?>
        </p>
      </div>
      <?php endwhile;?>
      <?php the_posts_navigation();?>
      <?php wp_reset_postdata();?>
      <?php else: ?>
      <h2>Nothing found!</h2>
      <?php endif;?>
      <div class="new-guestspot"></div>
    </section>
  </main><!-- #main -->
</div><!-- #primary -->
<?php get_footer();?>