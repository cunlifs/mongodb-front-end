<?php
require_once('functions.php');
require_once('page-header.php');
require('vendor/autoload.php');
require('connection.php');

// Include a way to return to the previous page
echo '<h4 class="ds-heading-4 ds-margin-t-b-2"><a href="index.php">&lt back to employee list</a></h4>
';

// Display title and description
echo '<div class="ds-row"><h2 class="ds-heading-1 ds-col-6">Employee Info</h2>
<p class="ds-col-6 ds-margin-b-2">This information relates to the employee that you selected from the previous list.
We have called against another API endpoint to pull this data from our database.</p>
</div>
';

// Collect the data from various endpoints

// Start with the employee information - we use the API endpoint /getEmployee
$rperfclient = new GuzzleHttp\Client([ 'base_uri'=>$apiBaseUri]);
$rperfresponse = $rperfclient->request('GET', 'getEmployee?id=' . $_GET['id']);
$content = $rperfresponse->getBody();
$jsonContent = json_decode($content, false);
if ($jsonContent->success == 1) {
    $person = $jsonContent->data[0];

    // Now we can render our page using that data
    // The remderPerson function can be found in functions.php
    renderPerson($person);

// If the lookup fails, provide information
} else {
    echo '<div class="ds-margin-t-b-2">API call to look up employee has failed.
    ' . print_r($jsonContent) . '
    </div>';
}

// Include a way to return to the previous page
echo '<br />
<h4 class="ds-heading-4 ds-margin-t-b-2"><a href="index.php">&lt back to employee list</a></h4>
';

// Add footer from template
require_once('page-footer.php');
?>