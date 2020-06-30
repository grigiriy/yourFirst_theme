<?php define('STATIC_FILES_BUILD_VERSION', '0.1');

//deregister unnessosary scripts
function my_dequeue_scripts() {
  wp_dequeue_script( 'jquery-ui-core' );
  wp_dequeue_script( 'jquery-ui-sortable' );
}


//remove smthng
add_filter('xmlrpc_enabled', '__return_false');
remove_action('wp_head','adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'wp_shortlink_wp_head');


// remove hAtom micromarkup
function remove_hentry( $classes ) {
  $classes = array_diff($classes, array('hentry'));
  return $classes;
}
add_filter( 'post_class', 'remove_hentry' );


// remove Emojii
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_action( 'admin_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
add_filter( 'tiny_mce_plugins', 'disable_wp_emojis_in_tinymce' );
function disable_wp_emojis_in_tinymce( $plugins ) {
  if ( is_array( $plugins ) ) {
    return array_diff( $plugins, array( 'wpemoji' ) );
  } else {
    return array();
  }
}

// start
function theme_styles()
{
  wp_enqueue_style('bootstrap','https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css',[], STATIC_FILES_BUILD_VERSION);
  wp_enqueue_style('main', get_template_directory_uri() . '/css/main.css',['bootstrap'], STATIC_FILES_BUILD_VERSION);
}
function theme_scripts()
{  
  wp_enqueue_script('popper', 'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js',['jquery'], STATIC_FILES_BUILD_VERSION, true);
  wp_enqueue_script('bootstrap', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js',['popper'], STATIC_FILES_BUILD_VERSION, true);
  wp_enqueue_script('master-script', get_template_directory_uri() . '/js/main.js',['bootstrap'], STATIC_FILES_BUILD_VERSION, true);

}
add_action('wp_print_styles', 'theme_styles');
add_action('wp_print_styles', 'theme_scripts');




add_action( 'carbon_fields_register_fields', 'crb_register_custom_fields' );
function crb_register_custom_fields() {
  include_once __DIR__ . '/theme-helpers/custom-fields/custom.php';
}

add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
  require_once( 'vendor/autoload.php' );
  \Carbon_Fields\Carbon_Fields::boot();
}

require_once __DIR__ . '/theme-helpers/cpt.php';
require_once __DIR__ . '/theme-helpers/taxonomy.php';

  
// FUNS
add_action('wp_ajax_log_out', 'log_out'); 
function log_out(){
  wp_logout();
  wp_die();
  return true;
}
