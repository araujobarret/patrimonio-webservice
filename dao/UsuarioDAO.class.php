<?php
namespace dao;

interface UsuarioDAO{

	public function detalhar($id);

	public function listar();
	
	public function deletar($login);
	
	public function inserir($usuario);
	
	public function atualizar($usuario);	

	public function limpar();

	public function queryByNome($value);

	public function deleteByNome($value);
}
?>