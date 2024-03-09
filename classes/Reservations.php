<?php

namespace classes;

use Cassandra\Date;

class Reservations
{
    private $_firstname;
    private $_lastName;
    private $_email;
    private $_phone;
    private $_totalPrice;
    private $_date;
    private $_time;

    /**
     * @param $_firstname
     * @param $_lastName
     * @param $_email
     * @param $_phone
     * @param $_totalPrice
     * @param $_date
     * @param $_time
     */
    public function __construct(
        String $_firstname="",
        $_lastName, $_email,
        $_phone,
        $_totalPrice,
        Date $_date,
        Time $_time)
    {
        $this->_firstname = $_firstname;
        $this->_lastName = $_lastName;
        $this->_email = $_email;
        $this->_phone = $_phone;
        $this->_totalPrice = $_totalPrice;
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
    public function getPhone()
    {
        return $this->_phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->_phone = $phone;
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

    public function getDate(): Date
    {
        return $this->_date;
    }

    public function setDate(Date $date): void
    {
        $this->_date = $date;
    }

    public function getTime(): Time
    {
        return $this->_time;
    }

    public function setTime(Time $time): void
    {
        $this->_time = $time;
    }
}