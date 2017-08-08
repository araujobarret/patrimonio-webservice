<?php 
require_once('autoload.php');
use controllers\BemController as BemController;
use controllers\UsuarioController as UsuarioController;
use controllers\PessoaController as PessoaController;
/*
$bem = new BemController();
$bens = $bem->listar_bens();
var_dump($bens);


$usuario = new UsuarioController();
$usuarios = $usuario->listar_usuarios();
var_dump($usuarios);
*/
/*
$tipo =2;

$pessoa = new stdClass();
$pessoa->cod = 1;
$pessoa->endereco = 'rua ABC';
$pessoa->bairro = 'Olaria';
$pessoa->cidade = 'Sao Paulo';
$pessoa->uf='SP';
$pessoa->cep='21041-030';
$pessoa->telefone1='8764-8294';
$pessoa->telefone2='9234-5456';

$fisica = new stdClass();
$fisica->codPessoa=1;
$fisica->cpf='12345678901';
$fisica->nome= 'JOAO DA SILVA';

$juridica = new stdClass();
$juridica->codPessoa=1;
$juridica->cnpj = '123343443435532';
$juridica->razaoSocial= 'CASA DE BRINQUEDOS';
$pessoa_obj->cadastrar_pessoa($tipo,$pessoa,$fisica,$juridica);
*/ 
$pessoa_obj = new PessoaController();
$pessoas = $pessoa_obj->listar_Pessoas();
?>