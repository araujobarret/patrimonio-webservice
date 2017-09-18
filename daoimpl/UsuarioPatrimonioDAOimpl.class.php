<?php

namespace daoimpl;

use \model\Usuario as Usuario;
use \dao\UsuarioPatrimonioDAO as UsuarioPatrimonioDAO;
use \api\Banco as Banco;

class UsuarioPatrimonioDAOimpl implements UsuarioPatrimonioDAO
{
    const TABELA = 'usuario_patrimonio';

    // Retorna true ou false se o usuário está cadastrado como sendo do patrimônio
    public static function isPatrimonio($login)
    {
        $banco = new Banco();
        $pdo = $banco->getPdo();

        $sql = "SELECT * FROM " . self::TABELA . " WHERE login_usuario='" . $login . "'";
        $result = $pdo->query($sql);
        $usuario = $result->fetch(\PDO::FETCH_ASSOC);

        if($usuario)
            return true;
        else
            return false;

    }

    // Cadastra um novo usuário na tabela patrimônio
    public function create(Usuario $usuario)
    {
        // Prepara o SqlStatement
        $pdo = $this->pdo;
        $stm = $pdo->prepare("INSERT INTO " . self::TABELA . " (login) VALUES(:login);");
        $stm->bindParam(':login', $usuario->getLogin(), \PDO::PARAM_STR);
        if($stm->execute())
            return '{"status": true}';
        else
            return '{"erro": null}';
    }

    // Remover o usuário da classe patrimonio
    public function delete(Usuario $usuario)
    {
        // Prepara o SqlStatement
        $pdo = $this->pdo;
        $stm = $pdo->prepare("DELETE FROM " . self::TABELA . " WHERE login=:login;");
        $stm->bindParam(':login', $usuario->getLogin(), \PDO::PARAM_STR);

        if($stm->execute())
            return '{"status": true}';
        else
            return '{"erro": null}';
    }
}