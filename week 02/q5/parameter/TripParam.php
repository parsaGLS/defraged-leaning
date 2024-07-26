<?php

namespace parameter;

class TripParam{
    public int $initialPoint;
    public int $destinationPoint;
    public bool $traffic;
    public bool $rainy;

    /**
     * @param int $initialPoint
     * @param int $destinationPoint
     * @param bool $traffic
     * @param bool $rainy
     */
    public function __construct(int $initialPoint, int $destinationPoint, bool $traffic, bool $rainy)
    {
        $this->initialPoint = $initialPoint;
        $this->destinationPoint = $destinationPoint;
        $this->traffic = $traffic;
        $this->rainy = $rainy;
    }


}
