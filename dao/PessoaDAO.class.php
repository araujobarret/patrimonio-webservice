<?php
namespace dao;

interface PessoaDAO{

	public function listarId($id);

	public function listar();

	public function deletar($cod_pessoa);

	public function inserir($pessoa);

	public function atualizar($pessoa);	

	public function limpar();
}
?>