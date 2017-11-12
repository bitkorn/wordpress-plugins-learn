<?php
/*
  Plugin Name: Apache log4php
  Plugin URI: http://logging.apache.org/log4php/
  Description: Apache log4php für Wordpress (No activation in Wordpress required to work)
  Version: 0.0.1
  Author: Torsten Brieskorn
  Author URI: http://www.bitkorn.de
 */
/**
 * https://logging.apache.org/log4php/quickstart.html
 */
require_once __DIR__ . '/Logger.php';
register_activation_hook(__FILE__, 'bk_log4php_install');
global $logger;
function bk_log4php_install()
{
    global $logger;

    $confFqfn = __DIR__ . '/config.xml';
    if (!file_exists($confFqfn)) {
        throw new \Exception('File does not exist: ' . $confFqfn);
    }
    if (!is_writable($confFqfn)) {
        throw new \Exception('File is not writable: ' . $confFqfn);
    }
    $xmlConf = simplexml_load_file($confFqfn);
    if (isset($xmlConf->appender->param->attributes()['value'])) {
        if (!file_exists(ABSPATH . 'bkwp.log')) {
            file_put_contents(ABSPATH . 'bkwp.log', '');
        }
        $xmlConf->appender->param->attributes()['value'] = ABSPATH . 'bkwp.log';
        file_put_contents($confFqfn, $xmlConf->asXML());
    }

    Logger::configure(__DIR__ . '/config.xml');
    $logger = Logger::getLogger('bkLogger');
    $logger->info('Successfully activated plugin Apache log4php');
}


function bk_log4php_global_var()
{
    global $logger;
    Logger::configure(__DIR__ . '/config.xml');
    $logger = Logger::getLogger('bkLogger');
}
add_action('parse_request', 'bk_log4php_global_var');