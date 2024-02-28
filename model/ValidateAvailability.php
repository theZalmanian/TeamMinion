<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require($_SERVER['DOCUMENT_ROOT'] . '/../config.php');

class ValidateAvailability
{
    private $_dbh;

    /**
     * @param $_dbh
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

    function selectAllQuery($dbConnection) {
        // define the select query
        $query = "SELECT * 
                  FROM Reservations";

        // prepare the statement
        $statement = $dbConnection->prepare($query);

        // execute the query
        $statement->execute();

        // get, process, and display the returned rows
        $allReservations = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($allReservations as $currReservation) {
            $type = $currReservation["Type"];
            $date = $currReservation["OurDate"];

            echo "<p>{$type} - {$date}</p>";
        }
    }


}