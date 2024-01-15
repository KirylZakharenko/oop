<?php
//function test($name, callable $callback)
//{
//    echo 'invoke: ' . $callback($name) . PHP_EOL;
//    echo 'user_func ' . call_user_func($callback, [$name]) . PHP_EOL;
//}
//
//function simpleHello($name = ''): string
//{
//    return 'Simple Hello to: ' . $name;
//}
//
//test('world', 'simpleHello');

//class ClosureExample
//{
//    private $value = 0;
//
//    public function __construct(int $value)
//    {
//        $this->value = $value;
//    }
//
//    private function getValue()
//    {
//        return $this->value;
//    }
//
//    public function formatValue(Closure $closure)
//    {
//        return $closure->call($this);
//    }
//}
//
//$formater = function () {
//    return sprintf("Price:  %01.2f$", $this->getValue());
//};
//
//$example = new ClosureExample(5);
//
//echo $example->formatValue($formater);

interface Formatter
{
    public function format($value);
}

function format($value, Formatter $formatter)
{
    echo $formatter->format($value) . PHP_EOL;
}

$tmpClass = new class implements Formatter {
    public function format($value): string
    {
        return sprintf("Price: %01.4f$", $value);
    }
};

format(10, $tmpClass);