<?php

namespace BikeStore;

class Bike{
    private string $id;
    private string $name;
    private string $status;
    private int $returnTime;

    public function __construct($id, $name, $status){
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
    }


    public function getReturnTime(): int
    {
        return $this->returnTime;
    }

    public function setReturnTime(int $returnTime): void
    {
        $this->returnTime = $returnTime;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }


}
