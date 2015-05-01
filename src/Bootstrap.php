<?php
error_reporting(E_ALL | E_STRICT);

require_once('./vendor/autoload.php');

define('CONFIG_PATH', __DIR__ . '/tests/config/');

use SeleniumPhp\Writer\Writer;

class Bootstrap
{
    public static function init()
    {
        Writer::write('Bootstrap::init() complete');
    }
}

Bootstrap::init();