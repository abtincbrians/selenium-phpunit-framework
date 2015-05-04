<?php
namespace SeleniumPhp\Config;

/**
 * Class GlobalsConfig
 * @package SeleniumPhp\Config
 */
class GlobalsConfig extends EnvConfig
{
    /**
     * @param $key
     * @param null $default
     * @param bool $allowOverride
     * @return null
     */
    public function getConfiguredValue($key, $default = null, $allowOverride = true)
    {
        $myKey   = $this->makeKey($key);
        $myValue = isset($GLOBALS[$myKey]) ? $GLOBALS[$myKey] : $default;

        return $this->deferToChild($key, $myValue, $allowOverride);
    }
}
