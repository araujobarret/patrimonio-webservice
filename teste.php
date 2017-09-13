<?php 

require_once('autoload.php');

use \api\BemController  as BemController;
use \api\Usuario_Controller as Usuario_Controller;
use \api\PessoaController as PessoaController;
use \models\Usuario as Usuario;

header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=utf-8");
header('access-control-allow-methods: GET, POST');

$usuarioCtrl = new Usuario_Controller();
$usuario = new Usuario();
$usuario->setNome('Thalles');
$usuario->setLogin('testepatrimonio@rb.gov.br');

//$usuarioCtrl->cadastrar_usuario($usuario);
$usuarioCtrl ->autenticar();
?>
