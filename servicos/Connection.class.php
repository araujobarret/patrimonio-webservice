<?php
namespace servicos;

class Connection{
	private $connection;

	public function Connection(){
		$this->connection = ConnectionFactory::getConnection();
		return $this->connection;
	}

	public function close(){
		ConnectionFactory::close($this->connection);
	}
	public function executeQuery($sql){
		$this->connection = ConnectionFactory::getConnection();
		$stmt = $this->connection->prepare($sql);
		$stmt->execute();				
		return $stmt; 
	}
}
?>