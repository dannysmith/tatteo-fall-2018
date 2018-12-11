<?php
/**
 * The template for displaying all pages.
 *
 * @package RED_Starter_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

	
	<?php get_template_part( 'template-parts/content-studio', 'page' ); ?>


		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>
