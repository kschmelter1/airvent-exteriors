<?php

/**
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// Create class attribute allowing for custom "className" and "align" values.
$className = 'block block-testimonial-slider';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}


$title = get_field('title');
$image = get_field('image');
$code = get_field('code');

if ($code) :
?>
<div class="<?= $className; ?>">
  <?= echo_image($image, 'large'); ?>
  <div class="container-fluid">
    <?= ($title ? '<h2 class="title">'.$title.'</h2>' : ''); ?>
    <!-- ************* -->
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php
                $collection_id = $code;// 1025;
                //need to be sure this number is the same number in the code.
                $reviews_plugin = new WP_Business_Reviews_Bundle\Includes\Core\Core();
                $collection_deserializer = new WP_Business_Reviews_Bundle\Includes\Collection_Deserializer(new WP_Query());
                $collection = $collection_deserializer->get_collection($collection_id);
                $review_data = $reviews_plugin->get_reviews($collection);
                $reviews = $review_data['reviews'];
                foreach ($reviews as $review) : ?>
                    <?php
                    $review_picture = $review->author_avatar;
                    $review_rating = $review->rating;
                    $review_text = $review->text;
                    $review_author = $review->author_name;
                    $review_rating = $review->rating;
                    $review_provider = $review->provider;
                    $review_date = $review->time;
                    if ($review_text) :
                    ?>
                    <div class="swiper-slide">
                        <div class="testimonial-single">
                          <div class="author-photo"><div><?= $review_author[0]; ?></div></div>
                          <div class="content">
                          <?php echo '<p class="h4 author">' . $review_author . '</p>'; ?>
                          <?php echo '<p class="date">'.meks_time_ago($review_date).'</p>'; ?>
                            <div class="stars">
                                <?php $i = $review_rating;
                                for ($c = 0; $i > $c; $c++) {
                                    echo '<i class="fas fa-star"></i>';
                                }
                                ?>
                            </div>
                            <?php echo '<p class="text">' . wp_trim_words( $review_text, 30 ) . '</p>'; ?><br />
                          </div>
                        </div>
                    </div>
                <?php endif; endforeach; ?>
            </div>
        </div>
        <div class="swiper-navigation">
            <div class="swiper-button-prev"><i class="fas fa-long-arrow-left"></i></div>
            <div class="swiper-button-next"><i class="fas fa-long-arrow-right"></i></div>
        </div>
        <div class="text-center">
          <a href="https://app.listen360.com/organizations/891271308891919423/reviews/public" class="btn btn-accent" style="position:relative; z-index: 100;" target="_blank">View More Reviews</a>
        </div>
  </div>

</div>
<?php endif; ?>
