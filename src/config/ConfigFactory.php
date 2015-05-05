<?php
namespace SeleniumPhp\Config;

use SeleniumPhp\Config\FileConfig;
use SeleniumPhp\Config\GlobalsConfig;
use SeleniumPhp\Config\EnvConfig;
use SeleniumPhp\Writer\Writer;
use Zend\Stdlib\ArrayUtils;

/**
 * Class ConfigFactory
 * @package SeleniumPhp\Config
 */
class ConfigFactory
{
    // Hold an instance of the class
    private static $instance;

    protected $configFilePath;

    // The singleton method
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param string $configFilePath
     * @return this
     */
    public function setConfigFilePath($configFilePath)
    {
        $this->configFilePath = $configFilePath;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConfigFilePath()
    {
        if (!isset($this->configFilePath)) {
            $this->configFilePath = __DIR__ . '/config/';
        }

        return $this->configFilePath;
    }

    public function setup($options = array())
    {
        if (isset($options['configurationFilePath'])) {
            $this->configFilePath = $options['configurationFilePath'];
        }
    }

    public function getConfiguration($context = null)
    {
        $config = new FileConfig($this->getConfigurationFromFiles($context));
        $config
            ->push(new GlobalsConfig())
            ->push(new EnvConfig());

        return $config;
    }


    public function getConfigurationFromFiles($context = null)
    {
        return
            ArrayUtils::merge(
                $this->getGlobalConfiguration(),
                $this->getTestConfiguration($context)
            );
    }

    protected function getGlobalConfiguration()
    {
        $config  = array();

        // Load global configs (configs marked .global)
        foreach (glob($this->getConfigFilePath() . "{,*.}global.php", GLOB_BRACE) as $filename) {
            if (is_readable($filename)) {
                $tempConfig = include $filename;
                $config     = ArrayUtils::merge($config, $tempConfig);
            }
        }

        return $config;
    }


   protected function getTestConfiguration($context = null)
    {
        $config  = array();

        if (isset($context) && is_string($context)) {
            // Load tests config files
            foreach (glob($this->getConfigFilePath() . "{,*.}test.php", GLOB_BRACE) as $filename) {
                if (is_readable($filename)) {
                    $testsConfig = include $filename;
                    $testConfig  = isset($testsConfig[$context]) ? $testsConfig[$context] : array();
                    $config      = ArrayUtils::merge($config, $testConfig);
                }
            }
        }

        return $config;
    }
}