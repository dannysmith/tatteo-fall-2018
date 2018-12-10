<?php
/**
 * Widget template. This template can be overriden using the "sp_template_image-widget_widget.php" filter.
 * See the readme.txt file for more info.
 */

// Block direct requests
if ( ! defined( 'ABSPATH' ) )
	die( '-1' );

echo $before_widget;
?>
<h2 class="title-featured-artist">Featured Artist</h2>
<?php 
if ( ! empty( $title ) ) { echo $before_title . $title . $after_title; }

echo $this->get_image_html( $instance, true );

if ( ! empty( $description ) ) {
	echo '<div class="' . esc_attr( $this->widget_options['classname'] ) . '-description" >';
	echo wpautop( $description );
	echo '</div>';
}
echo $after_widget;
