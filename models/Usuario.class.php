<?php

namespace models;

Class Usuario
{
    private $login;
    private $senha;
    private $nome;
	
    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getSenha()
    {
        return $this->senha;
    }

    public function setSenha($senha)
    {
        $this->senha = $senha;
    }

    public function getNome()
    {
        return $this->nome;
    }
	public function setNome($nome)
    {
        $this->nome = $nome;
    }

}