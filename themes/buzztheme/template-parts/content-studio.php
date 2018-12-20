<?php
/**
 * Template part for displaying page content in author.php.
 *
 * @package RED_Starter_Theme
 */

?>

<article class="studio-profile" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<section class="single-studio">
	<?php
    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
    ?>
	<div class="avatar" style="background-image: url(<?php echo get_avatar_url($user->ID)?>);"></div>
	<div class="studioname"><h2><?php echo $curauth->nickname; ?></h2></div>
	<?php if(!empty($curauth->facebook&&$curauth->instagram)) { ?>
		<div class="socialmedia">
		<div class="socialmedialinks">
		<ul>
		<li><a href="https://www.instagram.com/<?php echo $curauth->instagram ?>"><i class="fa fa-instagram"></i><?php echo $curauth->instagram ?></a></li>
		<li><a href="https://www.facebook.com/<?php echo $curauth->facebook ?>"><i class="fa fa-facebook"></i><?php echo $curauth->facebook ?></a></li>
		</ul>
		</div>
		</div>
	<?php } else { ?>
		<div class="socialmedia" <?php echo 'hidden'; ?>></div>
	<?php } ?>
	<?php if(!empty($curauth->user_description)) { ?>
		<div class="studiodescription"><p><?php echo $curauth->user_description; ?></p></div>
	<?php } else { ?>
		<div class="studiodescription" <?php echo 'hidden'; ?>></div>
	<?php } ?>
	</section>

	<section class="previous-guestspots">
    <?php $args = array('post_type' => 'guestspot', 'author' => $curauth->ID, 'order' => 'ASC', 'posts_per_page' => '3');
	$guestspots = new WP_Query($args);
	if ($guestspots->have_posts()): ?>
    <h2>Previous Guestspots</h2>
    <div class="grid-container">
      <?php while ($guestspots->have_posts()): $guestspots->the_post();?>
      <div id='<?php echo get_the_ID() ?>' class="guestspots">
        <img src=" <?php echo CFS()->get('image'); ?>" />

        <div class="studio-information">
          <a href="<?php echo get_post_permalink(get_the_ID()) ?>">
            <p>
              <?php echo CFS()->get('studio_name'); ?>
            </p>
          </a>
          <p>
            <?php echo CFS()->get('location'); ?>
          </p>
          <p>
			<?php get_currentuserinfo(); ?>
			<a href="https://www.instagram.com/<?php echo $curauth->instagram ?>"><?php echo $curauth->instagram ?></a>
          </p>
        </div>

    </div>
    <?php endwhile;?>
    <?php endif;
wp_reset_postdata();
?>
    </div>
  </section>

</article><!-- #post-## -->
