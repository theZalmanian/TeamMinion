<?php

require_once 'user.class.php';

class Admin extends User{

    public function isAdmin(){
        return true;
    }

}

?>