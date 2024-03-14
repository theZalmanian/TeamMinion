<?php

class User {
    private $userID;
    private $username;
    private $password;
    private $email;
    private $phone;
    private $address;
    private $state;
    private $city;

    public function __construct($userID, $username, $password, $email, $phone, $address, $state, $city) {
        $this->userID = $userID;
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->state = $state;
        $this->city = $city;
    }

    public function isAdmin(){
        return false;
    }

    public function isUser(){
        return true;
    }

    // Getters
    public function getUserID() {
        return $this->userID;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getAddress() {
        return $this->address;
    }

    public function getState() {
        return $this->state;
    }

    public function getCity() {
        return $this->city;
    }

    // Setters
    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function setState($state) {
        $this->state = $state;
    }

    public function setCity($city) {
        $this->city = $city;
    }
}

?>