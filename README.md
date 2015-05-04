## Selenium + PHPUnit Black Box Testing Framework
=================================================

This is a proof-of-concept black box testint framework + test scaffolding that seeks to integrate PHPUnit and Selenium.

## GETTING STARTED

### Installation

#### Composer

Add the following to your repositories (in composer.json)

    {
        "type":"composer",
        "url":"http://satis.atlanticbt.com"
    }

Add the following dependency ( require in composer.json)

    "require": {
        "atlanticbt/selenium-phpunit-framework" : "dev-master"
    }

Download composer.phar in your project

    curl -sS https://getcomposer.org/installer | php

Install dependencies

    php composer.phar install


#### Sample Files

The sample files are optional, depending on your project and project requirements. These instructions assume you have installed the package into the vendor directory of your project root using Composer. If that's not the case, adjust paths accordingly.

Bootstrap

* Copy vendor/atlanticbt/selenium-phpunit-framework/sample/Bootstrap.sample.php into the project root
* Rename the file to Bootstrap.php

PHPUnit

* Copy vendor/atlanticbt/selenium-phpunit-framework/sample/phpunit.sample.xml into your project root
* Rename file to phpunit.xml
* Update appropriately for your project

Tests

* Copy vendor/atlanticbt/selenium-phpunit-framework/sample/tests directory into your project root
* Copy (and rename) the files in tests/config, remove the .dist extension
* Update tests/config/global.php with global configuration (such as site base url)
* Update /tests/config/test.php with test specific configuration
* Write your tests, you can use tests/SampleHompePageTest.php to start, but eventually you'll want to remove that from your project


## MOTIVATION

The goal is to help PHP developers ease into black box (decidedly NOT unit oriented) testing using Selenium + PHPUnit.

## Contributors

* Brian Shirey <brian.shirey@atlanticbt.com>

## LICENSE

N/A

## DESIGN

* These testing framework doesn't do much yet, and what it does will need refactoring.
* Primarily, this abstracts out configuration / setup.
* Configuration is based on precedence, we have ...
    ** Global Configuration (shared amongst all tests) in src/tests/config/global.php
        *** PHP indexed array
        *** Any file of the format {*.}global.php will be read into global config
    ** Test Configuration (for individual test classes) in src/tests/config/test.php
        *** PHP indexed array, each class defines a key (i.e. 'login')
        *** Any file of the format {*.}test.php will be read into test-specific config
    ** PHP GLOBALS
        *** For instance, as defined by phpunit.xml
    ** Environment Variables
        *** For instance, set in test.runner.sh
* Configuration precedence is (highest to lowest) Environment Variables overwrite GLOBALS overwrite Test Configurations overwrite Global Configurations
* This setup allows environment specific values so that we can use the test runner to run the tests on different environments (production versus develop server versus local vagrant)