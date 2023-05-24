<?php
namespace Db\PDO;

class Connection
{
  private static $instance;
  private $connection;

  private function __construct()
  {
    $this->makeConnection();
  }

  // function to get connection instance
  public static function getInstance(): Connection
  {
    // if instance is not a instance of connection
    if (!self::$instance instanceof self)
      // asign self instance to new instance
      self::$instance = new self;
    return self::$instance;
  }

  // get db instance
  public function getDbInstance()
  {
    return $this->connection;
  }


  private function makeConnection(): void
  {
    // gettin db credentials from .env file
    $HOST = $_ENV["DB_HOST"];
    $PASS = $_ENV["DB_PASS"];
    $USER = $_ENV["DB_USER"];
    $PORT = $_ENV["DB_PORT"];
    $NAME = $_ENV["DB_NAME"];

    try {
      $conn = new \PDO("mysql:host=$HOST;dbname=$NAME;port=$PORT", $USER, $PASS, array(\PDO::MYSQL_ATTR_FOUND_ROWS => true));
      $setNames = $conn->prepare("SET NAMES 'utf8'");
      $setNames->execute();
      $this->connection = $conn;
    } catch (\PDOException $e) {
      die("Connection failed: {$e->getMessage()}");
    }
  }
}