<?php

namespace api;
use daoimpl\BemDAOimpl as BemDAOimpl;
use daoimpl\EntradaDAOimpl as EntradaDAOimpl;
use daoimpl\SaidaDAOimpl as SaidaDAOimpl;

Class BemController {
	private $bemDaoImpl;
	private $entradaDaoImpl;
	private $saidaDaoImpl;
	private $bens;
	private $bem;
	
	function __construct()
	{
		$this->bemDaoImpl = new BemDAOimpl();
		$this->entradaDaoImpl = new EntradaDAOImpl
		$this->saidaDaoImpl = new SaidaDAOImpl();
	}

	public function detalhar_bem($id)
	{
		$this->bem = $this->bemDaoImpl->detalhar($id);
		return $this->bem;
	}
	public function cadastrar_bem($id)
	{
		$this->bem = $this->bemDaoImpl->inserir($id);
	}
	public function listar_bens()
	{
		$this->bens = $this->bemDaoImpl->listar();
		return $this->bens;
	}
	public function remover_bem($id)
	{
		$this->bem = $this->bemDaoImpl->deletar($id);
	}
	public function registrar_entrada($tipo, $descricao, $usuario, $data, $processo, $pessoa)
	{
		$id = $this->entradaDaoImpl->registrar_entrada($descricao, $usuario, $data, $processo, $pessoa);
		switch($tipo)
		{
			case 1:
				$this->entradaDaoImpl->inserir_entrada_aquisicao($id);
			break;
			case 2:
				$this->entradaDaoImpl->inserir_entrada_comodato($id);
			break;
			case 3:
				$this->entradaDaoImpl->inserir_entrada_doacao($id);
			break;
			case 4:
				$this->entradaDaoImpl->inserir_entrada_incorporacao($id);
			break;
			default:
				echo "Tipo de entrada invalida";
				exit;
			break;
		}
	}
	public function registrar_saida($tipo, $descricao, $usuario, $processo, $data)
	{
		$id = $this->saidaDaoImpl->registrar_saida($descricao, $usuario, $processo, $data);
		switch($tipo)
		{
			case 1:
				$this->saidaDaoImpl->inserir_saida_cessao($id);
			break;
			case 2:
				$this->saidaDaoImpl->inserir_saida_defaziamento($id);
			break;
			case 3:
				$this->saidaDaoImpl->inserir_saida_doacao($id);
			break;
			default:
				echo "Tipo de saida invalida";
				exit;
			break;
	}
	public function cadastrar_grupo($descricao, $meses_vida_util)
	{
		$this->bemDaoImpl->cadastrar_grupo($descricao, $meses_vida_util);
	}
	public function movimentar_bem($id_bem, $data_solicitacao, $data_liberacao, $data_recebimento, $status, $usuario_setor_origem, $usuario_setor_destino, $usuario_patrimonio_liberado, $setor_origem, $setor_destino)
	{
		$id_movimentacao = $this->bemDaoImpl->movimentar_bem($data_solicitacao, $data_liberacao, $data_recebimento, $status, $usuario_setor_origem, $usuario_setor_destino, $usuario_patrimonio_liberado, $setor_origem, $setor_destino);
		$this->bemDaoImpl->registrar_movimento_bem($id_bem, $id_movimentacao);
	}
}

?>