<?php
namespace discount;


require_once "DiscountStrategy.php";



class SummerDiscountStrategy implements DiscountStrategy{
    public static function priceByDiscount(Clothing $clothing):float{
        if ($clothing-> getSeason()==="summer"){
            return ($clothing->getBasePrice())/2;
        }elseif ($clothing-> getSeason()==="spring"){
            return (($clothing->getBasePrice())*6)/10;
        }elseif ($clothing-> getSeason()==="winter"){
            return (($clothing->getBasePrice())*7)/10;
        }else{
            return ($clothing->getBasePrice());
        }
    }
}
