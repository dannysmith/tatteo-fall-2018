<?php
/**
 * The header for our theme.
 *
 * @package RED_Starter_Theme
 */

?>
<!DOCTYPE html>
<html <?php language_attributes();?>>

<head>
  <meta charset="<?php bloginfo('charset');?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="profile" href="http://gmpg.org/xfn/11">
  <link rel="pingback" href="<?php bloginfo('pingback_url');?>">

  <?php wp_head();?>
</head>

<body <?php body_class();?>>

  <div class="overlay"></div>

  <div class="dilog-container">


    <div class="modal-dilog-roles">
      <a class="cancel-modal-dilog-roles"></a>
      <div class="flex-container">
        <h2>Sign up here to have full access to Buzz!</h2>
        <div class="roles-links">
          <a class="studio-role role">Studio</a>
          <a class="artist-role role">Artist</a>
        </div>
        <p>Already have an account? Login <a>here</a>.</p>
      </div>
    </div>

    <div class="modal-dilog-submit">
      <form class="register-form">
        <label>User name</label>
        <input type="text" class="new-user-name" />
        <label>Password</label>
        <input type="password" class="new-user-password" />
        <input class="add-user-btn" type="submit" value="Submit">
      </form>
    </div>
  </div>

  <div id="page" class="hfeed site">
    <a class="skip-link screen-reader-text" href="#content">
      <?php echo esc_html('Skip to content'); ?></a>

    <header id="masthead" class="site-header" role="banner">
      <div class="site-branding">
        <h1 class="site-title screen-reader-text"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
            <?php bloginfo('name');?></a></h1>
        <p class="site-description">
          <?php bloginfo('description');?>
        </p>
      </div><!-- .site-branding -->

      <nav id="site-navigation" class="main-navigation" role="navigation">
        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
          <?php echo esc_html('Primary Menu'); ?></button>
        <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu'));?>
      </nav><!-- #site-navigation -->
      <a class="login-link">login</a>
    </header><!-- #masthead -->

    <div id="content" class="site-content">