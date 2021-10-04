<?php
/*
 * Load the theme styles within Gutenberg.
 */
function compulse_add_gutenberg_assets() {
	wp_enqueue_style( 'compulse-gutenberg', get_stylesheet_directory_uri(). '/includes/gutenberg-editor-style.css' , false );
}
add_action( 'enqueue_block_editor_assets', 'compulse_add_gutenberg_assets' );

add_action(
    'after_setup_theme',
    function() {
        add_theme_support( 'html5', [ 'script', 'style' ] );
    }
);


/*
 * Loads jQuery from Google CDN
*/
function use_jquery_from_google () {
	if (is_admin()) {
		return;
	}

	global $wp_scripts;
	if (isset($wp_scripts->registered['jquery']->ver)) {
		$ver = $wp_scripts->registered['jquery']->ver;
                $ver = str_replace("-wp", "", $ver);
	} else {
		$ver = '1.12.4';
	}

	wp_deregister_script('jquery');
	wp_register_script('jquery', "//ajax.googleapis.com/ajax/libs/jquery/$ver/jquery.min.js", false, $ver);
}
add_action('init', 'use_jquery_from_google');

/*
 * Loads main css and js
*/
function compulse_enqueue_scripts() {
	$style_path = get_stylesheet_directory_uri();

	wp_enqueue_style('compulse' , $style_path . '/style.css');

	wp_enqueue_script('vendor', $style_path . '/js/vendor.js', array('jquery'), '', true);
	wp_enqueue_script('app', $style_path . '/js/app.js', array('jquery'), '', true);
}
add_action('wp_enqueue_scripts', 'compulse_enqueue_scripts');

/*
 * Loads swiper when called
*/
function compulse_swiper_enqueue_scripts() {
	wp_enqueue_style( 'Swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css' );
	wp_enqueue_script( 'Swiper', 'https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js', null, null, true );
}

/*
 * Loads cocoen when called
*/
function compulse_acf_enqueue_cocoen() {
	//wp_enqueue_script( 'Cocoen', 'https://cdn.jsdelivr.net/npm/cocoen@2.0.5/dist/js/cocoen.min.js', array('jquery'), null, true );
	wp_enqueue_style( 'Cocoen', get_stylesheet_directory_uri() . '/js/cocoen/cocoen.min.css' );
	wp_enqueue_script( 'Cocoen', get_stylesheet_directory_uri() . '/js/cocoen/cocoen.min.js' , null, null, true );
	//wp_enqueue_script( 'Cocoen', get_stylesheet_directory_uri() . '/js/cocoen/cocoen-jquery.min.js' , array('jquery'), null, true );
}

/*
 * Loads masonry gallery when called
*/
function compulse_gallery_enqueue_scripts() {
	wp_enqueue_script( 'imagesLoaded', 'https://unpkg.com/imagesloaded@4/imagesloaded.pkgd.min.js', null, null, true );
  wp_enqueue_script( 'Masonry', 'https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js', null, null, true );
	wp_enqueue_style('lightgallery', 'https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.11/css/lightgallery.css');
	wp_enqueue_script('lightgalleryjs', 'https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.11/js/lightgallery.min.js', array('jquery'), null, true );
	wp_enqueue_script( 'GalleryJS', get_template_directory_uri() . '/js/parts/gallery.bundle.js', array('jquery'), null, true );
}

/*
 * Loads promo-slider block scripts
*/
function acf_promoslider_scripts() {
	compulse_swiper_enqueue_scripts();
	wp_enqueue_script( 'PromoSlider', get_template_directory_uri() . '/js/parts/promo-slider.bundle.js', array('jquery'), null, true );
}

/*
 * Loads diagram block scripts
*/
function acf_diagram_scripts() {
	compulse_swiper_enqueue_scripts();
	wp_enqueue_script( 'Diagram', get_template_directory_uri() . '/js/parts/diagram.bundle.js', array('jquery'), null, true );
}

/*
 * Loads hero block scripts
*/
function acf_hero_scripts() {
	wp_enqueue_script( 'Hero', get_template_directory_uri() . '/js/parts/hero.bundle.js', array('jquery'), null, true );
}
