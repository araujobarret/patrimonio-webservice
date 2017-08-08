<?php
interface EntradaDAO{

	public function detalhar($id);

	public function listar();

	public function deletar($cod);

	public function inserir($entrada);

	public function atualizar($entrada);	

	public function limpar();
	
	public function inserir_entrada_aquisicao($codEntrada);
	
	public function inserir_entrada_comodato($codEntrada);
	
	public function inserir_entrada_doacao($codEntrada);
	
	public function inserir_entrada_incorporacao($codEntrada);

	public function queryByDescricao($value);

	public function queryByLoginUsuarioPatrimonio($value);

	public function queryByData($value);

	public function queryByCodProcesso($value);

	public function queryByCodPessoa($value);

	public function deleteByDescricao($value);

	public function deleteByLoginUsuarioPatrimonio($value);

	public function deleteByData($value);

	public function deleteByCodProcesso($value);

	public function deleteByCodPessoa($value);
}
?>