<?php

namespace models;

Class Pessoa
{
    private $cod;
    private $endereco;
    private $bairro;
	private $cidade;
	private $uf;
	private $cep;
	private $telefone1;
	private $telefone2;
	
	
    public function getCod()
    {
        return $this->cod;
    }
	
	  public function setCod($cod)
    {
        $this->cod = $cod;
    }
	
    public function getEndereco()
    {
        return $this->endereco;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
    }

    public function getBairro()
    {
        return $this->bairro;
    }
	public function setBairro($bairro)
    {
        $this->bairro = $bairro;
    }
	
	public function getCidade()
    {
        return $this->cidade;
    }
	public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }
	
	public function getUf()
    {
        return $this->uf;
    }
	public function setUf($uf)
    {
        $this->uf = $uf;
    }
	
	public function getCep()
    {
        return $this->cep;
    }
	public function setCep($cep)
    {
        $this->cep = $cep;
    }
	
	public function getTelefone1()
    {
        return $this->telefone1;
    }
	public function setTelefone1($telefone1)
    {
        $this->telefone1 = $telefone1;
    }
	
	public function getTelefone2()
    {
        return $this->telefone2;
    }
	public function setTelefone2($telefone2)
    {
        $this->telefone2 = $telefone2;
    }

}