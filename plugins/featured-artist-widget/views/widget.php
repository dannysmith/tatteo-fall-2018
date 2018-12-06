<!-- This file is used to markup the public-facing widget. -->
<?php if ( strlen( trim( $artist_name ) ) > 0 ) : ?>
<p class="artist-description">Artist Name:<?php echo $artist_name; ?>
</p>
<?php endif; ?>
<?php if ( strlen( trim( $artist_description ) ) > 0 ) : ?>
<p class="artist-description">Artist Description:<?php echo $artist_description; ?>
</p>
<?php endif; ?>

<?php if(isset($instance['image'])): ?>
<p>
<img src='<?php echo $instance['image'] ?>'>
</p>
<?php endif; ?>