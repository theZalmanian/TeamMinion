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
            // Instantiate a PDO databse connection object
            $this->_dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
            echo 'Connected to database!';
        } catch (PDOException $e) {
            echo $e->getMessage(); #temporary
        }
    }

public static function checkOut() {

}


}