<?php
namespace SeleniumPhp\Config;

use Zend\Stdlib\ArrayUtils;
/**
 * Class FileConfig
 * @package SeleniumPhp\Config
 */
class GlobalFileConfig extends FileConfig
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

        // Load global configs (configs marked .global)
        foreach (glob($this->getConfigFilePath() . "{,*.}global.php", GLOB_BRACE) as $filename) {
            if (is_readable($filename)) {
                $tempConfig = include $filename;
                $config     = ArrayUtils::merge($config, $tempConfig);
            }
        }

        return $config;
    }
}
