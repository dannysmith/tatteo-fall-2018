<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @package RED_Starter_Theme
 */

?>

<article class="artist-profile" id="post-<?php the_ID();?>" <?php post_class();?>>
  <header class="entry-header">
    <?php the_title('<h1 class="entry-title">', '</h1>');?>

  </header><!-- .entry-header -->
  <?php
function scrapeImage($text)
{
    $pattern = '/src=[\'"]?([^\'" >]+)[\'" >]/';
    preg_match($pattern, $text, $link);
    $link = $link[1];
    $link = urldecode($link);
    return $link;
}
?>
  <section class="single-artist">
    <div class="avatar-container">
      <div class="avatar" style="background-image:url('<?php echo scrapeImage(get_wp_user_avatar($user_info->ID)); ?>')"></div>
    </div>
    <div class="artistdetails">
      <?php $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));?>
      <div class="artistname">
        <h2>
          <?php echo $curauth->nickname; ?>
        </h2>
      </div>
      <?php if (!empty($curauth->user_description)) {?>
      <div class="artistdescription">
        <p>
          <?php echo $curauth->user_description; ?>
        </p>
      </div>
      <?php } else {?>
      <div class="artistdescription" <?php echo "style='border:none;'" ; ?>></div>
      <?php }?>
      <?php if (!empty($curauth->facebook && $curauth->instagram)) {?>
      <div class="socialmedia">
        <div class="socialmedialinks">
          <ul>
            <li><a href="https://www.instagram.com/<?php echo $curauth->instagram ?>"><i class="fa fa-instagram"></i>
                <?php echo $curauth->instagram ?></a></li>
            <li><a href="https://www.facebook.com/<?php echo $curauth->facebook ?>"><i class="fa fa-facebook"></i>
                <?php echo $curauth->facebook ?></a></li>
          </ul>
        </div>
      </div>
      <?php } else if (!empty($curauth->facebook)) {?>
      <div class="socialmedia">
        <div class="socialmedialinks">
          <ul>
            <li><a href="https://www.facebook.com/<?php echo $curauth->facebook ?>"><i class="fa fa-facebook"></i>
                <?php echo $curauth->facebook ?></a></li>
          </ul>
        </div>
      </div>
      <?php } else if (!empty($curauth->instagram)) {?>
      <div class="socialmedia">
        <div class="socialmedialinks">
          <ul>
            <li><a href="https://www.instagram.com/<?php echo $curauth->instagram ?>"><i class="fa fa-instagram"></i>
                <?php echo $curauth->instagram ?></a></li>
          </ul>
        </div>
      </div>
      <?php } else {?>
      <div class="socialmedia" <?php echo 'hidden' ; ?>></div>
      <?php }?>

    </div>
  </section>

</article><!-- #post-## -->