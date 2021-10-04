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
$swatch_cat = get_field('swatch_category');

// Create class attribute allowing for custom "className" and "align" values.
$className = 'container-fluid block block-swatches';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Create id attribute allowing for custom "anchor" value.
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

$args = array(
    'post_type' => 'swatch',
    'posts_per_page' => -1,
    'tax_query' => array(
        array(
            'taxonomy' => 'swatch_type',
            'field'    => 'id',
            'terms'    => $swatch_cat
        )
    )
);

$swatches = get_posts($args);

if ($swatches) :
?>
<div class="<?= $className; ?>" <?= ($id ? 'id="'.$id.'"' : ''); ?>>
  <?= ($title ? '<h2 class="block-title">'.$title.'</h2>' : ''); ?>
  <div class="row">
    <?php
      foreach ($swatches as $swatch) :
        $color = "";
        $image = "";
        $type = get_field('type', $swatch->ID);
        if ($type == "color") {
          $color = get_field('color', $swatch->ID);
        } else {
          $image = get_field('image', $swatch->ID);
        }
    ?>
      <div class="col-6 col-lg-4 col-xl-3 block-swatches-single">
        <div class="img-wrap swatch-wrap" <?= ($color ? 'style="background-color:'.$color.'"' : ''); ?>>
          <?= ($image ? echo_image($image, 'medium') : ''); ?>
         </div>
         <div class="content">
         <h3 class="swatch-caption"><?= $swatch->post_title; ?></h3>
         <?= ($image['caption'] ? '<div class="swatch-text">'.$image['caption'].'</div>' : ''); ?>
          </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>
