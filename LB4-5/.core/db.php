<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/web-lab/LB4-5/.core/index.php');
class DB {
    private static $instance = null;
    private $connect;

    private function __construct() {
       
        $this->connect = new mysqli("localhost", "root", "", "web");
        
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new DB();
        }
        return self::$instance->connect;
    }

    public function escape($value) {
        return $this->connect->real_escape_string($value);
    }
}
