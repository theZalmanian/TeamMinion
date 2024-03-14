<?php
/**
 * Main controller for Team Minion's site
 *
 * This class handles routing and rendering of views.
 *
 * @author     LeeRoy
 * @version    1.0
 */
class Controller
{
    /**
     * Renders the home page.
     *
     * @param $f3 FatFree Framework
     */
    public function home($f3)
    {
        echo Template::instance()->render('app/views/home.html');
    }

    /**
     * Renders the sign-in page.
     *
     * @param $f3 FatFree Framework
     */
    public function signIn($f3)
    {
        echo Template::instance()->render('app/views/signIn.html');
    }

    /**
     * Clears session, which was holding User object
     *
     * @param $f3 FatFree Framework
     */
    public function signingOut($f3) {
        $f3->clear('SESSION');
        $f3->reroute('/home');
    }

    /**
     * Renders the create account page.
     *
     * @param $f3 FatFree Framework
     */
    public function createAccount($f3)
    {
        echo Template::instance()->render('app/model/createAccount.php');
    }

    /**
     * Renders the account success page.
     *
     * @param $f3 FatFree Framework
     */
    public function accountSuccess($f3)
    {
        echo Template::instance()->render('app/views/accountSuccess.html');
    }

    /**
     * Renders the event success page.
     *
     * @param $f3 FatFree Framework
     */
    public function eventSuccess($f3)
    {
        echo Template::instance()->render('app/views/eventSuccess.html');
    }

    /**
     * Renders the sign-up page.
     *
     * @param $f3 FatFree Framework
     */
    public function signUp($f3)
    {
        echo Template::instance()->render('app/views/signUp.html');
    }

    /**
     * Renders the create event page.
     *
     * @param $f3 FatFree Framework
     */
    public function createEvent($f3)
    {
        echo Template::instance()->render('app/views/createEvent.html');
    }

    /**
     * Renders the leave event page.
     *
     * @param $f3 FatFree Framework
     */
    public function leaveEvent($f3)
    {
        $EventId = $f3->get('POST.EventId');
        $UserId = $f3->get('POST.UserId');

        $f3->set('SESSION.leaveUserId', $UserId);
        $f3->set('SESSION.leaveEventId', $EventId);

        var_dump($EventId, $UserId);

        echo Template::instance()->render('app/views/leaveEvent.html');
    }

    /**
     * Renders the view events page.
     *
     * @param $f3 FatFree Framework
     */
    public function viewEvents($f3)
    {
        $userId = $f3->get('SESSION.user') !== null ? $f3->get('SESSION.user')->
        getUserId() : null;

        $db = new Database($f3);

        $sql = 'SELECT * FROM events WHERE EventID NOT IN (SELECT EventId FROM 
        attendance WHERE UserId = ?)';
        $result = $db->exec($sql, [$userId]);

        $f3->set('SESSION.eventArray', $result);

        echo Template::instance()->render('app/views/viewEvents.html');
    }

    /**
     * Renders the joined events page.
     *
     * @param $f3 FatFree Framework
     */
    public function joinedEvents($f3)
    {
        $UserId = $f3->get('POST.joinedUserID');

        if ($UserId == null) {
            $UserId = $f3->get('POST.returnUserID');
        }

        $db = new Database($f3);

        $sql = 'SELECT events.* FROM events JOIN attendance ON events.EventID =
        attendance.EventID WHERE attendance.UserID = ?';
        $result = $db->exec($sql, [$UserId]);

        $f3->set('SESSION.joinedEventArray', $result);

        echo Template::instance()->render('app/views/joinedEvents.html');
    }

    /**
     * Renders the owned events page.
     *
     * @param $f3 FatFree Framework
     */
    public function ownedEvents($f3)
    {
        $UserId = $f3->get('POST.ownedUserID');

        $db = new Database($f3);

        $sql = 'SELECT * FROM events WHERE OwnerID = ?';
        $result = $db->exec($sql, [$UserId]);

        $f3->set('SESSION.ownedEventArray', $result);

        echo Template::instance()->render('app/views/ownedEvents.html');
    }

    /**
     * Processes leaving an event.
     *
     * @param $f3 FatFree Framework
     */
    public function processLeaveEvent($f3)
    {
        $leaveUserId = $f3->get('POST.leaveUserId');
        $leaveEventId = $f3->get('POST.leaveEventId');

        $db = new Database($f3);

        $sql = 'DELETE FROM attendance WHERE UserId = ? AND EventId = ?';
        $db->exec($sql, [$leaveUserId, $leaveEventId]);

        $sql = 'UPDATE events SET Attending = Attending - 1 WHERE EventId = ?';
        $db->exec($sql, [$leaveEventId]);

        $f3->reroute('/myAccount');
    }

    /**
     * Grabs form data, and queries SQL to add event to events table
     *
     * @param $f3 FatFree framework
     */
    public function processCreateEventForm($f3) {
        // Get form data
        $name = $f3->get('POST.name');
        $description = $f3->get('POST.description');
        $date = $f3->get('POST.date');
        $time = $f3->get('POST.time');
        $state = $f3->get('POST.state');
        $city = $f3->get('POST.city');
        $address = $f3->get('POST.address');
        $capacity = $f3->get('POST.capacity');
        $OwnerID = $f3->get('POST.UserId');
        $attending = 0;

        $db = new Database($f3);

        $sql = 'INSERT INTO events (OwnerID, date, time, State, City, Address, name, description, capacity, attending) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $db->exec($sql, [$OwnerID, $date, $time, $state, $city, $address, $name, $description, $capacity, $attending]);


        $f3->reroute('/eventSuccess');
    }

    /**
     * Renders the myAccount page.
     *
     * @param $f3 FatFree Framework
     */
    public function myAccount($f3)
    {
        echo Template::instance()->render('app/views/myAccount.html');
    }

    /**
     * Joins an event.
     *
     * @param $f3 FatFree Framework
     */
    public function joinEvent($f3)
    {
        if (!in_array($f3->get('VERB'), ['GET', 'POST'])) {
            $f3->reroute('/home');
        }

        $EventId = $f3->get('POST.EventId');
        $UserId = $f3->get('POST.UserId');

        $db = new Database($f3);

        $sql = 'INSERT INTO attendance (UserId, EventId) VALUES (?, ?)';
        $db->exec($sql, [$UserId, $EventId]);

        $sql = 'UPDATE events SET Attending = Attending + 1 WHERE EventId = ?';
        $db->exec($sql, [$EventId]);

        $f3->reroute('/viewEvents');
    }

    /**
     * Signs the user in.
     *
     * @param $f3 FatFree Framework
     */
    public function checkSignIn($f3)
    {
        $email = $f3->get('POST.emailOrUser');
        $password = $f3->get('POST.password');

        $db = new Database($f3);

        $sql = 'SELECT * FROM users WHERE email = ? AND password = ?';

        $result = $db->exec($sql, [$email, $password]);

        if (!$result) {
            $sql = 'SELECT * FROM users WHERE userName = ? AND password = ?';

            $result = $db->exec($sql, [$email, $password]);
        }

        if ($result) {
            $user = $result[0];

            if ($user['isAdmin'] == true) {
                $userObject = new Admin($user['UserID'], $user['username'],
                    $user['password'], $user['email'], $user['phone'],
                    $user['address'], $user['state'], $user['city']);
            } else {
                $userObject = new User($user['UserID'], $user['username'],
                    $user['password'], $user['email'], $user['phone'],
                    $user['address'], $user['state'], $user['city']);
            }

            $f3->set('SESSION.user', $userObject);
            $f3->reroute('/home');
        } else {
            $f3->reroute('/signIn');
        }
    }

    /**
     * Processes the sign-up form.
     *
     * @param $f3 FatFree Framework
     */
    public function processSignUpForm($f3)
    {
        $username = $f3->get('POST.username');
        $password = $f3->get('POST.password');
        $confirmPassword = $f3->get('POST.confirmPassword');
        $email = $f3->get('POST.email');
        $phone = $f3->get('POST.phone');
        $address = $f3->get('POST.address');
        $state = $f3->get('POST.state');
        $city = $f3->get('POST.city');

        $errors = [];

        if ($password !== $confirmPassword) {
            $errors['confirmPassword'] = 'Passwords do not match';
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Invalid email format';
        }

        if (!empty($errors)) {
            $f3->set('errors', $errors);
            echo Template::instance()->render('app/views/signUp.html');
            return;
        }

        $db = new Database($f3);

        $sql = 'INSERT INTO users (username, password, email, phone, 
                   city, state, address) VALUES (?, ?, ?, ?, ?, ?, ?)';
        $db->exec($sql, [$username, $password, $email, $phone, $city, $state, $address]);

        $f3->reroute('/accountSuccess');
    }

    /**
     * Opens availability.html
     *
     * @param $f3 FatFree Framework
     */
    public function availability($f3){
        echo Template::instance()->render('app/views/availability.html');
    }

    /**
     * config.php is missing from Toby and Zalman's contribution to GitHub,
     * so rerouting to their site is the closest option to a seamless opening
     * of working availability
     *
     * @param $f3 FatFree Framework
     */
    public function external($f3) {
        $external = "https://thezalmanian.greenriverdev.com/TeamMinion/availability";
        header("Location: $external");
        exit;
    }


}
?>
