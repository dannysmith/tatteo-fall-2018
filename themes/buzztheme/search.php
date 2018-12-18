<?php
/**
 * The template for displaying search results pages.
 *
 * @package RED_Starter_Theme
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
		

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html( 'Search Results for: %s' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<div class="tab">
			<button class="tablinks" onclick="openSearch(event, 'posts')" >Guestspots</button>
			<button class="tablinks" onclick="openSearch(event, 'studio')">Studios</button>
			<button class="tablinks" onclick="openSearch(event, 'artist')">Artists</button>
			</div>

			<!-- Start the Loop  -->
			<?php while ( have_posts() ) : the_post(); ?>

			<div id="posts" class="tabcontent"><?php get_template_part( 'template-parts/content', 'search' ); ?></div>

			
			<div id="studio" class="tabcontent"><?php get_template_part( 'template-parts/content', 'search-studio' ); ?></div>
			<div id="artist" class="tabcontent"><?php get_template_part( 'template-parts/content', 'search-artist' ); ?></div>

			<?php endwhile; ?>

			<?php red_starter_numbered_pagination(); ?>

		<?php else : ?>

		
		<div id="studio" class="tabcontent"><?php get_template_part( 'template-parts/content', 'search-studio' ); ?></div>
		<div id="artist" class="tabcontent"><?php get_template_part( 'template-parts/content', 'search-artist' ); ?></div>

		<?php endif; ?>
			

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_footer(); ?>
