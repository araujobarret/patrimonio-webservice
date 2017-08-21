<?php

namespace \models;

class Setor
{
    private $sigla;

    public function __construct()
    { 
	
	}
	
    public function getSigla()
    {
        return $this->sigla;
    }

    public function setSigla($sigla)
    {
        $this->sigla = $sigla;
    }

}