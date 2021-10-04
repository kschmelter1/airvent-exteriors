<nav class="list-unstyled navbar-secondary">
  <?php

    wp_nav_menu([
      'theme_location'    => 'secondary',
      'depth'             => 1,
      'container'         => '',
      'container_class'   => '',
      'container_id'      => '',
      'menu_class'        => 'navbar-nav',
      'echo'				=> true,
      'walker'            => new bs4Navwalker()
    ]);

  ?>
</nav>
