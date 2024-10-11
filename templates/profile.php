<h3><?php _e("Multisite role & access", 'multisite-role-popagination'); ?></h3>

<table id="multisite-role-access" class="wp-list-table widefat fixed striped" style="max-width: 1200px;" class="widefat fixed" cellspacing="0">
    <?php
        foreach ($data['sites'] as $siteChunk) {
            echo '<tr>';
            foreach ($siteChunk as $site) {

                //Pad tables
                switch (count($siteChunk)) {
                    case 1:
                        $tablepadding = '<td></td><td></td>';
                        break;
                    case 2:
                        $tablepadding = '<td></td>';
                        break;
                    default:
                        $tablepadding = '';
                }

                //Switch to site
                switch_to_blog($site->blog_id);

                echo '<td>';
                echo '<label>';

                echo '<span style="font-weight: bold;" class="ellipsis">' . get_option('blogname') . '</span>';
                echo '<select style="width: 100%;" id="userEnabled' . $site->blog_id . '" name="userEnabled[' . $site->blog_id . ']">';
                echo '<option selected="" value="">' . __("No role"). '</option>';

                wp_dropdown_roles($data['savedState'][$site->blog_id]);

                echo '</select>';
                echo '<small class="description ellipsis">' . get_option('home') . '</small>';

                echo '</label> ';
                echo '</td>';

                //Restore to current site
                restore_current_blog();

                echo $tablepadding;
            }
            echo '</tr>';
        }
    ?>
</table>

<style>
    .ellipsis {
        display: block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
