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

    // Get the sales manual link
    // $smclient = new GuzzleHttp\Client([ 'base_uri'=>'http://smfinder:8080/']);
    // $smresponse = $smclient->request('GET', '?mtm=' . $modelType);
    // $smurl = $smresponse->getBody();

    // Then use that to get the dates
    // $srclient = new GuzzleHttp\Client([ 'base_uri'=>'http://smreader:8080/']);
    // $srresponse = $srclient->request('GET', '?url=' . $smurl);
    // $srdetails = $srresponse->getBody();
    // $dates = json_decode($srdetails,false);

    // Now we can render our page
    renderPerson($person);

// If the lookup fails, provide information
} else {
    echo '<div class="ds-pad-b-3">API call to look up employee has failed.
    ' . $jsonContent . '
    </div>';
}

// Include a way to return to the previous page
echo '<h4 class="ds-heading-4 ds-col-10"><a href="index.php">&lt back to employee list</a></h4>
';

echo '</div>';

// Add footer from template
require_once('page-footer.php');
?>