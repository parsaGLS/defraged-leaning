<?php

namespace BikeStore;



interface BikeProviderInterface{
    public function provide();
    public function repaire(Bike $bike);
}

class BikeProvider implements BikeProviderInterface{
    private array $storage=array();

    /**
     * @param array $storage
     */
    public function __construct(array $storage)
    {
        $this->storage = $storage;
    }

    public function add(Bike $bike){
        $this->storage[] = $bike;
    }
    public function provide()
    {
        return array_pop($this->storage);
    }

    public function repaire(Bike $bike): void
    {
        $bike->setStatus("perfect");
    }
}
