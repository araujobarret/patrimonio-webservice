<?php

namespace api;
use \daoimpl\UsuarioDAOimpl as UsuarioDAOimpl;
use \models\Usuario as Usuario;
use \servicos\JWT as JWT;

Class UsuarioController {
		
	private $usuarioDaoImpl;
	private $usuariosList;
	private $jwt;
	private $tipo;

	public function __construct()
	{
		$this->usuarioDaoImpl = new UsuarioDAOimpl();
		$this->jwt = new JWT();
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
	public function autenticar()
	{
		$usuario = new Usuario();
		$_POST['login'] = "Thalles"; $_POST['senha'] = "123";
		if(!empty($_POST) && $_POST['login'] !=null && $_POST['senha'] !=null){
			$usuario->setLogin($_POST['login']);
			$usuario->setSenha($_POST['senha']);
		}
		if($usuario->getLogin() !=null && $usuario->getSenha() != null){
			if ($this->usuarioDaoImpl->autenticar($usuario, null))
			{
				// Pega o json e decodifica referente às informações do tipo de usuário, e caso possua setor também
				$this->tipo = $this->usuarioDaoImp->getType($usuario);
				$this->tipo = json_decode($tipo);

				// Gera o token
				if(isset($this->tipo->tipo)){
					$this->jwt->setJWT($usuario, $this->tipo);
				}
				else{
					$this->jwt->setJWT($usuario, null);
				}
				echo $this->jwt->__toJson();
			}
			else
			{
				echo json_encode(array("erro" => "login e/ou senha inválidos - Nao autenticou"), JSON_UNESCAPED_UNICODE);
			}
		}else{
			echo json_encode(array("erro" => "login e/ou senha inválidos - Usuario e Senha vazio."), JSON_UNESCAPED_UNICODE);
		}
	}
}
?>