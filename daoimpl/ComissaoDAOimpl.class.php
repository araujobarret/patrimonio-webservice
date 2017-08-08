<?php
class ComissaoMySqlDAO implements ComissaoDAO{

	public function load($id){
		$sql = 'SELECT * FROM comissao WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	public function queryAll(){
		$sql = 'SELECT * FROM comissao';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}

	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM comissao ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}

	public function delete($cod){
		$sql = 'DELETE FROM comissao WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($cod);
		return $this->executeUpdate($sqlQuery);
	}

	public function insert($comissao){
		$sql = 'INSERT INTO comissao (portaria) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($comissao->portaria);

		$id = $this->executeInsert($sqlQuery);	
		$comissao->cod = $id;
		return $id;
	}

	public function update($comissao){
		$sql = 'UPDATE comissao SET portaria = ? WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($comissao->portaria);

		$sqlQuery->setNumber($comissao->cod);
		return $this->executeUpdate($sqlQuery);
	}

	public function clean(){
		$sql = 'DELETE FROM comissao';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByPortaria($value){
		$sql = 'SELECT * FROM comissao WHERE portaria = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByPortaria($value){
		$sql = 'DELETE FROM comissao WHERE portaria = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	protected function readRow($row){
		$comissao = new Comissao();
		
		$comissao->cod = $row['cod'];
		$comissao->portaria = $row['portaria'];

		return $comissao;
	}
	
	protected function getList($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		$ret = array();
		for($i=0;$i<count($tab);$i++){
			$ret[$i] = $this->readRow($tab[$i]);
		}
		return $ret;
	}

	protected function getRow($sqlQuery){
		$tab = QueryExecutor::execute($sqlQuery);
		if(count($tab)==0){
			return null;
		}
		return $this->readRow($tab[0]);		
	}

	protected function execute($sqlQuery){
		return QueryExecutor::execute($sqlQuery);
	}

	protected function executeUpdate($sqlQuery){
		return QueryExecutor::executeUpdate($sqlQuery);
	}

	protected function querySingleResult($sqlQuery){
		return QueryExecutor::queryForString($sqlQuery);
	}

	protected function executeInsert($sqlQuery){
		return QueryExecutor::executeInsert($sqlQuery);
	}
}
?>