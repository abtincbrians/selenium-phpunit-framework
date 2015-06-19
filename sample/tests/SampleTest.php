<?php

use SeleniumPhp\TestCase;

/**
 * Class SampleHomePageTest
 *
 * This is a sample test. You probably don't want to include
 * this in your real test suite. This will get you started.
 *
 */
class SampleTest extends TestCase
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
        $this->url("/");

        $this->waitUntil(function($testCase) {
            if (strlen($testCase->source()) > 0) {
                return true;
            }
        }, 0);

        $this->assertNotEmpty($this->source());
    }
}
