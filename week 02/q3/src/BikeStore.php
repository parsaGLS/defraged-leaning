<?php

namespace BikeStore;
require_once "vendor/autoload.php";
use BikeStore\Bike;
use BikeStore\BikeProvider;
use BikeStore\Clock;

class BikeStore{
    private array $store=[];
    private BikeProvider $provider;
    private Clock $clock;
    private int $expireTime ;
    private array $borrowedBikes=[];
    private int $borrowCount = 0;

    /**
     * @param BikeProvider $provider
     * @param Clock $clock
     * @param int $expireTime
     */
    public function __construct(BikeProvider $provider, Clock $clock, int $expireTime)
    {
        $this->provider = $provider;
        $this->clock = $clock;
        $this->expireTime = $expireTime;
    }
    public function borrow() :Bike{
        foreach ($this->store as $bike){

            if ($bike->getStatus() == "perfect"){
                $this->borrowedBikes[]=$bike;
                $bike->setReturnTime($this->clock->getCurrentTime() + $this->expireTime);
                $this->borrowCount++;
                return $bike;
            }else{
                $this->provider->repaire($bike);
            }
        }
        foreach ($this->borrowedBikes as $bike){
            if ($bike->getReturnTime()<=time()){
                $bike->setReturnTime($this->clock->getCurrentTime() + $this->expireTime);
                $this->borrowCount++;
                return $bike;
            }

        }
        $bike=$this->provider->provide();
        $this->borrowedBikes[]=$bike;
        $bike->setReturnTime($this->clock->getCurrentTime() + $this->expireTime);
        $this->borrowCount++;
        return $bike;



    }
    public function restore(Bike $bike, bool $needsRepair){

        foreach ($this->borrowedBikes as $key => $borrowedBike){
            if ($borrowedBike->getId() == $bike->getId()){
                if ($needsRepair){
                    $borrowedBike ->setStatus("failure");
                }
                $this->store[]=$borrowedBike;
                unset($this->borrowedBikes[$key]);
                return;
            }
        }
        throw new Exception("Bike is not for this store");
    }
    public function borrowedCount() : int{
        return $this->borrowCount;
    }




}
