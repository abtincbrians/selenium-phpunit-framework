<?php
namespace SeleniumPhp\Config;

use Zend\Stdlib\ArrayUtils;

/**
 * Class FileConfig
 * @package SeleniumPhp\Config
 */
abstract class FileConfig extends AbstractConfig
{
    /**
     * @var
     */
    protected $configFilePath;

    /**
     * @var null
     */
    protected $context = null;

    /**
     *
     * @return array
     */
    abstract protected function readConfigurationFiles();

    /**
     * @param array $config
     */
    public function __construct($config = array())
    {
        $config = $this->doPreSetup($config);
        $config = $this->doSetup($config);
        $config = $this->doPostSetup($config);

        parent::__construct($config);
    }

    /**
     * Override in child if you need to override core config setup.
     *
     * @param array $config
     * @return array
     */
    protected function doSetup($config = array())
    {
        // Catch the configuration file path
        if (isset($options['configurationFilePath'])) {
            $this->configFilePath = $config['configurationFilePath'];
        } else {
            // Also consider throwing an exception here instead
            // of failing silently
            return $config;
        }

        // Catch the context
        if (isset($options[ConfigInterface::KEY_CONTEXT])) {
            $this->context = $config[ConfigInterface::KEY_CONTEXT];
        }

        return $this->readConfigurationFiles();
    }

    /**
     * Override in child if you need to manipulate the starting config.
     *
     * @param array $config
     * @return array
     */
    protected function doPreSetup($config = array())
    {
        return $config;
    }

    /**
     * Override in child if you need to manipulate the final config.
     *
     * @param array $config
     * @return array
     */
    protected function doPostSetup($config = array())
    {
        return $config;
    }

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

    /**
     * @param null $context
     * @return $this
     */
    public function setContext($context)
    {
        $this->context = $context;
        return $this;
    }

    /**
     * @return null
     */
    public function getContext()
    {
        return $this->context;
    }
}
