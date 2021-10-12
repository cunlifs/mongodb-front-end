<?php

function drawLine($person) {
    echo '<tr>';
    echo '<td><a href="employee.php?id=' . $person->EMPNO . '">' . $person->EMPNO . '</a></td>';
    echo '<a href="employee.php?id=' . $person->EMPNO . '"><td>' . $person->FIRSTNME . '</td></a>';
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