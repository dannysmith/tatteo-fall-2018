<?php
/**
 * The template for displaying archive pages.
 *
 * @package RED_Starter_Theme
 */

get_header();?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">
    <section class="create-guestspot-section">
      <h1>New Guestspot</h1>

      <form class="guestspot-form" name="new_guestspot" method="post">
        <?php echo CFS()->get('image'); ?>
        <?php global $current_user;
get_currentuserinfo();?>
        <p><label for="studio-name">Studio Name</label><br />
          <input type="text" id="studio-name" value=" <?php echo $current_user->user_login ?>" tabindex="1" name="studio-name" />
        </p>
        <p>
          <label for="location">Location</label><br />
          <input type="text" id="guestspot-location" value="" tabindex="1" name="guestspot-location" />
        </p>
        <p><label for="guestspot-start">Start Date</label><br />
          <input type="date" id="guestspot-start" name="guestspot-start">
        </p>
        <p><label for="guestspot-finish">Finish Date</label><br />
          <input type="date" id="guestspot-finish" name="guestspot-finish">
        </p>
        <input type="submit" value="Add Guestspot" />
      </form>

    </section>
  </main><!-- #main -->
</div><!-- #primary -->
<?php get_footer();?>