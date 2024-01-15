<?php

require_once 'App/Shop/Order.php';

$config = [
    'order' => '\App\Shop\Order',
];

//if(class_exists($config['order'])){
//    $order = new $config['order'];
//    $order->test();
//
//    echo '<br>';
//    echo get_class($order);
//} else {
//    echo 'Такого класса не существует';
//}

//echo '<pre>';
//echo 'Классы';
//print_r(get_declared_classes());
//echo '</pre>';
//
//
//echo '<pre>';
//echo 'Трейты';
//print_r(get_declared_traits());
//echo '</pre>';
//
//
//echo '<pre>';
//echo 'Интерфейсы';
//print_r(get_declared_interfaces());
//echo '</pre>';


$order = new $config['order'];

// ** instanseof - проверяет реализацию заданного экземпляра класс или интерфейсы

//if($order instanceof \App\Shop\HasPrice){
//    echo $order->getPrice() . PHP_EOL;
//} else {
//    $order->test();
//}
//
//var_dump(is_a($order, App\Shop\Order::class));
//var_dump(is_subclass_of($order, App\Shop\Order::class));

echo '<pre>';
print_r(get_class_methods($order));