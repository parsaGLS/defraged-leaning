<?php

namespace discount;
require_once "DiscountStrategy.php";


class WinterDiscountStrategy implements DiscountStrategy
{
    public static function priceByDiscount(Clothing $clothing):float{
        $price = $clothing->getBasePrice();

        if ($clothing-> getSeason()==="autumn"){
            $price= (($price)*6)/10;
        }elseif ($clothing-> getSeason()==="summer"){
            $price= (($price)*75)/100;
        }elseif ($clothing-> getSeason()==="winter"){
            $price= (($price)*5)/10;
        }

        if ($clothing instanceof Jacket ){
            $price*=9;
            $price/=10;

        }
        return $price;
    }

}
