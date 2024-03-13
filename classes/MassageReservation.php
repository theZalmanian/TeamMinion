<?php

/**
 * Massage type of reservation that extends from Reservation
 * class and defines certain massage options
 */
class MassageReservation extends Reservations
{
    private $_massageType;

    private $_hotStone;

    private $_intensity;

    public function getMassageType(): string
    {
        return $this->_massageType;
    }

    public function setMassageType(string $massageType)
    {
        $this->_massageType = $massageType;
    }

    public function isHotStone(): bool
    {
        return $this->_hotStone;
    }

    public function setHotStone(bool $hotStone)
    {
        $this->_hotStone = $hotStone;
    }

    public function getIntensity(): string
    {
        return $this->_intensity;
    }

    public function setIntensity(string $intensity)
    {
        $this->_intensity = $intensity;
    }
}