<?php

namespace daoimpl;

use \dao\UsuarioDAO as UsuarioDAO;
use \daoimpl\UsuarioPatrimonioDAOimpl as UsuarioPatrimonioDAOimpl;
use \models\Usuario as Usuario;
use \models\UsuarioChefeSetor as UsuarioChefeSetor;
use \servicos\SqlQuery as SqlQuery;
use \servicos\QueryExecutor as QueryExecutor;
use \servicos\Banco as Banco;

class UsuarioDAOImpl implements UsuarioDAO{
	
	const TABELA = 'usuario';
    const AD = 'rb.gov.br';
    const PORTA_AD = 389;
    // Segredo do JWT
    const SECRET_JWT = 'ruibarbosafcrb';

    protected $banco;
    protected $pdo;
    protected $ldap;

    public function __construct()
    {
        $this->banco = new Banco();
        $this->pdo = $this->banco->getPdo();
    }
	
	public function listarId($id){
		$sql = 'SELECT * FROM usuario WHERE login = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($id);
		return $this->getRow($sqlQuery);
	}

	public function listar(){
		$sql = 'SELECT * FROM usuario';
		$sqlQuery = new SqlQuery($sql);
		return $this->getList($sqlQuery);
	}

	public function deletar($login){
		$sql = 'DELETE FROM usuario WHERE login = ?';
		$sqlQuery = new SqlQuery($sql);
		$sqlQuery->set($login);
		return $this->executeUpdate($sqlQuery);
	}
	
	public function inserir($usuario){
		$sql = 'INSERT INTO usuario (nome,login) VALUES (?,?)';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($usuario->getNome());
		$sqlQuery->set($usuario->getLogin());

		$id = $this->executeInsert($sqlQuery);	
		$usuario->getLogin = $id;
		return $id;
	}
	
	public function atualizar($usuario){
		$sql = 'UPDATE usuario SET nome = ? WHERE login = ?';
		$sqlQuery = new SqlQuery($sql);
		
		$sqlQuery->set($usuario->nome);

		$sqlQuery->set($usuario->login);
		return $this->executeUpdate($sqlQuery);
	}

	public function limpar(){
		$sql = 'DELETE FROM usuario';
		$sqlQuery = new SqlQuery($sql);
		return $this->executeUpdate($sqlQuery);
	}
	
	public function autenticar(Usuario $usuario, $token)
    {
        $flag = false;
        // Verifica se o usuário já tem um token válido de acesso
        if(!isset($token))
        {
            // Conecta ao ldap e realiza o bind
            $this->ldap = @ldap_connect(self::AD, self::PORTA_AD);
            // Verifica se o usuário está previamente cadastrado
            if ($this->hasUsuario($usuario->getLogin())){
                if ($this->ldap)
                { 
					try{
						$bind = ldap_bind($this->ldap, $usuario->getLogin(), $usuario->getSenha());
					}
					catch (Exception $e) {
                        json_encode(array("erro" => null, "mensagem" => "Não foi possível entrar em contato com o AD"), JSON_UNESCAPED_UNICODE);
					}
                    if ($bind){
                        $flag = true;
					}
                    @ldap_close($this->ldap);
                }
                else{
                    echo json_encode(array("erro" => null), JSON_UNESCAPED_UNICODE);
				}
			}
        }
        else{
            echo json_encode(array("erro" => null), JSON_UNESCAPED_UNICODE);
		}
        // Retorna true se a autenticação for com sucesso
        return $flag;
    }

    private function hasUsuario($login)
    {
        // Verifica se o usuário existe no banco de dados
        $sql = "SELECT login FROM " . self::TABELA . " WHERE login=\"" . $login . "\"";
        $result = $this->pdo->query($sql);
        $usuario = $result->fetch(\PDO::FETCH_ASSOC);

        if(isset($usuario['login']))
            return true;
        else
            return false;
    }

    // Checa o tipo de usuário e retorna em formato json
    public function getType($usuario)
    {
        // Verifica primeiro se ele é administrador
        if(UsuarioPatrimonioDAOimpl::isPatrimonio($usuario->getLogin()))
        {
            return json_encode(
                array(
                    "tipo" => "UsuarioPatrimonio",
                    "sigla_setor" => null
                ),
                JSON_UNESCAPED_UNICODE
            );
        }
        else
            // Se o usuário for chefe de setor precisa pegar o respectivo setor dele
            if(UsuarioChefeSetorDAO::isChefeSetor($usuario->getLogin()))
            {
                $usuarioChefeSetor = UsuarioChefeSetorDAO::retrieve($usuario->getLogin());
                if(isset($usuarioChefeSetor))
                    return json_encode(
                        array(
                            "tipo" => "UsuarioPatrimonio",
                            "sigla_setor" => $usuarioChefeSetor->getSiglaSetor()
                        ),
                        JSON_UNESCAPED_UNICODE
                    );
                else
                    return json_encode(array("erro" => null, JSON_UNESCAPED_UNICODE));
            }
    }


}
?>
