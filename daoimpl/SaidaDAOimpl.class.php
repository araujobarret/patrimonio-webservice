<?php
namespace daoimpl;
use \dao\SaidaDAO as SaidaDAO;
use \servicos\SqlQuery as SqlQuery;
use \servicos\QueryExecutor as QueryExecutor;

class SaidaDAOimpl implements SaidaDAO{

	public function detalhar($id){
		$sql = 'SELECT * FROM saida WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	public function listar(){
		$sql = 'SELECT * FROM saida';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}

	public function deletar($cod){
		$sql = 'DELETE FROM saida WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($cod);
		return $this->executeUpdate($sqlQuery);
	}

	public function inserir($saida){
		$sql = 'INSERT INTO saida (descricao, login_usuario_patrimonio, cod_processo, data) VALUES (?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($saida->descricao);
		$sqlQuery->set($saida->loginUsuarioPatrimonio);
		$sqlQuery->setNumber($saida->codProcesso);
		$sqlQuery->set($saida->data);

		$id = $this->executeInsert($sqlQuery);	
		$saida->cod = $id;
		return $id;
	}

	public function atualizar($saida){
		$sql = 'UPDATE saida SET descricao = ?, login_usuario_patrimonio = ?, cod_processo = ?, data = ? WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($saida->descricao);
		$sqlQuery->set($saida->loginUsuarioPatrimonio);
		$sqlQuery->setNumber($saida->codProcesso);
		$sqlQuery->set($saida->data);

		$sqlQuery->setNumber($saida->cod);
		return $this->executeUpdate($sqlQuery);
	}
	
	public function limpar(){
		$sql = 'DELETE FROM saida';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}
	
	public function inserir_saida_cessao($codSaida,$dataEntrada)
	{
		$sql = 'INSERT INTO saida_cessao(cod_saida,data_entrada) VALUES (?,?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($codSaida);
		$sqlQuery->set($dataEntrada);
		$id = $this->executeInsert($sqlQuery);	
		return $id;
	}
	
	public function inserir_saida_desfaziamento($codSaida,$codModoDesfaziamento)
	{
		$sql = 'INSERT INTO saida_desfaziamento(cod_saida,cod_modo_desfaziamento) VALUES (?,?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($codSaida);
		$sqlQuery->setNumber($codModoDesfaziamento);
		$id = $this->executeInsert($sqlQuery);	
		return $id;
	}
	
	public function inserir_saida_doacao($codSaida,$data_entrada)
	{
		$sql = 'INSERT INTO saida_doacao(cod_saida) VALUES (?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($codSaida);
		$id = $this->executeInsert($sqlQuery);	
		return $id;
	}

	public function queryByDescricao($value){
		$sql = 'SELECT * FROM saida WHERE descricao = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByLoginUsuarioPatrimonio($value){
		$sql = 'SELECT * FROM saida WHERE login_usuario_patrimonio = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByCodProcesso($value){
		$sql = 'SELECT * FROM saida WHERE cod_processo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryByData($value){
		$sql = 'SELECT * FROM saida WHERE data = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByDescricao($value){
		$sql = 'DELETE FROM saida WHERE descricao = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByLoginUsuarioPatrimonio($value){
		$sql = 'DELETE FROM saida WHERE login_usuario_patrimonio = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByCodProcesso($value){
		$sql = 'DELETE FROM saida WHERE cod_processo = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByData($value){
		$sql = 'DELETE FROM saida WHERE data = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	protected function readRow($row){
		$saida = new Saida();
		
		$saida->cod = $row['cod'];
		$saida->descricao = $row['descricao'];
		$saida->loginUsuarioPatrimonio = $row['login_usuario_patrimonio'];
		$saida->codProcesso = $row['cod_processo'];
		$saida->data = $row['data'];

		return $saida;
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