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

// run through all time slots (09:00 - 17:00), and only display times not reserved in DB
for($currHour = 9; $currHour <= 17; $currHour++) {
    // check db for a reservation at the current date selected through calender and hour
    $query = "SELECT * 
              FROM reservations
              WHERE reservationDate = :currDate AND reservationTime = :currHour";

    // prepare the statement
    $statement = $dbConnection->prepare($query);

    $statement->bindValue(":currDate", $currDate);
    $statement->bindValue(":currHour", $currHour . ":00:00");

    // execute the query
    $statement->execute();

    // get the current row
    $currReservation = $statement->fetch(PDO::FETCH_ASSOC);

    // if there is not a reservation at that time in DB
    if(!$currReservation) {
        // if the hour is after 12, subtract 12 as we are using
        // 24h format for the for loop due to DB
        $displayHour = $currHour > 12 ? $currHour - 12 : $currHour;

        // determine the time suffix for current hour
        $timeSuffix = $currHour < 12 ? 'am' : 'pm';

        // display a button for that hour
        echo "<button class='times'>{$displayHour}:00 {$timeSuffix}</button>";
    }
}