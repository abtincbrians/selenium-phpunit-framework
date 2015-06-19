<?php

use SeleniumPhp\TestCase;

/**
 * Class SampleHomePageTest
 *
 * This is a sample test. You probably don't want to include
 * this in your real test suite. This will get you started.
 *
 */
class SampleHomePageTest extends TestCase
{
    /**
     * Setup Function. This is where you run any functionality required to
     * setup your tests.
     */
    protected function setUp()
    {
        $this->setBrowser($this->getConfig()->getConfiguredValue('browser'));
        $this->setBrowserUrl($this->getConfig()->getConfiguredValue('url'));
        $this->setHost($this->getConfig()->getConfiguredValue('host'));
        $this->setPort($this->getConfig()->getConfiguredValue('port'));
    }

    /**
     * This is a test.
     */
    public function testHomePageLoads()
    {
        $this->open("");
        $this->selectWindow("null");
        $this->assertContains($this->getConfig()->getConfiguredValue('pageTitle'), $this->getTitle());
    }
}
