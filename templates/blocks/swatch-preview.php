<?php
/**
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

 // Load values and assigning defaults.

$title = get_field('title');
//$swatches = get_field('swatches');
$btn = get_field('button');

$args = array(
  'post_type'      => 'swatch',
  'orderby'   => 'rand',
  'posts_per_page' => 4
);
$swatches = get_posts($args);

// Create class attribute allowing for custom "className" and "align" values.
$className = 'container-fluid wide block block-swatch-preview';

if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Create id attribute allowing for custom "anchor" value.
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

if ($swatches) :
?>
<div class="<?= $className; ?>" <?= ($block['anchor'] ? 'id="'.$block['anchor'].'"' : ''); ?>>
  <?= ($title ? '<h2 class="block-title">'.$title.'</h2>' : ''); ?>
  <div class="row justify-content-center">
    <?php foreach ($swatches as $swatch) : $color = get_field('color', $swatch->ID); ?>
      <div class="col-md-3 swatch">
        <div class="swatch-wrap" <?= ($color ? 'style="background-color:'.$color.';"' : ''); ?>>
          <?php if (get_field('type', $swatch->ID) == "image") {
            $image = get_field('image', $swatch->ID);
            echo ($image ? echo_image($image, 'medium') : '');
          } ?>
        </div>
        <div class="swatch-caption"><?= get_the_title($swatch->ID); ?></div>
      </div>
    <?php endforeach; ?>
  </div>
  <div class="btn-wrapper text-center">
    <?= ($btn ? echo_link($btn, 'btn btn-accent') : ''); ?>
  </div>

</div>
<?php endif; ?>
