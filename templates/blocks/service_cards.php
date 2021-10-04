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
$cards = get_field('cards');
$layout = get_field('layout');

// Create class attribute allowing for custom "className" and "align" values.
$className = 'container-fluid block block-service-cards';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}


// Create id attribute allowing for custom "anchor" value.
$id = 'service-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

if ($cards) :

  $col = 'col-md-6 col-xl-4';
  if ($layout === "2") {
    $col = 'col-md-6';
  }
?>
<div class="<?= $className; ?>" id="<?= $id; ?>">
  <?= ($title ? '<h2 class="block-title">'.$title.'</h2>' : ''); ?>
  <div class="row justify-content-center">
    <?php foreach ($cards as $card) : ?>
      <div class="<?= $col; ?>">
        <div class="single-card <?= ($card['image'] ? '' : 'no-img'); ?>">
          <?php if ($card['image']) : ?>
          <div class="img-wrap">
            <?= echo_image($card['image'], 'medium_large'); ?>
          </div>
          <?php endif; ?>
          <div class="single-card-content">
            <?php if ($card['title']) : ?>
              <div class="title">
                <?= ($card['link'] && !$card['link']['title'] ? echo_link($card['link'], 'title-link', $card['title']) : $card['title']); ?>
              </div>
            <?php endif; ?>
            <div class="single-card-content-inner <?= (!$card['text'] && !$card['image'] ? 'justify-content-center' : '');?>">
              <?= ($card['text'] ? '<div class="text">'.$card['text'].'</div>' : ''); ?>
              <?= ($card['link'] && $card['link']['title'] ? echo_link($card['link'], 'link') : ''); ?>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>
</div>
<?php endif; ?>
