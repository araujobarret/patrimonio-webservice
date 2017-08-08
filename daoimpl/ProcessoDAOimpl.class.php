<?php
/**
 * Class that operate on table 'processo'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2017-07-12 20:00
 */
class ProcessoMySqlDAO implements ProcessoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return ProcessoMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM processo WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM processo';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM processo ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param processo primary key
 	 */
	public function delete($cod){
		$sql = 'DELETE FROM processo WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($cod);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param ProcessoMySql processo
 	 */
	public function insert($processo){
		$sql = 'INSERT INTO processo (numero, assunto) VALUES (?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($processo->numero);
		$sqlQuery->set($processo->assunto);

		$id = $this->executeInsert($sqlQuery);	
		$processo->cod = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param ProcessoMySql processo
 	 */
	public function update($processo){
		$sql = 'UPDATE processo SET numero = ?, assunto = ? WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($processo->numero);
		$sqlQuery->set($processo->assunto);

		$sqlQuery->setNumber($processo->cod);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM processo';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByNumero($value){
		$sql = 'SELECT * FROM processo WHERE numero = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByAssunto($value){
		$sql = 'SELECT * FROM processo WHERE assunto = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByNumero($value){
		$sql = 'DELETE FROM processo WHERE numero = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByAssunto($value){
		$sql = 'DELETE FROM processo WHERE assunto = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return ProcessoMySql 
	 */
	protected function readRow($row){
		$processo = new Processo();
		
		$processo->cod = $row['cod'];
		$processo->numero = $row['numero'];
		$processo->assunto = $row['assunto'];

		return $processo;
	}
	
	protected function getList($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		$ret = array();
		for($i=0;$i<count($tab);$i++){
			$ret[$i] = $this->readRow($tab[$i]);
		}
		return $ret;
	}
	
	/**
	 * Get row
	 *
	 * @return ProcessoMySql 
	 */
	protected function getRow($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		if(count($tab)==0){
			return null;
		}
		return $this->readRow($tab[0]);		
	}
	
	/**
	 * Execute sql query
	 */
	protected function execute($sqlQuery){
		return QueryExecutor::execute($sqlQuery);
	}
	
		
	/**
	 * Execute sql query
	 */
	protected function executeUpdate($sqlQuery){
		return QueryExecutor::executeUpdate($sqlQuery);
	}

	/**
	 * Query for one row and one column
	 */
	protected function querySingleResult($sqlQuery){
		return QueryExecutor::queryForString($sqlQuery);
	}

	/**
	 * Insert row to table
	 */
	protected function executeInsert($sqlQuery){
		return QueryExecutor::executeInsert($sqlQuery);
	}
}
?>