<?php

namespace daoimpl;
use \dao\SetorDAO as SetorDAO;

class SetorMySqlDAO implements SetorDAO{

	public function detalhar($id){
		$sql = 'SELECT * FROM setor WHERE sigla = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($id);
		return $this->getRow($sqlQuery);
	}

	public function listar(){
		$sql = 'SELECT * FROM setor';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}

	public function deletar($sigla){
		$sql = 'DELETE FROM setor WHERE sigla = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($sigla);
		return $this->executeUpdate($sqlQuery);
	}

	public function inserir($setor){
		$sql = 'INSERT INTO setor (sigla) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($setor->sigla);
		$id = $this->executeInsert($sqlQuery);	
		$setor->sigla = $id;
		return $id;
	}
	
	public function atualizar($setor){
		$sql = 'UPDATE setor SET  WHERE sigla = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($setor->sigla);
		return $this->executeUpdate($sqlQuery);
	}
	
	public function limpar(){
		$sql = 'DELETE FROM setor';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	protected function readRow($row){
		$setor = new Setor();
		
		$setor->sigla = $row['sigla'];

		return $setor;
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