<?php
namespace servicos;
class QueryExecutor{
	
	public static function execute($sqlQuery){
		$transaction = Transaction::getCurrentTransaction();
		if(!$transaction){
			$connection = new Connection();
		}else{
			$connection = $transaction->getConnection();
		}		
		$query = $sqlQuery->getQuery();

		$result = $connection->executeQuery($query);
		if(!$result){
			throw new Exception("SQL Error: -->".$query."<--" . mysqli_error());
		}
		$tab = $result->fetchAll();
		$result->closeCursor();
		
		if(!$transaction){
			$connection->close();
		}
		return $tab;
	}
	
	
	public static function executeUpdate($sqlQuery){
		$transaction = Transaction::getCurrentTransaction();
		if(!$transaction){
			$connection = new Connection();
		}else{
			$connection = $transaction->getConnection();
		}		
		$query = $sqlQuery->getQuery();
		$result = $connection->executeQuery($query);
		if(!$result){
			throw new Exception("SQL Error: -->".$query."<--" . mysqli_error());
		}
		return $result->rowCount();		
	}

	public static function executeInsert($sqlQuery){
		return self::executeUpdate($sqlQuery);
		//return $result->lastInsertId();
	}

	public static function queryForString($sqlQuery){
		$transaction = Transaction::getCurrentTransaction();
		if(!$transaction){
			$connection = new Connection();
		}else{
			$connection = $transaction->getConnection();
		}
		$result = $connection->executeQuery($sqlQuery->getQuery());
		if(!$result){
			throw new Exception("SQL Error: -->".$sqlQuery->getQuery()."<--" . mysqli_error());
		}
		$row = $result->fetchAll();		
		return $row[0];
	}

}
?>