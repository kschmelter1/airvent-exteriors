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
$embed = get_field('embed');
// Create class attribute allowing for custom "className" and "align" values.
$className = 'container-fluid block block-cta block-cta-'.$layout;
if ($heading) {$className .= ' has-heading';}
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}


// Create id attribute allowing for custom "anchor" value.
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

if ($text && $image || $text && $embed) :
?>
<div class="<?= $className; ?>" <?= ($block['anchor'] ? 'id="'.$block['anchor'].'"' : ''); ?>>
  <?= ($heading ? '<div class="block-cta-heading">'.$heading.'</div>' : ''); ?>
  <div class="row">
    <div class="col-lg-6">
      <?= ($title ? '<h2 class="block-cta-title">'.$title.'</h2>' : ''); ?>
      <?= ($text ? '<div class="block-text">'.$text.'</div>' : ''); ?>
      <?php if ($btns) : ?>
        <div class="btns">
        <?php foreach ($btns as $btn) {
          echo echo_link($btn['link'], 'btn');
        } ?>
        </div>
      <?php endif; ?>
    </div>
    <div class="col-lg-6">
      <?php if ($image) : ?>
      <div class="img-wrap-shadow <?= $height; ?>">
        <div class="img-wrap"><?= echo_image($image, 'medium_large'); ?></div>
      </div>
    <?php elseif ($embed) : ?>
      <div class="embed-shadow">
        <div class="embed-responsive embed-responsive-16by9"><?= $embed; ?></div>
      </div>
    <?php endif; ?>
    </div>
  </div>

</div>
<?php endif; ?>
