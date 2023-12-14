<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . "/lr2/.config/config.php");
class DB
{
    private static $instance = null;
    private $connection;
    private function __clone() {}
    public function __wakeup() {
        throw new Exception("You shouldn't call this method. Give up. Go home and sleep. Try again tomorrow.");
    }
    private function __construct()
    {
        global $DB_CONNECTION;
        $this->connection = new PDO(
            "mysql:host=" . $DB_CONNECTION['DB_HOST'] . ":" . $DB_CONNECTION['DB_PORT'] . ";dbname=" . $DB_CONNECTION['DB_NAME'],
            $DB_CONNECTION['DB_USER'],
            $DB_CONNECTION['DB_PASSWORD']);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    public static function prepare(string $stmt): PDOStatement
    {
        return static::getConnection()->prepare($stmt);
    }
    private static function getInstance(): DB
    {
        if (self::$instance == null)
        {
            self::$instance = new DB();
        }
        return self::$instance;

    }
    private static function getConnection(): PDO
    {
        return static::getInstance()->connection;
    }
}
