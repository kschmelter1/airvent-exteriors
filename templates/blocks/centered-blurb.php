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
$text = get_field('text');
$btns = get_field('buttons');

// Create class attribute allowing for custom "className" and "align" values.
$className = 'container-fluid block block-center-blurb';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}


// Create id attribute allowing for custom "anchor" value.
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

if ($title || $text) :
?>
<div class="<?= $className; ?>" <?= ($block['anchor'] ? 'id="'.$block['anchor'].'"' : ''); ?>>
  <?= ($title ? '<h2 class="block-title">'.$title.'</h2>' : ''); ?>
  <?= ($text ? '<div class="block-text text-center">'.$text.'</div>' : ''); ?>
  <?php if ($btns) : ?>
    <div class="block-buttons">
      <?php foreach ($btns as $btn) {
        echo echo_link($btn['button'], 'btn btn-accent');
      } ?>
    </div>
  <?php endif; ?>
</div>
<?php endif; ?>
