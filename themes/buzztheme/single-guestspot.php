<?php
/**
 * The template for displaying archive pages.
 *
 * @package RED_Starter_Theme
 */

get_header();?>

<div class="edit-guestspot-form">
  <form method='post' class='guestspot-upload-form' id="<?php echo get_the_ID() ?>">
    <img id=<?php echo CFS()->get('image', false, array('format' => 'raw')); ?> src="
    <?php echo CFS()->get('image'); ?>" />

    <input type='file' id='guespot-image' />

    <?php global $current_user;
get_currentuserinfo();?>
    <p><label for="guestspot-title">Title</label><br />
      <input type="text" id="edit-guestspot-title" value=" <?php echo the_title() ?>" />
    </p>

    <p><label for="studio-name">Studio Name</label><br />
      <input type="text" id="edit-guestspot-studio-name" value="<?php echo CFS()->get('studio_name'); ?>" />
    </p>
    <p>
      <label for="location">Location</label><br />
      <input type="text" id="edit-guestspot-location" value="<?php echo CFS()->get('location'); ?>" required />
    </p>
    <p><label for="guestspot-start">Start Date</label><br />
      <input type="date" id="edit-guestspot-start-date" value="<?php echo CFS()->get('start_date'); ?>" required />
    </p>
    <p><label for="guestspot-finish">Finish Date </label><br />
      <input type="date" id="edit-guestspot-finish-date" value="<?php echo CFS()->get('finish_date'); ?>" required />
    </p>
    <p><label for="guestspot-description">Description</label><br />
      <input cols="40" rows="20" class="text-input" name="description" type="text" id="studiodescription" value="" />
    </p>
    <input type='submit' name='Submit' value="Submit" class='upload-btn'>
  </form>
</div>

<div id="primary" class="content-area edit-area">

  <?php while (have_posts()): the_post();?>
  <section id='<?php echo get_the_ID() ?>' class="guestspot">
    <img id=<?php echo CFS()->get('image', false, array('format' => 'raw')); ?> src="
    <?php echo CFS()->get('image'); ?>" />
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
      <?php
    get_currentuserinfo();
    if ($post->post_author == $current_user->ID): ?>
      <a href="#" class="edit-guestspot-btn">Edit Guestspot</a><a href="#" class="delete-guestspot-btn">Delete
        Guestspot</a>
      <?php else: ?>
      <a href="mailto:<?php echo get_the_author_meta('user_email', $post->post_author->id) ?>" class="get-in-touch-btn">Get
        in touch</a>
      <?php endif;?>
    </div>
  </section>
  <?php endwhile; // End of the loop. ?>


</div><!-- #primary -->
<?php get_footer();?>