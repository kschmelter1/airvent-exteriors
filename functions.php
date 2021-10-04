<?php
require_once 'includes/client_role.php';
require_once 'includes/blocks.php';
require_once 'includes/helper.php';
require_once 'includes/enqueue.php';
require_once 'includes/marketsharp-form.php';


register_nav_menus( array(
    'primary' => 'Primary Menu',
		'secondary' => 'Secondary Menu',
		'footer' => 'Footer Menu',
) );


require_once 'bs4Navwalker.php';


/**
 * Add a sidebar.
 */
function compulse_sidebar_init() {
    register_sidebar( array(
        'name'          => __( 'Blog Sidebar', 'textdomain' ),
        'id'            => 'sidebar-blog',
        'description'   => __( 'Widgets in this area will be shown on all posts and pages.', 'textdomain' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'compulse_sidebar_init' );

/*
add_filter('frm_setup_new_fields_vars', 'frm_populate_posts', 20, 2);
add_filter('frm_setup_edit_fields_vars', 'frm_populate_posts', 20, 2); //use this function on edit too
function frm_populate_posts($values, $field){
  if($field->id == 35){ //replace 125 with the ID of the field to populate
    $terms = get_terms([
    'taxonomy' => 'service',
    'hide_empty' => false,
    'orderby' => 'menu_order'
    ]);
    unset($values['options']);

    foreach ($terms as $t) {
      $values['options'][$t->term_id] = $t->name;
      $values['custom_html'] = '<div id="frm_field_[id]_container" class="frm_form_field form-field [required_class][error_class]">
    <div  id="field_[key]_label" class="frm_primary_label">[field_name]
        <span class="frm_required">[required_label]</span>
    </div>
    <div class="frm_opt_container" aria-labelledby="field_[key]_label" role="group">[input]</div>
    [if description]<div class="frm_description" id="frm_desc_field_[key]">[description]</div>[/if description]
    [if error]<div class="frm_error" id="frm_error_field_[key]">[error]</div>[/if error]
</div>';
    }
    var_dump($values);
    //$values['use_key'] = true; //this will set the field to save the post ID instead of post title
    unset($values['options'][0]);
  }
  return $values;
}*/

function crunchify_print_scripts_styles() {

    $result = [];
    $result['scripts'] = [];
    $result['styles'] = [];

    // Print all loaded Scripts
    global $wp_scripts;
    foreach( $wp_scripts->queue as $script ) :
       //$result['scripts'][] =  $wp_scripts->registered[$script]->src . ";";
       $result['scripts'][] =  $wp_scripts->registered[$script];
    endforeach;

    // Print all loaded Styles (CSS)
    global $wp_styles;
    foreach( $wp_styles->queue as $style ) :
       //$result['styles'][] =  $wp_styles->registered[$style]->src . ";";
       $result['styles'][] =  $wp_styles->registered[$style];
    endforeach;

    return $result;
}

function dequeue_dequeue_plugin_style(){
    wp_dequeue_style( 'rplg-css' ); //Name of Style ID.
    wp_dequeue_style('swiper-css');
    wp_dequeue_script('brb-wpac-time-js');
    wp_dequeue_script('blazy-js');
    wp_dequeue_script('rplg-js');
    wp_dequeue_script('swiper-js');
}
add_action( 'wp_enqueue_scripts', 'dequeue_dequeue_plugin_style', 999 );


add_filter( 'wp_dropdown_users_args', 'add_subscribers_to_dropdown', 10, 2 );
function add_subscribers_to_dropdown( $query_args, $r ) {

    $query_args['who'] = '';
    return $query_args;

}

$staff_member = get_role('client');
$staff_member->add_cap('level_1');

//Disallow duplicate entries in a specific form for one year
//https://formidableforms.com/knowledgebase/frm_time_to_check_duplicates/#kb-disallow-duplicate-entries-in-a-specific-form-for-one-year
add_filter('frm_time_to_check_duplicates', 'change_duplicate_time_limit_one_form', 10, 2);
function change_duplicate_time_limit_one_form( $time_limit, $entry_values ) {
    if ( $entry_values['form_id'] == 193 || $entry_values['form_id'] == 244 ) { //change 100 to your form ID
        $time_limit = 31536000;
    }
    return $time_limit;
}
