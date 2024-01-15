<?php

class BadValueException extends \InvalidArgumentException
{

}

class TooBigValueException extends \BadValueException
{

}

class NegativeValueException extends \BadValueException {

}

function arithmeticOperations($a,$b)
{
    if ($a < 0 || $b < 0){
        throw new NegativeValueException('$a < 0 || $b < 0');
    }
    if ($a <= $b){
        throw new TooBigValueException('$a <= $b');
    }
    if ($b == 0){
        throw new InvalidArgumentException('$a < 0 || $b < 0');
    }

    return $a / $b;
}

$values = [
    ['a' => 0, 'b' => 2],
    ['a' => -1, 'b' => -3],
    ['a' => 10, 'b' => 0],
    ['a' => 3, 'b' => 1],
];

echo '<pre>';
foreach ($values as $value) {
    try {
        try {
            echo "a = {$value['a']}, b = {$value['b']} ";

            $c = arithmeticOperations($value['a'], $value['b']);

            echo 'Результат' . $c . PHP_EOL;
        } catch (BadValueException $e) {
            echo 'Проблема с числами: ' .$e->getMessage() . PHP_EOL;
        }
    } catch (Exception $e){
        echo '<br>' .'Логируем ошибку' .$e->getMessage() . PHP_EOL;
    }
}
echo '</pre>';

set_exception_handler(function (Throwable $e){
    echo '';
});

