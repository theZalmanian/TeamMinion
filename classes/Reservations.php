<?php

/**
 * Reservation base class to be extended when more
 * services become available, ie hair cuts,
 */
class Reservations
{

//    private guest; Possible future database extension
    private $_firstname;
    private $_lastName;
    private $_email;
    private $_date;
    private $_time;
    private $_totalPrice;


    /**
     * @param string $_firstname first name of client
     * @param string $_lastName last name of client
     * @param string $_email email of client
     * @param DateTime $_date  date of clients reservation
     * @param DateTime $_time time of clients reservation
     */
    public function __construct(
        $_firstname,
        $_lastName,
        $_email,
        $_date,
        $_time)
    {
        $this->_firstname = $_firstname;
        $this->_lastName = $_lastName;
        $this->_email = $_email;
        $this->_date = $_date;
        $this->_time = $_time;
    }

    /**
     * @return string clients first name
     */
    public function getFirstname(): string
    {
        return $this->_firstname;
    }

    /**
     * @param string $firstname clients first name
     */
    public function setFirstname(string $firstname): void
    {
        $this->_firstname = $firstname;
    }

    /**
     * @return string clients last name
     */
    public function getLastName()
    {
        return $this->_lastName;
    }

    /**
     * @param string $lastName clients last name
     */
    public function setLastName($lastName): void
    {
        $this->_lastName = $lastName;
    }

    /**
     * @return string clients email
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param string $email clients email
     */
    public function setEmail($email): void
    {
        $this->_email = $email;
    }

    /**
     * @return mixed total calculated price for reservation
     */
    public function getTotalPrice()
    {
        return $this->_totalPrice;
    }

    /**
     * @param mixed $totalPrice total calculated price for reservation
     */
    public function setTotalPrice($totalPrice): void
    {
        $this->_totalPrice = $totalPrice;
    }

    /**
     * @return mixed date of reservation
     */
    public function getDate()
    {
        return $this->_date;
    }

    /**
     * @param DateTime $date date of reservation
     * @return void
     */
    public function setDate($date)
    {
        $this->_date = $date;
    }

    /**
     * @return mixed time of reservation
     */
    public function getTime()
    {
        return $this->_time;
    }

    /**
     * @param DateTime $time time of reservation
     * @return void
     */
    public function setTime($time)
    {
        $this->_time = $time;
    }
}