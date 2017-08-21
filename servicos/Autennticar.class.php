<?php
namespace servicos;

include '../autoload.php';
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=utf-8");
header('access-control-allow-methods: GET, POST');

use \models\JWT as JWT;
use \models\Usuario as Usuario;
use \models\dao\UsuarioDAO as UsuarioDao;

class Autenticar{
	// Função de autenticação do usuário
	private $jwt;
	private $login;
	private $senha;
	
	function __construct()
	{
		$jwt = new JWT();
	}
	function autentica()
	{
		if ($this->login) && isset($this->senha))
		{
			if (strlen($this->login) >= 11 && strlen($this->senha) > 8)
			{
				// Consulta para verificar se os dados estão corretos
				$usuarioDAO = new UsuarioDAO();
				$usuario = new Usuario(array("login" => $this->login, "senha" => $this->senha));
				if ($usuarioDAO->autenticar($usuario, null))
				{
					// Pega o json e decodifica referente às informações do tipo de usuário, e caso possua setor também
					$tipo = $usuarioDAO->getType($usuario);
					$tipo = json_decode($tipo);

					// Gera o token
					if(isset($tipo->tipo))
						$jwt->setJWT($usuario, $tipo);
					else
						$jwt->setJWT($usuario, null);

					echo $jwt->__toJson();

				}
				else
				{
					echo json_encode(array("erro" => "login e/ou senha inválidos"), JSON_UNESCAPED_UNICODE);
				}
			}
			else{
				echo json_encode(array("erro" => "login e/ou senha inválidos"), JSON_UNESCAPED_UNICODE);
			}
		}
		else{
			echo json_encode(array("erro" => "login e/ou senha inválidos"), JSON_UNESCAPED_UNICODE);
		}
	}
	
	public getLogin()
	{
		return $this->login;
	}
	
	public setLogin($login)
	{
		$this->login = $login;
	}
	
	public getSenha()
	{
		return $this->senha;
	}
	
	public setSenha($senha)
	{
		$this->senha = $senha;
	}
}