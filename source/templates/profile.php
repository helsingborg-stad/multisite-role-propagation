<h3><?php _e("Multisite role"); ?></h3>

<table class="form-table">

    <tr>
        <th><label for="twitter"><?php _e("Select sites to enable the user on"); ?></label></th>

        <td>
            <input type="text" name="test" id="test" value="<?php echo esc_attr(get_the_author_meta('test', $user->ID)); ?>" class="regular-text" /><br />
            <span class="description">Please enter your username.</span>
        </td>
    </tr>

</table>
