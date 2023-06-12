<?php

class Countries_Plugin_Add_Country
{
    public function __construct()
    {
        add_action('admin_init', [$this, 'add_country']);
    }

    public function add_country()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        if (strtolower($method) != 'post') {
            return;
        }

        if (isset($_POST['add_country']) && $_POST['add_country'] == 'add_country') {
            if (!$this->validate()) {
                add_action('admin_notices', [$this, 'show_validation_error_message']);
                return;
            }

            global $wpdb;
            if ($wpdb->insert($wpdb->prefix . 'country_codes', [
                'country_name' => sanitize_text_field($_POST['country_name']),
                'country_code' => $_POST['country_code'],
                'calling_code' => $_POST['country_calling_code'],
                'created_at' => wp_date('Y-m-d H:i:s'),
                'updated_at' => wp_date('Y-m-d H:i:s'),
            ])) {
                add_action('admin_notices', [$this, 'show_success_message']);
                return;
            };
        }
    }

    public function validate()
    {
        /**
         * @TODO Validate input here
         */
        return true;
    }

    public function show_validation_error_message()
    {
        ?>
        <div class="notice notice-error is-dismissible">
            <p>
                Validation errors occurred.
            </p>
        </div>
        <?php
    }

    public function show_success_message()
    {
        ?>
        <div class="notice notice-success is-dismissible">
            <p>
                Data Saved.
            </p>
        </div>
        <?php
    }
}