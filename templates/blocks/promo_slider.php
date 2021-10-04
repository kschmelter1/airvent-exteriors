<?php

/**
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create class attribute allowing for custom "className" and "align" values.
$className = 'block block-promo-slider';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}


if (get_field('promotions')) {
  $cat = get_field('category');
  $args = array(
    'post_type'      => 'promotion',
    'posts_per_page' => -1,
    'cat' => $cat
  );
  $promos = get_posts($args);
  $slides = array();
  foreach ($promos as $promo) {
    $singlePromo = array(
      'title' => get_field('title', $promo->ID),
      'text' => get_field('text', $promo->ID),
      'image' => get_field('image', $promo->ID),
      'buttons' => get_field('buttons', $promo->ID)
    );
    array_push($slides, $singlePromo);
  }
} else {
  $slides = get_field('slides');
}

if ($slides) :
?>
<div class="<?= $className; ?>">
  <div class="swiper-container">

      <div class="swiper-wrapper">
          <?php foreach ($slides as $slide) : ?>
            <div class="swiper-slide">
              <?= echo_image($slide['image'], 'large'); ?>
              <div class="content">
                <?= ($slide['title'] ? '<div class="title">'.$slide['title'].'</div>' : ''); ?>
                <?= ($slide['text'] ? '<div class="text">'.$slide['text'].'</div>' : ''); ?>
                <?php if ($slide['buttons']) { ?>
                  <div class="buttons">
                  <?php foreach ($slide['buttons'] as $btn) {
                    echo echo_link($btn['link'], 'btn');
                  } ?>
                  </div>
                <?php } ?>
              </div>
            </div>
          <?php endforeach; ?>
      </div>

      <?php if (count($slides) > 1) : ?>
        <div class="swiper-button-prev"><i class="fas fa-long-arrow-left"></i></div>
        <div class="swiper-button-next"><i class="fas fa-long-arrow-right"></i></div>
      <?php endif; ?>

  </div>
</div>
<?php endif; ?>
