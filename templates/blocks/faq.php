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
$image = get_field('image');
$list = get_field('questions');
$height = get_field('image_height');
$layout = get_field('layout');

// Create class attribute allowing for custom "className" and "align" values.
$className = 'container-fluid block block-faq block-faq-'.$layout;

if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}


// Create id attribute allowing for custom "anchor" value.
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

if ($text || $list) :
?>
<div class="<?= $className; ?>" <?= ($block['anchor'] ? 'id="'.$block['anchor'].'"' : ''); ?> itemscope itemtype="https://schema.org/FAQPage">
  <div class="row">
    <div class="col-lg-7 text-col">
      <?php $h = 'h2'; ?>
      <?= ($title ? '<'.$h.' class="block-intro-content-title">'.$title.'</'.$h.'>' : ''); ?>
      <?= ($text ? '<div class="block-text">'.$text.'</div>' : ''); ?>
      <?php if ($list) : ?>
        <div class="accordion" id="accordion-<?= $block['id']; ?>">
          <?php for ($i = 0; $i < count($list); $i++) : ?>
            <div class="faq" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
              <h3 class="faq-question btn btn-link <?= ($i > 0 ? 'collapsed' : ''); ?>"
                  id="heading-<?= $i; ?>" type="button" data-toggle="collapse" data-target="#collapse-<?= $i; ?>"
                  aria-expanded="<?= ($i > 0 ? 'false' : 'true'); ?>" aria-controls="collapse-<?= $i; ?>"
                  itemprop="name"><?= $list[$i]['question']; ?> </h3>
              <div id="collapse-<?= $i; ?>" class="faq-answer collapse <?= ($i > 0 ? '' : 'show'); ?>" aria-labelledby="heading-<?= $i; ?>" data-parent="#accordion-<?= $block['id']; ?>" itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                <div itemprop="text"><?= $list[$i]['answer']; ?></div>
              </div>
            </div>
          <?php endfor; ?>
        </div>
      <?php endif; ?>
      <?php if ($btns) : ?>
        <div class="btns">
        <?php foreach ($btns as $btn) {
          echo echo_link($btn['link'], 'btn btn-accent');
        } ?>
        </div>
      <?php endif; ?>
    </div>
    <?php if ($image) : ?>
    <div class="col-lg-5">
      <div class="img-wrap-shadow">
          <div class="img-wrap <?= $height; ?>"><?= echo_image($image, 'medium_large'); ?></div>
      </div>
    </div>
    <?php endif; ?>
  </div>

</div>
<?php endif; ?>
