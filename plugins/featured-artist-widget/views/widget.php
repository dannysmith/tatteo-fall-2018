<!-- This file is used to markup the public-facing widget. -->
<?php if ( strlen( trim( $artist_name ) ) > 0 ) : ?>
<p class="artist-name"><?php echo $artist_name; ?>
</p>
<?php endif; ?>
<?php if ( strlen( trim( $artist_description ) ) > 0 ) : ?>
<div class="artist-description">
<p class="artist-description-p"><?php echo $artist_description; ?>
</p>
<a href="#"></a>
</div>
<?php endif; ?>
