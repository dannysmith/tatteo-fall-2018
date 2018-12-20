<?php
/**
 * The template for displaying archive pages.
 *
 * @package RED_Starter_Theme
 */

get_header();?>

<div id="primary" class="content-area edit-area">
  <section class="create-guestspot-section">
    <form method='post' class='image-upload-form'>
      <h1>New Guestspot</h1>
      <img class="uploaded-image-new" />
      <input type='file' id='new-guespot-image-input' required>
      <?php global $current_user;
get_currentuserinfo();?>

      <p><label for="studio-name">Studio Name</label><br />
        <input type="text" id="studio-name" value="<?php echo $current_user->user_login ?>" />
      </p>
      <p>
        <label for="location">Current City</label><br />
        <input type="text" id="location" required />
      </p>
      <p><label for="guestspot-start">Start Date</label><br />
        <input type="date" id="start-date" required />
      </p>
      <p><label for="guestspot-finish">Finish Date </label><br />
        <input type="date" id="finish-date" required />
      </p>
      <p><label for="content">Description </label><br />
        <textarea rows="6" id="guestspot-content" required></textarea>
      </p>
      <input type='submit' name='Submit' value="Add Guestspot" class='upload-btn'>
    </form>
    <div class="imagecontainer">
      <img src="../../../../buzz/wp-content/themes/buzztheme/assets/Images/Textures-2-Vertical.png" alt="sidetexture">
    </div>
  </section>

  <h1>
    <?php echo get_the_author_meta('ID'); ?>
  </h1>
</div><!-- #primary -->
<?php get_footer();?>