<?php
require_once('functions.php');
require_once('page-header.php');
require('vendor/autoload.php');
require('connection.php');

// Display title and description
echo '<h2 class="ds-heading-1 ds-col-10">Chicago Airbnb Listing Info.</h2>
<p class="ds-col-10 ds-margin-b-2">Access information from our sample database that represents Airbnb listing data.</p>
';

// Collect the data from various endpoints

// Start with the listing information - we use the API endpoint 
$rperfclient = new GuzzleHttp\Client([ 'base_uri'=>$apiBaseUri]);
$rperfresponse = $rperfclient->request('GET', 'findall');
$content = $rperfresponse->getBody();
$jsonContent = json_decode($content, false);

    // Now we can render our page
echo '<h3 class="ds-heading-2 ds-col-10">Listings</h3>
<p class="ds-col-10 ds-margin-b-2">Here is a directory of all of our listings. Click on a listing to get more information about it.</p>
';
drawTable($jsonContent);

/*if ($jsonContent->success == 1) {
    $listings = $jsonContent->data[];

    // Now we can render our page
    echo '<h3 class="ds-heading-2 ds-col-10">Listings</h3>
    <p class="ds-col-10 ds-margin-b-2">Here is a directory of all of our listings. Click on a listing to get more information about it.</p>
    ';
    // The function drawTable can be found in functions.php
    drawTable($listings);

// If we don't have access to the API or database, provide information
} else {
    echo '<div class="ds-margin-t-b-2">API call to look up all listings has failed (index.php).
    ' . print_r($jsonContent) . '
    </div>';
}*/
echo '<p class="ds-col-10 ds-margin-b-2">&nbsp</p>';

// Add footer from template
require_once('page-footer.php');
?>
