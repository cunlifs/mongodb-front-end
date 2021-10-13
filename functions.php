<?php

// This function takes the details of a $person and creates a row in a table with that information
function drawLine($person) {
    echo '<tr>';
    echo '<td><a href="employee.php?id=' . $person->EMPNO . '">' . $person->EMPNO . '</a></td>';
    echo '<td>' . $person->FIRSTNME . '</td>';
    echo '<td>' . $person->LASTNAME . '</td>';
    echo '<td>' . $person->JOB . '</td>';
    echo '<td>' . $person->DEPTNAME . '</td>';
    echo '</a></tr>
    ';
}

// This function produces the HTML to construct a table with a row for each of the people in the $people object
function drawTable($people) {
    echo '<div class="ds-table-container ds-col-10">
    <table class="ds-table ds-table-compact ds-striped ds-hover">
    ';
    echo '<tr><th>Employee number</th><th>First name</th><th>Last name</th><th>Job title</th><th>Department</th></tr>
    ';
    // Iterate over the set of people and create a row in the table
    foreach($people as $person) {
        drawLine($person);
    }
    echo '</table></div>
    ';
}

function renderPerson($person) {
    
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
        echo '<div class="ds-col-10 ds-alert ds-success ds-mar-t-1">
        <p>Today is ' . $firstname . '\'s Birthday!</p>
        </div>';
    }

    // Here we present that information to the user
    echo '<div class="ds-row ds-bg-neutral-2">
    <div class="ds-col-6 ds-shadow-floating">
    <div class="ds-hr-thick"></div>
    <h3 class="ds-heading-2">' . $person->FIRSTNME . ' ' . $person->MIDINIT . ' ' . $person->LASTNAME . '</h3>
    <div class="ds-hr-thick"></div>
    <h4 class="ds-heading-3">' . $person->JOB . '</h4>
    <p class="ds-margin-bottom-2">&nbsp</p>
    <p class="ds-margin-bottom-2">
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
    <p class="ds-margin-bottom-2">&nbsp</p>
    <div class="ds-hr-thick"></div>
    <p class="ds-margin-bottom-2">&nbsp</p>
    </div></div></div>
    ';
}

function renderProduct($product) {
    echo '<div class="ds-table-container ds-col-10">
    <table class="ds-table ds-table-compact ds-striped">
    ';
    echo '<tr><th>Announcement</th><th>General Availability</th><th>Withdrawn from Marketing</th><th>End of Support</th></tr>
    ';
    echo '<tr><td>' . $dates->announce . '</td><td>' . $dates->available . '</td><td>' . $dates->wdfm . '</td><td>' . $dates->eos . '</td></tr>
    ';
    echo '</table></div>';
}

?>