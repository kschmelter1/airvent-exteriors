<?php $seo = get_field('locality_footer_text','options'); if ($seo) : ?>
  <div class="h3"><?= get_bloginfo('sitename'); ?></div>
  <div class="seo"><?= $seo; ?></div>
<?php endif; ?>
