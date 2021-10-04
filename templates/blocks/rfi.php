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
$form = get_field('form');

// Create class attribute allowing for custom "className" and "align" values.
$className = 'container-fluid wide block block-rfi';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}


// Create id attribute allowing for custom "anchor" value.
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

if ($form) :
?>
<div class="<?= $className; ?>" <?= ($block['anchor'] ? 'id="'.$block['anchor'].'"' : ''); ?>>
  <?php if ($title) {
    echo ($text ? '<h2 class="block-rfi-title">'.$title.'</h2>' : '<h2 class="block-rfi-title text-center">'.$title.'</h2>');
  } ?>
  <div class="row justify-content-center">
    <?php if ($text) : ?>
      <div class="col-lg-5">
        <div class="block-text">
          <?= $text; ?>
        </div>
      </div>
    <?php endif; ?>
    <div class="col-lg-7">
      <?= do_shortcode($form); ?>
    </div>
  </div>
</div>
<?php endif; ?>
