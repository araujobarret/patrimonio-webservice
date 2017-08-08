<?php
namespace dao;

interface BemDAO{

	public function detalhar($id);
	
	public function listar();

	public function deletar($cod);
	
	public function inserir($bem);
	
	public function atualizar($bem);	
	
	public function limpar();

	public function queryByCodTombamento($value);

	public function queryBySiglaSetor($value);

	public function queryByStatus($value);

	public function queryByEstado($value);

	public function queryByNumeroSerie($value);

	public function queryByValorAquisicao($value);

	public function deleteByCodTombamento($value);

	public function deleteBySiglaSetor($value);

	public function deleteByStatus($value);

	public function deleteByEstado($value);

	public function deleteByNumeroSerie($value);

	public function deleteByValorAquisicao($value);


}
?>