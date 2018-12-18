<?php

require_once 'inc/update-profile.php';
?>

<?php get_header();?>



<?php if (!have_posts()) {
    get_template_part('parts/notice/no-posts');
}
?>

<?php while (have_posts()): the_post();?>



<?php get_template_part('parts/dashboard/edit-profile/intro');?>

<?php if (!empty($_GET['validation'])): ?>
<?php if ($_GET['validation'] == 'unknown'): ?>
<div class="error">
  <?php _e('An unknown error accurd, please try again or contant the website administrator', 'textdomain');?>
</div>
<?php endif;?>

<?php endif;?>

<?php $current_user = wp_get_current_user();?>
<div id="primary" class="content-area edit-area">
  <main id="main" class="site-main" role="main">
    <section class="edit-profile">
      <form name="profileForm" method="post" class="submit-form" method="post" id="adduser" action="<?php the_permalink();?>">

        <h2>
          <?php the_title();?>
        </h2>
        <h2>
          <?php _e('Details', 'textdomain');?>
        </h2>


        <div class="container">
          <div class="artist"><a href="http://localhost:8888/buzz/author/artist3/"><img src="http://localhost:8888/buzz/wp-content/plugins/wp-user-avatar/images/wpua-150x150.png"
                width="120" height="120" alt="" class="avatar avatar-120 wp-user-avatar wp-user-avatar-120 photo avatar-default"></a></div>
          <li><a href="http://localhost:8888/buzz/author/artist3/">artist3</a></li><a href="http://localhost:8888/buzz/author/artist3/">
            <li>artist3@artist3.artist3</li>
            <li></li>
          </a>
        </div>

        <label for="nickname">
          <?php _e('Name', 'textdomain');?></label>
        <input class="text-input" name="nickname" type="text" id="username" value="<?php the_author_meta('nickname', $current_user->ID);?>" />

        <label for="location">
          <?php _e('Current city', 'textdomain');?></label>
        <input class="text-input" name="location" type="text" id="location" value="<?php the_author_meta('location', $current_user->ID);?>" />

        <label for="phone_number">
          <?php _e('Phone Number', 'textdomain');?></label>
        <input class="text-input" name="phone_number" type="tel" placeholder="123-4567-8901" id="contactnumber" value="<?php the_author_meta('phone_number', $current_user->ID);?>" />

        <label for="date_of_birth">
          <?php _e('Date of birth', 'textdomain');?></label>
        <input class="text-input" id="dob" placeholder="DD/MM/YY" name="date_of_birth" type="text" value="<?php the_author_meta('date_of_birth', $current_user->ID);?>" />

        <label for="instagram">
          <?php _e('Instagram', 'textdomain');?></label>
        <input class="text-input" name="instagram" type="text" id="instalink" value="<?php the_author_meta('instagram', $current_user->ID);?>" />

        <label for="facebook">
          <?php _e('Facebook', 'textdomain');?></label>
        <input class="text-input" name="facebook" type="text" id="facelink" value="<?php the_author_meta('facebook', $current_user->ID);?>" />

        <label for="description">
          <?php _e('Biography', 'textdomain');?></label>
        <input cols="20" rows="10" class="text-input" name="description" type="text" id="userbio" value="<?php the_author_meta('description', $current_user->ID);?>" />

        <?php
// action hook for plugin and extra fields
do_action('edit_user_profile', $current_user);
?>
        <p class="form-submit">
          <?php echo $referer; ?>
          <input name="updateuser" type="submit" id="updateuser" class="submit button" value="<?php _e('Update', 'profile');?>" />
          <?php wp_nonce_field('update-user')?>
          <input name="action" type="hidden" id="action" value="update-user" />
        </p><!-- .form-submit -->

      </form><!-- #adduser -->
      <div class="imagecontainer">
        <img src="../../../../buzz/wp-content/themes/buzztheme/assets/Images/Textures-2-Vertical.png" alt="sidetexture">
      </div>
    </section>
    <?php endwhile;?>
    <div class="profile-footer">
      <?php get_footer();?>
    </div>
  </main><!-- #main -->
</div><!-- #primary -->
<?php wp_reset_postdata();?>