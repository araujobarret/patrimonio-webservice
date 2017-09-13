<?php
namespace daoimpl;

use \dao\PessoaJuridicaDAO as PessoaJuridicaDAO;
use \models\PessoaJuridica as PessoaJuridica;
use \servicos\SqlQuery as SqlQuery;
use \servicos\QueryExecutor as QueryExecutor;

class PessoaJuridicaDAOimpl implements PessoaJuridicaDAO{

	public function detalhar($id){
		$sql = 'SELECT * FROM pessoa_juridica WHERE cod_pessoa = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	public function listar(){
		$sql = 'SELECT * FROM pessoa_juridica';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
		
	public function deletar($cod_pessoa){
		$sql = 'DELETE FROM pessoa_juridica WHERE cod_pessoa = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($cod_pessoa);
		return $this->executeUpdate($sqlQuery);
	}
	
	public function inserir($pessoaJuridica){
		$sql = 'INSERT INTO pessoa_juridica (cnpj, razao_social) VALUES (?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($pessoaJuridica->cnpj);
		$sqlQuery->set($pessoaJuridica->razaoSocial);

		$id = $this->executeInsert($sqlQuery);	
		$pessoaJuridica->codPessoa = $id;
		return $id;
	}
	
	public function atualizar($pessoaJuridica){
		$sql = 'UPDATE pessoa_juridica SET cnpj = ?, razao_social = ? WHERE cod_pessoa = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($pessoaJuridica->cnpj);
		$sqlQuery->set($pessoaJuridica->razaoSocial);

		$sqlQuery->setNumber($pessoaJuridica->codPessoa);
		return $this->executeUpdate($sqlQuery);
	}
	
	public function limpar(){
		$sql = 'DELETE FROM pessoa_juridica';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	protected function readRow($row){
		$pessoaJuridica = new PessoaJuridica();
		
		$pessoaJuridica->codPessoa = $row['cod_pessoa'];
		$pessoaJuridica->cnpj = $row['cnpj'];
		$pessoaJuridica->razaoSocial = $row['razao_social'];

		return $pessoaJuridica;
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