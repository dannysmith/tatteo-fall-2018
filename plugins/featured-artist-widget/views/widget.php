<!-- This file is used to markup the public-facing widget. -->
<?php if ( strlen( trim( $artist_name ) ) > 0 ) : ?>
<p class="artist-description"><?php echo $artist_name; ?>
</p>
<?php endif; ?>
<?php if ( strlen( trim( $artist_description ) ) > 0 ) : ?>
<p class="artist-description"><?php echo $artist_description; ?>
</p>
<?php endif; ?>
