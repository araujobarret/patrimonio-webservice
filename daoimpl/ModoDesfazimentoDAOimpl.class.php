<?php
namespace daoimpl;
use \dao\ModoDesfazimentoDAO as ModoDesfazimentoDAO;
use \servicos\SqlQuery as SqlQuery;
use \servicos\QueryExecutor as QueryExecutor;

class ModoDesfazimentoDAOimpl implements ModoDesfazimentoDAO{

	public function detalhar($id){
		$sql = 'SELECT * FROM modo_desfazimento WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	public function listar(){
		$sql = 'SELECT * FROM modo_desfazimento';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	public function deletar($cod){
		$sql = 'DELETE FROM modo_desfazimento WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($cod);
		return $this->executeUpdate($sqlQuery);
	}

	public function inserir($modoDesfazimento){
		$sql = 'INSERT INTO modo_desfazimento (descricao) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($modoDesfazimento->descricao);

		$id = $this->executeInsert($sqlQuery);	
		$modoDesfazimento->cod = $id;
		return $id;
	}

	public function atualizar($modoDesfazimento){
		$sql = 'UPDATE modo_desfazimento SET descricao = ? WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($modoDesfazimento->descricao);

		$sqlQuery->setNumber($modoDesfazimento->cod);
		return $this->executeUpdate($sqlQuery);
	}

	public function limpar(){
		$sql = 'DELETE FROM modo_desfazimento';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByDescricao($value){
		$sql = 'SELECT * FROM modo_desfazimento WHERE descricao = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByDescricao($value){
		$sql = 'DELETE FROM modo_desfazimento WHERE descricao = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	protected function readRow($row){
		$modoDesfazimento = new ModoDesfazimento();
		
		$modoDesfazimento->cod = $row['cod'];
		$modoDesfazimento->descricao = $row['descricao'];

		return $modoDesfazimento;
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