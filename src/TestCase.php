<?php
namespace SeleniumPhp;

use HierarchicalConfig\Config\ConfigInterface;
use HierarchicalConfig\Config\ConfigFactory;
use HierarchicalConfig\Configurable;
use PHPUnit_Extensions_Selenium2TestCase;

/**
 * Class TestCase
 * @package SeleniumPhp
 */
class TestCase extends PHPUnit_Extensions_Selenium2TestCase
{
    use Configurable;
}
