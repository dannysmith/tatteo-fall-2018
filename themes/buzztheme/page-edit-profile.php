<?php
/**
 * The template for displaying edit profile pages.
 *
 * @package RED_Starter_Theme
 */

get_header();?>
<!-- <i class="fas fa-quote-right"></i>
         <i class="fas fa-quote-left"></i>  -->
<div id="primary" class="content-area edit-area" >
  <main id="main" class="site-main" role="main">
    <section class="edit-profile">
      <?php if (is_user_logged_in()): ?>
      <form name="profileForm" id="profile-submission-form" method="post" class="submit-form">
        <header>

          <h2>
            <?php the_title();?>
          </h2>

        </header>

        <h3>Details</h3>

        <label>Name</label>
        <input type="text" name="username" id="username">

        <label>Current city</label>
        <input type="text" name="location" id="location">

        <label>Phone number</label>
        <input id="contactnumber" name="contactnumber" type="tel" placeholder="123-4567-8901">

        <label>Date of birth</label>
        <input type="text" name="dob" id="dob" placeholder="DD/MM/YY">

        <label>Instagram</label>
        <input type="text" name="instalink" id="instalink">

        <label>Facebook</label>
        <input type="text" name="facelink" id="facelink">

        <label>Biography</label>
        <textarea type="text" name="userbio" id="userbio" cols="20" rows="10"></textarea>

        <button>Save</button>

      </form>
      <p class="success-msg"> </p>
      <p class="sorry-msg"> </p>
      <?php else: ?>
      <p>Sorry, you must be logged in to submit a quote!</p>
      <a href="<?php echo wp_login_url(get_permalink()); ?>" title="login">Click here to login</a>
      <?php endif;?>
      <div class="imagecontainer">
        <img src="../../../../buzz/wp-content/themes/buzztheme/assets/Images/Textures-2-Vertical.png" alt="sidetexture">
      </div>

    </section>
    <div class="profilefooter">
      <?php get_footer();?>
    </div>


  </main><!-- #main -->
</div><!-- #primary -->