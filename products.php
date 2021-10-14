<?php
require_once('functions.php');
require_once('page-header.php');
require('vendor/autoload.php');

// This is the name of the service in OpenShift that connects to our API endpoint
// Any dashes (-) should be converted to underscores (_)
$apiInstanceName = $_ENV['DB2_API_SERVICE_NAME'] || 'DB2_READER_API';

// Include a way to return to the previous page
echo '<h4 class="ds-heading-4 ds-margin-t-b-2"><a href="index.php">&lt back to employee list</a></h4>
';

// Display title and description
echo '<div class="ds-row"><h2 class="ds-heading-1 ds-col-6">Product Info</h2>
<p class="ds-col-6 ds-margin-b-2">This information relates to the products that are listed in the Db2 database running
on AIX that we are connected to. These are in the PRODUCTS table of the sample database, and contain a mix of information
including some XML formatted data.</p>
</div>
';

// Collect the data from various endpoints

// First, set the endpoint of our API instance
$apiBaseUri = 'http://' . $_ENV[$apiInstanceName.'_SERVICE_HOST'] . ':' . $_ENV[$apiInstanceName.'_SERVICE_PORT'];

// Start with the product information
$rperfclient = new GuzzleHttp\Client([ 'base_uri'=>$apiBaseUri]);
$rperfresponse = $rperfclient->request('GET', 'getProducts' . $_GET['id']);
$content = $rperfresponse->getBody();
$jsonContent = json_decode($content, false);
if ($jsonContent->success == 1) {
    $products = $jsonContent->data;

    // Now we can render our page
    echo '<div class="ds-margin-t-b-2">';
    drawProducts($products);
    echo '</div>';

// If the lookup fails, provide information
} else {
    echo '<div class="ds-margin-t-b-2">API call to look up products has failed.
    ' . print_r($jsonContent) . '
    </div>';
}

// Include a way to return to the original page
echo '<br />
<h4 class="ds-heading-4 ds-margin-t-b-2"><a href="index.php">&lt back to employee list</a></h4>
';

// Add footer from template
require_once('page-footer.php');
?>