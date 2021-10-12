<?php
require_once('functions.php');
require_once('page-header.php');
require('vendor/autoload.php');

// Display title and description
echo '<h2 class="ds-heading-1 ds-col-10">Company Info</h2>
<p class="ds-col-10 ds-margin-bottom-2">Access information from our sample database that represents company data.</p>
';

// Collect the data from various endpoints

// First, set the endpoint of our API instance
$api_base_uri = 'http://' . $_ENV['DB2_READER_API_SERVICE_HOST'] . ':' . $_ENV['DB2_READER_API_SERVICE_PORT'];

// Start with the employee information
$rperfclient = new GuzzleHttp\Client([ 'base_uri'=>$api_base_uri]);
$rperfresponse = $rperfclient->request('GET', 'getAllEmployees');
$content = $rperfresponse->getBody();
$jsonContent = json_decode($content, false);
if ($jsonContent->success == 1) {
    $people = $jsonContent->data;

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
    echo '<h3 class="ds-heading-2 ds-col-10">Employees</h3>
    <p class="ds-col-10 ds-margin-bottom-2">Here is a directory of all of our employees. Click on an entry to get more information about them.</p>
    ';
    drawTable($people);

// If we don't have both machine type and model, provide instructions
} else {
    echo '<div class="ds-pad-b-3">API call to look up all employees has failed.
    ' . $jsonContent . '
    </div>';
}

echo '</div>';

// Add footer from template
require_once('page-footer.php');
?>