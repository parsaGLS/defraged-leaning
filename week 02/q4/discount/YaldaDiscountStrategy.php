<?php

namespace discount;
require_once "DiscountStrategy.php";

class YaldaDiscountStrategy implements DiscountStrategy
{
    public static function priceByDiscount(Clothing $clothing):float{
        $price = $clothing->getBasePrice();
        if ($clothing instanceof Jacket ){
            $price*=9;
            $price/=10;
        }elseif ($clothing instanceof Socks){
            $price*=8;
            $price/=10;
        }else{
            $price*=75;
            $price/=100;
        }
        return $price;
    }

}
