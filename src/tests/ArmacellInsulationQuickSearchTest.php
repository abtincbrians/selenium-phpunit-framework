<?php

use SeleniumPhp\TestCase;

class ArmacellInsulationQuickSearchTest extends TestCase
{
    // Example where we override the config key for this test
    protected function defineConfigKey()
    {
        return 'quicksearch';
    }

    protected function setUp()
    {
        $this->setBrowser($this->getConfig()->getConfiguredValue('browser'));
        $this->setBrowserUrl($this->getConfig()->getConfiguredValue('url'));
    }


    public function testResultsNonZeroOnLoad()
    {
        $this->open($this->getConfig()->getConfiguredValue('path'));
        $this->selectWindow("null");
        $this->waitForPageToLoad();
        sleep(3);
        $this->assertNotEquals("Products (0)", $this->getText("css=h1.ng-binding"));
    }

    public function testResultsZeroOnBadSearchTerm()
    {
        $this->open($this->getConfig()->getConfiguredValue('path'));
        $this->selectWindow("null");
        $this->waitForPageToLoad();
        sleep(3);
        $this->type("xpath=(//input[@type='text'])[2]", "zzzzlmnopzzz");
        sleep(3);
        $this->assertEquals("Products (0)", $this->getText("css=h1.ng-binding"));
    }
}

