<?php

namespace models;

class Bem
{
	private $cod;
	private $codTombamento;
	private $siglaSetor;
	private $status;
	private $estado;
	private $numeroSerie;
	private $valorAquisicao;
	
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
	
	public function getCodTombamento()
    {
        return $this->codTombamento;
    }
	
    public function setCodTombamento($codTombamento)
    {
        $this->codTombamento = $codTombamento;
    }
	
	public function getSiglaSetor()
    {
        return $this->siglaSetor;
    }
	
    public function setSiglaSetor($siglaSetor)
    {
        $this->siglaSetor = $siglaSetor;
    }
	
	public function getStatus()
    {
        return $this->status;
    }
	
    public function setStatus($status)
    {
        $this->status = $status;
    }
	
	public function getEstado()
    {
        return $this->estado;
    }
	
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }
	
	public function getNumeroSerie()
    {
        return $this->numeroSerie;
    }
	
    public function setNumeroSerie($numeroSerie)
    {
        $this->numeroSerie = $numeroSerie;
    }
	
	public function getValorAquisicao()
    {
        return $this->valorAquisicao;
    }
	
    public function setValorAquisicao($valorAquisicao)
    {
        $this->valorAquisicao = $valorAquisicao;
    }

}