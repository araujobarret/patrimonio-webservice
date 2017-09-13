<?php
/**
 * Descrição: Controller que fará os selects na tabela processo
 * Date: 22/02/17
 * Time: 10:40
 */

include 'autoload.php';
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=utf-8");
header('access-control-allow-methods: GET, POST');

$processoDAO = new patrimonio_webservice\model\dao\ProcessoDAO();

if(isset($_GET['acao']))
    switch($_GET['acao'])
    {
        case "listarProcessos":
            echo $processoDAO->getLista();
            break;
        case "buscarProcesso":
            if(isset($_GET['numero']) && strlen($_GET['numero']) > 0)
                echo $processoDAO->buscarProcesso(urlencode($_GET['numero']));
            break;
        case "buscarProcessoAssunto":
            if(isset($_GET['assunto']) && strlen($_GET['assunto']) > 0)
                echo $processoDAO->buscarProcessoAssunto(urlencode($_GET['assunto']));
            else
                echo json_encode(array('status' => 'false'), JSON_UNESCAPED_UNICODE);
            break;
        default:
            echo json_encode(array('status' => 'null'), JSON_UNESCAPED_UNICODE);
    }
else
    echo json_encode(array('status' => 'null'), JSON_UNESCAPED_UNICODE);