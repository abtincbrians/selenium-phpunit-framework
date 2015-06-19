<?php
namespace SeleniumPhp;

use SeleniumPhp\Config\ConfigFactory;
use SeleniumPhp\Config\ConfigInterface;
use PHPUnit_Extensions_Selenium2TestCase;
use SeleniumPhp\Configurable;
use SeleniumPhp\Writer\Writer; // Leave this in place for dev purposes

class TestCase extends PHPUnit_Extensions_Selenium2TestCase
{
    use Configurable;
}
