<?php
namespace SeleniumPhp\Config;

use HierarchicalConfig\Config\FileConfig;
use Zend\Stdlib\ArrayUtils;

/**
 * Class FileConfig
 * @package SeleniumPhp\Config
 */
class TestFileConfig extends FileConfig
{
    /**
     * @param $key
     * @param null $default
     * @param bool $allowOverride
     * @return mixed
     */
    public function getConfiguredValue($key, $default = null, $allowOverride = true)
    {
        $myValue = $this->config->get($key, $default);

        return $this->deferToChild($key, $myValue, $allowOverride);
    }

    /**
     *
     * @return array
     */
    protected function readConfigurationFiles()
    {
        $config  = array();
        $context = $this->getContext();

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
