<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 22/02/17
 * Time: 15:21
 */
include 'autoload.php';
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=utf-8");
header('access-control-allow-methods: GET, POST');

$jwt = new \patrimonio_webservice\model\JWT();

// Função de autenticação do usuário
function autentica()
{
    global $jwt;

    if (isset($_GET['login']) && isset($_GET['senha']))
    {
        if (strlen($_GET['login']) >= 11 && strlen($_GET['senha']) > 8)
        {
            // Consulta para verificar se os dados estão corretos
            $usuarioDAO = new \patrimonio_webservice\model\dao\UsuarioDAO();
            $usuario = new \patrimonio_webservice\model\Usuario(array("login" => $_GET["login"], "senha" => $_GET["senha"]));
            if ($usuarioDAO->autenticar($usuario, null))
            {
                // Pega o json e decodifica referente às informações do tipo de usuário, e caso possua setor também
                $tipo = $usuarioDAO->getType($usuario);
                $tipo = json_decode($tipo);

                // Gera o token
                if(isset($tipo->tipo))
                    $jwt->setJWT($usuario, $tipo);
                else
                    $jwt->setJWT($usuario, null);

                echo $jwt->__toJson();

            }
            else
            {
                echo json_encode(array("erro" => "login e/ou senha inválidos"), JSON_UNESCAPED_UNICODE);
            }
        }
        else
            echo json_encode(array("erro" => "login e/ou senha inválidos"), JSON_UNESCAPED_UNICODE);
    }
    else
        echo json_encode(array("erro" => "login e/ou senha inválidos"), JSON_UNESCAPED_UNICODE);

}

autentica();
// Checar primeiro se o usuário já possui um token de acesso
//if(!isset($_COOKIE['patrimonioapp']))
//{
    // Faz as devidas validações do usuário e senha, e cria o cookie

//}
//else {
//    // Caso já exista o cookie verifica se o mesmo ainda é válido
//    $json = $_COOKIE['patrimonioapp'];
//
//    if ($jwt->validaJWT($json))
//    {
//        echo "{'status': true}";
//    }
//    else
//    {
//        // Caso não seja válido apaga o cookie e realiza a autenticação novamente
//        setcookie('patrimonioapp', '', time() - (3600), "/");
//        autentica();
//    }
//}