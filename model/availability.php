<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require($_SERVER['DOCUMENT_ROOT'] . '/../config.php');

echo $_POST['date'] . "<br><br>";

$currDate = date_create($_POST['date'])->format('Y-m-d H:i:s');

try {
    // Instantiate a PDO database connection object
    $dbConnection = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    echo 'Connected to database!';
} catch (PDOException $e) {
    echo $e->getMessage(); #temporary
}

// define the select query
$query = "SELECT * 
          FROM reservations
          WHERE reservationDate = :currDate";

// prepare the statement
$statement = $dbConnection->prepare($query);

$statement->bindValue(":currDate", $currDate);

// execute the query
$statement->execute();

// get, process, and display the returned rows
$allReservations = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach ($allReservations as $currReservation) {
    $type = $currReservation["type"];
    $date = $currReservation["reservationDate"];

    echo "<p>{$type} - {$date}</p>";
}