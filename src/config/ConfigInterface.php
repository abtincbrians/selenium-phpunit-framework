<?php
namespace SeleniumPhp\Config;

/**
 * Interface ConfigInterface
 * @package SeleniumPhp\Config
 */
Interface ConfigInterface
{
    const KEY_CONTEXT = 'context';

    /**
     * @param $key
     * @param null $default
     * @param bool $allowOverride
     * @return mixed
     */
    public function getConfiguredValue($key, $default = null, $allowOverride = true);

    /**
     * @param ConfigInterface $config
     * @return mixed
     */
    public function push(ConfigInterface $config);
}
