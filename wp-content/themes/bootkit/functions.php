<?php

// Setup
define('BOOTSTRAPTOPIC_DEV_MODE', true);

// Includes
include get_theme_file_path('includes/enqueue.php');
include get_theme_file_path('includes/setup.php');
include get_theme_file_path('includes/custom-nav-walker.php');
include get_theme_file_path('includes/widgets.php');
include get_theme_file_path('includes/next-prev.php');
include get_theme_file_path('includes/taxonomies.php');
include get_theme_file_path('includes/custom-post-types.php');
include get_theme_file_path('includes/theme-customizer.php');

// Hooks
add_action('wp_enqueue_scripts', 'bootkit_enqueue');
add_action('after_setup_theme', 'bootkit_setup_theme');
add_action('widgets_init', 'bootkit_widgets');
add_filter('next_posts_link_attributes', 'posts_link_attributes');
add_filter('previous_posts_link_attributes', 'posts_link_attributes');
add_action('init', 'bootkit_taxonomies');
add_action('init', 'bootkit_register_post_type_init');
add_action('customize_register', 'bootkit_customize_register');

// Shortcodes

// [myurl]


// Tests

add_action('wp_ajax_bootkit', 'bootkit_ajax');
add_action('wp_ajax_nopriv_bootkit', 'bootkit_ajax');

function bootkit_ajax()
{
    $summa = $_POST['param1'] + $_POST['param2'];
    echo $summa;
    die;
}
