<?php

namespace models;

Class PessoaFisica
{
    private $cod_pessoa;
    private $cpf;
    private $nome;	
	
    public function getCodPessoa()
    {
        return $this->cod_pessoa;
    }
	
	  public function setCodPessoa($cod_pessoa)
    {
        $this->cod_pessoa= $cod_pessoa;
    }
	
    public function getCpf()
    {
        return $this->cpf;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
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