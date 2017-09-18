<?php

namespace dao;

use models\Usuario as Usuario;

interface UsuarioDAO{

	public function listarId($id);

	public function listar();
	
	public function deletar($login);
	
	public function inserir($usuario);
	
	public function atualizar($usuario);	

	public function limpar();
	
	public function autenticar(Usuario $usuario, $token);
	
	public function getType($usuario);
}
?>