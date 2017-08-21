<?php

namespace \models;

use \models\Usuario as Usuario;

class UsuarioChefeSetor extends Usuario
{
    private $siglaSetor;

    public function __construct()
    {
        parent::__construct(array("login" => null, "senha" => null));
    }

    public function getSiglaSetor()
    {
        return $this->siglaSetor;
    }

    public function setSiglaSetor($siglaSetor)
    {
        $this->siglaSetor = $siglaSetor;
    }

}