<?php
$ppp = get_option( 'posts_per_page' );;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

/*
  query_posts(array(
    'post_type'      => 'post', // You can add a custom post type if you like
    'paged'          => $paged,
    'posts_per_page' => $ppp
  ));
*/
if (have_posts()) :
  if (is_archive()) {
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
    <?php endif; // if bg?>
    <div class="block-page-title">
      <div class="bg"></div>
      <h1><?= get_the_archive_title(); ?></h1>
    </div>
  <?php } else {

$first = true;

while ( have_posts() ) : the_post();
    if ($first) : $first = false; ?>
      <?php
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
      <?php endif; // if bg?>

      <div class="block-page-title blog">
        <div class="bg"></div>
        <div class="wrapper">
        <h1><?= get_the_title(); ?></h1>
        <div class="blog-meta">
          <div class="date"><?php echo get_the_date(); ?></div>
          <div>|</div>
          <div class="category">
            <?php $cat = get_the_category(); echo $cat[0]->name; ?>
          </div>
        </div>
        <?php if (has_excerpt()) {?><div class="text"><?php the_excerpt(); ?></div><?php }
        else {
          $blocks = parse_blocks(get_the_content());
          if ($blocks) {
            for ($i = 0; $i < count($blocks); $i++) {
              //var_dump($blocks[$i]);

              if ($blocks[$i]['blockName'] == "core/paragraph" || $blocks[$i]['blockName'] == "tadv/classic-paragraph")
              { $exc = apply_filters( 'the_content', wp_trim_words( strip_tags( $blocks[$i]['innerHTML'] ), 83 ) );
                echo '<div class="text">'.$exc.'</div>'; break;}
            }
          }
        }
        ?>
          <div class="block-buttons">
            <a href="<?php the_permalink(); ?>" class="btn btn-accent">Read Article</a>
          </div>
        </div>
      </div>

    <?php endif; break; endwhile; }?>
      <div class="container-fluid blog-page">
        <div class="row">
        <div class="col-md">
      <div class="block block-blog-posts">
      <?php while ( have_posts() ) : the_post(); ?>
      <div class="row single-blog">
        <div class="col-md-6">
          <div class="img-wrap-shadow">
            <a href="<?php the_permalink(); ?>" title="Read more" class="img-wrap">
              <?php echo get_the_post_thumbnail( $post->ID, 'large', array( 'class' => 'img-fluid' ) ); ?>
            </a>
          </div>
        </div>
        <div class="col-md-6">
          <a href="<?php the_permalink(); ?>" class="title"><?php the_title(); ?></a>
          <div class="blog-meta">
            <div class="date"><?php echo get_the_date(); ?></div>
            <div>|</div>
            <div class="category">
              <?php $cat = get_the_category(); echo $cat[0]->name; ?>
            </div>
          </div>
          <?php if (has_excerpt()) {?><div class="text"><?php the_excerpt(); ?></div><?php }
                else {
                  $blocks = parse_blocks(get_the_content());
                  if ($blocks) {
                    for ($i = 0; $i < count($blocks); $i++) {
                      //var_dump($blocks[$i]);

                      if ($blocks[$i]['blockName'] == "core/paragraph" || $blocks[$i]['blockName'] == "tadv/classic-paragraph")
                      { $exc = apply_filters( 'the_content', wp_trim_words( strip_tags( $blocks[$i]['innerHTML'] ), 45 ) );
                        echo '<div class="text">'.$exc.'</div>'; break;}
                    }
                  }
                }
           ?>
          <a href="<?php the_permalink(); ?>" class="btn btn-accent">Read Article</a>
        </div>
      </div>
    <?php endwhile; // end second loop?>
</div>
<?php endif; // if posts?>
</div>

<?php if ( is_active_sidebar( 'sidebar-blog' ) ) { ?>
  <div class="col-md-3">
    <div class="sidebar sidebar-blog">
      <?php dynamic_sidebar('sidebar-blog'); ?>
    </div>
  </div>
<?php } ?>
</div>
<nav id="nav-posts" class="nav justify-content-center">
  <?php the_posts_pagination(array(
          'mid_size'  => 1,
          'prev_text' => __( 'Back', 'textdomain' ),
          'next_text' => __( 'Next', 'textdomain' ),
      )); ?>
</nav>
</div><?php // end blog-page ?>
<?php wp_reset_postdata(); ?>
