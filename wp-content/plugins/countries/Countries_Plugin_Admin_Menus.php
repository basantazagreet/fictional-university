<?php

class Countries_Plugin_Admin_Menus
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'add_menu_pages']);
    }

    public function add_menu_pages()
    {
        add_menu_page(
            'Countries',
            'Countries',
            'manage_options',
            'countries',
            [$this, 'country_list'], //callback for html view
        );
    }

    public function country_list()
    {
        $action = 'list';
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        }

        switch ($action) {
            case 'add':
                include COUNTRIES_PLUGIN_PATH . '/views/admin/add-country.php';
                break;
            case 'edit':
                include COUNTRIES_PLUGIN_PATH . '/views/admin/edit-country.php';
                break;
            default:
                include COUNTRIES_PLUGIN_PATH . '/views/admin/countries-list.php';
        }
    }
}