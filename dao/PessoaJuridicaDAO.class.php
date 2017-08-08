<?php
namespace dao;

interface PessoaJuridicaDAO{

	public function detalhar($id);

	public function listar();

	public function deletar($cod_pessoa);

	public function inserir($pessoaJuridica);

	public function atualizar($pessoaJuridica);	

	public function limpar();
}
?>