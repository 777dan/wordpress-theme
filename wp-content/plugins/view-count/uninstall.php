<?php
function uninstall_view_count()
{
    global $wpdb;
    $query = "SELECT view_count FROM wp_posts";
    $result = $wpdb->get_row($query);
    if (is_null($result)) {
        return;
    }
    $query = "ALTER TABLE
              " . $wpdb->posts . "
          DROP
              `view_count`";
    $wpdb->query($query);
}

register_uninstall_hook(__FILE__, 'uninstall_view_count');