<?php
// ** Адаптер / Adapter

//interface SocialNetworkAuth
//{
//    public function auth();
//    public function getUserData();
//}
//
//class VkAuth implements SocialNetworkAuth
//{
//    public function auth()
//    {
//        // Логика авторизации вк
//    }
//
//    public function getUserData()
//    {
//        // Отправляем запросы, получая данные
//    }
//}
//
//class InstagramAuth
//{
//    public function authByID()
//    {
//      // реализация
//    }
//
//    public function getUserID()
//    {
//
//    }
//
//    public function getPhotos()
//    {
//
//    }
//
//    public function getUserInfo()
//    {
//
//    }
//}
//
//class InstagramAdapter implements SocialNetworkAuth
//{
//    private $adaptee;
//    public function __construct()
//    {
//        $this->adaptee = new InstagramAuth();
//    }
//
//    public function auth()
//    {
//        $this->adaptee->authByID($this->adaptee->getUserID());
//    }
//
//    public function getUserData(){
//        $this->adaptee->getUserInfo();
//    }
//}
//
//function auth(SocialNetworkAuth $provider): void
//{
//    $provider->auth();
//}
//
//$instagram = new InstagramAdapter();
//auth($instagram);
//
//$vk = new VkAuth();
//auth($vk);

//interface Boxable
//{
//    public function getSize();
//}
//
//class BoxFactory
//{
//    public static function getBoxSize(Boxable $boxable)
//    {
//        return $boxable->getSize();
//    }
//}
//
//interface Valueable
//{
//    public function getValue();
//}
//
//class Cube implements Boxable, Valueable
//{
//    private $size;
//
//    public function __construct($size)
//    {
//        $this->size = $size;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getSize()
//    {
//        return $this->size;
//    }
//
//    public function getValue()
//    {
//        return $this->getSize();
//    }
//}
//
//class Ball implements Valueable
//{
//    private $radius;
//
//    public function __construct($radius)
//    {
//        $this->radius = $radius;
//    }
//
//    /**
//     * @return mixed
//     */
//    public function getRadius()
//    {
//        return $this->radius;
//    }
//
//    public function getValue()
//    {
//        return $this->getRadius();
//    }
//}
//
//class BoxableBallAdapter implements Boxable
//{
//    private $ball;
//
//    public function __construct(Ball $ball)
//    {
//        $this->ball = $ball;
//    }
//
//    public function getSize()
//    {
//        return $this->ball->getRadius() * 2;
//    }
//}
//
//$items = [
//    new Ball(10),
//    new Cube(10),
//    new Ball(1),
//];
//
//foreach ($items as $item) {
//
//    $boxable = $item;
//
//    if ($item instanceof Ball) {
//        $boxable = new BoxableBallAdapter($item);
//    }
//
//    echo 'Чтобы положить ' . get_class($item) . ' размером: ' . $item->getValue() . ' Нужна коробка размером: ' . BoxFactory::getBoxSize($boxable) . PHP_EOL;
//}

// ** Мост / Bridge

//interface Formatter
//{
//    public function format($value): string;
//}
//
//abstract class Service
//{
//    protected $formatter;
//
//    public function __construct(Formatter $formatter)
//    {
//        $this->formatter = $formatter;
//    }
//
//    public function setFormatter(Formatter $formatter)
//    {
//        $this->formatter = $formatter;
//    }
//
//    abstract function get();
//}
//
//class HtmlFormatter implements Formatter
//{
//    public function format($value): string
//    {
//        return '<h1>' . $value . '</h1>';
//    }
//}
//
//class PlainTextFormatter implements Formatter
//{
//    public function format($value): string
//    {
//        return $value;
//    }
//}
//
//class HelloWorldService extends Service
//{
//    public function get()
//    {
//        return $this->formatter->format('Hello World');
//    }
//}
//
//$service = new HelloWorldService(new PlainTextFormatter());
//
//echo $service->get() . PHP_EOL;
//
//$service->setFormatter(new HtmlFormatter());
//
//echo $service->get() . PHP_EOL;

// ** Компонивщик / Composite

//interface Renderable
//{
//    public function render(): string;
//}
//
//class RenderableGroup implements Renderable
//{
//    protected $elements = [];
//
//    public function addElement(Renderable $element)
//    {
//        $this->elements = $element;
//        return $this;
//    }
//
//    public function render(): string
//    {
//        $result = '';
//        foreach ($this->elements as $element) {
//            $result .= $element->render();
//        }
//
//        return $result;
//    }
//}
//
//class Form extends RenderableGroup
//{
//    public function render(): string
//    {
//        return '<form>' . parent::render() . '</form>';
//    }
//}
//
//class DivGroup extends RenderableGroup
//{
//    public function render(): string
//    {
//        return '<div>' . parent::render() . '</div>';
//    }
//}
//
//class InputElement implements Renderable
//{
//    protected $type = 'text';
//
//    public function render(): string
//    {
//        return '<input type="' . $this->type . '" />"';
//    }
//}
//
//class RadioInputElement extends InputElement
//{
//    protected $type = 'radio';
//}
//
//class FormButtonElement extends InputElement
//{
//    protected $type = 'submit';
//}
//
//echo (new Form())
//    ->addElement(new InputElement())
//    ->addElement(
//        (new DivGroup())
//            ->addElement(new RadioInputElement())
//            ->addElement(new RadioInputElement())
//    )
//    ->addElement(new FormButtonElement())
//    ->render();

// ** Декоратор / Decorator

//interface Booking
//{
//    public function calculatePrice(): int;
//    public function getDescription(): string;
//}
//
//abstract class BookingDecorator implements Booking
//{
//    protected $booking;
//    public function __construct(Booking $booking)
//    {
//        $this->booking = $booking;
//    }
//}
//
//class DoubleRoomBooking implements Booking
//{
//
//    #[\Override] public function calculatePrice(): int
//    {
//        return 40;
//    }
//
//    #[\Override] public function getDescription(): string
//    {
//       return "Номер на двоих";
//    }
//}
//
//class WIFI extends BookingDecorator
//{
//    private const PRICE = 2;
//
//    #[\Override] public function calculatePrice(): int
//    {
//        return $this->booking->calculatePrice() + self::PRICE;
//    }
//
//    #[\Override] public function getDescription(): string
//    {
//        return $this->booking->getDescription() . ' есть Wifi';
//    }
//}
//
//class UnlimitedDrink extends BookingDecorator
//{
//    private const PRICE = 100;
//
//    #[\Override] public function calculatePrice(): int
//    {
//        return $this->booking->calculatePrice() + self::PRICE;
//    }
//
//    #[\Override] public function getDescription(): string
//    {
//        return $this->booking->getDescription() . ' холодильник с безлимитными напитками';
//    }
//}
//
//$booking1 = new WIFI(new DoubleRoomBooking());
//$booking2 = new WIFI(new UnlimitedDrink(new DoubleRoomBooking()));
//
//echo $booking1->getDescription() . " Всего за " . $booking1->calculatePrice() . '<br>';
//echo $booking2->getDescription() . " Всего за " . $booking2->calculatePrice() . '<br>';


// ** Фасад / Facade

//interface OsInterface
//{
//    public function halt();
//
//    public function getName(): string;
//}
//
//interface BiosInterface
//{
//    public function execute();
//    public function awaitForKeyPress();
//    public function launch(OsInterface $os);
//    public function powerDown();
//}
//
//class Facade
//{
//    private $os;
//    private $bios;
//
//    public function __construct(BiosInterface $bios, OsInterface $os)
//    {
//        $this->bios = $bios;
//        $this->os = $os;
//    }
//
//    public function turnOn()
//    {
//        $this->bios->execute();
//        $this->bios->awaitForKeyPress();
//        $this->bios->launch($this->os);
//    }
//
//    public function turnOff()
//    {
//        $this->os->halt();
//        $this->bios->powerDown();
//    }
//}

///**
// * Класс Фасада предоставляет простой интерфейс для сложной логики одной или
// * нескольких подсистем. Фасад делегирует запросы клиентов соответствующим
// * объектам внутри подсистемы. Фасад также отвечает за управление их жизненным
// * циклом. Все это защищает клиента от нежелательной сложности подсистемы.
// */
//class Facade
//{
//    protected $subsystem1;
//
//    protected $subsystem2;
//
//    /**
//     * В зависимости от потребностей вашего приложения вы можете предоставить
//     * Фасаду существующие объекты подсистемы или заставить Фасад создать их
//     * самостоятельно.
//     */
//    public function __construct(
//        Subsystem1 $subsystem1 = null,
//        Subsystem2 $subsystem2 = null
//    ) {
//        $this->subsystem1 = $subsystem1 ?: new Subsystem1();
//        $this->subsystem2 = $subsystem2 ?: new Subsystem2();
//    }
//
//    /**
//     * Методы Фасада удобны для быстрого доступа к сложной функциональности
//     * подсистем. Однако клиенты получают только часть возможностей подсистемы.
//     */
//    public function operation(): string
//    {
//        $result = "Facade initializes subsystems:\n";
//        $result .= $this->subsystem1->operation1();
//        $result .= $this->subsystem2->operation1();
//        $result .= "Facade orders subsystems to perform the action:\n";
//        $result .= $this->subsystem1->operationN();
//        $result .= $this->subsystem2->operationZ();
//
//        return $result;
//    }
//}
//
///**
// * Подсистема может принимать запросы либо от фасада, либо от клиента напрямую.
// * В любом случае, для Подсистемы Фасад – это еще один клиент, и он не является
// * частью Подсистемы.
// */
//class Subsystem1
//{
//    public function operation1(): string
//    {
//        return "Subsystem1: Ready!\n";
//    }
//
//    // ...
//
//    public function operationN(): string
//    {
//        return "Subsystem1: Go!\n";
//    }
//}
//
///**
// * Некоторые фасады могут работать с разными подсистемами одновременно.
// */
//class Subsystem2
//{
//    public function operation1(): string
//    {
//        return "Subsystem2: Get ready!\n";
//    }
//
//    // ...
//
//    public function operationZ(): string
//    {
//        return "Subsystem2: Fire!\n";
//    }
//}
//
///**
// * Клиентский код работает со сложными подсистемами через простой интерфейс,
// * предоставляемый Фасадом. Когда фасад управляет жизненным циклом подсистемы,
// * клиент может даже не знать о существовании подсистемы. Такой подход позволяет
// * держать сложность под контролем.
// */
//function clientCode(Facade $facade)
//{
//    // ...
//
//    echo $facade->operation();
//
//    // ...
//}
//
///**
// * В клиентском коде могут быть уже созданы некоторые объекты подсистемы. В этом
// * случае может оказаться целесообразным инициализировать Фасад с этими
// * объектами вместо того, чтобы позволить Фасаду создавать новые экземпляры.
// */
//$subsystem1 = new Subsystem1();
//$subsystem2 = new Subsystem2();
//$facade = new Facade($subsystem1, $subsystem2);
//clientCode($facade);

// ** Заместитель / Proxy

//interface Balance
//{
//    public function getBalance();
//}
//
//class BankAccount implements Balance
//{
//    public function getBalance()
//    {
//        sleep(2);
//        return 100;
//    }
//}
//
//class BankAccountProxy extends BankAccount
//{
//    protected $balance;
//
//    public function getBalance(): int
//    {
//        if(!is_null($this->balance)){
//            return $this->balance;
//        }
//        return $this->balance = parent::getBalance();
//    }
//}
//
//$bankAccount = new BankAccount();
//
//echo '<pre>';
//echo date('H:i:s') . ' - ' . $bankAccount->getBalance() . ' - ' . date('H:i:s') . PHP_EOL;
//echo date('H:i:s') . ' - ' . $bankAccount->getBalance() . ' - ' . date('H:i:s') . PHP_EOL;
//
//$bankAccount = new BankAccountProxy();
//echo date('H:i:s') . ' - ' . $bankAccount->getBalance() . ' - ' . date('H:i:s') . PHP_EOL;
//echo date('H:i:s') . ' - ' . $bankAccount->getBalance() . ' - ' . date('H:i:s') . PHP_EOL;
//echo '</pre>';

//interface Downloader
//{
//    public function download(string $url): string;
//}
//
///**
// * Реальный Субъект делает реальную работу, хотя и не самым эффективным
// * способом. Когда клиент пытается загрузить тот же самый файл во второй раз,
// * наш загрузчик именно это и делает, вместо того, чтобы извлечь результат из
// * кэша.
// */
//class SimpleDownloader implements Downloader
//{
//    public function download(string $url): string
//    {
//        echo "Downloading a file from the Internet.\n";
//        $result = file_get_contents($url);
//        echo "Downloaded bytes: " . strlen($result) . "\n";
//
//        return $result;
//    }
//}
//
///**
// * Класс Заместителя – это попытка сделать загрузку более эффективной. Он
// * обёртывает реальный объект загрузчика и делегирует ему первые запросы на
// * скачивание. Затем результат кэшируется, что позволяет последующим вызовам
// * возвращать уже имеющийся файл вместо его повторной загрузки.
// */
//class CachingDownloader implements Downloader
//{
//    /**
//     * @var SimpleDownloader
//     */
//    private $downloader;
//
//    /**
//     * @var string[]
//     */
//    private $cache = [];
//
//    public function __construct(SimpleDownloader $downloader)
//    {
//        $this->downloader = $downloader;
//    }
//
//    public function download(string $url): string
//    {
//        if (!isset($this->cache[$url])) {
//            echo "CacheProxy MISS. ";
//            $result = $this->downloader->download($url);
//            $this->cache[$url] = $result;
//        } else {
//            echo "CacheProxy HIT. Retrieving result from cache.\n";
//        }
//        return $this->cache[$url];
//    }
//}
//
///**
// * Клиентский код может выдать несколько похожих запросов на загрузку. В этом
// * случае кэширующий заместитель экономит время и трафик, подавая результаты из
// * кэша.
// *
// * Клиент не знает, что он работает с заместителем, потому что он работает с
// * загрузчиками через абстрактный интерфейс.
// */
//function clientCode(Downloader $subject)
//{
//    // ...
//
//    $result = $subject->download("http://example.com/");
//
//    // Повторяющиеся запросы на загрузку могут кэшироваться для увеличения
//    // скорости.
//
//    $result = $subject->download("http://example.com/");
//
//    // ...
//}
//
//echo "Executing client code with real subject:\n";
//$realSubject = new SimpleDownloader();
//clientCode($realSubject);
//
//echo "\n";
//
//echo "Executing the same client code with a proxy:\n";
//$proxy = new CachingDownloader($realSubject);
//clientCode($proxy);

