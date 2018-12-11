<?php
/**
 * The template for displaying all pages.
 *
 * @package RED_Starter_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			
	<?php $user = get_user_by('id', $author);
			if ( in_array( 'artist', (array) $user->roles ) ) {

				get_template_part( 'template-parts/content', 'artist' );

			}
			if ( in_array( 'studio', (array) $user->roles ) ) {

				get_template_part( 'template-parts/content', 'studio' );

			} ?>


		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>
