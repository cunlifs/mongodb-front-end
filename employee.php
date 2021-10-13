<?php
require_once('functions.php');
require_once('page-header.php');
require('vendor/autoload.php');

// This is the name of the service in OpenShift that connects to our API endpoint
// Any dashes (-) should be converted to underscores (_)
$apiInstanceName = 'DB2_READER_API';

// Include a way to return to the previous page
echo '<h4 class="ds-heading-4 ds-col-10"><a href="index.php">&lt back to employee list</a></h4>
';

// Display title and description
echo '<h2 class="ds-heading-1 ds-col-10">Employee Info</h2>
<p class="ds-col-10 ds-margin-bottom-2">This information relates to the employee that you selected from the previous list.
We have called against another API endpoint to pull this data from our database.</p>
';
echo '<p class="ds-col-10 ds-margin-bottom-2">&nbsp</p>';

// Collect the data from various endpoints

// First, set the endpoint of our API instance
$apiBaseUri = 'http://' . $_ENV[$apiInstanceName.'_SERVICE_HOST'] . ':' . $_ENV[$apiInstanceName.'_SERVICE_PORT'];

// Start with the employee information
$rperfclient = new GuzzleHttp\Client([ 'base_uri'=>$apiBaseUri]);
$rperfresponse = $rperfclient->request('GET', 'getEmployee?id=' . $_GET['id']);
$content = $rperfresponse->getBody();
$jsonContent = json_decode($content, false);
if ($jsonContent->success == 1) {
    $person = $jsonContent->data[0];

    // Now we can render our page
    renderPerson($person);

// If the lookup fails, provide information
} else {
    echo '<div class="ds-pad-b-3">API call to look up employee has failed.
    ' . $jsonContent . '
    </div>';
}

// Include a way to return to the previous page
echo '<br />
<h4 class="ds-heading-4 ds-col-10"><a href="index.php">&lt back to employee list</a></h4>
';

echo '<p class="ds-col-10 ds-margin-bottom-2">&nbsp</p>';

// Add footer from template
require_once('page-footer.php');
?>