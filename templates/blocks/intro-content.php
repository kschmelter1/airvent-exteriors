<?php
/**
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

 // Load values and assigning defaults.
$heading = get_field('heading');
$title = get_field('title');
$text = get_field('text');
$btns = get_field('buttons');
$image = get_field('image');
$layout = get_field('layout');
$height = get_field('image_height');
$gallery = get_field('gallery'); // For before/after only

$textSize = get_field('text_size');

// Create class attribute allowing for custom "className" and "align" values.
$className = 'container-fluid wide block block-intro-content block-intro-content-'.$layout;
if ($heading) {$className .= ' has-heading';}
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if ($textSize === "large") {
  $className .= ' large-text';
}


// Create id attribute allowing for custom "anchor" value.
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

if ($text && $image || $gallery) :
?>
<div class="<?= $className; ?>" <?= ($block['anchor'] ? 'id="'.$block['anchor'].'"' : ''); ?>>
  <?php if ($heading) : ?>
    <div class="row justify-content-center">
      <h2 class="block-title"><?= $heading; ?></h2>
    </div>
  <?php endif; ?>
  <div class="row">
    <div class="col-lg-6 text-col">
      <?php if ($heading) {$h = 'h3';} else {$h = 'h2';} ?>
      <div class="block-text">
        <?= ($title ? '<'.$h.' class="block-intro-content-title">'.$title.'</'.$h.'>' : '');
        //echo ($text ? '<div class="block-text">'.$text.'</div>' : '');
        echo ($text ? $text : ''); ?>
        <?php if ($btns) : ?>
        <div class="btns">
        <?php foreach ($btns as $btn) {
          echo echo_link($btn['link'], 'btn btn-accent');
        } ?>
        </div>
      <?php endif; ?>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="img-wrap-shadow">
        <?php if ($gallery) : ?>
          <div class="cocoen">
            <?php foreach ($gallery as $img) {echo echo_image($img, 'medium_large');}?>
          </div>
        <?php else : ?>
          <div class="img-wrap <?= $height; ?>"><?= echo_image($image, 'medium_large'); ?></div>
        <?php endif; ?>
      </div>
    </div>
  </div>

</div>
<?php elseif ($image) : ?>
  <div class="<?= $className; ?> fullwidth-image" <?= ($block['anchor'] ? 'id="'.$block['anchor'].'"' : ''); ?>>
    <?php if ($heading) : ?>
      <div class="row justify-content-center">
        <h2 class="block-title"><?= $heading; ?></h2>
      </div>
    <?php endif; ?>
    <div class="row">
      <div class="col-lg-12">
        <div class="img-wrap-shadow">
            <div class="img-wrap <?= $height; ?>"><?= echo_image($image, 'large'); ?></div>
            <?php if (get_field('image_overlay')) {
              $img2 = get_field('image_overlay');
              echo '<div class="image-overlay-wrap"><div class="image-overlay">'.echo_image($img2).'</div></div>';
            } ?>
        </div>
      </div>
    </div>

  </div>
<?php endif; ?>
