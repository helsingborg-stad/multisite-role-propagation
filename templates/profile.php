<h3><?php _e("Multisite role & access", 'multisite-role-popagination'); ?></h3>

<table id="multisite-role-access" class="wp-list-table widefat fixed striped" style="max-width: 800px;" class="widefat fixed" cellspacing="0">
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

                    echo '<td ' . ($siteChunk % 2) . '>';
                        echo '<label>';

                            echo '<span style="font-weight: bold;">' . __("Site") . " " . $site->domain .'</span>';
                            echo '<br/>';
                            echo '<select style="width: 100%;" id="userEnabled' . $site->blog_id . '" name="userEnabled[' . $site->blog_id . ']">';
                                echo '<option selected="" value="">' . __("No role"). '</option>';
                                wp_dropdown_roles($data['savedState'][$site->blog_id]);
                            echo '</select>';

                        echo '</label> ';
                    echo '</td>';

                    echo $tablepadding;
                }
            echo '</tr>';
        }
    ?>
</table>
