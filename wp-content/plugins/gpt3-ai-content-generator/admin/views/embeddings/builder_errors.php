<?php
if ( ! defined( 'ABSPATH' ) ) exit;
global $wpdb;
if(isset($_GET['sub_action']) && sanitize_text_field($_GET['sub_action']) == 'reindexall'){
    if(count($wpaicg_total_errors)){
        foreach($wpaicg_total_errors as $wpaicg_total_error){
            update_post_meta($wpaicg_total_error->ID,'wpaicg_indexed','reindex');
        }
    }
    echo '<script>window.location.href = "'.admin_url('admin.php?page=wpaicg_embeddings&action=builder&sub=errors').'";</script>';
    exit;
}
?>
<div class="tablenav top">
    <div class="alignleft actions bulkactions">
        <a href="<?php echo admin_url('admin.php?page=wpaicg_embeddings&action=builder&sub=error&sub_action=reindexall')?>" class="button button-primary">Re-Index All</a>
        <button class="button button-primary btn-reindex-builder">Re-Index Selected</button>
    </div>
</div>
<div class="tablenav top">
    <div class="alignleft actions bulkactions">
        <a href="<?php echo admin_url('admin.php?page=wpaicg_embeddings&action=builder')?>">Indexed (<?php echo esc_html($wpaicg_total_indexed)?>)</a> |
        Failed (<?php echo esc_html(count($wpaicg_total_errors))?>) |
        <a href="<?php echo admin_url('admin.php?page=wpaicg_embeddings&action=builder&sub=skip')?>">Skipped (<?php echo esc_html(count($wpaicg_total_skips))?>)</a>
    </div>
</div>
<table class="wp-list-table widefat fixed striped table-view-list posts">
    <thead>
    <tr>
        <td id="cb" class="manage-column column-cb check-column" scope="col"><input type="checkbox" class="wpaicg-select-all"></td>
        <th>Title</th>
        <th>Message</th>
    </tr>
    </thead>
    <tbody>
    <?php
    if(count($wpaicg_total_errors)){
        foreach ($wpaicg_total_errors as $wpaicg_total_error) {
            ?>
            <tr>
                <th scope="row" class="check-column">
                    <input class="cb-select-embedding" id="cb-select-<?php echo esc_html($wpaicg_total_error->ID);?>" type="checkbox" name="ids[]" value="<?php echo esc_html($wpaicg_total_error->ID);?>">
                </th>
                <td><a href="<?php echo esc_url(admin_url('post.php?post='.esc_html($wpaicg_total_error->ID).'&action=edit'))?>" target="_blank"><?php echo esc_html($wpaicg_total_error->post_title)?></a></td>
                <td><?php echo esc_html(get_post_meta($wpaicg_total_error->ID,'wpaicg_error_msg',true))?></td>
            </tr>
            <?php
        }
    }
    ?>
    </tbody>
</table>
<script>
    jQuery(document).ready(function ($){
        $('.btn-reindex-builder').click(function (){
            function wpaicgLoading(btn){
                btn.attr('disabled','disabled');
                if(!btn.find('spinner').length){
                    btn.append('<span class="spinner"></span>');
                }
                btn.find('.spinner').css('visibility','unset');
            }
            function wpaicgRmLoading(btn){
                btn.removeAttr('disabled');
                btn.find('.spinner').remove();
            }
            var btn = $(this);
            var ids = [];
            $('.cb-select-embedding:checked').each(function (idx, item){
                ids.push($(item).val())
            });
            if(ids.length){
                $.ajax({
                    url: '<?php echo admin_url('admin-ajax.php')?>',
                    data: {action: 'wpaicg_reindex_builder_data', ids: ids,'nonce': '<?php echo wp_create_nonce('wpaicg-ajax-nonce')?>'},
                    dataType: 'JSON',
                    type: 'POST',
                    beforeSend: function () {
                        wpaicgLoading(btn);
                    },
                    success: function (res){
                        window.location.reload();
                    },
                    error: function (){

                    }
                });
            }
            else{
                alert('Nothing to do');
            }
        });
    })
</script>
