<?php
namespace daoimpl;
use \dao\UsuarioDAO as UsuarioDAO;
use \models\Usuario as Usuario;
use \servicos\SqlQuery as SqlQuery;
use \servicos\QueryExecutor as QueryExecutor;

class UsuarioDAOImpl implements UsuarioDAO{

	public function load($id){
		$sql = 'SELECT * FROM usuario WHERE login = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($id);
		return $this->getRow($sqlQuery);
	}

	public function queryAll(){
		$sql = 'SELECT * FROM usuario';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM usuario ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}

	public function delete($login){
		$sql = 'DELETE FROM usuario WHERE login = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($login);
		return $this->executeUpdate($sqlQuery);
	}
	
	public function insert($usuario){
		$sql = 'INSERT INTO usuario (nome,login) VALUES (?,?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($usuario->nome);
		$sqlQuery->set($usuario->login);

		$id = $this->executeInsert($sqlQuery);	
		$usuario->login = $id;
		return $id;
	}
	
	public function update($usuario){
		$sql = 'UPDATE usuario SET nome = ? WHERE login = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($usuario->nome);

		$sqlQuery->set($usuario->login);
		return $this->executeUpdate($sqlQuery);
	}

	public function clean(){
		$sql = 'DELETE FROM usuario';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByNome($value){
		$sql = 'SELECT * FROM usuario WHERE nome = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByNome($value){
		$sql = 'DELETE FROM usuario WHERE nome = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	protected function readRow($row){
		$usuario = new Usuario();
		
		$usuario->setLogin($row['login']);
		$usuario->setNome($row['nome']);

		return $usuario;
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