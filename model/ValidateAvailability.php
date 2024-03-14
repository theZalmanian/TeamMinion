<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

// access DB connection constants
require_once($_SERVER['DOCUMENT_ROOT'] . '/../config.php');

/**
 * Contains various methods used to interact with the reservation DB
 */
class ValidateAvailability
{
    /**
     * @var PDO PDO Connection to DB
     */
    private $_dbh;

    /**
     * Attempts to establish PDO connection to DB
     */
    public function __construct()
    {
        // attempt to connect to DB
        try {
            // Instantiate a PDO database connection object
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
        }

        // display error if connection failed
        catch (PDOException $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Generates a button for each hour of the given date which has not been currently reserved for a massage
     * @param string $currDate The date being searched in DB
     */
    function getAvailableTimes($currDate)
    {
        // run through all working hours (09:00 - 17:00), and only display times not reserved in DB
        for ($currHour = 9; $currHour <= 17; $currHour++) {
            // check db for a reservation at the given date and time
            $query = "SELECT * 
                      FROM massages
                      WHERE massageDate = :currDate AND massageTime = :currHour";

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
                echo "<button class='timeSlots btn btn-primary' id='{$displayHour}' value='{$currHour}:00:00'>
                            {$displayHour}:00 {$timeSuffix}
                        </button>";
            }
        }
    }

    /**
     * Gets the current massage reservation from session (if exists), and adds it to the DB
     */
    function setMassageReservation() {
        // grab current massage reservation from session
        $currReservation = $_SESSION["currMassageReservation"];

        // id one exists, attempt to insert it into the DB
        if(!empty($currReservation)) {
            // setup query
            $query = "INSERT INTO massages (massageDate, massageTime, massageType, hotStones, massageIntensity, firstName, lastName, email) 
                        VALUES (:massageDate, :massageTime, :massageType, :hotStones, :massageIntensity, :firstName, :lastName, :email)";

            // prepare the statement
            $statement = $this->_dbh->prepare($query);

            // bind parameters from current submitted reservation
            $statement->bindValue(":massageDate", $currReservation->getDate());
            $statement->bindValue(":massageTime", $currReservation->getTime());
            $statement->bindValue(":massageType", $currReservation->getMassageType());
            $statement->bindValue(":hotStones", $currReservation->isHotStone());
            $statement->bindValue(":massageIntensity", $currReservation->getIntensity());
            $statement->bindValue(":firstName", $currReservation->getFirstName());
            $statement->bindValue(":lastName", $currReservation->getLastName());
            $statement->bindValue(":email", $currReservation->getEmail());

            // execute the query
            $statement->execute();
        }
    }

    function getMassageReservation() {
        // grab current massage reservation from session
        $currReservation = $_SESSION["currMassageReservation"];

        // setup query
        $query = "SELECT * 
                  FROM massages
                  WHERE massageDate = :currDate AND massageTime = :currHour";

        // prepare the statement
        $statement = $this->_dbh->prepare($query);

        // bind parameters
        $statement->bindValue(":currDate", $currReservation->getDate());
        $statement->bindValue(":currHour", $currReservation->getTime());

        // execute query
        $statement->execute();

        // process result
        $currReservation = $statement->fetch(PDO::FETCH_ASSOC);

        // display the returned massage reservation
        var_dump($currReservation);

        // clear the corresponding object from session
        $_SESSION["currMassageReservation"] = null;
    }
}