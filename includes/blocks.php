<?php
add_filter( 'block_categories', function( $categories, $post ) {
    return array_merge(
        $categories,
        array(
            array(
                'slug'  => 'compulse',
                'title' => 'Compulse Blocks',
            ),
        )
    );
}, 10, 2 );


/*** Blocks ***/
function register_acf_block_types() {

  acf_register_block_type(array(
      'name'              => 'promo-slider',
      'title'             => __('Promo Slider'),
      'description'       => __('A custom slider block.'),
      'render_template'   => 'templates/blocks/promo_slider.php',
      'category'          => 'compulse',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'slider', 'promotions' ),
      'mode'              => 'edit',
      'supports' => array(
        'mode' => false, // Turns off preview mode permanently
        'multiple' => true, // Does not allow multiple of this block on one page
        'anchor' => false // If true, allows custom ID
      ),
      'enqueue_assets' => 'acf_promoslider_scripts'
  ));

  acf_register_block_type(array(
      'name'              => 'gallery-page',
      'title'             => __('Gallery Page'),
      'description'       => __('Display sortable galleries.'),
      'render_template'   => 'templates/blocks/gallery_page.php',
      'category'          => 'compulse',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'gallery', 'images' ),
      'mode'              => 'edit',
      'supports' => array(
        'mode' => false, // Turns off preview mode permanently
        'multiple' => false, // Does not allow multiple of this block on one page
        'anchor' => false // If true, allows custom ID
      ),
      'enqueue_assets' => 'compulse_gallery_enqueue_scripts'
  ));

  acf_register_block_type(array(
      'name'              => 'swatches',
      'title'             => __('Swatches'),
      'description'       => __('A section for the swatches page.'),
      'render_template'   => 'templates/blocks/swatches.php',
      'category'          => 'compulse',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'image', 'colors', 'fabric' ),
      'mode'              => 'edit',
      'supports' => array(
        'mode' => false, // Turns off preview mode permanently
        'multiple' => true, // Does not allow multiple of this block on one page
        'anchor' => true // If true, allows custom ID
      )
  ));

  acf_register_block_type(array(
      'name'              => 'testimonials-slider',
      'title'             => __('Testimonials Slider'),
      'description'       => __('A custom testimonial block.'),
      'render_template'   => 'templates/blocks/testimonial_slider.php',
      'category'          => 'compulse',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'slider', 'testimonials' ),
      'mode'              => 'edit',
      'supports' => array(
        'mode' => false, // Turns off preview mode permanently
        'multiple' => false, // Does not allow multiple of this block on one page
        'anchor' => false // If true, allows custom ID
      ),
      'enqueue_assets' => 'acf_promoslider_scripts'
  ));

  acf_register_block_type(array(
      'name'              => 'design-slider',
      'title'             => __('Design Options Slider'),
      'description'       => __('Displays design options.'),
      'render_template'   => 'templates/blocks/design_slider.php',
      'category'          => 'compulse',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'slider', 'images' ),
      'mode'              => 'edit',
      'supports' => array(
        'mode' => false, // Turns off preview mode permanently
        'multiple' => true, // Does not allow multiple of this block on one page
        'anchor' => true // If true, allows custom ID
      ),
      'enqueue_assets' => 'acf_promoslider_scripts'
  ));

  acf_register_block_type(array(
      'name'              => 'hero',
      'title'             => __('Hero'),
      'description'       => __('A custom hero block.'),
      'render_template'   => 'templates/blocks/hero.php',
      'category'          => 'compulse',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'hero', 'homepage' ),
      'mode'              => 'edit',
      'supports' => array(
        'mode' => false, // Turns off preview mode permanently
        'multiple' => false, // Does not allow multiple of this block on one page
        'anchor' => false // If true, allows custom ID
      ),
      'enqueue_assets' => 'acf_hero_scripts'
  ));

  acf_register_block_type(array(
      'name'              => 'service_cards',
      'title'             => __('Service Cards'),
      'description'       => __('A custom services block.'),
      'render_template'   => 'templates/blocks/service_cards.php',
      'category'          => 'compulse',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'services', 'homepage' ),
      'mode'              => 'edit',
      'supports' => array(
        'mode' => false, // Turns off preview mode permanently
        'multiple' => true, // Does not allow multiple of this block on one page
        'anchor' => true // If true, allows custom ID
      )
  ));

  acf_register_block_type(array(
      'name'              => 'rfi',
      'title'             => __('RFI Form'),
      'description'       => __(' '),
      'render_template'   => 'templates/blocks/rfi.php',
      'category'          => 'compulse',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'form', 'contact' ),
      'mode'              => 'edit',
      'supports' => array(
        'mode' => false, // Turns off preview mode permanently
        'multiple' => true, // Does not allow multiple of this block on one page
        'anchor' => true // If true, allows custom ID
      )
  ));

  acf_register_block_type(array(
      'name'              => 'center-blurb',
      'title'             => __('Centered Blurb'),
      'description'       => __('A custom services block.'),
      'render_template'   => 'templates/blocks/centered-blurb.php',
      'category'          => 'compulse',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'text', 'section' ),
      'mode'              => 'edit',
      'supports' => array(
        'mode' => false, // Turns off preview mode permanently
        'multiple' => true, // Does not allow multiple of this block on one page
        'anchor' => true // If true, allows custom ID
      )
  ));

  acf_register_block_type(array(
      'name'              => 'intro-content',
      'title'             => __('Intro Content'),
      'description'       => __('Title, text, and image for internal pages.'),
      'render_template'   => 'templates/blocks/intro-content.php',
      'category'          => 'compulse',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'text', 'image', 'header' ),
      'mode'              => 'edit',
      'supports' => array(
        'mode' => false, // Turns off preview mode permanently
        'multiple' => true, // Does not allow multiple of this block on one page
        'anchor' => true // If true, allows custom ID
      )
  ));

  acf_register_block_type(array(
      'name'              => 'faq',
      'title'             => __('FAQ'),
      'description'       => __('Frequently Asked Questions'),
      'render_template'   => 'templates/blocks/faq.php',
      'category'          => 'compulse',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'text', 'faq' ),
      'mode'              => 'edit',
      'supports' => array(
        'mode' => false, // Turns off preview mode permanently
        'multiple' => true, // Does not allow multiple of this block on one page
        'anchor' => true // If true, allows custom ID
      )
  ));

  acf_register_block_type(array(
      'name'              => 'before-after',
      'title'             => __('Before & After with Text'),
      'description'       => __('Title, text, and image for internal pages.'),
      'render_template'   => 'templates/blocks/intro-content.php',
      'category'          => 'compulse',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'text', 'image', 'header', 'slider' ),
      'mode'              => 'edit',
      'supports' => array(
        'mode' => false, // Turns off preview mode permanently
        'multiple' => true, // Does not allow multiple of this block on one page
        'anchor' => true // If true, allows custom ID
      ),
      'enqueue_assets' => 'compulse_acf_enqueue_cocoen'
  ));

  acf_register_block_type(array(
      'name'              => 'cta',
      'title'             => __('Call to Action'),
      'description'       => __('A custom cta block.'),
      'render_template'   => 'templates/blocks/cta.php',
      'category'          => 'compulse',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'cta', 'image' ),
      'mode'              => 'edit',
      'supports' => array(
        'mode' => false, // Turns off preview mode permanently
        'multiple' => true, // Does not allow multiple of this block on one page
        'anchor' => true // If true, allows custom ID
      )
  ));

  acf_register_block_type(array(
      'name'              => 'swatch-preview',
      'title'             => __('Swatch Preview'),
      'description'       => __('Displays 4 swatches'),
      'render_template'   => 'templates/blocks/swatch-preview.php',
      'category'          => 'compulse',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'cta', 'image' ),
      'mode'              => 'edit',
      'supports' => array(
        'mode' => false, // Turns off preview mode permanently
        'multiple' => true, // Does not allow multiple of this block on one page
        'anchor' => true // If true, allows custom ID
      )
  ));

  acf_register_block_type(array(
      'name'              => 'interactive-diagram',
      'title'             => __('Interactive Diagram'),
      'description'       => __('Slider with clickable hotspots'),
      'render_template'   => 'templates/blocks/interactive-diagram.php',
      'category'          => 'compulse',
      'icon'              => 'admin-comments',
      'keywords'          => array( 'slider', 'image' ),
      'mode'              => 'edit',
      'supports' => array(
        'mode' => false, // Turns off preview mode permanently
        'multiple' => true, // Does not allow multiple of this block on one page
        'anchor' => true // If true, allows custom ID
      ),
      'enqueue_assets' => 'acf_diagram_scripts'
  ));

}

// Check if function exists and hook into setup.
if( function_exists('acf_register_block_type') ) {
    add_action('acf/init', 'register_acf_block_types');
}


/* Adds support for editor color palette.
$theme_name = 'theme-name';
add_theme_support( 'editor-color-palette', array(
	array(
		'name'  => __( 'Cyan', $theme_name ),
		'slug'  => 'primary',
		'color'	=> '#CCE7EB',
	),
	array(
		'name'  => __( 'Teal', $theme_name ),
		'slug'  => 'secondary',
		'color' => '#4C7880',
	)
) );*/
