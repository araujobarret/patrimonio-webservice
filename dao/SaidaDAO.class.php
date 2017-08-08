<?php
interface SaidaDAO{

	public function detalhar($id);
	
	public function listar();
	
	public function deletar($cod);

	public function inserir($saida);

	public function atualizar($saida);	

	public function limpar();
	
	public function inserir_saida_cessao($codSaida,$dataEntrada);
	
	public function inserir_saida_desfaziamento($codSaida,$codModoDesfaziamento);
	
	public function inserir_saida_doacao($codSaida,$data_entrada);

	public function queryByDescricao($value);

	public function queryByLoginUsuarioPatrimonio($value);

	public function queryByCodProcesso($value);

	public function queryByData($value);

	public function deleteByDescricao($value);

	public function deleteByLoginUsuarioPatrimonio($value);

	public function deleteByCodProcesso($value);

	public function deleteByData($value);
}
?>