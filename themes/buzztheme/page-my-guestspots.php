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
      <h1>My Guestspots</h1>
      <?php $args = array('post_type' => 'guestspot',
    'author' => wp_get_current_user()->ID);
$guestspots = new WP_Query($args);?>
      <?php if ($guestspots->have_posts()): ?>
      <?php while ($guestspots->have_posts()): $guestspots->the_post();?>
      <div id='<?php echo get_the_ID() ?>' class="guestspot">
        <img src=" <?php echo CFS()->get('image'); ?>" />
        <div class="studio-information">
          <a href="<?php echo get_post_permalink(get_the_ID()) ?>">
            <h2>
              <?php echo the_title(); ?>
            </h2>
          </a>
          <p>
            <?php echo CFS()->get('location'); ?>
          </p>

        </div>

      </div>
      <?php endwhile;?>
      <?php endif;?>
      <div class="new-guestspot">
        <a class="edit-guestspot" href="<?php echo get_permalink(get_page_by_path('create-guestspot')) ?>"><img src="<?php echo get_template_directory_uri() ?>/assets/Buttons/add-button.png" /></a>
        <h2>Add Guestspot</h2>
      </div>

    </section>
  </main><!-- #main -->
</div><!-- #primary -->
<?php get_footer();?>