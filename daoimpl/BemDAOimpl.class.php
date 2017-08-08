<?php
namespace daoimpl;
use \dao\BemDAO as BemDAO;
use \servicos\SqlQuery as SqlQuery;
use \servicos\QueryExecutor as QueryExecutor;
use \models\Bem as Bem;

class BemDAOimpl implements BemDAO{

	public function detalhar($id){
		$sql = 'SELECT * FROM bem WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($id);
		return $this->getRow($sqlQuery);
	}

	public function listar(){
		$sql = 'SELECT * FROM bem';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}
	
	public function deletar($cod){
		$sql = 'DELETE FROM bem WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($cod);
		return $this->executeUpdate($sqlQuery);
	}

	public function inserir($bem){
		$sql = 'INSERT INTO bem (cod_tombamento, sigla_setor, status, estado, numero_serie, valor_aquisicao) VALUES (?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($bem->codTombamento);
		$sqlQuery->set($bem->siglaSetor);
		$sqlQuery->set($bem->status);
		$sqlQuery->set($bem->estado);
		$sqlQuery->set($bem->numeroSerie);
		$sqlQuery->set($bem->valorAquisicao);

		$id = $this->executeInsert($sqlQuery);	
		$bem->cod = $id;
		return $id;
	}

	public function atualizar($bem){
		$sql = 'UPDATE bem SET cod_tombamento = ?, sigla_setor = ?, status = ?, estado = ?, numero_serie = ?, valor_aquisicao = ? WHERE cod = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($bem->codTombamento);
		$sqlQuery->set($bem->siglaSetor);
		$sqlQuery->set($bem->status);
		$sqlQuery->set($bem->estado);
		$sqlQuery->set($bem->numeroSerie);
		$sqlQuery->set($bem->valorAquisicao);

		$sqlQuery->setNumber($bem->cod);
		return $this->executeUpdate($sqlQuery);
	}
	
	public function cadastrar_grupo($descricao, $meses_vida_util)
	{
		$sql = 'INSERT INTO grupo_bem (descricao, meses_vida_util) VALUES (?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($escricao);
		$sqlQuery->set($meses_vida_util);

		$id = $this->executeInsert($sqlQuery);	
		return $id;
	}
	public function movimentar_bem($id_bem, $data_solicitacao, $data_liberacao, $data_recebimento, $status, $usuario_setor_origem, $usuario_setor_destino, $usuario_patrimonio_liberado, $setor_origem, $setor_destino)
	{
		$sql = 'INSERT INTO bem (data_solicitacao, data_liberacao, data_recebimento, status, login_usuario_setor_origem, login_usuario_setor_destino, login_usuario_patrimonio_liberacao, setor_origem, setor_destino) VALUES (?, ?, ?, ?, ?, ?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->setNumber($bem->codTombamento);
		$sqlQuery->set($data_solicitacao);
		$sqlQuery->set($data_liberacao);
		$sqlQuery->set($data_recebimento);
		$sqlQuery->set($status);
		$sqlQuery->set($usuario_setor_origem);
		$sqlQuery->set($usuario_setor_destino);
		$sqlQuery->set($usuario_patrimonio_liberado);
		$sqlQuery->set($setor_origem);
		$sqlQuery->set($setor_destino);
		
		$id = $this->executeInsert($sqlQuery);	
		$bem->cod = $id;
		return $id;
	}

	public function clean(){
		$sql = 'DELETE FROM bem';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}

	public function queryByCodTombamento($value){
		$sql = 'SELECT * FROM bem WHERE cod_tombamento = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->getList($sqlQuery);
	}

	public function queryBySiglaSetor($value){
		$sql = 'SELECT * FROM bem WHERE sigla_setor = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByStatus($value){
		$sql = 'SELECT * FROM bem WHERE status = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByEstado($value){
		$sql = 'SELECT * FROM bem WHERE estado = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByNumeroSerie($value){
		$sql = 'SELECT * FROM bem WHERE numero_serie = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}

	public function queryByValorAquisicao($value){
		$sql = 'SELECT * FROM bem WHERE valor_aquisicao = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->getList($sqlQuery);
	}


	public function deleteByCodTombamento($value){
		$sql = 'DELETE FROM bem WHERE cod_tombamento = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->setNumber($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteBySiglaSetor($value){
		$sql = 'DELETE FROM bem WHERE sigla_setor = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByStatus($value){
		$sql = 'DELETE FROM bem WHERE status = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByEstado($value){
		$sql = 'DELETE FROM bem WHERE estado = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByNumeroSerie($value){
		$sql = 'DELETE FROM bem WHERE numero_serie = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	public function deleteByValorAquisicao($value){
		$sql = 'DELETE FROM bem WHERE valor_aquisicao = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($value);
		return $this->executeUpdate($sqlQuery);
	}

	protected function readRow($row){
		$bem = new Bem();
		
		$bem->setCod($row['cod']);
		$bem->setCodTombamento($row['cod_tombamento']);
		$bem->setSiglaSetor ($row['sigla_setor']);
		$bem->setStatus ($row['status']);
		$bem->setEstado ($row['estado']);
		$bem->setNumeroSerie ($row['numero_serie']);
		$bem->setValorAquisicao ($row['valor_aquisicao']);

		return $bem;
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