<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once($_SERVER['DOCUMENT_ROOT'] . '/../config.php');

/**
 * Validate Object created to fun validation methods on user Input
 * and contains connection to database via field
 */
class ValidateAvailability
{
    private $_dbh;

    /**
     * constructs a ValidateAvailability object
     */
    public function __construct()
    {
        try {
            // Instantiate a PDO database connection object
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            echo 'Connected to database!';
        } catch (PDOException $e) {
            echo $e->getMessage(); #temporary
        }
    }

    /**
     * Collects the current date clicked from calendar and queries
     * database to render available time slots for massage
     * @param $currDate
     * @return void
     */
    function getAvailableTimes($currDate)
    {
        // run through all time slots (09:00 - 17:00), and only display times not reserved in DB
        for ($currHour = 9; $currHour <= 17; $currHour++) {
            // check db for a reservation at the current date selected through calendar and hour
            $query = "SELECT * 
                      FROM reservations
                      WHERE reservationDate = :currDate AND reservationTime = :currHour";

            // prepare the statement
            $statement = $this->_dbh->prepare($query);

            // bind parameters
            $statement->bindValue(":currDate", $currDate);
            $statement->bindValue(":currHour", $currHour . ":00:00");

            // execute the query
            $statement->execute();

            // get the current row
            $currReservation = $statement->fetch(PDO::FETCH_ASSOC);

            // if there is not a reservation at that time in DB
            if (!$currReservation) {
                // if the hour is after 12, subtract 12 as we are using
                // 24h format for the for loop due to DB
                $displayHour = $currHour > 12 ? $currHour - 12 : $currHour;

                // determine the time suffix for current hour
                $timeSuffix = $currHour < 12 ? 'am' : 'pm';

                // display a button for that hour
                echo "<button class='timeSlots btn btn-primary' id='{$displayHour}' value='{$currHour}:00:00'>{$displayHour}:00 {$timeSuffix}</button>";
            }
        }
    }

    /**
     * Gets the current reservation object from session and saves it to DB
     */
    function reserveEvent() {
        // grab current reservation from session
        $currReservation = $_SESSION["currReservation"];

        $query = "INSERT INTO reservations (type, reservationDate, reservationTime, firstName, lastName, email) 
                    VALUES (:type, :reservationDate, :reservationTime, :firstName, :lastName, :email)";

        // prepare the statement
        $statement = $this->_dbh->prepare($query);

        // bind parameters
        $statement->bindValue(":type", "Massage");
        $statement->bindValue(":reservationDate", $currReservation->getDate());
        $statement->bindValue(":reservationTime", $currReservation->getTime());
        $statement->bindValue(":firstName", $currReservation->getFirstName());
        $statement->bindValue(":lastName", $currReservation->getLastName());
        $statement->bindValue(":email", $currReservation->getEmail());

        // execute the query
        $statement->execute();

        if(empty($statement->errorInfo())) {
            echo "Massage Reserved, see you then!";
        }
    }
}