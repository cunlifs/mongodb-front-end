<?php

// This function takes the details of a $listing and creates a row in a table with that information
function drawLine($listing) {
    echo '<tr>';
    echo '<td><a href="listing.php?id=' . $listing->id . '">' . $listing->id . '</a></td>';
    echo '<td>' . $listing->name . '</td>';
    echo '<td>' . $listing->host_name . '</td>';
    echo '<td>' . $listing->host_location . '</td>';
    echo '<td>' . $person->property_type . '</td>';
    echo '</tr>
    ';
}

// This function produces the HTML to construct a table with a row for each of the listings in the $listing object
function drawTable($listings) {
    echo '<div class="ds-table-container ds-col-8">
    <table class="ds-table ds-table-compact ds-striped ds-hover">
    ';
    echo '<tr><th> ID </th><th> Property Name</th><th>Host Name</th><th>Host Location</th><th>Property Type</th></tr>
    ';
    // Iterate over the set of listings and create a row in the table
    foreach($listing as $listings) {
        // We call the drawLine function for each $listing in $listings
        drawLine($listing);
    }
    echo '</table></div>
    ';
}

////------- below unedited, will investigate once the above is confirmed to work


// This function produces the HTML to construct a listing for a single property using data held in the $listing object
function renderListing($listing) {
    // The following steps demonstrate that the data coming back from the API calls to the database can be manipulated
    // within the front-end code to provide further insights and more detail to the end user.
    // We are not limited to using just the data that comes from our API calls.

    // Here we are using the database entry 'SEX' to represent Gender and implying pronouns (possibly incorrectly)
    if ($person->SEX == 'M') {
        $pronoun = 'He';
        $descriptor = 'has';
    } else if ($person->SEX == 'F') {
        $pronoun = 'She';
        $descriptor = 'has';
    } else {
        $pronoun = 'They';
        $descriptor = 'have';
    }

    // Create a nicely formatted version of the person's firstname
    $firstname = ucfirst(strtolower($person->FIRSTNME));

    // We can calculate the total annual earnings of this individual
    $totalEarnings = $person->SALARY + $person->BONUS + $person->COMM;

    // We calculate some figures based on dates
    $startdate = new DateTime($person->HIREDATE);
    $birthdate = new DateTime($person->BIRTHDATE);
    $todaydate = new DateTime('now');

    $age = $todaydate->diff($birthdate);
    $employmenttime = $todaydate->diff($startdate);
    $startage = $startdate->diff($birthdate);

    // Present a message if it's this employee's birthday today
    if ($birthdate->format('m') == $todaydate->format('m') && $birthdate->format('d') == $todaydate->format('d')) {
        echo '<div class="ds-row"><div class="ds-col-6 ds-alert ds-success ds-mar-t-1">
        <p>Today is ' . $firstname . '\'s Birthday!</p>
        </div></div>';
    }

    // Here we present that information to the user
    echo '<div class="ds-row">
    <div class="ds-col-6 ds-shadow-floating ds-bg-neutral-2">
    <h3 class="ds-heading-2 ds-margin-t-2">' . $person->FIRSTNME . ' ' . $person->MIDINIT . ' ' . $person->LASTNAME . '</h3>
    <div class="ds-hr-thick"></div>
    <h4 class="ds-heading-3 ds-margin-t-b-2">' . $person->JOB . '</h4>
    <p class="ds-margin-b-2">
    ' . $firstname . ' is ' . $age->y . ' years old. <br />
    ' . $pronoun . ' ' . $descriptor . ' worked here for ' . $employmenttime->y . ' years. <br />
    ' . $pronoun . ' started at the age of ' . $startage->y . '.
    </p>
    <h4 class="ds-heading-3">Earnings</h4>
    <div class="ds-table-container">
    <table class="ds-table ds-table-compact">
    <tr><th>Annual Salary</th><th>Bonus</th><th>Commission</th></tr>
    <tr><td class="ds-text-align-right">$' . $person->SALARY . '</td><td class="ds-text-align-right">$' . $person->BONUS . '</td><td class="ds-text-align-right">$' . $person->COMM . '</td></tr>
    <tr><td>&nbsp</td><td class="ds-text-align-right">Total compensation:</td><td class="ds-text-align-right">$' . $totalEarnings . '</td></tr>
    </table>
    <p class="ds-margin-b-2">&nbsp</p>
    </div></div></div>
    ';
}

// This function creates the HTML to construct a tile for each product using data in $product
function renderProduct($product) {
    // Handle the XML content to make it an object in PHP
    $description = simplexml_load_string($product->DESCRIPTION);

    // Render our page with the name, details, and price of the product
    echo '<div class="ds-shadow-floating ds-col-4 ds-mar-t-b-2 ds-mar-l-r-2 ds-bg-neutral-2">
    <h2 class="ds-heading-3">' . $product->NAME . '</h2>
    <p class="ds-mar-t-b-2">' . $description->description->details . '</p>';

    // Only present the weight of the item if one is included in the listing
    if ($description->description->weight) {
        echo '<p class="ds-mar-t-b-2">Weight: ' . $description->description->weight . '</p>';
    }

    // Add the price to the bottom of the listing
    echo '<h3 class="ds-heading-3 ds-text-align-right">$' . number_format($product->PRICE) . '</h3>
    ';
    echo '</div>';
}

// This function creates tiles for each of the products in $products
function drawProducts($products) {
    // Iterate through the products in the array and render each
    foreach($products as $product) {
        renderProduct($product);
    }
}

?>
