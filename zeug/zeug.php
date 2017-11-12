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

//$log->debug(print_r($elem, true));
//$log->debug('some text');

function wpdbTest($param) {
    /** @var \wpdb The WP database object */
    global $wpdb, $logger;
    $tablename = $wpdb->prefix.'options';
    $sql = $wpdb->prepare("SELECT * FROM $tablename WHERE option_id = %d", $param);
    $result = $wpdb->query($sql);
//    $logger->debug(print_r($result, true));
}
wpdbTest(15);
