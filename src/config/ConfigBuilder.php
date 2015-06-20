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
    public function build($context = null)
    {
        if (isset($context)) {
            $this->options[ConfigFactory::KEY_CONTEXT] = $context;
        }

        $config = new GenericConfig($this->getOptions());
        $config
            ->push(new GlobalFileConfig($this->getOptions()))
            ->push(new TestFileConfig($this->getOptions()))
            ->push(new GlobalsConfig($this->getOptions()))
            ->push(new EnvConfig($this->getOptions()));

        return $config;
    }
}