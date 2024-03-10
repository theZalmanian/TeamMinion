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
     * Routes to the home page
     */
    function home()
    {
        // set title
        $this->_f3->set("title", "Home");

        // create a new view object
        $view = new Template();

        // display file at following path
        echo $view->render("views/home.html");
    }

    /**
     * Routes to the booking page
     */
    function availability()
    {
        // if a checkout submission was received
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // create a reservation object with the given data
            $currReservation = new Reservations(
                                    $_POST["firstName"],
                                    $_POST["lastName"],
                                    $_POST["email"],
                                    $_POST["phone"],
                                    $_POST["date"],
                                    $_POST["time"]);

            // save reservation object session
            $this->_f3->set("SESSION.currReservation", $currReservation);

            // add reservation to DB
            $ValidateAvailability = new ValidateAvailability();
            $ValidateAvailability->reserveEvent();
        }

        // set title
        $this->_f3->set("title", "Availability");

        // create a new view object
        $view = new Template();

        // display file at following path
        echo $view->render('views/availability.html');
    }

    /**
     * Routes to the Sign In page
     */
    function signIn()
    {
        // set title
        $this->_f3->set("title", "Sign In");

        // create a new view object
        $view = new Template();

        // display file at following path
        echo $view->render('views/signIn.html');
    }
}