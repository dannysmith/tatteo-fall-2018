<!-- This file is used to markup the administration form of the widget. -->

<div class="featured-artist-widget">
   <p><label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>">
   </p>
   <p><label for="<?php echo $this->get_field_id('artist_name'); ?>">Artist Name:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('artist_name'); ?>" name="<?php echo $this->get_field_name('artist_name'); ?>" type="text" value="<?php echo $artist_name; ?>">
   </p>
   <p>
      <label for="<?php echo $this->get_field_id('artist_description'); ?>">Artist Description:</label>
		<input class="widefat" id="<?php echo $this->get_field_id('artist_description'); ?>" name="<?php echo $this->get_field_name('artist_description'); ?>" type="text" value="<?php echo $artist_description; ?>">
   </p>
   <p>
    <label for="<?php echo $this->get_field_name( 'image' ); ?>"><?php _e( 'Image:' ); ?></label>
    <input class="upload_image_button" type="button" value="Upload Image" />
</p>


</div>
