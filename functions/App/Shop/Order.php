<?php

namespace App\Shop;

interface HasPrice
{
    public function getPrice();
}

trait WithPrice
{
    public function getPrice()
    {
        if(property_exists(new Order, 'price'))
        {
            return $this->price;
        } else {
            return 0;
        }
    }
}

class Order implements HasPrice
{
    use WithPrice;

    private $price;

    public function __construct($price = 0.0)
    {
        $this->price = $price;
    }

    public function test()
    {
        echo 'test' . PHP_EOL;
    }

}