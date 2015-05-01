## Selenium + PHPUnit Blackbox Testing Framework

This is a quick proof-of-concept of how we PHPers at ABT *might* go about doing blackbox integration testing using PHPUnit and Selenium.

## Getting Started

* Make sure Java is installed (needed for Selenium Standalone Server)
* Make sure you have composer installed in the src directory
    ** url -sS https://getcomposer.org/installer | php
* Run composer to install external dependencies
    ** ABT dependencies may be added to composer at a later date/time
* Write your tests!!!
    ** Testing conventions should follow PHPUnit conventions
    ** Tests go in the src/tests directory
    ** Test class files should be named {SITE}{Page}Test.php
    ** Test functions should be named test{USE_CASE}
    ** Tests should use namespace and extend SeleniumPhp\TestCase
* There's a convenience script called test.runner.sh to run tests
    ** On command line, run ./test.runner.sh

## Motivation

The goal is to help PHP developers ease into blackbox (decidedly NOT unit oriented) testing using Selenium + PHPUnit.

## Contributors


## License

N/A

## Design

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