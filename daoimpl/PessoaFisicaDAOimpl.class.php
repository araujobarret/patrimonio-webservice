<?php
namespace daoimpl;

use \dao\PessoaFisicaDAO as PessoaFisicaDAO;
use \models\PessoaFisica as PessoaFisica;
use \servicos\SqlQuery as SqlQuery;
use \servicos\QueryExecutor as QueryExecutor;

class PessoaFisicaDAOimpl extends PessoaDAOimpl implements PessoaFisicaDAO{

	public function detalhar($id){
		$sql = 'SELECT * FROM pessoa_fisica WHERE cod_pessoa = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	public function listar(){
		$sql = 'SELECT * FROM pessoa_fisica';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	public function deletar($cod_pessoa){
		$sql = 'DELETE FROM pessoa_fisica WHERE cod_pessoa = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($cod_pessoa);
		return $this->executeUpdate($sqlQuery);
	}

	public function inserir($pessoaFisica){
		$sql = 'INSERT INTO pessoa_fisica (cpf, nome) VALUES (?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($pessoaFisica->cpf);
		$sqlQuery->set($pessoaFisica->nome);

		$id = $this->executeInsert($sqlQuery);	
		$pessoaFisica->codPessoa = $id;
		return $id;
	}

	public function atualizar($pessoaFisica){
		$sql = 'UPDATE pessoa_fisica SET cpf = ?, nome = ? WHERE cod_pessoa = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($pessoaFisica->cpf);
		$sqlQuery->set($pessoaFisica->nome);

		$sqlQuery->setNumber($pessoaFisica->codPessoa);
		return $this->executeUpdate($sqlQuery);
	}

	public function limpar(){
		$sql = 'DELETE FROM pessoa_fisica';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	protected function readRow($row){
		$pessoaFisica = new PessoaFisica();
		
		$pessoaFisica->codPessoa = $row['cod_pessoa'];
		$pessoaFisica->cpf = $row['cpf'];
		$pessoaFisica->nome = $row['nome'];

		return $pessoaFisica;
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