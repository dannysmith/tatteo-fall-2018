<?php
/**
 * The template for displaying archive pages.
 *
 * @package RED_Starter_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
	<section class="filter-guestspot">
		<div class="location-div">
			<form class="form-guest-search">
			<h3>Location</h3>
			<input type="text" id="location" placeholder="London">
		</div>
		<div class="date-div">
			<h3>Dates</h3>
			<input id="start-date" type="date"><input id="finish-date" type="date">
		</div>
		<button>Search</button>
			</form>
	</section>

	<?php if ( have_posts() ) : ?>

	<header class="page-header">
		<h1 class="page-title">Guestspots</h1>
	</header><!-- .page-header -->

<div class="guestspots-message">
</div>

	<section class="guestspots-container-js">
<?php
    $loop = new WP_Query( array( 'post_type' => 'guestspot', 'order' => 'ASC', 'posts_per_page' => '-1') );
    if ( $loop->have_posts() ) :
        while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <div class="guestspots-container">
                    <div class="link-guestspot">
					<a href="<?php the_permalink(); ?>"><div class="avatar" style="background-image: url(<?php echo CFS()->get('image'); ?>);"></div></a>
                    </div>
                	<div class="">
                   <p><?php echo get_the_title(); ?></p>
                   <p> <?php echo CFS()->get('location'); ?></p>
				</div>
            </div>
        <?php endwhile;
    endif;
    wp_reset_postdata();
?>
</section>

			<?php the_posts_navigation(); ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
