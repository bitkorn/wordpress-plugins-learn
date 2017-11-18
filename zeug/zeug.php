<?php
/*
  Plugin Name: Zeug
  Plugin URI: http://www.bitkorn.de
  Description: Hier werden unterschiedliche Dinge (Zeug) der Wordpress Plugin API getestet und veranschaulicht.
  Version: 0.0.1
  Author: Torsten Brieskorn
  Author URI: http://www.bitkorn.de
 */
?>
<?php

/**
 * @param $param
 */
function wpdbTest($param)
{
    /** @var \wpdb The WP database object */
    global $wpdb, $logger;
    $tablename = $wpdb->prefix . 'options';
    $sql = $wpdb->prepare("SELECT * FROM $tablename WHERE option_id = %d", $param);
    $result = $wpdb->query($sql);
//    $logger->debug(print_r($result, true));
}

//wpdbTest(15);

function bk_zeug_preferences_menu()
{
    // so
//    add_options_page('BK Zeug Prefs', 'BK Zeug', 'manage_options', 'bk-zeug-prefs', 'bk_zeug_preferences_page');

    // oder so
    add_submenu_page(
        'options-general.php',        //The new options page will be added as a sub menu to the Settings menu.
        'BK Zeug Prefs',        //Page <title>
        'BK Zeug',        //Menu title
        'manage_options',            //Capability
        'bk_zeug_prefs',    //Slug
        'bk_zeug_preferences_page'    //Function to call
    );
}

function bk_zeug_preferences_page()
{
    global $logger;
    echo file_get_contents(__DIR__ . '/html/bk_zeug_preferences.html');
    if (isset($_POST['bk_zeug_hidden'])) {
        $logger->info('BK Zeug Prefferences saved: ' . filter_input(INPUT_POST, 'bk_zeug_zeug', FILTER_SANITIZE_STRING));
    }
}

/*
 * HOOKS
 */

add_action('admin_menu', 'bk_zeug_preferences_menu');