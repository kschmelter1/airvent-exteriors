<?php
/**
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

 // Load values and assigning defaults.
$diagram = get_field('diagram'); // id of diagram post

// Create class attribute allowing for custom "className" and "align" values.
$className = 'container-fluid wide block block-diagram';

if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

// Create id attribute allowing for custom "anchor" value.
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

if ($diagram) :
  $image = get_field('image', $diagram);
  $parts = get_field('parts', $diagram);
?>
<div class="<?= $className; ?>" <?= ($block['anchor'] ? 'id="'.$block['anchor'].'"' : ''); ?>>

  <div class="diagram">
    <div class="img-wrap">
      <?= echo_image($image); ?>

      <?php if ($parts) : for ($i = 0; $i < count($parts); $i++) :
        $h = $parts[$i]['hotspot'];
        echo '<div class="hotspot part-'.chr(64 + $i + 1).' '.($i === 0 ? "active" : "").'" data-number="'.$i.'" style="top:'.$h['top'].'%;left:'.$h['left'].'%;">'.chr(64 + $i + 1).'</div>';
        endfor; endif;
      ?>

    </div>
    <div class="swiper-container parts">
    <div class="swiper-wrapper parts-wrapper">
      <?php if ($parts) : for ($i = 0; $i < count($parts); $i++) : ?>
        <div class="swiper-slide single-part">
          <div class="single-part-left">
            <div class="single-part-label">Select A Part</div>
            <div class="single-part-box">
              <div class="badge"><?= chr(64 + $i + 1); ?></div>
              <div class="single-part-image"><?= ($parts[$i]['image'] ? echo_image($parts[$i]['image'], 'medium') : '<i class="fal fa-cogs"></i>'); ?></div>
              <div class="single-part-title"><?= $parts[$i]['title']; ?></div>
            </div>
          </div>

          <div class="single-part-right">
            <div class="single-part-label">Features</div>
            <div class="single-part-features"><?= $parts[$i]['features']; ?></div>
          </div>
        </div>
      <?php endfor; endif; ?>
    </div>
      <div class="part-button button-prev">
        <i class="fas fa-arrow-left"></i>
      </div>
      <div class="part-button button-next">
        <i class="fas fa-arrow-right"></i>
      </div>
    </div>
  </div>

</div>
<?php endif; ?>
