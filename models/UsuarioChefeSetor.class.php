<?php

namespace patrimonio_webservice\model;

use patrimonio_webservice\model\Usuario;

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