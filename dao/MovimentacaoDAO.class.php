<?php

interface MovimentacaoDAO{

	public function load($id);

	public function queryAll();

	public function queryAllOrderBy($orderColumn);

	public function delete($cod);

	public function insert($movimentacao);

	public function update($movimentacao);	

	public function clean();

	public function queryByDataSolicitacao($value);

	public function queryByDataLiberaчуo($value);

	public function queryByDataRecebimento($value);

	public function queryByStatus($value);

	public function queryByLoginUsuarioSetorOrigem($value);

	public function queryByLoginUsuarioSetorDestino($value);

	public function queryByLoginUsuarioPatrimonioLiberacao($value);

	public function queryBySetorOrigem($value);

	public function queryBySetorDestino($value);

	public function deleteByDataSolicitacao($value);

	public function deleteByDataLiberaчуo($value);

	public function deleteByDataRecebimento($value);

	public function deleteByStatus($value);

	public function deleteByLoginUsuarioSetorOrigem($value);

	public function deleteByLoginUsuarioSetorDestino($value);

	public function deleteByLoginUsuarioPatrimonioLiberacao($value);

	public function deleteBySetorOrigem($value);

	public function deleteBySetorDestino($value);
}
?>