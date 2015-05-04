<?php
namespace SeleniumPhp\Config;

/**
 * Class FileConfig
 * @package SeleniumPhp\Config
 */
class FileConfig extends AbstractConfig
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
}
