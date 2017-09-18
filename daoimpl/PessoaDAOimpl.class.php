<?php
namespace daoimpl;

use \dao\PessoaDAO as PessoaDAO;
use \models\Pessoa as Pessoa;
use \servicos\SqlQuery as SqlQuery;
use \servicos\QueryExecutor as QueryExecutor;

class PessoaDAOimpl implements PessoaDAO{

	public function listarId($id){
		$sql = 'SELECT * FROM pessoa WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	public function listar(){
		$sql = 'SELECT * FROM pessoa';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}	
	
	public function deletar($cod){
		$sql = 'DELETE FROM pessoa WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($cod);
		return $this->executeUpdate($sqlQuery);
	}
	
	
	public function inserir($pessoa){
		$sql = 'INSERT INTO pessoa (endereco, bairro, cidade, uf, cep, telefone1, telefone2) VALUES (?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($pessoa->endereco);
		$sqlQuery->set($pessoa->bairro);
		$sqlQuery->set($pessoa->cidade);
		$sqlQuery->set($pessoa->uf);
		$sqlQuery->set($pessoa->cep);
		$sqlQuery->set($pessoa->telefone1);
		$sqlQuery->set($pessoa->telefone2);

		$id = $this->executeInsert($sqlQuery);	
		$pessoa->cod = $id;
		return $id;
	}
	
	
	public function atualizar($pessoa){
		$sql = 'UPDATE pessoa SET endereco = ?, bairro = ?, cidade = ?, uf = ?, cep = ?, telefone1 = ?, telefone2 = ? WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($pessoa->endereco);
		$sqlQuery->set($pessoa->bairro);
		$sqlQuery->set($pessoa->cidade);
		$sqlQuery->set($pessoa->uf);
		$sqlQuery->set($pessoa->cep);
		$sqlQuery->set($pessoa->telefone1);
		$sqlQuery->set($pessoa->telefone2);

		$sqlQuery->setNumber($pessoa->cod);
		return $this->executeUpdate($sqlQuery);
	}

	public function limpar(){
		$sql = 'DELETE FROM pessoa';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}
	
	protected function readRow($row){
		$pessoa = new Pessoa();
		
		$pessoa->setCod($row['cod']);
		$pessoa->setEndereco($row['endereco']);
		$pessoa->setBairro($row['bairro']);
		$pessoa->setCidade($row['cidade']);
		$pessoa->setUf($row['uf']);
		$pessoa->setCep($row['cep']);
		$pessoa->setTelefone1($row['telefone1']);
		$pessoa->setTelefone2($row['telefone2']);

		return $pessoa;
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