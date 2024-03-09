<?php
/**
 * Unsure how to handle script pathway to instantiate object
 */
require_once("ValidateAvailability.php");

ini_set('display_errors', 1);
error_reporting(E_ALL);

//require($_SERVER['DOCUMENT_ROOT'] . '/../config.php');

echo $_POST['date'] . "<br><br>";

$currDate = date_create($_POST['date'])->format('Y-m-d H:i:s');

$ValidateAvailability = new ValidateAvailability();
$ValidateAvailability->getAvailableTimes($currDate);
