<?php
/**
 * Template part for displaying results in search pages.
 *
 * @package RED_Starter_Theme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">

	
		<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

		<?php if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
		<?php
  $image_url = get_post_meta($post->ID, 'image-url-field', true);
  $link_url = get_post_meta($post->ID, 'link-url-field', true);
  $link_text = get_post_meta($post->ID, 'link-text-field', true);

  // display inline image
  echo '<img src="' . esc_url($image_url) . '" />';

  // display clickable link
  echo '<a href="' . esc_url($link_url) . '">' . esc_html($link_text) . '</a>';
?>
			<?php red_starter_posted_on(); ?> / <?php comments_number( '0 Comments', '1 Comment', '% Comments' ); ?> / <?php red_starter_posted_by(); ?>
		</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	
<?php
$blogusers = get_users( array( 'search' => 'john' ) );
// Array of WP_User objects.
foreach ( $blogusers as $user ) {
    echo '<span>' . esc_html( $user->user_email ) . '</span>';
} ?>

	<div class="entry-summary">
		<?php the_excerpt(); ?>

	</div><!-- .entry-summary -->
</article><!-- #post-## -->
