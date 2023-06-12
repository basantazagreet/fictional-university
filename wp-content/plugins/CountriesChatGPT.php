<?php
/*
Plugin Name: Country CRUD Plugin
Plugin URI: https://www.example.com/
Description: Simple plugin for CRUD operations on countries.
Version: 1.0
Author: Your Name
Author URI: https://www.example.com/
License: GPL2
*/

// Create the database table on plugin activation
function create_countries_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'countries';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(100) NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(__FILE__, 'create_countries_table');



// Add menu item in WordPress dashboard
function add_country_menu_item() {
    add_menu_page(
        'Countries',
        'Countries-all',
        'manage_options',
        'country-list',
        'render_country_page',
        'dashicons-admin-site',
        30
    );
}
add_action('admin_menu', 'add_country_menu_item');

// Render the country page
function render_country_page() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'countries';

    // Handle form submission
    if (isset($_POST['submit'])) {
        $country_name = sanitize_text_field($_POST['country_name']);

        if (!empty($country_name)) {
            $wpdb->insert(
                $table_name,
                array('name' => $country_name)
            );
            echo '<div class="notice notice-success"><p>Country added successfully.</p></div>';
        } else {
            echo '<div class="notice notice-error"><p>Country name is required.</p></div>';
        }
    }

    // Handle delete action
    if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $wpdb->delete(
            $table_name,
            array('id' => $id)
        );
        echo '<div class="notice notice-success"><p>Country deleted successfully.</p></div>';
    }

    // Fetch all countries
    $countries = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
    ?>

    <div class="wrap">
        <h1>Countries</h1>

        <!-- Add Country Form -->
        <h2>Add Country</h2>
        <form method="post" action="">
            <input type="text" name="country_name" placeholder="Country Name" required>
            <input type="submit" name="submit" class="button button-primary" value="Add Country">
        </form>

        <!-- Country List -->
        <h2>Country List</h2>
        <table class="wp-list-table widefat striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($countries as $country) : ?>
                    <tr>
                        <td><?php echo $country['id']; ?></td>
                        <td><?php echo $country['name']; ?></td>
                        <td>
                            <a href="?page=country-list&action=delete&id=<?php
                            
                                                   echo $country['id']; ?>" onclick="return confirm('Are you sure you want to delete this country?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <?php
}