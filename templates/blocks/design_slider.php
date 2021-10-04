<?php

/**
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

$title = get_field('title');
$h = get_field('heading');
$cat = get_field('category');
if ($cat) {
  $args = array(
    'post_type'      => 'design_option',
    'posts_per_page' => -1,
    'tax_query' => array(
      array(
        'taxonomy' => 'design_category',
        'field' => 'term_id',
        'terms' => $cat
       )
    )
  );
  $slides = get_posts($args);
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'container-fluid block block-design-slider';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}


// Create id attribute allowing for custom "anchor" value.
$id = 'service-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}


if ($slides) :
?>
<div class="<?= $className; ?>" id="<?= $block['anchor']; ?>">
  <?php if ($title) : ?>
    <?php if ($h === "h3") {
      echo '<h3 class="block-intro-content-title">'.$title.'</h3>';
    } else {
      echo '<h2 class="block-title">'.$title.'</h2>';
    } ?>
  <?php endif; ?>
  <div class="design-slider">
    <div class="swiper-container">

        <div class="swiper-wrapper">
            <?php foreach ($slides as $slide) : ?>
              <div class="swiper-slide">
                <div class="content">
                  <div class="single-card">
                    <div class="img-wrap">
                      <?= get_the_post_thumbnail($slide->ID,'medium'); ?>
                    </div>
                    <div class="single-card-content">
                        <div class="title">
                          <?= $slide->post_title; ?>
                        </div>
                      <div class="single-card-content-inner">

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
        </div>

    </div>


    <?php if (count($slides) > 1) : ?>
      <div class="swiper-button-prev"><i class="fas fa-long-arrow-left"></i></div>
      <div class="swiper-button-next"><i class="fas fa-long-arrow-right"></i></div>
    <?php endif; ?>
  </div>
</div>
<?php endif; ?>
