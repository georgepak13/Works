<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/web-lab/LB1/.core/index.php');
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
}
