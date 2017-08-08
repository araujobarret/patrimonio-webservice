<?php
namespace daoimpl;
use \dao\EntradaDAO as EntradaDAO;
use \servicos\SqlQuery as SqlQuery;
use \servicos\QueryExecutor as QueryExecutor;

class EntradaDAOimpl implements EntradaDAO{

	public function detalhar($id){
		$sql = 'SELECT * FROM entrada WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}
	
	public function listar(){
		$sql = 'SELECT * FROM entrada';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	public function deletar($cod){
		$sql = 'DELETE FROM entrada WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($cod);
		return $this->executeUpdate($sqlQuery);
	}
	
	public function inserir($entrada){
		$sql = 'INSERT INTO entrada (descricao, login_usuario_patrimonio, data, cod_processo, cod_pessoa) VALUES (?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($entrada->descricao);
		$sqlQuery->set($entrada->loginUsuarioPatrimonio);
		$sqlQuery->set($entrada->data);
		$sqlQuery->setNumber($entrada->codProcesso);
		$sqlQuery->setNumber($entrada->codPessoa);

		$id = $this->executeInsert($sqlQuery);	
		$entrada->cod = $id;
		return $id;
	}

	public function atualizar($entrada){
		$sql = 'UPDATE entrada SET descricao = ?, login_usuario_patrimonio = ?, data = ?, cod_processo = ?, cod_pessoa = ? WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($entrada->descricao);
		$sqlQuery->set($entrada->loginUsuarioPatrimonio);
		$sqlQuery->set($entrada->data);
		$sqlQuery->setNumber($entrada->codProcesso);
		$sqlQuery->setNumber($entrada->codPessoa);

		$sqlQuery->setNumber($entrada->cod);
		return $this->executeUpdate($sqlQuery);
	}

	public function limpar(){
		$sql = 'DELETE FROM entrada';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}
	
	public function inserir_entrada_aquisicao($codEntrada)
	{
		$sql = 'INSERT INTO entrada_aquisicao(cod_entrada) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($codEntrada);

		$id = $this->executeInsert($sqlQuery);	
		return $id;
	}
	
	public function inserir_entrada_comodato($codEntrada)
	{
		$sql = 'INSERT INTO entrada_comodato(cod_entrada) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($codEntrada);
		$id = $this->executeInsert($sqlQuery);	
		return $id;
	}
	
	public function inserir_entrada_doacao($codEntrada)
	{
		$sql = 'INSERT INTO entrada_doacao(cod_entrada) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($codEntrada);
		$id = $this->executeInsert($sqlQuery);	
		return $id;
	}
	
	public function inserir_entrada_incorporacao($codEntrada)
	{
		$sql = 'INSERT INTO entrada_incorporacao(cod_entrada) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($entrada->codEntrada);

		$id = $this->executeInsert($sqlQuery);	
		$entrada->cod = $id;
		return $id;
	}

	public function queryByDescricao($value){
		$sql = 'SELECT * FROM entrada WHERE descricao = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByLoginUsuarioPatrimonio($value){
		$sql = 'SELECT * FROM entrada WHERE login_usuario_patrimonio = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByData($value){
		$sql = 'SELECT * FROM entrada WHERE data = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCodProcesso($value){
		$sql = 'SELECT * FROM entrada WHERE cod_processo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCodPessoa($value){
		$sql = 'SELECT * FROM entrada WHERE cod_pessoa = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function deleteByDescricao($value){
		$sql = 'DELETE FROM entrada WHERE descricao = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByLoginUsuarioPatrimonio($value){
		$sql = 'DELETE FROM entrada WHERE login_usuario_patrimonio = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByData($value){
		$sql = 'DELETE FROM entrada WHERE data = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCodProcesso($value){
		$sql = 'DELETE FROM entrada WHERE cod_processo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCodPessoa($value){
		$sql = 'DELETE FROM entrada WHERE cod_pessoa = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}
	
	protected function readRow($row){
		$entrada = new Entrada();
		
		$entrada->cod = $row['cod'];
		$entrada->descricao = $row['descricao'];
		$entrada->loginUsuarioPatrimonio = $row['login_usuario_patrimonio'];
		$entrada->data = $row['data'];
		$entrada->codProcesso = $row['cod_processo'];
		$entrada->codPessoa = $row['cod_pessoa'];

		return $entrada;
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