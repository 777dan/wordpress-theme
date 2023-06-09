<?php
if ( ! defined( 'ABSPATH' ) ) exit;
$wpaicg_action = isset($_GET['action']) && !empty($_GET['action']) ? sanitize_text_field($_GET['action']) : '';
?>
<style>
.wpaicg_notice_text_rw {
    padding: 10px;
    background-color: #F8DC6F;
    text-align: left;
    margin-bottom: 12px;
    color: #000;
    box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
}
</style>
<div class="wrap fs-section">
    <p class="wpaicg_notice_text_rw">Need help? Watch our <a href="https://www.youtube.com/watch?v=ZBJyhr_DlxE" target="_blank">video tutorial</a>.</p>
    <h2 class="nav-tab-wrapper">
        <a href="<?php echo admin_url('admin.php?page=wpaicg_single_content')?>" class="nav-tab<?php echo empty($wpaicg_action) ? ' nav-tab-active': ''?>">Express Mode</a>
        <a href="<?php echo admin_url('admin.php?page=wpaicg_single_content&action=custom')?>" class="nav-tab<?php echo $wpaicg_action == 'custom' ? ' nav-tab-active': ''?>">Custom Mode</span></a>
        <a href="<?php echo admin_url('admin.php?page=wpaicg_single_content&action=comparison')?>" class="nav-tab<?php echo $wpaicg_action == 'comparison' ? ' nav-tab-active': ''?>">Comparison</span></a>
        <a href="<?php echo admin_url('admin.php?page=wpaicg_single_content&action=speech')?>" class="nav-tab<?php echo $wpaicg_action == 'speech' ? ' nav-tab-active': ''?>">Speech-to-Post</a>
        <a href="<?php echo admin_url('admin.php?page=wpaicg_single_content&action=playground')?>" class="nav-tab<?php echo $wpaicg_action == 'playground' ? ' nav-tab-active': ''?>">Playground</a>
        <a href="<?php echo admin_url('admin.php?page=wpaicg_single_content&action=logs')?>" class="nav-tab<?php echo $wpaicg_action == 'logs' ? ' nav-tab-active': ''?>">Logs</a>
    </h2>
    <div id="poststuff">
        <div id="fs_account">
            <?php
            if(empty($wpaicg_action)):
            ?>
                <div>
                    <form class="wpaicg-single-content-form" id="wpaicg-single-content-form">
                        <?php
                        $mode = 'NEW';
                        global  $wpdb ;
                        $table = $wpdb->prefix . 'wpaicg';
                        $result = $wpdb->get_row( $wpdb->prepare( "SELECT * FROM {$table} WHERE name = %s", 'wpaicg_settings' ) );
                        $value = '';
                        $_wporg_preview_title = '';
                        $_wporg_language = $result->wpai_language;
                        $_wporg_number_of_heading = $result->wpai_number_of_heading;
                        $_wporg_writing_style = $result->wpai_writing_style;
                        $_wporg_writing_tone = $result->wpai_writing_tone;
                        $_wporg_heading_tag = $result->wpai_heading_tag;
                        $_wporg_target_url = '';
                        $_wporg_cta_pos = $result->wpai_cta_pos;
                        $_wporg_target_url_cta = '';
                        $_wporg_keywords = "";
                        $_wporg_add_keywords_bold = $result->wpai_add_keywords_bold;
                        $_wporg_words_to_avoid = '';
                        $_wporg_modify_headings = $result->wpai_modify_headings;
                        $_wporg_add_img = $result->wpai_add_img;
                        $_wporg_add_tagline = $result->wpai_add_tagline;
                        $_wporg_add_intro = $result->wpai_add_intro;
                        $_wporg_add_faq = $result->wpai_add_faq;
                        $_wporg_add_conclusion = $result->wpai_add_conclusion;
                        $_wporg_anchor_text = '';
                        $_wporg_generated_text = '';
                        include __DIR__.'/wpaicg_meta_form.php';
                        ?>
                    </form>

                    <!-- Modal -->
                    <div class="modal fade" id="myModal" role="dialog" data-backdrop="static" data-keyboard="false">
                        <div class="modal-dialog">

                            <!-- Modal content-->
                            <div class="wpcgai_modal-content">
                                <div class="wpcgai_modal-header">
                                    <!--<button type="button" class="close" data-dismiss="modal">&times;</button>-->
                                    <h4 class="wpcgai_modal-title">Outline Editor</h4>
                                    <span>You can modify, sort, add or delete headings.</span>
                                </div>
                                <div class="wpcgai_modal-body">
                                    <ol class="wpcgai_menu_editor"></ol>
                                    <a href="javascript:;" id="wpcgai_add_new_heading">+ Add new heading</a>
                                </div>
                                <div class="wpcgai_modal-footer">
                                    <button type="button" class="button button-secondary button-large m_close">CANCEL</button>
                                    <button type="button" class="button button-primary button-large m_generate">GENERATE</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <script>
                    jQuery("#wpai_modify_headings2").change(function()
                    {
                        if(this.checked)
                            jQuery('#wpai_modify_headings').attr('value', 1);
                        else
                            jQuery('#wpai_modify_headings').attr('value', 0);
                    });

                    jQuery("#wpai_add_img2").change(function()
                    {
                        if(this.checked)
                            jQuery('#wpai_add_img').attr('value', 1);
                        else
                            jQuery('#wpai_add_img').attr('value', 0);
                    });

                    jQuery("#wpai_add_tagline2").change(function()
                    {
                        if(this.checked)
                            jQuery('#wpai_add_tagline').attr('value', 1);
                        else
                            jQuery('#wpai_add_tagline').attr('value', 0);
                    });

                    jQuery("#wpai_add_intro2").change(function()
                    {
                        if(this.checked)
                            jQuery('#wpai_add_intro').attr('value', 1);
                        else
                            jQuery('#wpai_add_intro').attr('value', 0);
                    });

                    jQuery("#wpai_add_faq2").change(function()
                    {
                        if(this.checked)
                            jQuery('#wpai_add_faq').attr('value', 1);
                        else
                            jQuery('#wpai_add_faq').attr('value', 0);
                    });

                    jQuery("#wpai_add_conclusion2").change(function()
                    {
                        if(this.checked)
                            jQuery('#wpai_add_conclusion').attr('value', 1);
                        else
                            jQuery('#wpai_add_conclusion').attr('value', 0);
                    });

                    jQuery("#wpai_add_keywords_bold2").change(function()
                    {
                        if(this.checked)
                            jQuery('#wpai_add_keywords_bold').attr('value', 1);
                        else
                            jQuery('#wpai_add_keywords_bold').attr('value', 0);
                    });

                    jQuery(".m_generate").on("click", function(e)
                    {
                        var menuholder = new Array();
                        var menuholder2 = new Array();

                        var menu_data = jQuery(".wpcgai_menu_editor").children();
                        var firstli = menu_data;

                        firstli.each(function ()
                        {
                            var menus_html = jQuery(this).children();

                            var identifier = jQuery(this).find("#identifier").text();
                            var text = jQuery(this).find("#text").val();

                            if(text == '')
                            {
                                menuholder = new Array();
                                menuholder2 = new Array();
                                alert('Heading input can\'t be blank!');
                            }
                            else
                            {
                                var menuObj = new Object();
                                menuObj['Identifier'] = identifier;
                                menuObj['Text'] = text;

                                menuholder.push(menuObj);
                                menuholder2.push(text);
                            }
                        });

                        if(menuholder.length > 0)
                        {
                            jQuery('#wpai_number_of_heading').val(menuholder.length);

                            jQuery("#hfHeadings2").val(JSON.stringify(menuholder));

                            jQuery("#hfHeadings").val(menuholder2.join('||'));

                            jQuery("#is_generate_continue").val(1);

                            jQuery('#myModal').fadeOut('wpcgai_hide');
                            jQuery('.modal-backdrop').hide();

                            jQuery('#wpcgai_load_plugin_settings').click();
                        }
                        else if(firstli.length == 0)
                        {
                            alert('No heading found.');
                        }
                    });

                    jQuery(".m_close").on("click", function(e)
                    {
                        jQuery('#myModal').fadeOut('wpcgai_hide');
                        jQuery('.modal-backdrop').hide();
                        jQuery('.wpcgai_lds-ellipsis').hide();
                        clearTimeout(window['wpaicgTimer']);
                        jQuery('#wpcgai_load_plugin_settings').removeAttr('disabled');
                        jQuery('#wpcgai_load_plugin_settings .spinner').remove();
                        e.stopPropagation();
                    });

                    jQuery("#wpcgai_add_new_heading").on("click", function(e)
                    {
                        if(jQuery('#myModal .wpcgai_menu_editor li').length >= 10){
                            alert('Limited 10 headings')
                        }
                        else{
                            var randomnum = Math.floor((Math.random() * 100000) + 1);

                            var itemTemplate = "<li><div>";

                            itemTemplate += "<input type='text' id='text' value='' placeholder='Type heading text...' style='width: 90%;'/>";

                            itemTemplate += "<span class='wpcgai_sort_heading'><i class='fa fa-bars'></i></span>";

                            itemTemplate += "<span id='wpcgai_remove_heading'><i class='fa fa-trash-o'></i></span>";

                            itemTemplate += "<div style='display: none;'><span id='identifier'>" + randomnum + "</span>";
                            itemTemplate += "</div>";
                            itemTemplate += "</div></li>";
                            jQuery(".wpcgai_menu_editor").append(itemTemplate);
                        }
                    });
                    function URLSearchParams2JSON_2(STRING) {
                        var searchParams = new URLSearchParams(STRING);
                        var object = {};
                        searchParams.forEach((value, key) => {
                            var keys = key.split('.'),
                                last = keys.pop();
                            keys.reduce((r, a) => r[a] = r[a] || {}, object)[last] = value;
                        });
                        return object;
                    }
                    jQuery(document).ready(function ()
                    {
                        var menuHolder = jQuery('.wpcgai_menu_editor');
                        menuHolder.sortable({
                            handle: 'div',
                            items: 'li',
                            toleranceElement: '> div',
                            maxLevels: 2,
                            isTree: true,
                            tolerance: 'pointer'
                        });

                        jQuery("body").on('click', '#wpcgai_remove_heading', function ()
                        {
                            var p = jQuery(this).parent().parent();
                            jQuery(p).remove();
                        });
                    });
                </script>
            <?php
            elseif($wpaicg_action == 'logs'):
                include __DIR__.'/wpaicg_single_log.php';
            elseif($wpaicg_action == 'speech'):
                include __DIR__.'/wpaicg_speech.php';
            elseif($wpaicg_action == 'comparison'):
                include __DIR__.'/wpaicg_comparison_tool.php';
            elseif($wpaicg_action == 'playground'):
                include __DIR__.'/wpaicg_playground.php';
            elseif($wpaicg_action == 'custom'):
                include __DIR__.'/wpaicg_custom_model.php';
            endif
            ?>
        </div>
    </div>
</div>
