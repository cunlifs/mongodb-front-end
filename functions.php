<?php

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

function drawTable($people) {
    echo '<div class="ds-table-container ds-col-10">
    <table class="ds-table ds-table-compact ds-striped ds-hover">
    ';
    echo '<tr><th>Employee number</th><th>First name</th><th>Last name</th><th>Job title</th><th>Department</th></tr>
    ';
    foreach($people as $person) {
        drawLine($person);
    }
    echo '</table></div>
    ';
}

function renderPerson($person) {
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

    // We can calculate the total annual earnings of this individual
    $totalEarnings = $person->SALARY + $person->BONUS + $person->COMM;

    // We calculate some figures based on dates
    $startdate = new DateTime($person->HIREDATE);
    $birthdate = new DateTime($person->BIRTHDATE);
    $todaydate = new DateTime('now');

    $age = $todaydate->diff($birthdate);
    $employmenttime = $todaydate->diff($startdate);
    $startage = $startdate->diff($birthdate);

    // Here we present that information to the user
    echo '<h3 class="ds-heading-2 ds-col-10">' . $person->FIRSTNME . ' ' . $person->MIDINIT . ' ' . $person->LASTNAME . '</h3>
    <h4 class="ds-heading-3 ds-col-10">' . $person->JOB . ' </h4>
    <p class="ds-col-10 ds-margin-bottom-2">
    ' . ucfirst(strtolower($person->FIRSTNME)) . ' is ' . $age->y . ' years old. <br />
    ' . $pronoun . ' ' . $descriptor . ' worked here for ' . $employmenttime->y . ' years. <br />
    ' . $pronoun . ' started at the age of ' . $startage->y . '.
    </p>
    <h4 class="ds-heading-3 ds-col-10">Earnings</h4>
    <div class="ds-table-container ds-col-10">
    <table class="ds-table ds-table-compact ds-striped">
    <tr><th>Annual Salary</th><th>Bonus</th><th>Commission</th></tr>
    <tr><td>$' . $person->SALARY . '</td><td>$' . $person->BONUS . '</td><td>$' . $person->COMM . '</td></tr>
    <tr><td>$nbsp</td><td>Total compensation:</td><td>$' . $totalEarnings . '</td></tr>
    </table>
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