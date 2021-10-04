<?php
$header = get_field('header');

if (has_post_thumbnail()) {
  $bg_full = get_the_post_thumbnail_url(get_the_ID(),'full');
  $bg_mobile = get_the_post_thumbnail_url(get_the_ID(),'large');
} elseif (get_field('default_header','options')) {
  $bg = get_field('default_header','options');
  $bg_full = $bg['url'];
  $bg_mobile = $bg['sizes']['medium_large'];
}

if ($bg_full || $bg_mobile) : ?>
  <style>
    @media only screen and (min-width:1200px) {
      .block-page-title .bg {
        background-image: url('<?= $bg_full; ?>');
      }
    }
    @media only screen and (max-width:1199px) {
      .block-page-title .bg {
        background-image: url('<?= $bg_mobile; ?>');
      }
    }
  </style>
<?php endif; ?>
<?php
  $parents = get_post_ancestors($post);
  $id = get_the_ID();
  $servicePages = array(251, 278);
  $subtext = '';
  if ($header['subtext']) {
    $subtext = $header['subtext'];
  } elseif ($parents && !in_array(290, $parents)) { // add a note about parent being in servicePages array
    $subtext = 'We look forward to assisting you with your '.get_the_title().' project.';
    $btn = '<a href="/contact" class="btn btn-light">Contact Us</a>';
  } elseif (in_array($id, $servicePages)) {
    $title = str_replace(' Services', '', get_the_title());
    $subtext = 'We look forward to assisting you with your '.$title.' project.';
    $btn = '<a href="/contact" class="btn btn-light">Contact Us</a>';
  }
 ?>
<div class="block-page-title <?= (is_single() ? 'blog' : ''); ?>">
  <div class="bg"></div>
  <h1><?= ($header['title'] ? $header['title'] : get_the_title()); ?></h1>
  <?= ($subtext ? '<p>'.$subtext.'</p>' : ''); ?>
  <?php if ($header['buttons']) : ?>
    <div class="block-buttons">
      <?php foreach ($header['buttons'] as $btn) {
        echo echo_link($btn['button'], 'btn btn-light');
      } ?>
    </div>
  <?php elseif ($btn) : ?>
    <div class="block-buttons">
      <?= $btn; ?>
    </div>
  <?php endif; ?>
</div>
