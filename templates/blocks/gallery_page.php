<?php
/**
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

 // Load values and assigning defaults.
$args = array(
  'post_type'      => 'airvent_gallery',
  'posts_per_page' => -1
);
$galleries = get_posts($args);
if ($galleries) :

// Create class attribute allowing for custom "className" and "align" values.
$className = 'container-fluid block block-gallery-page';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}

?>
<div class="<?= $className; ?>">

  <div class="row">
    <div class="col-xl-8">
      <div class="masonry">
        <?php foreach ($galleries as $gal) : ?>
          <div class="masonry-wrapper" id="gallery-<?= $gal->ID; ?>">
          <h2 class="masonry-title"><i class="fal fa-angle-down"></i> <?= $gal->post_title; ?></h2>
          <div class="row masonry-gallery grid">
            <div class="col-6 col-md-4 grid-sizer"></div>
            <?php
              $imgs = get_field('gallery',$gal->ID);
              foreach ($imgs as $img) : ?>
                <div class="col-6 col-md-4 img-wrap grid-item" data-src="<?php echo $img['sizes']['large'];?>">
                  <?= echo_image($img,'medium'); ?>
                </div>
              <?php endforeach; ?>
          </div>
        </div>
        <?php endforeach; ?>
      </div>
    </div>
    <div class="col-xl-4">
      <div class="gallery-categories">
      <div class="gallery-categories-title">Categories</div>
      <div class="gallery-categories-options">
        <span data-check="true">Select All</span><span data-check="false">Deselect All</span>
      </div>
      <ul class="gallery-categories-list">
        <?php foreach ($galleries as $gal) {
          echo '<li><input type="checkbox" id="'.$gal->post_name.'" value="#gallery-'.$gal->ID.'"><label for="'.$gal->post_name.'">'.$gal->post_title.'</label></li>';
        } ?>
      </ul>
    </div>
    </div>
  </div>

</div>
<?php endif; ?>
