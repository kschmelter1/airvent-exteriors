<?php
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );
add_theme_support( 'responsive-embeds' );

//Advanced Custom Fields Options page
if( function_exists('acf_add_options_page') ) {

	$option_page = acf_add_options_page(array(
		'page_title' => 'Site Options',
		'menu_slug' => 'options',
		'position' => '2.5',
		'post_id' => 'options',
		'icon_url' => 'dashicons-smiley'
	));

}

/*** Helper Functions ***/
function clean_phone($num, $full = false) {
	$clean = 'tel:'.preg_replace('/\D+/', '', $num);
	if ($full) {
		$output = '<a href="'.$clean.'" class="phone">'.$num.'</a>';
		return $output;
	} else {
		return $clean;
	}
}

function echo_image($img, $size = 'full', $class = "img-fluid") {
	if (is_array($img)) { //ACF image array
		$src = acf_image($img['id'],$size);
		$alt = $img['alt'];
	} else { //Assuming $img is an ID
		$src = acf_image($img,$size);
		$alt = get_post_meta($img, '_wp_attachment_image_alt', TRUE);
	}

	return '<img class="'.$class.'" alt="'.$alt.'" '.$src.'>';
}

function echo_link($link, $class, $title = null) {
	if ($title) {
		$link_title = html_entity_decode($title);
	} else {
		$link_title = html_entity_decode($link['title']);
	}
	return '<a href="'.$link['url'].'" '.a_target($link).' class="'.$class.'">'.$link_title.'</a>';
}

function a_target($link) {
	if ($link['target']) {return 'target="_blank"';} else {return;}
}

function make_id($str) {
		$str = strip_tags( $str );
		return str_replace(' ', '-', strtolower($str));
		// return: convert-spaces-to-dash-and-lowercase-with-php
}

/**
 * Responsive Image Helper Function
 *
 * @param string $image_id the id of the image (from ACF or similar)
 * @param string $image_size the size of the thumbnail image or custom image size
 * @param string $max_width the max width this image will be shown to build the sizes attribute
 */

function acf_image($image_id,$image_size){
	switch ($image_size) {
		case 'thumbnail': $max_width = '150px'; break;
		case 'medium': $max_width = '300px'; break;
		case 'medium_large': $max_width = '768px'; break;
		case 'large': $max_width = '1024px'; break;
		default: $max_width = '2048px'; break;
	}

	// check the image ID is not blank
	if($image_id != '') {

		// set the default src image size
		$image_src = wp_get_attachment_image_url( $image_id, $image_size );
		$output = 'src="'.$image_src.'"';
		// set the srcset with various image sizes
		$image_srcset = wp_get_attachment_image_srcset( $image_id, $image_size );
		if ($image_scrset) {
			$output .= ' srcset="'.$image_srcset.'" sizes="(max-width: '.$max_width.') 100vw, '.$max_width.'"';
		}
		// generate the markup for the responsive image
		//return 'src="'.$image_src.'" srcset="'.$image_srcset.'" sizes="(max-width: '.$max_width.') 100vw, '.$max_width.'"';
		return $output;
	}
}

/* Automatically set the image Title, Alt-Text, Caption & Description upon upload
--------------------------------------------------------------------------------------*/
add_action( 'add_attachment', 'my_set_image_meta_upon_image_upload' );
function my_set_image_meta_upon_image_upload( $post_ID ) {

	// Check if uploaded file is an image, else do nothing

	if ( wp_attachment_is_image( $post_ID ) ) {

		$my_image_title = get_post( $post_ID )->post_title;

		// Sanitize the title:  remove hyphens, underscores & extra spaces:
		$my_image_title = preg_replace( '%\s*[-_\s]+\s*%', ' ',  $my_image_title );

		// Sanitize the title:  capitalize first letter of every word (other letters lower case):
		$my_image_title = ucwords( strtolower( $my_image_title ) );

		// Create an array with the image meta (Title, Caption, Description) to be updated
		// Note:  comment out the Excerpt/Caption or Content/Description lines if not needed
		$my_image_meta = array(
			'ID'		=> $post_ID,			// Specify the image (ID) to be updated
			'post_title'	=> $my_image_title,		// Set image Title to sanitized title
			'post_excerpt'	=> '',		// Set image Caption (Excerpt)
			'post_content'	=> '',		// Set image Description (Content)
		);

		// Set the image Alt-Text
		update_post_meta( $post_ID, '_wp_attachment_image_alt', $my_image_title );

		// Set the image meta (e.g. Title, Excerpt, Content)
		wp_update_post( $my_image_meta );

	}
}

function meks_time_ago($date = null) {
	if ($date === null) {
	return human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ).' '.__( 'ago' );}
	else {
		return human_time_diff( date('U', $date), current_time( 'timestamp' ) ).' '.__( 'ago' );
	}
}
