<?php
namespace SeleniumPhp\Config;

use SeleniumPhp\Config\ConfigInterface;
use SeleniumPhp\Config\GenericConfig;
use SeleniumPhp\Config\TestFileConfig;
use SeleniumPhp\Config\GlobalFileConfig;
use SeleniumPhp\Config\GlobalsConfig;
use SeleniumPhp\Config\EnvConfig;
use SeleniumPhp\Writer\Writer;


/**
 * Class ConfigFactory
 * @package SeleniumPhp\Config
 */
class ConfigFactory
{
    // Hold an instance of the class
    /**
     * @var
     */
    private static $instance;

    protected $options = array();


    // The singleton method
    /**
     * @return ConfigFactory
     */
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param null $context
     * @return ConfigInterface
     */
    public function getConfig($context = null)
    {
        return $this->initConfig($context);
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setOptions($options)
    {
        $this->options = $options;
        return $this;
    }

    /**
     * @return array
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * You need to call setup before using this baby.
     *
     * @param string $context
     * @return ConfigInterface
     */
    protected function initConfig($context = null)
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