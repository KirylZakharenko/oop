<?php

// ** Объект «Значение» / Value Object

//final class Point
//{
//    private $x;
//    private $y;
//
//    public function __construct($x, $y)
//    {
//        $this->x = $x;
//        $this->y = $y;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getX()
//    {
//        return $this->x;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getY()
//    {
//        return $this->y;
//    }
//
//    public function isEqual(Point $point)
//    {
//        return $this->getX() == $point->getX() && $this->getY() == $point->getY();
//    }
//}
//
//$point1 = new Point(1, 2);
//$point2 = new Point(1, 2);
//
//echo ($point1 === $point2 ? 'равны' : 'не равны') . PHP_EOL;
//echo ($point1->isEqual($point2) ? 'равны' : 'не равны') . PHP_EOL;

// ** Деньги / Money

//final class Money
//{
//    private $amount;
//    private $currency;
//
//    public function __construct($amount, $currency)
//    {
//        $this->amount = $amount;
//        $this->currency = $currency;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getAmount()
//    {
//        return $this->amount;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getCurrency()
//    {
//        return $this->currency;
//    }
//
//    public function isEqual(Money $money)
//    {
//        if ($this->getCurrency() == $money->getCurrency()) {
//            return $this->getAmount() == $money->getAmount();
//        }
//
//        return false;
//    }
//}
//
//$money1 = new Money(1, '$');
//$money2 = new Money(1, '$');
//
//echo ($money1->isEqual($money2) ? 'Столько же' :'Раскулачить!!') . PHP_EOL;

// ** Реестр / Registry

class Registry
{
    private static $data = [];

    /**
     * @param array $data
     */
    public static function setData(string $key, $value): void
    {
        self::$data[$key] = $value;
    }

    /**
     * @return array
     */
    public static function getData(string $key, $defaultValue = null)
    {
        return self::$data[$key] ?? $defaultValue;
    }
}