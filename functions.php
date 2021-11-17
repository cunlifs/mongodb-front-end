<?php

// This function takes the details of a $listing and creates a row in a table with that information
function drawLine($listing) {
    echo '<tr>';
    echo '<td><a href="listing.php?id=' . $listing['id'] . '">' . $listing['id'] . '</a></td>';
    echo '<td>' . $listing['host_id'] . '</td>';
    echo '<td>' . $listing['beds'] . '</td>';
    echo '<td>' . $listing['bedrooms'] . '</td>';
    echo '<td>' . $listing['accommodates'] . '</td>';
    echo '</tr>
    ';
}

// This function produces the HTML to construct a table with a row for each of the listings in the $listing object
function drawTable($listings) {
    echo '<div class="ds-table-container ds-col-8">
    <table class="ds-table ds-table-compact ds-striped ds-hover">
    ';
    echo '<tr><th>Listing ID</th><th>Host ID</th><th>Beds</th><th>Bedrooms</th><th>Accommodates</th></tr>
    ';
    // Iterate over the set of listings and create a row in the table
    foreach($listings as $listing) {
        // We call the drawLine function for each $listing in $listings
        drawLine($listing);
    }
    echo '</table></div>
    ';
}

?>
