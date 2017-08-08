<?php
interface SetorDAO{

	public function detalhar($id);

	public function listar();

	public function deletar($sigla);

	public function inserir($setor);

	public function atualizar($setor);	

	public function limpar();
}
?>