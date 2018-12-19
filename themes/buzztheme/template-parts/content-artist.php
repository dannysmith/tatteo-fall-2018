<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @package RED_Starter_Theme
 */

?>

<article class="artist-profile" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<section class="single-artist">
	<?php $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));?>
	<div class="avatar"> <?php echo get_avatar($user->ID, 120) ?></div>
	<div class="artistname"><h2><?php echo $curauth->nickname; ?></h2></div>
	<div class="artistdescription"><p><?php echo $curauth->user_description; ?></p></div>
	</section>

	<section class="previous-guestspots">
	<h2>Previous Guestspots</h2>
	<section class="grid-container">
	<?php
    $loop = new WP_Query( array( 'post_type' => 'guestspot', 'order' => 'ASC', 'posts_per_page' => '3') );
    if ( $loop->have_posts() ) :
        while ( $loop->have_posts() ) : $loop->the_post(); ?>
            <div class="guestspots">
                <?php if ( has_post_thumbnail() ) { ?>
                    <div class="link-guestspot">
                        <a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
                    </div>
                <?php } ?>
                <div class="">
                    <p><?php echo get_the_title(); ?></p>
                </div>
            </div>
        <?php endwhile;
    endif;
    wp_reset_postdata();
	?>
	</section>
	</section>
	<section class="instagram">
	<h2>Instagram</h2>
	<div class="grid container">
<a href="https://www.instagram.com/<?php echo $curauth->instagram ?>"><?php echo $curauth->instagram ?></a>
	</div>
	</section>

</article><!-- #post-## -->
