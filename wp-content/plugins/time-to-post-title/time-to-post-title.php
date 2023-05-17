<?php
/*
Plugin Name: Time to Post Title
Plugin URI: https://example.com/
Version: 1.0
Author: M.A.I.
Author URI: https://example.com/
Text Domain: time-to-post-title
License: GPL2
 */

function time_to_post_content($content)
{
    return '<div class="time">' . __('Time of post creation: ') . get_the_time() . " " . get_the_date() . '</div>' . $content;
}
add_filter('the_content', 'time_to_post_content');

add_action('plugins_loaded', 'time_load_plugin_textdomain');
function time_load_plugin_textdomain()
{
    load_plugin_textdomain('time-to-post-title', false, dirname(plugin_basename(__FILE__)) . '/languages/');
}

function site_url_shortcode($atts)
{
    return site_url();
}
add_shortcode('myurl', 'site_url_shortcode');
