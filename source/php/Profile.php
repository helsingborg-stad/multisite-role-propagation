<?php

namespace msRolePropagination;

class Profile
{
    public function __construct()
    {
        //Load view
        add_action('show_user_profile', array($this, 'loadSitesList'));
        add_action('edit_user_profile', array($this, 'loadSitesList'));

        //Fetch save state
        add_action('personal_options_update', array($this, 'saveUserPofile'));
        add_action('edit_user_profile_update', array($this, 'saveUserPofile'));
    }

    /**
     * Enqueue required style
     * @return void
     */
    public function loadSitesList($user)
    {
        var_dump(MSROLEPROPAGINATION_TEMPLATE_PATH.'profile.php');
        require MSROLEPROPAGINATION_TEMPLATE_PATH.'profile.php';
    }

    /**
     * Handle save data
     * @return void
     */
    public function saveUserPofile($user_id)
    {
        if (!current_user_can('edit_user', $user_id)) {
            return false;
        }

        //Update user options


        //Propagate site role
        $this->popagateRole();
    }

    /**
     * Enqueue required style
     * @return void
     */
    public function popagateRole()
    {
    }
}
