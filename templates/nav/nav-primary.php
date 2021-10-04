<nav class="navbar navbar-expand-xl navbar-primary">
  <div class="collapse navbar-collapse" id="primary-navbar">
    <i class="navbar-close far fa-times" id="navbar-close"></i>
  <?php

    wp_nav_menu([
      'theme_location'    => 'primary',
      'depth'             => 3,
      'container'         => '',
      'container_class'   => '',
      'container_id'      => '',
      'menu_class'        => 'navbar-nav',
      'echo'				=> true,
      'walker'            => new bs4Navwalker()
    ]);

  ?>
  <div class="d-xl-none mobile-search"><?php get_template_part('templates/global/part','search'); ?></div>
  </div>
</nav>
