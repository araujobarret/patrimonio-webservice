<?php

namespace dao;

use \models\Usuario as Usuario;

interface UsuarioPatrimonioDAO
{
    // Retorna true ou false se o usuário está cadastrado como sendo do patrimônio
    public static function isPatrimonio($login);

    // Cadastra um novo usuário na tabela patrimônio
    public function create(Usuario $usuario);

    // Remover o usuário da classe patrimonio
    public function delete(Usuario $usuario);

}