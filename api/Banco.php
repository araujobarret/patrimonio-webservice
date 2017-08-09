<?php

namespace patrimonio_webservice\controller;

Class Banco {

    private static $banco;
    private $pdo;

    private function __construct()
    {
        $this->pdo = new \PDO("mysql:host=localhost;dbname=patrimonio;charset=utf8", "root", "root");
        $this->pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstancia()
    {
        if(!self::$banco){
            self::$banco = new Banco();
        }
        return self::$banco;
    }

    public function getPdo()
    {
        return $this->pdo;
    }

}

?>