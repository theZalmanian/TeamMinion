<?php

/**
 * Main controller for Spa On
 */
class Controller
{
    /**
     * @var Base Fat Free Framework router
     */
    private $_f3;

    /**
     * Constructs a controller object with the given connection to F3
     * @param $f3 Base Fat Free Framework router
     */
    function __construct($f3)
    {
        $this->_f3 = $f3;
    }


    /**
     * Routes to the booking page
     */
    function availability()
    {
        // create validate availability object in session
        $this->_f3->set("validateAvailability", new ValidateAvailability());

        // if a checkout submission was received
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // create a massage reservation object with the given data
            $currReservation = new MassageReservation(
                                    $_POST["firstName"],
                                    $_POST["lastName"],
                                    $_POST["email"],
                                    $_POST["date"],
                                    $_POST["time"]);

            // save selected massage options
            $currReservation->setMassageType($_POST["massageType"]);
            $currReservation->setHotStone($_POST["hotStones"]);
            $currReservation->setIntensity($_POST["massageIntensity"]);

            // save reservation object session
            $this->_f3->set("SESSION.currMassageReservation", $currReservation);

            // add reservation to DB
            $ValidateAvailability = new ValidateAvailability();
            $ValidateAvailability->setMassageReservation();
        }

        // set title
        $this->_f3->set("title", "Availability");

        // create a new view object
        $view = new Template();

        // display file at following path
        echo $view->render('views/availability.html');
    }

}