<?php

// This is the name of the service in OpenShift that connects to our API endpoint
// Any dashes (-) should be converted to underscores (_)
// We pull this in from an environment varaible if set, otherwise using the default
if ($_ENV['DB2_API_SERVICE_NAME']) {
    $apiInstanceName = $_ENV['DB2_API_SERVICE_NAME'];
} else {
    $apiInstanceName = 'DB2_READER_API';
}

// Here we set the endpoint of our API instance
$apiBaseUri = 'http://' . $_ENV[$apiInstanceName.'_SERVICE_HOST'] . ':' . $_ENV[$apiInstanceName.'_SERVICE_PORT'];

// This varaiable $apiBaseUri can then be used in all the pages

?>