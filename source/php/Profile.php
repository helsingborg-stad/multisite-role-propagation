<?php

namespace msRolePropagination;

class Profile
{

    private $db;

    public function __construct()
    {
        //Get wpdb
        global $wpdb;
        $this->db = $wpdb;

        //Load view
        add_action('show_user_profile', array($this, 'loadSitesList'));
        add_action('edit_user_profile', array($this, 'loadSitesList'));

        //Fetch save state
        add_action('personal_options_update', array($this, 'saveUserPofile'));
        add_action('edit_user_profile_update', array($this, 'saveUserPofile'));
    }

    /**
     * Fetch the view
     * @return void
     */
    public function loadSitesList($user)
    {
        if (!is_super_admin()) {
            return;
        }

        if (file_exists(MSROLEPROPAGINATION_TEMPLATE_PATH . 'profile.php')) {

            //Get data for view
            $data = array(
                'sites' => array_chunk(get_sites(), 3),
                'savedState' => $this->getUserRoles($user->ID)
            );

            //Require view
            require MSROLEPROPAGINATION_TEMPLATE_PATH.'profile.php';
        } else {
            wp_die("Profile page view does not exists at " . MSROLEPROPAGINATION_TEMPLATE_PATH.'profile.php');
        }
    }

    /**
     * Handle save data
     * @return void
     */
    public function saveUserPofile($user_id)
    {
        //Authentication check
        if (!is_super_admin()) {
            return;
        }

        if (isset($_POST['userEnabled']) && is_array($_POST['userEnabled']) && !empty($_POST['userEnabled'])) {
            foreach ((array) $_POST['userEnabled'] as $site_key => $role) {
                if (get_role($role) !== null) {
                    if ($site_key != 1) {
                        update_user_meta($user_id, $this->db->prefix . $site_key . '_capabilities', array($role => true));
                    } else {
                        update_user_meta($user_id, $this->db->prefix . 'capabilities', array($role => true));
                    }
                } else {
                    if ($site_key != 1) {
                        delete_user_meta($user_id, $this->db->prefix . $site_key . '_capabilities');
                    } else {
                        delete_user_meta($user_id, $this->db->prefix . 'capabilities');
                    }
                }
            }
        }
    }

    /**
     * Get roles that are defined at each site
     * @return array
     */
    public function getUserRoles($user_id)
    {
        $roles = array();

        foreach ((array) get_sites() as $site) {

            //Get user role
            if ($site->blog_id != 1) {
                $userSettings = get_user_meta($user_id, $this->db->prefix . $site->blog_id . '_capabilities', true);
            } else {
                $userSettings = get_user_meta($user_id, $this->db->prefix . 'capabilities', true);
            }

            //Store to settings array
            if (is_array($userSettings)) {
                $roles[$site->blog_id] = key($userSettings);
            } else {
                $roles[$site->blog_id] = false;
            }
        }

        return $roles;
    }
}
