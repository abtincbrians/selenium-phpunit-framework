<?php

use SeleniumPhp\TestCase;
use SeleniumPhp\Writer\Writer;

class ArmacellInsulationHomePageTest extends TestCase
{
    protected function setUp()
    {
        $this->setBrowser($this->getConfig()->getConfiguredValue('browser'));
        $this->setBrowserUrl($this->getConfig()->getConfiguredValue('url'));
    }

    public function testHomePageLoads()
    {
        $this->open("");
        $this->selectWindow("null");
        $this->assertContains($this->getConfig()->getConfiguredValue('pageTitle'), $this->getTitle());
    }

    public function testHomePageSliderGear()
    {
        $this->open("");
        $this->click("css=span.icon-gear");
        $this->assertTrue($this->isVisible("id=tab2"));
    }

    public function testHomePageSliderDrop()
    {
        $this->open("");
        $this->click("css=span.icon-drop");
        $this->assertTrue($this->isVisible("id=tab3"));
    }

    public function testHomePageSliderFan()
    {
        $this->open("");
        $this->click("css=span.icon-fan");
        $this->assertTrue($this->isVisible("id=tab4"));
    }

    public function testHomePageSliderSpiral()
    {
        $this->open("");
        $this->click("css=span.icon-spiral");
        $this->assertTrue($this->isVisible("id=tab6"));
    }
}

