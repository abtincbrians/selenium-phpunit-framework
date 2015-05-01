<?php
namespace SeleniumPhp;

use SeleniumPhp\Config\FileConfig;
use SeleniumPhp\Config\GlobalsConfig;
use SeleniumPhp\Config\EnvConfig;
use SeleniumPhp\Writer\Writer;
use Zend\Stdlib\ArrayUtils;
use PHPUnit_Extensions_SeleniumTestCase;

/**
 * Class TestCase
 *
 * 2015-05-01: Leaving this as an abstract class, though
 *              it no longer contains any abstract functions.
 *
 */
abstract class TestCase extends PHPUnit_Extensions_SeleniumTestCase
{
    /**
     * @var
     */
    protected $config;

    /**
     * @var
     */
    protected $configKey;

    /**
     * @param this
     */
    public function setConfig($config)
    {
        $this->config = $config;

        return $this->config;
    }

    /**
     * @return mixed
     */
    public function getConfig()
    {
        if (!isset($this->config)) {
            $this->config = new FileConfig($this->getConfigurationFromFiles());
            $this->config
                ->push(new GlobalsConfig())
                ->push(new EnvConfig());
        }

        return $this->config;
    }

    protected function getFileConfigurationPath()
    {
        $class_info = new \ReflectionClass($this);
        $configDirectory = dirname($class_info->getFileName()) . '/config/';

        return defined('SELENIUM_CONFIG_PATH') ? SELENIUM_CONFIG_PATH : $configDirectory;
    }

    /**
     * @param string $configDirectory
     * @return array
     */
    protected function getConfigurationFromFiles($configDirectory = null)
    {
        if (!isset($configDirectory)) {
            $configDirectory = $this->getFileConfigurationPath();
        }

        return
            ArrayUtils::merge(
                $this->getGlobalConfiguration($configDirectory),
                $this->getTestConfiguration($configDirectory)
            );
    }

    /**
     * @param string $configDirectory
     * @return array
     */
    protected function getGlobalConfiguration($configDirectory = null)
    {
        $config  = array();

        if (!isset($configDirectory)) {
            $configDirectory = $this->getFileConfigurationPath();
        }

        // Load global configs (configs marked .global)
        foreach (glob($configDirectory . "{,*.}global.php", GLOB_BRACE) as $filename) {
            if (is_readable($filename)) {
                $tempConfig = include $filename;
                $config     = ArrayUtils::merge($config, $tempConfig);
            }
        }

        return $config;
    }

    /**
     * @param string $configDirectory
     * @return array
     */
    protected function getTestConfiguration($configDirectory = null)
    {
        $config  = array();
        $testKey = $this->getConfigKey();
        if (!isset($configDirectory)) {
            $configDirectory = $this->getFileConfigurationPath();
        }

        // Load tests config files
        foreach (glob($configDirectory . "{,*.}test.php", GLOB_BRACE) as $filename) {
            if (is_readable($filename)) {
                $testsConfig = include $filename;
                $testConfig  = isset($testsConfig[$testKey]) ? $testsConfig[$testKey] : array();
                $config      = ArrayUtils::merge($config, $testConfig);
            }
        }

        return $config;
    }

    /**
     * @param $configKey
     * @return $this
     */
    public function setConfigKey($configKey)
    {
        $this->configKey = $configKey;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConfigKey()
    {
        if (!isset($this->configKey)) {
            $this->configKey = $this->defineConfigkey();
        }

        return $this->configKey;
    }

    /**
     * Use this in your child class to define a custom
     * config key, otherwise your test config key is
     * assumed to match your test's class name.
     *
     * Since class names for your tests *might* change (who knows)
     * it may be better to override this function to return
     * a specified key (ex: 'homepage')
     *
     * @return string
     */
    protected function defineConfigKey()
    {
        return get_called_class();
    }
}
