<?php

namespace model;

class Processo
{
    private $cod;
    private $numero;
    private $assunto;

    public function __construct()
    { 
	
	}
	
    public function getCod()
    {
        return $this->cod;
    }

    public function setCod($cod)
    {
        $this->cod = $cod;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
    }

    public function getAssunto()
    {
        return $this->assunto;
    }

    public function setAssunto($assunto)
    {
        $this->assunto = $assunto;
    }

}