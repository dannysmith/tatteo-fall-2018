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
  <div class="overlay">
  </div>
  <div class="dilog-container">


    <!-- Login form -->
    <div class="modal-dilog-login">
      <a class="cancel-modal-dilog-roles"></a>
      <div class="flex-container">
        <p class="error-message"></p>
        <form class="login-form" action="/buzz/wp-login.php" name="loginform" id="loginform" method="post">

          <label>Username</label>
          <input type="text" class="user-name" name="log" id="user_login" required />
          <label>Password</label>
          <input type="password" class="user-password" name="pwd" id="user_pass" required />
          <input class="log-in-user-btn" type="submit" value="Log in" name="wp-submit" id="wp-submit">

          <input type="hidden" name="redirect_to" value="http://localhost:8888/buzz/wp-admin/" />
          <input type="hidden" name="testcookie" value="1" />
        </form>
        <p>Don't have an account yet? Sign up <a class="sign-up-link">here</a>.</p>
      </div>
    </div>

    <!-- Sign-up form with roles -->
    <div class="modal-dilog-roles">
      <a class="cancel-modal-dilog-roles"></a>
      <div class="flex-container">
        <h2>Sign up here to have full access to Buzz!</h2>
        <div class="roles-links">
          <a class="studio-role role">Studio</a>
          <a class="artist-role role">Artist</a>
        </div>
        <p>Already have an account? Login <a class="login-here">here</a>.</p>
      </div>
    </div>

    <!-- Sign-up form with emal and password -->
    <div class="modal-dilog-submit">
      <a class="cancel-modal-dilog-roles"></a>
      <div class="flex-container">
        <p class="error-message-sign-up"></p>
        <form class="register-form">
          <label>User name</label>
          <input type="text" class="new-user-name" required />
          <label>Email</label>
          <input type="text" class="new-user-email" required />
          <label>Password</label>
          <input type="password" class="new-user-password" required />
          <input class="add-user-btn" type="submit" value="Submit">
        </form>
      </div>
    </div>

  </div>



  <div id="page" class="hfeed site">
    <header id="masthead" class="site-header" role="banner">
      <div class="site-branding">
        <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><img class="site-logo" src="<?php echo get_bloginfo('template_directory'); ?>/assets/logo/buzz-writing.png"></a>
      </div><!-- .site-branding -->
      <div class="dropdown-menu">
        <button class="dropbtn"><i class="fa fa-align-justify" aria-hidden="true"></i></button>
        <nav id="site-navigation" class="main-navigation" role="navigation">
          <?php wp_nav_menu();?>
          <div class="container-header-nav">
            <?php get_search_form();?>
            <a class="login-link">Login</a>
          </div>
        </nav><!-- #site-navigation -->
      </div> <!-- dropdown-menu-->
    </header><!-- #masthead -->

    <div id="content" class="site-content">