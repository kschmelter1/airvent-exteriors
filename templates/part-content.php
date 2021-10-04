<?php

$blocks = parse_blocks(get_the_content());
if (!$blocks || $blocks[0]['blockName'] !== 'acf/hero') {
  get_template_part('templates/global/part','title');
}
if (is_single()) { ?>
  <div class="block blog-meta">
    <div class="date"><?php echo get_the_date(); ?></div>
    <div>|</div>
    <div class="category">
      <?php $cat = get_the_category(); echo $cat[0]->name; ?>
    </div>
  </div>
<?php }
if ($blocks) {
  for ($i = 0; $i < count($blocks); $i++) {
    if (substr($blocks[$i]['blockName'], 0, 3) === 'acf') {
        echo render_block( $blocks[$i] );
    } elseif ($blocks[$i]['blockName'] == "core/columns") {
      echo '<div class="container-fluid guten-block '.$blocks[$i]['blockName'].'">';
      echo apply_filters( 'the_content', render_block( $blocks[$i] ) );
      echo '</div>';
    }
      else {
      if ($blocks[$i]['blockName']) { //Stops null blocks from outputting
      echo '<div class="container-fluid guten-block '.$blocks[$i]['blockName'].'">';
      echo '<div class="row justify-content-center"><div class="col-lg-7">';
      echo apply_filters( 'the_content', render_block( $blocks[$i] ) );
      echo '</div></div></div>';
      }
    }
  }
} else {
  the_content();
}
?>
