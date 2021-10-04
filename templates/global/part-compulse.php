<?php
    $theme = wp_get_theme(get_template());
    $author = $theme->get('Author');
    $uri = $theme->get('AuthorURI');
?>
<div class="copyright">
  <span>&copy; <?php echo date('Y'); ?> <strong><?php echo get_bloginfo('sitename');?></strong>.</span>
  <span class="divider"></span>
  <span class="credit">Designed by <a href="<?= $uri; ?>" target="_blank"><?= $author; ?></a>.</span>
</div>
