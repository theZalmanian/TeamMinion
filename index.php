<?php

/**
 * Author: Minions
 * Date: 1/25/2024
 * Description: Controller for Reservation Site w/ error reporting and routing.
 */

// turn on error reporting (when needed)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require Fat-Free Framework autoload file
require_once('vendor/autoload.php');

// instantiate Fat-Free Framework (f3) class and set up controller
$f3 = Base::instance();
$controller = new Controller($f3);

// setup home route
$f3->route('GET /', function () {
    global $controller;

    // call the home route
    $controller->home();
});

// set availability route to book appointments
$f3->route('GET|POST /availability', function () {
    global $controller;

    // call the availability route
    $controller->availability();
});

// signIn route
$f3->route('GET|POST /signIn', function ($f3) { //instance method
    $view = new Template();
    echo $view->render('views/signIn.php');
});

// run Fat-Free
$f3->run();