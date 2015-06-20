<?php
namespace SeleniumPhp;

use SeleniumPhp\Config\ConfigFactory;
use SeleniumPhp\Config\ConfigInterface;
use PHPUnit_Extensions_SeleniumTestCase;
use SeleniumPhp\Writer\Writer; // Leave this in place for dev purposes

trait Configurable
{
    /**
     * @var ConfigInterface
     */
    protected $config;

    /**
     * @var string
     */
    protected $configKey;

    /**
     * @param ConfigInterface $config
     * @return mixed
     */
    public function setConfig(ConfigInterface $config)
    {
        $this->config = $config;

        return $this;
    }

    /**
     * @return ConfigInterface
     */
    public function getConfig()
    {
        if (!isset($this->config)) {
            $this->config =
                ConfigFactory::getInstance()->getConfig($this->getConfigKey());
        }

        return $this->config;
    }

    /**
     * @param string $configKey
     * @return $this
     */
    public function setConfigKey($configKey)
    {
        $this->configKey = $configKey;
        return $this;
    }

    /**
     * @return string
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
