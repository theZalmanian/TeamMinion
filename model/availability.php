<?php
/**
 * Unsure how to handle script pathway to instantiate object
 */
require_once("ValidateAvailability.php");

// get the current date sent from calendar via AJAX
$currDate = date_create($_POST['date'])->format('Y-m-d H:i:s');

// check DB and display all times available on that day
$ValidateAvailability = new ValidateAvailability();
$ValidateAvailability->getAvailableTimes($currDate);