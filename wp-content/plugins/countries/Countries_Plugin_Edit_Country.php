<?php

class Countries_Plugin_Edit_Country
{
    public function __construct()
    {
        add_action('admin_init', [$this, 'edit_country']);
    }

    public function edit_country(){
        $method = $_SERVER['REQUEST_METHOD'];
        if (strtolower($method) != 'post') {
            return;
        }

        if (isset($_POST['edit_country']) && $_POST['edit_country'] == 'edit_country') {
            check_admin_referer('edit_country_nonce', 'edit_country_nonce_field');

            if(!isset($_POST['country_id'])){
                add_action('admin_notices', [$this, 'show_error_notice']);
            }

            $country_id = $_POST['country_id'];

            if (!$this->validate()) {
                add_action('admin_notices', [$this, 'show_validation_error_message']);
                return;
            }

            global $wpdb;
            if($wpdb->update($wpdb->prefix.'country_codes', [
                'country_name' => sanitize_text_field($_POST['country_name']),
                'country_code' => $_POST['country_code'],
                'calling_code' => $_POST['country_calling_code'],
                'updated_at' => wp_date('Y-m-d H:i:s'),
            ], [
               'id' => $country_id
            ])){
                add_action('admin_notices', [$this, 'show_success_message']);
                return;
            }
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

    public function show_error_notice()
    {
        ?>
        <div class="notice notice-error is-dismissible">
            <p>
                Error Occurred!
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