<?php

namespace api;
use \daoimpl\UsuarioDAOimpl as UsuarioDAOimpl;
use \daoimpl\UsuarioPatrimonioDAOimpl as UsuarioPatrimonioDAOimpl;
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
		$_POST['login'] = "testepatrimonio@rb.gov.br"; $_POST['senha'] = "reset@2017";
		if(!empty($_POST) && $_POST['login'] !=null && $_POST['senha'] !=null){	
			$usuario->setLogin($_POST['login']);
			$usuario->setSenha($_POST['senha']);
		}
		if($usuario->getLogin() !=null && $usuario->getSenha() != null){
			if ($this->usuarioDaoImpl->autenticar($usuario, null))
			{
				// Pega o json e decodifica referente às informações do tipo de usuário, e caso possua setor também
				$this->tipo = $this->usuarioDaoImpl->getType($usuario);
				$this->tipo = json_decode($this->tipo);

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
