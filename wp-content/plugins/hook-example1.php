<?php
/**
 * Plugin Name: Hooks example
 */

function added_footer()
{
    echo 'Added to footer by hook-example plugin ' . date("l");
}
add_action('wp_footer', 'added_footer');

function remove_added_footer()
{
    if (date("l") === "Sunday") {
// Target the 'wp_footer' action, remove the 'added_footer' function from it
        remove_action("wp_footer", "added_footer");
    }
}
add_action("wp_head", "remove_added_footer");

function hooked_title($title)
{
    return 'Hooked ' . $title;
}
add_filter('the_title', 'hooked_title');

function remove_hooked_title()
{
    if (date("l") === "Sunday") {
        remove_filter("the_title", "hooked_title");
    }
}
add_action("wp_head", "remove_hooked_title");