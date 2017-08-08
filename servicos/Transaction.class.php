<?php
namespace servicos;
class Transaction{
	private static $transactions;

	private $connection;

	public function __construct(){
		$this->connection = new Connection();
		if(!Transaction::$transactions){
			Transaction::$transactions = new ArrayList();
		}
		Transaction::$transactions->add($this);
		$this->connection->executeQuery('BEGIN');
	}

	public function commit(){
		$this->connection->executeQuery('COMMIT');
		$this->connection->close();
		Transaction::$transactions->removeLast();
	}

	public function rollback(){
		$this->connection->executeQuery('ROLLBACK');
		$this->connection->close();
		Transaction::$transactions->removeLast();
	}

	public function getConnection(){
		return $this->connection;
	}

	public static function getCurrentTransaction(){
		if(Transaction::$transactions){
			$tran = Transaction::$transactions->getLast();
			return $tran;
		}
		return;
	}
}
?>