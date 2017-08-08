<?php

namespace models;

Class Pessoa
{
    private $cod_pessoa;
    private $cnpj;
    private $razao_social;
	
	
    public function getCodPessoa()
    {
        return $this->cod_pessoa;
    }
	
	  public function setCodPessoa($cod_pessoa)
    {
        $this->cod_pessoa = $cod_pessoa;
    }
	
    public function getCnpj()
    {
        return $this->cnpj;
    }

    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    public function getRazaoSocial()
    {
        return $this->razao_social;
    }
	public function setRazaoSocial($razao_social)
    {
        $this->razao_social = $razao_social;
    }
}