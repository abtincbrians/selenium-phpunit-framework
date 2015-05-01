#!/usr/bin/env bash


echo "What environment are you testing? Type (prod, dev, local, other), followed by [ENTER]:"
read environment

if [[ $environment == "prod" ]]
then
    url="http://www.armacell.us/"
elif [[ $environment == "dev" ]]
then
    url="http://armacell-01.dev.atlanticbt-server.com/"
elif [[ $environment == "local" ]]
then
    url="http://armacell.dev/"
elif [[ $environment == "other" ]]
then
    echo "Enter the url to test, make sure to include protocol (http://, https://), followed by [ENTER]:"
    read url
else
    echo "Sorry, I did not understand your answer"
    exit
fi


echo "What browser are you testing? Type (firefox, chrome, other), followed by [ENTER]:"
read browser

if [[ $browser == "firefox" ]]
then
    browser="*firefox"
elif [[ $browser == "chrome" ]]
then
    browser="*googlechrome"
elif [[ $browser == "other" ]]
then
    echo "Enter the browser to test, followed by [ENTER]:"
    read browser
    browser="*$browser"
else
    echo "Sorry, I did not understand your answer"
    exit
fi


#browser="*googlechrome"
#url="http://www.armacell.us/"


# Allows us to define browser to use for testing
# This could/would be modified for per-browser use (i.e. cross browser compatibility testing)
export TEST_BROWSER="$browser"

# Allows us to define the base URL for our tests
# This would/could be modified for per-environment use (i.e. vagrant, dev, staging, production)
export TEST_URL="$url"


# Start Selenium server
java -jar vendor/bin/selenium-server-standalone.jar &
last_pid=$!

# Wait, then run tests
sleep 3s

# Run Tests
vendor/bin/phpunit --verbose --debug

# Kill Selenium server
kill -KILL $last_pid