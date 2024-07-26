<?php
namespace discount;


interface DiscountStrategy  {
    public static function priceByDiscount(Clothing $clothing):float;
}