<?php
namespace servicos;
class ConnectionFactory{

    private static $pdo;
	
	static public function getConnection(){
		
		self::$pdo = new \PDO("mysql:host=".ConnectionProperty::getHost().";dbname=".ConnectionProperty::getDatabase().";charset=utf8", ConnectionProperty::getUser(), ConnectionProperty::getPassword());
        self::$pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		if(!self::$pdo){
			throw new Exception('Não pode estabelecer conexão com a base de dados');
		}
		return self::$pdo;
	}

	static public function close($connection){
		self::$pdo=null;
	}

    public function getPdo()
    {
        return self::$pdo;
    }
}
?>