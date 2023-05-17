<?php
/*
Plugin Name: Breadcrumbs shortcode
Plugin URI: https://example.com/
Description: Breadcrumbs,  navigation scheme that reveals the user's location in a website
Version: 1.0
Author: M.A.I.
Author URI: https://example.com/
License: GPL2
 */

// Make sure we don't expose any info if called directly
if ( !function_exists( 'add_action' ) ) {
    echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
    exit;
}

function breadcrumbs_for_shortcode()
{
    $breadcrumbs = '<ol class="breadcrumb">';
    if (!is_front_page()) {
        $breadcrumbs .= '<li class="breadcrumb-item"><a href="';
        $breadcrumbs .= get_option('home');
        $breadcrumbs .= '">' . __("Home") . '</a></li>';
        if (is_category()) {
            $breadcrumbs .= '<li class="breadcrumb-item">';
            $categorie = get_category(get_query_var('cat'));
            $breadcrumbs .= '<a href="' . get_category_link($categorie->term_id) . '">' . $categorie->name . '</a>&nbsp;/&nbsp;';
            $breadcrumbs = trim($breadcrumbs, '&nbsp;/&nbsp;');
        } elseif (is_single()) {
            $breadcrumbs .= '<li class="breadcrumb-item">';
            $categories = get_the_category();
            if ($categories) {
                foreach ($categories as $category) {
                    $breadcrumbs .= '<a href="' . get_category_link($category->term_id) . '">' . $category->name . '</a>&nbsp;/&nbsp;';
                }
                $breadcrumbs = trim($breadcrumbs, '&nbsp;/&nbsp;');
            }
            $breadcrumbs .= '</li>';
            if (is_single()) {
                $breadcrumbs .= '<li class="breadcrumb-item active">' . get_the_title();
                $breadcrumbs .= '</li>';
            }
        } elseif (is_page()) {
            $breadcrumbs .= '<li class="breadcrumb-item active">';
            $breadcrumbs .= get_the_title();
            $breadcrumbs .= '</li>';
        }
    } else {
        $breadcrumbs .= __('<li class="breadcrumb-item">' . __("Home") . '</li>');
    }
    $breadcrumbs .= '</ol>';
    return $breadcrumbs;
}

function breadcrumbs_shortcode($atts)
{
    return breadcrumbs_for_shortcode();
}
add_shortcode('breadcrumbs', 'breadcrumbs_shortcode');
