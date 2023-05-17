<?php
/*
Plugin Name: View Count
Plugin URI: https://ex.com
Description: Output count of post view
Version: 1.0
Author: M.A.I.
Author URI: https://ex.com
 */
function view_count()
{
    global $wpdb;
    $query = "SELECT view_count FROM wp_posts";
    $result = $wpdb->get_row($query);

    if (!is_null($result)) {
        return;
    }
// добавляем новую колонку
    $query = "ALTER TABLE
              " . $wpdb->posts . "
          ADD
              `view_count` BIGINT UNSIGNED NOT NULL DEFAULT 0
          AFTER
              `comment_count`";
    $wpdb->query($query);
}

register_activation_hook(__FILE__, "view_count");

function show_view_count($content)
{
    if (!is_single()) {
        return $content;
    }
    global $post;
    $views = (int)$post->view_count;
    $text = '<p>' . __('Show view count:', 'view_count') . (int)$views . '</p>';
    return $content . $text;
}
add_filter('the_content', 'show_view_count');

function update_view_count()
{
    if (!is_single()) {
        return;
    }
    global $post, $wpdb;
    $views = (int)$post->view_count + 1;
    $wpdb->update(
        $wpdb->posts, // db table name
        ['view_count' => (int)$views], // field 'view_count' update
        ['ID' => $post->ID]// where condition
    );
}
add_action('wp_head', 'update_view_count');

// function uninstall_view_count()
// {
//     global $wpdb;
//     $query = "SELECT view_count FROM wp_posts";
//     $result = $wpdb->get_row($query);
//     if (is_null($result)) {
//         return;
//     }
//     $query = "ALTER TABLE
//               " . $wpdb->posts . "
//           DROP
//               `view_count`";
//     $wpdb->query($query);
// }

// register_uninstall_hook(__FILE__, 'uninstall_view_count');