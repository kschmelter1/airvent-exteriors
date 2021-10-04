<?php
get_header();
//get_template_part('templates/global/part','title');
?>

<?php
  $bg = get_field('default_header','options');
  $bg_full = $bg['url'];
  $bg_mobile = $bg['sizes']['medium_large'];

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

<div class="block-page-title">
  <div class="bg"></div>
  <h1>Search Results</h1>
</div>

<?php if ( have_posts() ) : ?>
                <div class="container-fluid wide block">
                        <h2 class="block-title"><?php printf( __( 'Results for: %s', 'shape' ), '<span>' . get_search_query() . '</span>' ); ?></h2>

                        <div class="text">
                          <ul class="results-list">
                          <?php while ( have_posts() ) : the_post(); ?>
                              <li><a href="<?php the_permalink(); ?>" title="Read more"><?php the_title(); ?></a></li>
                          <?php endwhile; ?>
                          </ul>
                          <?php wp_reset_postdata(); ?>
                        </div>
                </div>

            <?php else : ?>

                <div class="container-fluid wide block">
                        <h2 class="block-title"><?php printf( __( 'No results found for: %s', 'shape' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
                </div>

            <?php endif; ?>

<?php

get_footer();

?>
