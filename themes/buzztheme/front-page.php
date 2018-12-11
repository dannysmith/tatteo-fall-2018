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
    $loop = new WP_Query( array( 'post_type' => 'guestspot', 'order' => 'ASC', 'posts_per_page' => '6') );
    if ( $loop->have_posts() ) :
        while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <div class="guestspots">
                <?php if ( has_post_thumbnail() ) { ?>
                    <div class="link-guestspot">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                    </div>
                <?php } ?>
                <div class="">
                    <h2><?php echo get_the_title(); ?></h2>
                </div>
            </div>
        <?php endwhile;
    endif;
    wp_reset_postdata();
?>
</section>
    

    <section class="featured-artist">
    <?php get_sidebar();?>
    </section>


  </main><!-- #main -->
</div><!-- #primary -->
<?php get_footer();?>