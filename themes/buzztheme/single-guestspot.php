<?php
/**
 * The template for displaying archive pages.
 *
 * @package RED_Starter_Theme
 */

get_header();?>

<div id="primary" class="content-area edit-area">
  <section id='<?php echo get_the_ID() ?>' class="guestspot">
    <?php while (have_posts()): the_post();?>
    <img src=" <?php echo CFS()->get('image'); ?>" />
    <h1 class='title'>
      <?php echo the_title() ?>
    </h1>
    <div class="info">
      <h3>Location</h3>
      <p class="with-border">
        <?php echo CFS()->get('location'); ?>
      </p>
      <h3>Dates</h3>
      <span class="with-border first-date">
        <?php echo CFS()->get('start_date'); ?></span><span class="with-border">
        <?php echo CFS()->get('finish_date'); ?></span>
      <h3>Description</h3>
      <p class="with-border content">
        <?php echo wp_strip_all_tags(get_the_content()); ?>
      </p><br>
      <a class=>Edit Guestspot</a><a>Delete Guestspot</a>
    </div>
    <?php endwhile; // End of the loop. ?>
  </section>
  <div class="edit-guestspot-form">
    <form method='post' class='image-upload-form'>

      <input type='file' id='guespot-image' required>

      <?php global $current_user;
get_currentuserinfo();?>

      <p><label for="studio-name">Studio Name</label><br />
        <input type="text" id="studio-name" value="<?php echo $current_user->user_login ?>" />
      </p>
      <p>
        <label for="location">Location</label><br />
        <input type="text" id="location" required />
      </p>
      <p><label for="guestspot-start">Start Date</label><br />
        <input type="date" id="start-date" required />
      </p>
      <p><label for="guestspot-finish">Finish Date </label><br />
        <input type="date" id="finish-date" required />
      </p>
      <p>
      </p>
      <input type='submit' name='Submit' value="Add Guestspot" class='upload-btn'>
    </form>
  </div>
</div><!-- #primary -->
<?php get_footer();?>