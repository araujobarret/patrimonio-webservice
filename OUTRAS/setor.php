<?php
/**
 * Descrição: Controller que fará os selects na tabela setor
 * Date: 02/03/17
 * Time: 15:52
 */

include 'autoload.php';
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=utf-8");
header('access-control-allow-methods: GET, POST');

$setorDAO = new patrimonio_webservice\model\dao\SetorDAO();


if(isset($_GET['acao']))
    switch($_GET['acao'])
    {
        case "listarSetores":
            echo $setorDAO->getLista();
            break;
        case "buscarSetor":
            if(isset($_GET['sigla']) && strlen($_GET['sigla']) > 0)
                echo json_decode(json_encode($teste));
            else
                echo "{'status': false}";
            break;
    }
else
    echo "null";