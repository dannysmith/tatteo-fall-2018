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
      <form method='post' class='image-upload-form'>
        <input type='file' id='guespot-image'>

        <?php global $current_user;
get_currentuserinfo();?>
        <p><label for="studio-name">Title</label><br />
          <input type="text" id="title" tabindex="1" value="<?php echo $current_user->user_login ?>" required />
        </p>
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
        <p><label for="guestspot-finish">Finish Date</label><br />
          <input type="date" id="finish-date" required />
        </p>
        <p>
        </p>
        <input type='submit' name='Submit' value="Add Guestspot" class='upload-btn'>
      </form>
    </section>
  </main><!-- #main -->
</div><!-- #primary -->
<?php get_footer();?>