<nav class="navbar-footer">
  <?php

    wp_nav_menu([
      'theme_location'    => 'footer',
      'depth'             => 1,
      'container'         => '',
      'container_class'   => '',
      'container_id'      => '',
      'menu_class'        => 'nav',
      'echo'				=> true,
      'walker'            => new bs4Navwalker()
    ]);

  ?>
</nav>
