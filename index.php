<?php
require_once('functions.php');
require_once('page-header.php');
require('vendor/autoload.php');
require('connection.php');

// Display title and description
echo '<h2 class="ds-heading-1 ds-col-10">Company Info</h2>
<p class="ds-col-10 ds-margin-b-2">Access information from our sample database that represents company data. You can also see some information
on the <a href="products.php">products</a> that we sell, also pulled from the same databaase, but from a different table.</p>
';

// Collect the data from various endpoints

// Start with the employee information - we use the API endpoint /getAllEmployees
$rperfclient = new GuzzleHttp\Client([ 'base_uri'=>$apiBaseUri]);
$rperfresponse = $rperfclient->request('GET', 'getAllEmployees');
$content = $rperfresponse->getBody();
$jsonContent = json_decode($content, false);
if ($jsonContent->success == 1) {
    $people = $jsonContent->data;

    // Now we can render our page
    echo '<h3 class="ds-heading-2 ds-col-10">Employees</h3>
    <p class="ds-col-10 ds-margin-b-2">Here is a directory of all of our employees. Click on an employee number to get more information about that individual.</p>
    ';
    // The function drawTable can be found in functions.php
    drawTable($people);

// If we don't have access to the API or database, provide information
} else {
    echo '<div class="ds-margin-t-b-2">API call to look up all employees has failed.
    ' . print_r($jsonContent) . '
    </div>';
}
echo '<p class="ds-col-10 ds-margin-b-2">&nbsp</p>';

// Add footer from template
require_once('page-footer.php');
?>