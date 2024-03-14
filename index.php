<?php

/**
 * Author: Toby, Zalman, LeeRoy
 * Date: 1/25/2024
 * Description: Controller for our Site with error reporting and routing.
 */

// turn on error reporting (when needed)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// require Fat-Free Framework autoload file
require_once('vendor/autoload.php');
require_once('app/controllers/controller.php');
require_once ('app/model/user.class.php');
require_once ('app/model/admin.class.php');
require_once ('app/model/database.class.php');


// instantiate Fat-Free Framework (f3) class and set up controller
$f3 = Base::instance();

// Load configuration from config.ini
$f3->config('config/config.ini');


// Instantiate Controller and invoke the index method to define routes
$controller = new Controller();

// Define routes
$f3->route('GET /', 'Controller->home');
$f3->route('GET /home', 'Controller->home');
$f3->route('GET /signIn', 'Controller->signIn');
$f3->route('POST /signIn', 'Controller->checkSignIn');
$f3->route('GET|POST /checkSignIn', 'Controller->checkSignIn');
$f3->route('GET|POST /viewEvents', 'Controller->viewEvents');
$f3->route('GET|POST /joinedEvents', 'Controller->joinedEvents');
$f3->route('GET|POST /ownedEvents', 'Controller->ownedEvents');
$f3->route('GET|POST /myAccount', 'Controller->myAccount');
$f3->route('GET|POST /signingOut', 'Controller->signingOut');
$f3->route('GET|POST /joinEvent', 'Controller->joinEvent');
$f3->route('GET|POST /leaveEvent', 'Controller->leaveEvent');
$f3->route('GET|POST /processLeaveEvent', 'Controller->processLeaveEvent');
$f3->route('GET|POST /createAccount', 'Controller->createAccount');
$f3->route('GET|POST /accountSuccess', 'Controller->accountSuccess');
$f3->route('GET /signUp', 'Controller->signUp');
$f3->route('POST /signUp', 'Controller->processSignUpForm');
$f3->route('GET|POST /createEvent', 'Controller->createEvent');
$f3->route('GET|POST /eventSuccess', 'Controller->eventSuccess');
$f3->route('GET /createEvent', 'Controller->createEvent');
$f3->route('POST /createEvent', 'Controller->processCreateEventForm');

$f3->route('GET /external', 'Controller->external');
$f3->route('GET|POST /availability', 'Controller->availability');

// run Fat-Free
$f3->run();

?>