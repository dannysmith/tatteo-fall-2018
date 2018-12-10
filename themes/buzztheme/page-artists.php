s<?php
/**
 * The template for displaying archive pages.
 *
 * @package RED_Starter_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

<section class="studio-users">		
<?php
$args1 = array(
 'role' => 'artist',
 'orderby' => 'registered',
 'order' => 'ASC', 
 'number' => '6'
);
 $studios = get_users($args1);
 foreach ($studios as $user) {
 echo '<li>'
 . get_avatar($user->ID, 120) .
 '<br />'
 . $user->display_name .
 '<br />'
 . $user->user_email .
 '<br />'
 . $user->user_description .
 '</li>';
 }
?>

</section>
	
		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>

<?php
// Set the Current Author Variable $curauth
$curauth = (isset($_GET['author_name'])) ? get_user_by('role=studio') : get_userdata(intval($author));
?>
     
<div class="author-profile-card">
    <h2>About: <?php echo $curauth->first_name; ?></h2>
    <div class="author-photo">
    <?php echo get_avatar( $curauth->user_email , '90 '); ?>
    </div>
    <p><strong>Website:</strong> <a href="<?php echo $curauth->user_url; ?>"><?php echo $curauth->user_url; ?></a><br />
    <strong>Bio:</strong> <?php echo $curauth->user_description; ?></p>
</div>
     
<h2>Posts by <?php echo $curauth->nickname; ?>:</h2>
