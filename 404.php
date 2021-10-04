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
  <h1>404 Page Not Found</h1>
</div>


<?php

get_footer();

?>
