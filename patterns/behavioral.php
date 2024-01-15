<?php

// ** Цепочка навигации

//interface Handler
//{
//    public function handle(string $request);
//}
//
//abstract class AbstractHandler implements Handler
//{
//    private $next = null;
//
//    public function link(Handler $next)
//    {
//        $this->next = $next;
//        return $this->next;
//    }
//
//    public function handle($request)
//    {
//        if (!is_null($this->next)) {
//            return $this->next->handle($request);
//        }
//        return false;
//    }
//}
//
//class Operator extends AbstractHandler
//{
//    private $name;
//
//    public function __construct($name)
//    {
//        $this->name = $name;
//    }
//
//    public function handle($request)
//    {
//        if ($this->isBusy()) {
//            echo "Оператор {$this->name} занят" . PHP_EOL;
//
//            return parent::handle($request);
//        }
//
//        echo "Запрос $request принят оператором $this->name" . PHP_EOL;
//
//        return true;
//    }
//
//    private function isBusy()
//    {
//        return (bool)rand(0, 4);
//    }
//}
//
//class BusyHandler extends AbstractHandler
//{
//    private $request = null;
//
//    public function handle($request)
//    {
//        if ($this->request == $request) {
//            echo "Все операторы заняты" . PHP_EOL;
//            return false;
//        }
//
//        $this->request = $request;
//
//        if ($result = parent::handle($request)) {
//            return $result;
//        }
//    }
//}
//
//
//$busyHandler = new BusyHandler();
//$busyHandler
//    ->link(new Operator('#1'))
//    ->link(new Operator('#2'))
//    ->link(new Operator('#3'))
//    ->link($busyHandler);
//
//for ($i = 0; $i < 3; $i++){
//    $result = $busyHandler->handle("request $i");
//    if(!$result) {
//        echo 'запрос передан на уровень выше ' . PHP_EOL;
//    }
//}


// ** Команда

/**
 * Интерфейс Команды объявляет основной метод выполнения, а также несколько
 * вспомогательных методов для получения метаданных команды.
 */
//interface Command
//{
//    public function execute();
//
//    public function getId();
//
//    public function getStatus();
//}
//
///**
// * Базовая Команда скрейпинга устанавливает базовую инфраструктуру загрузки,
// * общую для всех конкретных команд скрейпинга.
// */
//abstract class WebScrapingCommand implements Command
//{
//    public $id;
//    public $status;
//
//    /**
//     * @var string URL для скрейпинга.
//     */
//    public $url;
//
//    public function __construct(string $url)
//    {
//        $this->url = $url;
//    }
//
//    public function getuRL(): string
//    {
//        return $this->url;
//    }
//
//    public function getId(): int
//    {
//        return $this->id;
//    }
//
//    public function getStatus(): int
//    {
//        return $this->status;
//    }
//
//    /**
//     * Поскольку методы выполнения для всех команд скрейпинга очень похожи, мы
//     * можем предоставить реализацию по умолчанию, позволив подклассам
//     * переопределить её при необходимости.
//     *
//     * Шш! Наблюдательный читатель может обнаружить здесь другой поведенческий
//     * паттерн в действии.
//     */
//
//    public function execute()
//    {
//        $html = $this->download();
//        $this->parse($html);
//        $this->complete();
//    }
//
//    public function download(): string
//    {
//        $html = file_get_contents($this->getuRL());
//        echo "WebScrapingCommand: Downloaded {$this->url}\n";
//
//        return $html;
//    }
//
//    abstract public function parse(string $html): void;
//
//    public function complete(): void
//    {
//        $this->status = 1;
//        Queue::get()->completeCommand($this);
//    }
//}
//
///**
// * Конкретная Команда для извлечения списка жанров фильма.
// */
//class IMDBGenresScrapingCommand extends WebScrapingCommand
//{
//
//
//    public function __construct()
//    {
//        $this->url = "https://www.imdb.com/feature/genre/";
//
//    }
//
//    /**
//     * Извлечение всех жанров и их поисковых URL со страницы:
//     * https://www.imdb.com/feature/genre/
//     */
//
//    #[\Override] public function parse(string $html): void
//    {
//        $dblogin = 'root';
//        $password = '';
//        $dbname = 'imdb';
//        $host = '127.0.0.1';
//
//
//        preg_match_all("|href=\"(https://www.imdb.com/search/title\?genres=.*?)\"|", $html, $matches);
//        echo "IMDBGenresScrapingCommand: Discovered " . count($matches[1]) . " genres.\n";
//        var_dump($matches[1]);
//
//        foreach ($matches[1] as $genre) {
//            Queue::get()->add(new IMDBGenrePageScrapingCommand($genre));
//        }
//    }
//
//}
//
///**
// * Конкретная Команда для извлечения списка фильмов определённого жанра.
// */
//class IMDBGenrePageScrapingCommand extends WebScrapingCommand
//{
//    private $page;
//
//    public function __construct(string $url, int $page = 1)
//    {
//        parent::__construct($url);
//        $this->page = $page;
//    }
//
//    public function getURL(): string
//    {
//        return $this->url . '?page=' . $this->page;
//    }
//
//    /**
//     * Извлечение всех фильмов со страницы вроде этой:
//     * https://www.imdb.com/search/title?genres=sci-fi&explore=title_type,genres
//     */
//    public function parse(string $html): void
//    {
//        preg_match_all("|href=\"(/title/.*?/)\?ref_=adv_li_tt\"|", $html, $matches);
//        echo "IMDBGenrePageScrapingCommand: Discovered " . count($matches[1]) . " movies.\n";
//
//        foreach ($matches[1] as $moviePath) {
//            $url = "https://www.imdb.com" . $moviePath;
//            Queue::get()->add(new IMDBMovieScrapingCommand($url));
//        }
//
//        // Извлечение URL следующей страницы.
//        if (preg_match("|Next &#187;</a>|", $html)) {
//            Queue::get()->add(new IMDBGenrePageScrapingCommand($this->url, $this->page + 1));
//        }
//    }
//}
//
///**
// * Конкретная Команда для извлечения подробных сведений о фильме.
// */
//class IMDBMovieScrapingCommand extends WebScrapingCommand
//{
//    /**
//     * Получить информацию о фильме с подобной страницы:
//     * https://www.imdb.com/title/tt4154756/
//     */
//    public function parse(string $html): void
//    {
//        if (preg_match("|<h1 itemprop=\"name\" class=\"\">(.*?)</h1>|", $html, $matches)) {
//            $title = $matches[1];
//        }
//        echo "IMDBMovieScrapingCommand: Parsed movie $title.\n";
//    }
//}
//
///**
// * Класс Очередь действует как Отправитель. Он складывает объекты команд в стек
// * и выполняет их поочерёдно. Если выполнение скрипта внезапно завершится,
// * очередь и все её команды можно будет легко восстановить, и вам не придётся
// * повторять все выполненные команды..
// */
//class Queue
//{
//    const OPTION = [
//        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
//        PDO::ATTR_EMULATE_PREPARES => false,
//        PDO::ATTR_EMULATE_PREPARES => true
////        PDO::MYSQL_ATTR_USE_BUFFERED_QUERY,
//    ];
//
//    private $dblogin;
//    private $dbpassword;
//    private $dbname;
//    private $host;
//    private $dsn;
//
//    private $database;
//
//    public function __construct()
//    {
//        $this->dblogin = 'root';
//        $this->dbpassword = '';
//        $this->dbname = 'imdb';
//        $this->host = '127.0.0.1';
//        $this->dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8";
//
//        try {
//            $this->database = new PDO($this->dsn, $this->dblogin, $this->dbpassword, self::OPTION);
//        } catch (PDOException $e) {
//            $this->database = null;
//            echo "Подключение не удалось: {$e->getMessage()}";
//        }
//
//        if (!is_null($this->database)) {
//            $this->database->query('create table if not exists commands (
//                `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
//                `command` TEXT,
//                `status` INTEGER
//            )');
//        }
//    }
//
//    public function isEmpty(): bool
//    {
//        $query = 'select count(`id`) from commands where `status` = 0';
//
//        return $this->database->exec($query) === 0;
//    }
//
//    public function add(Command $command)
//    {
//        $statement = $this->database->prepare('insert into commands (`command`, `status`)
//                                              values (:command, :status)');
//        $statement->bindValue(':command', base64_encode(serialize($command)), PDO::PARAM_STR);
//        $statement->bindValue(':status', $command->getStatus(), PDO::PARAM_INT);
//        $statement->execute();
//    }
//
//    public function getCommand(): Command
//    {
//        $query = 'select * from commands where `status` = 0 limit 1';
//        $record = $this->database->query($query);
//        $command = unserialize(base64_decode($record["command"]));
//        $command->id = $record['id'];
//
//        return $command;
//    }
//
//    public function completeCommand(Command $command): void
//    {
//        $statement = $this->database->prepare('update commands set `status` = :status where `id` = :id');
//        $statement->bindValue(':status', $command->getStatus());
//        $statement->bindValue(':id', $command->getId());
//        $statement->execute();
//    }
//
//    public function work(): void
//    {
//        while (!$this->isEmpty()){
//            $command = $this->getCommand();
//            $command->execute();
//        }
//    }
//
//    /**
//     * Для удобства объект Очереди является Одиночкой.
//     */
//    public static function get(): Queue
//    {
//        static $instance;
//        if (!$instance) {
//            $instance = new Queue();
//        }
//
//        return $instance;
//    }
//}
//
//$queue = Queue::get();
//
//if($queue->isEmpty()){
//    $queue->add(new IMDBGenresScrapingCommand());
//}
//
//$queue->work();

// ** Наблюдатель / Observer

interface Observer
{
    public function update($subject);
}

abstract class Subject
{
    protected $observers;

    public function __construct()
    {
        $this->observers = new \SplObjectStorage();
    }

    public function attach(Observer $observer)
    {
        $this->observers->attach($observer);
    }

    public function detach(Observer $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}

class User extends Subject
{
    private $email;

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
        $this->notify();
    }
}

class UserEmailObserver implements Observer
{
    public function update($subject){
        echo 'Обновлены данные пользователя, посылаем на почту: ' . $subject->getEmail() . PHP_EOL;
    }
}

$user = new User();
$user->attach(new UserEmailObserver());
$user->setEmail('testty@mail.ru');