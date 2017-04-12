<?php

namespace msRolePropagination;

class Admin
{

    private $message = array();

    /**
     * Define error messages on configuration errors.
     * @return void
     */
    public function __construct()
    {
        if (!is_multisite()) {
            $this->storeMessage(__("Multisite role propagination plugin requires the installation to be a multisite.", 'multisite-role-popagination'));
        }

        $this->render();
    }

    /**
     * Render active error messages
     * @return void
     */
    private function render()
    {
        add_action('admin_notices', function () {
            if (is_array($this->message) && !empty($this->message)) {
                echo '<div class="error notice">';
                echo '<ul>';
                foreach ($this->message as $message) {
                    echo '<li>' . $message . '</li>';
                }
                echo '</ul>';
                echo '</div>';

                $this->message = array();
            }
        });
    }

    /**
     * Add error messages to error array
     * @return void
     */
    private function storeMessage($message)
    {
        $this->message[] = $message;
    }
}
