<!--
Author: Minions
Date: 1/25/2024
Description:
    Controller for Reservation Site w/ error
    reporting and routing.
-->

<?php


//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

//Require the autoload file
require_once('vendor/autoload.php');

//Instantiate Fat-Free framework (f3)
$f3 = Base::instance(); //static method

// Default route
$f3->route('GET /', function ($f3) { //instance method
    $view = new Template();
    echo $view->render('views/home.html');
});

// home route
$f3->route('GET|POST /home', function ($f3) { //instance method
    $view = new Template();
    echo $view->render('views/home.html');
});

// availability route
$f3->route('GET|POST /availability', function ($f3) { //instance method
    $view = new Template();
    echo $view->render('views/availability.html');
});

// signIn route
$f3->route('GET|POST /signIn', function ($f3) { //instance method
    $view = new Template();
    echo $view->render('views/signIn.php');
});

//Run Fat-Free
$f3->run();
