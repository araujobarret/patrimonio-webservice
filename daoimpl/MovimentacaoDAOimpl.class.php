<?php
/**
 * Class that operate on table 'movimentacao'. Database Mysql.
 *
 * @author: http://phpdao.com
 * @date: 2017-07-12 20:00
 */
class MovimentacaoMySqlDAO implements MovimentacaoDAO{

	/**
	 * Get Domain object by primry key
	 *
	 * @param String $id primary key
	 * @return MovimentacaoMySql 
	 */
	public function load($id){
		$sql = 'SELECT * FROM movimentacao WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	/**
	 * Get all records from table
	 */
	public function queryAll(){
		$sql = 'SELECT * FROM movimentacao';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
	 * Get all records from table ordered by field
	 *
	 * @param $orderColumn column name
	 */
	public function queryAllOrderBy($orderColumn){
		$sql = 'SELECT * FROM movimentacao ORDER BY '.$orderColumn;
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	/**
 	 * Delete record from table
 	 * @param movimentacao primary key
 	 */
	public function delete($cod){
		$sql = 'DELETE FROM movimentacao WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($cod);
		return $this->executeUpdate($sqlQuery);
	}
	
	/**
 	 * Insert record to table
 	 *
 	 * @param MovimentacaoMySql movimentacao
 	 */
	public function insert($movimentacao){
		$sql = 'INSERT INTO movimentacao (data_solicitacao, data_liberação, data_recebimento, status, login_usuario_setor_origem, login_usuario_setor_destino, login_usuario_patrimonio_liberacao, setor_origem, setor_destino) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($movimentacao->dataSolicitacao);
		$sqlQuery->set($movimentacao->dataLiberação);
		$sqlQuery->set($movimentacao->dataRecebimento);
		$sqlQuery->set($movimentacao->status);
		$sqlQuery->set($movimentacao->loginUsuarioSetorOrigem);
		$sqlQuery->set($movimentacao->loginUsuarioSetorDestino);
		$sqlQuery->set($movimentacao->loginUsuarioPatrimonioLiberacao);
		$sqlQuery->set($movimentacao->setorOrigem);
		$sqlQuery->set($movimentacao->setorDestino);

		$id = $this->executeInsert($sqlQuery);	
		$movimentacao->cod = $id;
		return $id;
	}
	
	/**
 	 * Update record in table
 	 *
 	 * @param MovimentacaoMySql movimentacao
 	 */
	public function update($movimentacao){
		$sql = 'UPDATE movimentacao SET data_solicitacao = ?, data_liberação = ?, data_recebimento = ?, status = ?, login_usuario_setor_origem = ?, login_usuario_setor_destino = ?, login_usuario_patrimonio_liberacao = ?, setor_origem = ?, setor_destino = ? WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($movimentacao->dataSolicitacao);
		$sqlQuery->set($movimentacao->dataLiberação);
		$sqlQuery->set($movimentacao->dataRecebimento);
		$sqlQuery->set($movimentacao->status);
		$sqlQuery->set($movimentacao->loginUsuarioSetorOrigem);
		$sqlQuery->set($movimentacao->loginUsuarioSetorDestino);
		$sqlQuery->set($movimentacao->loginUsuarioPatrimonioLiberacao);
		$sqlQuery->set($movimentacao->setorOrigem);
		$sqlQuery->set($movimentacao->setorDestino);

		$sqlQuery->setNumber($movimentacao->cod);
		return $this->executeUpdate($sqlQuery);
	}

	/**
 	 * Delete all rows
 	 */
	public function clean(){
		$sql = 'DELETE FROM movimentacao';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByDataSolicitacao($value){
		$sql = 'SELECT * FROM movimentacao WHERE data_solicitacao = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDataLiberação($value){
		$sql = 'SELECT * FROM movimentacao WHERE data_liberação = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByDataRecebimento($value){
		$sql = 'SELECT * FROM movimentacao WHERE data_recebimento = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByStatus($value){
		$sql = 'SELECT * FROM movimentacao WHERE status = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByLoginUsuarioSetorOrigem($value){
		$sql = 'SELECT * FROM movimentacao WHERE login_usuario_setor_origem = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByLoginUsuarioSetorDestino($value){
		$sql = 'SELECT * FROM movimentacao WHERE login_usuario_setor_destino = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByLoginUsuarioPatrimonioLiberacao($value){
		$sql = 'SELECT * FROM movimentacao WHERE login_usuario_patrimonio_liberacao = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySetorOrigem($value){
		$sql = 'SELECT * FROM movimentacao WHERE setor_origem = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySetorDestino($value){
		$sql = 'SELECT * FROM movimentacao WHERE setor_destino = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByDataSolicitacao($value){
		$sql = 'DELETE FROM movimentacao WHERE data_solicitacao = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDataLiberação($value){
		$sql = 'DELETE FROM movimentacao WHERE data_liberação = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByDataRecebimento($value){
		$sql = 'DELETE FROM movimentacao WHERE data_recebimento = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByStatus($value){
		$sql = 'DELETE FROM movimentacao WHERE status = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByLoginUsuarioSetorOrigem($value){
		$sql = 'DELETE FROM movimentacao WHERE login_usuario_setor_origem = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByLoginUsuarioSetorDestino($value){
		$sql = 'DELETE FROM movimentacao WHERE login_usuario_setor_destino = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByLoginUsuarioPatrimonioLiberacao($value){
		$sql = 'DELETE FROM movimentacao WHERE login_usuario_patrimonio_liberacao = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySetorOrigem($value){
		$sql = 'DELETE FROM movimentacao WHERE setor_origem = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySetorDestino($value){
		$sql = 'DELETE FROM movimentacao WHERE setor_destino = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}


	
	/**
	 * Read row
	 *
	 * @return MovimentacaoMySql 
	 */
	protected function readRow($row){
		$movimentacao = new Movimentacao();
		
		$movimentacao->cod = $row['cod'];
		$movimentacao->dataSolicitacao = $row['data_solicitacao'];
		$movimentacao->dataLiberação = $row['data_liberação'];
		$movimentacao->dataRecebimento = $row['data_recebimento'];
		$movimentacao->status = $row['status'];
		$movimentacao->loginUsuarioSetorOrigem = $row['login_usuario_setor_origem'];
		$movimentacao->loginUsuarioSetorDestino = $row['login_usuario_setor_destino'];
		$movimentacao->loginUsuarioPatrimonioLiberacao = $row['login_usuario_patrimonio_liberacao'];
		$movimentacao->setorOrigem = $row['setor_origem'];
		$movimentacao->setorDestino = $row['setor_destino'];

		return $movimentacao;
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
	 * @return MovimentacaoMySql 
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