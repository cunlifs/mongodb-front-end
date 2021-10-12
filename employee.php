<?php
require_once('functions.php');
require_once('page-header.php');
require('vendor/autoload.php');

// This is the name of the service in OpenShift that connects to our API endpoint
// Any dashes (-) should be converted to underscores (_)
$apiInstanceName = 'DB2_READER_API';

// Display title and description
echo '<h2 class="ds-heading-1 ds-col-10">Employee Info</h2>
<p class="ds-col-10 ds-margin-bottom-2">Access information from our sample database that represents company data.</p>
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
    echo '<h3 class="ds-heading-2 ds-col-10">' . $person->FIRSTNME . ' ' . $person->MIDINIT . ' ' . $person->LASTNAME . '</h3>
    <h4 class="ds-heading-3 ds-col-10">' . $person->JOB . '
    <p class="ds-col-10 ds-margin-bottom-2">
    
    </p>
    ';
    drawTable($people);

// If we don't have both machine type and model, provide instructions
} else {
    echo '<div class="ds-pad-b-3">API call to look up employee has failed.
    ' . $jsonContent . '
    </div>';
}

echo '</div>';

// Add footer from template
require_once('page-footer.php');
?>