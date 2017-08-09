<?php

namespace controllers;
use daoimpl\UsuarioDAOimpl as UsuarioDAOimpl;

Class UsuarioController {
		
	private $usuarioDaoImpl;
	private $usuariosList;

	public function __construct()
	{
		$this->usuarioDaoImpl = new UsuarioDAOimpl();
	}
	public function detalhar_usuario($id)
	{
		return $this->usuarioDaoImpl->detalhar($id);
	}
    public function listar_usuarios()
	{
		$this->usuariosList = $this->usuarioDaoImpl->listar();
		return $this->usuariosList;
	}
	public function cadastrar_usuario($usuario)
	{
		return  $this->usuarioDaoImpl->inserir($usuario);
	}
	public function editar_usuario($id)
	{
		return  $this->usuarioDaoImpl->atualizar($id);
	}
	public function deletar_usuario($id)
	{
		return  $this->usuarioDaoImpl->deletar($id);
	}

}

?>