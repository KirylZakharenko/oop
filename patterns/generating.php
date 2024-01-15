<?php
// ** Фабричный метод

//interface Transport
//{
//    public function move($product);
//}
//
//class Boat implements Transport
//{
//    public function move($product)
//    {
//        echo $product . ' едет по воде' . PHP_EOL;
//    }
//}
//
//class Car implements Transport
//{
//    public function move($product)
//    {
//        echo $product . ' едет по дороге' . PHP_EOL;
//    }
//}
//
//class Standard
//{
//
//}
//
//interface FactoryMethod
//{
//    public function getTransport($product) : Transport;
//}
//
//class TransportFactory implements FactoryMethod
//{
//    const ROAD_TRANSPORT = 'road';
//    const WATER_TRANSPORT = 'water';
//
//    public function getTransport($product): Transport
//    {
//        $transport = $this->getOptimalWayForProduct($product);
//
//        return match ($transport) {
//            static::ROAD_TRANSPORT => new Car(),
//            static::WATER_TRANSPORT => new Boat(),
//            default => new Standard(),
//        };
//
//    }
//
//    private function getOptimalWayForProduct($product): string
//    {
//        $optimalWay = [
//          'Белка' =>   TransportFactory::ROAD_TRANSPORT,
//          'Кот' =>   TransportFactory::ROAD_TRANSPORT,
//          'Бегемот' =>   TransportFactory::WATER_TRANSPORT,
//        ];
//
//        return $optimalWay[$product];
//    }
//}
//
//$product = ['Белка','Кот','Бегемот'];
//
//echo '<pre>';
//foreach ($product as $item) {
//    $transport = (new TransportFactory())->getTransport($item);
//    $transport->move($item);
//}
//echo '</pre>';

// ** Абстрактная фабрика

//interface Chair
//{
//
//}
//
//interface Table
//{
//
//}
//
//interface Couch
//{
//
//}
//
//class WoodenChair implements Chair
//{
//
//}
//
//class WoodenTable implements Table
//{
//
//}
//
//class WoodenCouch implements Couch
//{
//
//}
//
//interface FurnitureFactory
//{
//    public function createChair(): Chair;
//
//    public function createTable(): Table;
//
//    public function createCouch(): Couch;
//}
//
//class WoodenFurnitureFactory implements FurnitureFactory
//{
//    public function createChair(): Chair
//    {
//        return new WoodenChair();
//    }
//
//    public function createTable(): Table
//    {
//        return new WoodenTable();
//    }
//
//    public function createCouch(): Couch
//    {
//        return new WoodenCouch();
//    }
//}
//
//class Gap implements FurnitureFactory
//{
//
//    #[\Override] public function createChair(): Chair
//    {
//        return new WoodenChair();
//    }
//
//    #[\Override] public function createTable(): Table
//    {
//        return new WoodenTable();
//    }
//
//    #[\Override] public function createCouch(): Couch
//    {
//        return new WoodenCouch();
//    }
//}
//
//class Factory
//{
//    const MATERIAL_WOOD = 'wood';
//    public static function createFactory($factory) : FurnitureFactory
//    {
//        if ($factory == static::MATERIAL_WOOD) {
//            return new WoodenFurnitureFactory();
//        }
//        return new Gap();
//    }
//}
//
//function getFurnitureCollection($type): array
//{
//    $factory = Factory::createFactory($type);
//
//    return [
//        'chair' => $factory->createChair(),
//        'table' => $factory->createTable(),
//        'couch' => $factory->createCouch(),
//    ];
//}
//
//$collection = getFurnitureCollection(Factory::MATERIAL_WOOD);
//
//echo '<pre>';
//print_r($collection);
//echo '</pre>';

// ** Строитель / Builder

//class House
//{
//    private $walls;
//    private $floor;
//    private $roof;
//    private $garage;
//
//    public function setWalls($walls)
//    {
//        $this->walls = $walls;
//    }
//
//    public function setFloor($floor)
//    {
//        $this->floor = $floor;
//    }
//
//    public function setRoof($roof)
//    {
//        $this->roof = $roof;
//    }
//
//    public function setGarage($garage)
//    {
//        $this->garage = $garage;
//    }
//}
//
//class HouseBuilder
//{
//    private $house;
//
//    public function __construct()
//    {
//        $this->house = new House();
//    }
//
//    /**
//     * @return House
//     */
//    public function getHouse(): House
//    {
//        return $this->house;
//    }
//
//    public function buildRoof($roof): HouseBuilder
//    {
//        $this->getHouse()->setRoof($roof);
//        return $this;
//    }
//
//    public function buildWalls($walls): HouseBuilder
//    {
//        $this->getHouse()->setWalls($walls);
//        return $this;
//    }
//
//    public function buildGarage($garage): HouseBuilder
//    {
//        $this->getHouse()->setGarage($garage);
//        return $this;
//    }
//
//    public function buildFloor($floor): HouseBuilder
//    {
//        $this->getHouse()->setFloor($floor);
//        return $this;
//    }
//}
//
//$house = new HouseBuilder();
//$house
//    ->buildRoof('Шифер')
//    ->buildFloor('Плитка')
//    ->buildGarage('Присуствует')
//    ->buildWalls('Бетонные плиты')
//    ->getHouse();
//
//
//echo '<pre>';
//print_r($house);
//echo '</pre>';

// ** Одиночка / Singleton

//final class Singleton
//{
//    private static $instance;
//    public function __construct(){}
//
//    public static function getInstance(): Singleton
//    {
//        if(Singleton::$instance === null){
//            Singleton::$instance = new Singleton();
//        }
//        return Singleton::$instance;
//    }
//}
//
//$singleton = Singleton::getInstance();
//$singleton1 = Singleton::getInstance();
//
//var_dump($singleton);
//var_dump($singleton1);

// ** Прототип / Prototype

class Author
{
    public $name;

    public function __construct($name)
    {
        $this->name = $name;
    }
}

abstract class BookPrototype
{
    protected $title;
    protected $category;
    public $author;
    
     public function __clone(): void
    {
        // TODO: Implement __clone() method.
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
        return $this;
    }
}

class StoryBookPrototype extends BookPrototype
{
    protected $category = 'Action';
    public function __clone(): void
    {
        // TODO: Implement __clone() method.
    }
}

$storyBook = new StoryBookPrototype();
$book1 = clone $storyBook;
$book1
    ->setTitle('Заголовок')
    ->setAuthor('Пушкин');

echo '<pre>';
print_r($book1);
echo '</pre>';
$book2 = clone $book1;
$book2
    ->setTitle('Nos')
    ->setAuthor('Gogol');

print_r($book2);