<?php
interface ComissaoDAO{

	public function load($id);

	public function queryAll();

	public function queryAllOrderBy($orderColumn);

	public function delete($cod);

	public function insert($comissao);

	public function update($comissao);	

	public function clean();

	public function queryByPortaria($value);

	public function deleteByPortaria($value);
}
?>