<?php

interface ProcessoDAO{

	public function detalhar($id);

	public function listar();

	public function deletar($cod_pessoa);

	public function inserir($pessoaJuridica);

	public function atualizar($pessoaJuridica);	

	public function limpar();

	public function queryByNumero($value);

	public function queryByAssunto($value);

	public function deleteByNumero($value);

	public function deleteByAssunto($value);
}
?>