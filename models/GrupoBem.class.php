<?php

namespace patrimonio_webservice\model\dao;

class GrupoBem
{
	private $cod;
    private $descricao;
	private $meses_vida_util;
	
    public function getCod()
    {
        return $this->cod;
    }

    public function setCod($cod)
    {
        $this->cod = $cod;
    }
	
	 public function getDescricao()
    {
        return $this->descricao;
    }

    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;
    }
	
	public function getMesesVidaUtil()
    {
        return $this->meses_vida_util;
    }

    public function setMesesVidaUtil($meses_vida_util)
    {
        $this->meses_vida_util = $meses_vida_util;
    }

}