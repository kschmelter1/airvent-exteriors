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
$cols = get_field('columns');

if ($cols) :

 // Create class attribute allowing for custom "className" and "align" values.
 $className = 'block-hero';
 if (count($cols) > 1) {
   $className .= ' two-col';
   $id = 'id="hero-cols"';
 }
 if( !empty($block['className']) ) {
     $className .= ' ' . $block['className'];
 }

 ?>

<div class="<?= $className; ?>" <?= $id; ?>>
  <?= ($title ? '<h1 class="block-hero-title"><span>'.$title.'</span></h1>' : ''); ?>
  <div class="block-hero-cols">
  <?php for ($i = 0; $i < count($cols); $i++) : ?>
    <div class="<?= 'panel-'.$i; ?>" data-number="<?= $i; ?>">
      <?= ($cols[$i]['image'] ? echo_image($cols[$i]['image'], 'large') : ''); ?>
      <?= ($cols[$i]['button'] ? echo_link($cols[$i]['button'], 'btn') : ''); ?>
    </div>
  <?php endfor; ?>
  </div>
</div>
<?php endif; ?>
