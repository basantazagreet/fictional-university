<?php
/**
 * Plugin Name: Countries
 * Plugin URI:
 * Description: Countries plugin tutorial
 * Version: 1.0.0
 * Author: Basanta
 * Author URI: https://basantasapkota.com.np
 * Text Domain: countries
 * Domain Path: /lang/
 */

define('COUNTRIES_PLUGIN_PATH', $pluginDirectory = plugin_dir_path(__FILE__));

class CountriesPlugin{
    public function __construct()
    {
        $this->init();
    }

    public function init(){
        $this->include_files();

        new Countries_Plugin_Admin_Menus();
        new Countries_Plugin_Add_Country();
        new Countries_Plugin_Edit_Country();
    }

    public function include_files(){
        include plugin_dir_path(__FILE__).'/Countries_Plugin_Admin_Menus.php';
        include plugin_dir_path(__FILE__).'/Countries_Plugin_Add_Country.php';
        include plugin_dir_path(__FILE__).'/Countries_Plugin_Edit_Country.php';
    }


    
}

new CountriesPlugin();