<?php 

require_once('autoload.php');

use \api\BemController as BemController;
use \api\UsuarioController as UsuarioController;
use \api\PessoaController as PessoaController;
use \models\Usuario as Usuario;

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=utf-8");
header('access-control-allow-methods: GET, POST');

$usuarioCtrl = new UsuarioController();
$usuario = new Usuario();
$usuario->setNome('Thalles');
$usuario->setLogin('testepatrimonio@rb.gov.br');

//$usuarioCtrl->cadastrar_usuario($usuario);
$usuarioCtrl ->autenticar();
?>