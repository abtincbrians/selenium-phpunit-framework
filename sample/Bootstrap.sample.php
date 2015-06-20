<?php
/* This is a sample Bootstrap. It doesn't do much at all on its own.
 *
 * This is intended to provide an example that you can use to get started
 * with the Selenium PHPUnit Framework in your project. There's really no
 * prescription for how you have to use this software, there are simply
 * guidelines. You're free to use this as you see fit.
 *
 * Guidelines:
 * - Use this file to bootstrap your not-really-unit tests.
 * - Copy this file into your project root, or any location that makes sense in the context of your project.
 * - Make sure to update your phpunit.xml file, update <phpunit bootstrap="{path_to}/Bootstrap.php">
 * - If you are using the bootstrap to bootstrap autoloading, make sure to update the path to autoload.php
 *
 * Also note, you may not even need this Bootstrap. Don't feel like
 * you have to have it for your project. You can include the autoloader file
 * into your testing suite in other ways (phpunit.xml).
 *
 * However, in case you need to do some REAL Bootstrappin', and need/want
 * to use PHP to run some functionality before your tests begin, then
 * you probably will need this file. You can simply implement this class
 * any way you want.
 *
 */

// For shits and giggles
error_reporting(E_ALL | E_STRICT);

// This assumes your project is using composer, that the dependencies
// are contained in the vendor directory of your project and
// that composer has generated the autoloader file
require_once('./vendor/autoload.php');

// You can write if you want to, you can Write::write('Write::write(\'write\'));
use SeleniumPhp\Writer\Writer;
use SeleniumPhp\Config\ConfigFactory;

/**
 * Class Bootstrap
 */
class Bootstrap
{
    /**
     * Add your initialization routine here.
     */
    public static function init($options = array())
    {
        ConfigFactory::getInstance()->setOptions($options);
        Writer::write('Bootstrap::init() complete');
    }
}

// Init all the things
Bootstrap::init(
    array(
        // Modify this to set project appropriate configuration file path
        // Default assumption is that your test runner or phpunit.xml file
        // will define SELENIUM_PHP_TEST_CONFIG_PATH or that your test
        // configuration is in the /tests/config/ directory.
        'configurationFilePath' =>
            defined('SELENIUM_PHP_TEST_CONFIG_PATH') ?
                SELENIUM_PHP_TEST_CONFIG_PATH :
                __DIR__ . '/tests/config/',
    )
);
