<?php
/**
 * The main template file.
 *
 * @package RED_Starter_Theme
 */

get_header();?>

<div id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

<section class="banner-image">
<div class="banner-title">
<h2>Tatoos.</h2>
<h2>Travel.</h2>
<h2>Worldwide.</h2>
<div>
  <div class="div-p-banner">
<p class="sign-up-link banner-p">Get Started</p>
</div>
</section>

<!-- need to edit this loop -->

<section>
      <?php
        $args = array( 'post_type' => 'guestspots', 'order' => 'ASC', 'posts_per_page' => '6');
        $guestspots_posts = get_posts( $args ); // returns an array of posts
      ?>
      <div class ="exampleguestspots">
      <?php foreach ( $guestspots_posts as $post ) : setup_postdata( $post ); ?>
      <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
        <?php the_post_thumbnail();?> 
      <?php endforeach; wp_reset_postdata(); ?>
      </div>
</section>
    

    <section class="featured-artist">
    <?php get_sidebar();?>
    </section>


  </main><!-- #main -->
</div><!-- #primary -->
<?php get_footer();?>