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
     * @param string $_firstname
     * @param string $_lastName
     * @param string $_email
     * @param $_date
     * @param $_time
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

    public function getFirstname(): string
    {
        return $this->_firstname;
    }

    public function setFirstname(string $firstname): void
    {
        $this->_firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->_lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName): void
    {
        $this->_lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getTotalPrice()
    {
        return $this->_totalPrice;
    }

    /**
     * @param mixed $totalPrice
     */
    public function setTotalPrice($totalPrice): void
    {
        $this->_totalPrice = $totalPrice;
    }

    public function getDate()
    {
        return $this->_date;
    }

    public function setDate($date)
    {
        $this->_date = $date;
    }

    public function getTime()
    {
        return $this->_time;
    }

    public function setTime($time)
    {
        $this->_time = $time;
    }
}