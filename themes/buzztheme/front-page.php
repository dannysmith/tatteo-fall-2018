<?php
/**
 * The main template file.
 *
 * @package RED_Starter_Theme
 */

get_header();?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

  	<section class="examplefirstblock">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/clem-onojeghuo-121575-unsplash.png" width="" height="" alt="background" />
		</section>

		<section class="examplesecondblock">
      <div class="exampleguestspots"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Adam-Sage.png" width="" height="" alt="the warren tattoo"></div>
      <div class="exampleguestspots"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Caleb-Kilby.png" width="" height="" alt="aesthetic ambition"></div>
      <div class="exampleguestspots"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Clare-Xthg.png" width="" height="" alt="black ink tattoo"></div>
      <div class="exampleguestspots"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Duncan-X.png" width="" height="" alt="mirror studios"></div>
      <div class="exampleguestspots"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/False-Modigliani.png" width="" height="" alt="human tattoo"></div>
      <div class="exampleguestspots"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Adam-Sage.png" width="" height="" alt="skinz place"></div>
    </section>

    <section class="featured-artist">
    <?php get_sidebar();?>
    </section>

    <section class="examplefourthblock">
      <img src="<?php echo get_template_directory_uri(); ?>/assets/images/oldhabits-12.png" width="" height="" alt="background" />
      <img class="textures" src="<?php echo get_template_directory_uri(); ?>/assets/images/Textures-2.png" width="" height="" alt="background" />
    </section>

    <?php if (have_posts()): ?>

    <?php if (is_home() && !is_front_page()): ?>
    <header>
      <h1 class="page-title screen-reader-text">
        <?php single_post_title();?>
      </h1>
    </header>
    <?php endif;?>

    <?php /* Start the Loop */?>
    <?php while (have_posts()): the_post();?>

    <?php get_template_part('template-parts/content');?>

    <?php endwhile;?>

    <?php the_posts_navigation();?>

    <?php else: ?>

    <?php get_template_part('template-parts/content', 'none');?>

    <?php endif;?>

  </main><!-- #main -->
</div><!-- #primary -->
<?php get_footer();?>