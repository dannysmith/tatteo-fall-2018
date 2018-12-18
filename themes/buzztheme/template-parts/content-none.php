<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @package RED_Starter_Theme
 */

?>

<section class="no-results not-found">
	<header class="page-header">
		<p class="page-title"><?php esc_html( 'Nothing Found' ); ?></p>
	</header><!-- .page-header -->

			<section class="error-404 not-found">
					<h1 class="page-title"><?php echo esc_html( 'Oops! Nothing Found.' ); ?></h1>

				<div class="page-content">
					<p><?php echo esc_html( 'It looks like nothing was found. Maybe try a new search?' ); ?></p>

					<?php get_search_form(); ?>


			
						</ul>
					</div><!-- .widget -->

				</div><!-- .page-content -->
			</section><!-- .error-404 -->
</section><!-- .no-results -->
