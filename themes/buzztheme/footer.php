<?php
/**
 * The template for displaying the footer.
 *
 * @package RED_Starter_Theme
 */

?>

</div><!-- #content -->

<footer id="colophon" class="site-footer" role="contentinfo">
  <div class="logo">
  <img src="<?php echo get_template_directory_uri(); ?>/assets/logo/buzz-writing-white.png" width="" height="" alt="buzz logo" />
  </div><!-- .logo -->
  <?php wp_nav_menu( array( 'theme_location' => 'new-menu', 'container_class' => 'footerlinks' ) ); ?>
  <p class="copyright">2019 Copyright ©</p>
  <?php wp_nav_menu( array( 'theme_location' => 'another-menu', 'container_class' => 'footersocialmedia' ) ); ?>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer();?>

</body>

</html>