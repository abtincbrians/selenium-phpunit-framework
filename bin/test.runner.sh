#!/usr/bin/env bash


echo "Type the URL of the site you want to test, followed by [ENTER]:"
read url

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