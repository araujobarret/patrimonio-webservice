<?php
interface ModoDesfazimentoDAO{

	public function load($id);

	public function queryAll();

	public function queryAllOrderBy($orderColumn);

	public function delete($cod);

	public function insert($modoDesfazimento);

	public function update($modoDesfazimento);	

	public function clean();

	public function queryByDescricao($value);

	public function deleteByDescricao($value);
}
?>