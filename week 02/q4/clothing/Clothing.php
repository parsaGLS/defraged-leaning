<?php

namespace clothing;
require_once "../vendor/autoload.php";
use discount\SummerDiscountStrategy;
use discount\WinterDiscountStrategy;
use discount\YaldaDiscountStrategy;

class Clothing
{
    private string $name;
    private string $season;
    private float $basePrice;

    /**
     * @param float $basePrice
     * @param string $season
     * @param string $name
     */
    public function __construct(float $basePrice, string $season, string $name)
    {
        $this->basePrice = $basePrice;
        $this->season = $season;
        $this->name = $name;
    }


    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getSeason(): string
    {
        return $this->season;
    }

    public function setSeason(string $season): void
    {
        $this->season = $season;
    }

    public function getBasePrice(): float
    {
        return $this->basePrice;
    }

    public function setBasePrice(float $basePrice): void
    {
        $this->basePrice = $basePrice;
    }






    public string $discountStrategy;

    public function getDiscountStrategy(): string
    {
        return $this->discountStrategy;
    }

    public function setDiscountStrategy(string $discountStrategy): void
    {
        $this->discountStrategy = $discountStrategy;
    }

    public function getPrice():float{
        if ($this->discountStrategy==="summer"){
            return SummerDiscountStrategy::priceByDiscount($this);
        }elseif ($this->discountStrategy==="winter"){
            return WinterDiscountStrategy::priceByDiscount($this);
        }elseif ($this->discountStrategy==="yalda"){
            return YaldaDiscountStrategy::priceByDiscount($this);
        }else{
            return $this->getBasePrice();

        }
    }

}
