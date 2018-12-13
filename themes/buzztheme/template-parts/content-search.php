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

		<?php if ( 'post' === get_post_type() && 'user' === get_users() ) : ?>
		<div class="entry-meta">
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
