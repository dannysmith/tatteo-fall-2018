<?php
/**
 * The template for displaying archive pages.
 *
 * @package RED_Starter_Theme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

<section>		
		<?php wp_list_authors(array(
    'orderby'       => 'registered', 
    'order'         => 'ASC', 
    'number'        => 6,
    'optioncount'   => false, 
    'exclude_admin' => true, 
    'show_fullname' => false,
    'hide_empty'    => true,
    'echo'          => true,
    'feed'          => '', 
    'feed_image'    => '',
    'feed_type'     => '',
    'style'         => 'list',
    'html'          => true,
    'exclude'       => '',
    'include'       => '')); ?>
</section>
	
		</main><!-- #main -->
	</div><!-- #primary -->


<?php get_footer(); ?>
