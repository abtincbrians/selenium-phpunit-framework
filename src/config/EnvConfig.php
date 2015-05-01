<?php
namespace SeleniumPhp\Config;

class EnvConfig extends AbstractConfig
{
    /**
     * @param $key
     * @param null $default
     * @param bool $allowOverride
     * @return null|string
     */
    public function getConfiguredValue($key, $default = null, $allowOverride = true)
    {
        $myKey   = $this->makeKey($key);
        $myValue = getenv($myKey) ? getenv($myKey) : $default;

        return $this->deferToChild($key, $myValue, $allowOverride);
    }

    /**
     * @param $key
     * @return string
     */
    protected function makeKey($key)
    {
        return 'TEST_' . strtoupper($key);
    }
}
