<?php
namespace dao;

interface PessoaFisicaDAO{

	public function detalhar($id);

	public function listar();

	public function deletar($cod_pessoa);

	public function inserir($pessoaFisica);

	public function atualizar($pessoaFisica);	

	public function limpar();
}
?>