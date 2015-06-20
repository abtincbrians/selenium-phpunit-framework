<?php
namespace SeleniumPhp\Config;

use HierarchicalConfig\Config\ConfigInterface;
use HierarchicalConfig\Config\ConfigBuilderInterface;
use HierarchicalConfig\Config\GenericConfig;
use HierarchicalConfig\Config\GlobalsConfig;
use HierarchicalConfig\Config\EnvConfig;
use HierarchicalConfig\Writer\Writer;

use SeleniumPhp\Config\TestFileConfig;
use SeleniumPhp\Config\GlobalFileConfig;


/**
 * Class ConfigFactory
 * @package SeleniumPhp\Config
 */
class ConfigBuilder implements ConfigBuilderInterface
{
    public function build($options = array())
    {
        $config = new GenericConfig($options);
        $config
            ->push(new GlobalFileConfig($options))
            ->push(new TestFileConfig($options))
            ->push(new GlobalsConfig($options))
            ->push(new EnvConfig($options));

        return $config;
    }
}