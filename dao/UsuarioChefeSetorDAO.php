<?php
/**
 * Descrição: DAO de manipulação da tabela Usuário Chefe de Setor
 * Date: 07/03/17
 */

namespace patrimonio_webservice\model\dao;

use patrimonio_webservice\controller\Banco;
use patrimonio_webservice\model\Usuario;
use patrimonio_webservice\model\UsuarioChefeSetor;

class UsuarioChefeSetorDAO extends UsuarioDAO
{
    const TABELA = 'usuario_chefe_setor';

    public static function isChefeSetor($login)
    {
        $banco = Banco::getInstancia();
        $pdo = $banco->getPdo();

        $sql = "SELECT * FROM " . self::TABELA . " WHERE login_usuario='" . $login . "'";
        $result = $pdo->query($sql);
        $usuario = $result->fetch(\PDO::FETCH_ASSOC);

        if(isset($usuario))
            return true;
        else
            return false;

    }

    // Retorna um objeto do usuário chefe de setor
    public static function retrieve($login)
    {
        $banco = Banco::getInstancia();
        $pdo = $banco->getPdo();

        $sql = "SELECT * FROM " . self::TABELA . " WHERE login_usuario=\"$login\"";
        $result = $pdo->query($sql);
        $usuario = $result->fetch(\PDO::FETCH_ASSOC);
        $usuarioChefeSetor = new UsuarioChefeSetor();

        // Checa se obteve algum resultado
        if(isset($usuario['login']))
        {
            $usuarioChefeSetor->setLogin($usuario['login']);
            $usuarioChefeSetor->setSiglaSetor($usuario['sigla_setor']);
            return $usuarioChefeSetor;
        }
        else
            return null;
    }

    // Cadastra um novo usuário na tabela chefe de setor
    public function create(UsuarioChefeSetor $usuario)
    {
        // Prepara o SqlStatement
        $pdo = $this->pdo;
        $stm = $pdo->prepare("INSERT INTO " . self::TABELA . " (login, sigla_setor) VALUES(:login, :sigla_setor);");
        $stm->bindParam(':login', $usuario->getLogin(), \PDO::PARAM_STR);
        $stm->bindParam(':sigla_setor', $usuario->getSiglaSetor(), \PDO::PARAM_STR);
        if($stm->execute())
            return '{"status": true}';
        else
            return '{"erro": null}';
    }

    // Update do usuário chefe de setor
    public function update(UsuarioChefeSetor $usuario)
    {
        // Prepara o SqlStatement
        $pdo = $this->pdo;
        $stm = $pdo->prepare(
            "UPDATE " . self::TABELA . " SET sigla_setor=:sigla_setor WHERE login_usuario=:login_usuario;"
        );
        $stm->bindParam(':sigla_setor', $usuario->getSiglaSetor(), \PDO::PARAM_STR);
        $stm->bindParam(':login_usuario', $usuario->getLogin(), \PDO::PARAM_STR);
        if($stm->execute())
            return '{"status": true}';
        else
            return '{"erro": null}';
    }

    // Remover o usuário da classe chefe de setor
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