<?php

// ** Принцип единой ответственности (SPR)

class Order
{
    public function getItems() {}
    public function getTotal() {}
    public function validate() {}
}
class OrderRepository
{
    public function save() {}
    public function load() {}
}

// ** Принцип открытости/закрытости (OCP)
abstract class Shape
{
    abstract public function draw();
}

class Circle extends Shape
{
    public function draw()
    {
    }
}

class Triangle extends Shape
{
    public function draw()
    {
    }
}

class Canvas
{
    public function drawAll($shapes)
    {
        foreach ($shapes as $shape) {
            $shape->draw();
        }
    }
}

// ** Принцип подстановки Лисков (LSP)

class Rectangle
{
    private $width;
    private $height;

    public function __construct($width, $height)
    {
        $this->width = $width;
        $this->height = $height;
    }


    public function getArea()
    {
        return $this->width * $this->height;
    }
}

class Square extends Rectangle
{
    public function __construct($size)
    {
        parent::__construct($size, $size);
    }
}


// ** Принцип разделения интерфейса (ISP)
interface Shape
{
    public function draw();
}

interface Plotable
{
    public function plot();
}


class Circle implements Shape, Plotable
{
    public function draw() {}
    public function plot() {}
}

class AxisLine implements Shape
{
    public function draw() {}
}

// ** Принцип инверсии зависимостей (DIP)
interface WithPrice
{
    public function getPrice();
}
class Product implements WithPrice
{
    public function getPrice() {}
}
class Order
{
    private $summ = 0;

    public function add(WithPrice $product)
    {
        $this->summ += $product->getPrice();
    }
}
class PerfectProduct implements WithPrice
{
    public function getPrice() {}
}
