<?php

namespace api;
use daoimpl\PessoaDAOimpl as PessoaDAOimpl;
use daoimpl\PessoaFisicaDAOimpl as PessoaFisicaDAOimpl;
use daoimpl\PessoaJuridicaDAOimpl as PessoaJuridicaDAOimpl;

Class PessoaController {
		
	private $pessoaDaoImpl;
	private $pessoaFisicaDaoImpl;
	private $pessoaJuridicaDaoImpl;
	private $pessoasList;
	private $pessooa;

	public function detalhar_pessoa($tipo, $id)
	{
		$this->pessoa = $this->pessoaDaoImpl->detalhar($tipo, $id);
		return $this->pessoa;
	}
    public function listar_pessoas()
	{
		$this->pessoaDaoImpl = new PessoaDAOimpl();
		$this->pessoasList = $this->pessoaDaoImpl->listar();
		return $this->pessoasList;
	}
	public function cadastrar_pessoa($tipo,$pessoa,$fisica = null,$juridica = null)
	{
		if($tipo == 1 && $fisica->cpf !=null)
		{
			$this->pessoaFisicaDaoImpl = new PessoaFisicaDAOimpl();
			$this->pessoaFisicaDaoImpl->insert($fisica);
			
		}
		if($tipo == 2 && $juridica->cnpj !=null)
		{
			$this->pessoaJuridicaDaoImpl = new PessoaJuridicaDAOimpl();
			$this->pessoaJuridicaDaoImpl->insert($juridica);
		}
		
		$this->pessoaDaoImpl = new PessoaDAOimpl();
		return  $this->pessoaDaoImpl->insert($pessoa);
	}
	public function editar_pessoa($id)
	{
		$this->pessoaDaoImpl = new PessoaDAOimpl();
		return  $this->pessoaDaoImpl->update($id);
	}
	public function deletar_pessoa($id)
	{
		$this->pessoaDaoImpl = new PessoaDAOimpl();
		return  $this->pessoaDaoImpl->delete($PessoaList);
	}

}

?>