<?php
/**
 * Descrição: Controller que fará os inserts e updates na tabela processo
 * Date: 22/02/17
 * Time: 10:40
 */

include 'autoload.php';
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=utf-8");
header('access-control-allow-methods: GET, POST');

$processoDAO = new patrimonio_webservice\model\dao\ProcessoDAO();

// A ação deverá vir pelo post para ser válida a entrada nesta seção
if(isset($_GET['acao']))
    // Este if verifica se o usuário informou os dados corretamente
    if(isset($_GET['numero']) && strlen($_GET['numero']) > 0 && isset($_GET['assunto']) && strlen($_GET['assunto']) > 0)
    {
        switch ($_GET['acao'])
        {
            case "inserirProcesso":
                // Cria um objeto do tipo processo
                $processo = new \patrimonio_webservice\model\Processo();
                $processo->setNumero(urlencode($_GET['numero']));
                $processo->setAssunto(urlencode($_GET['assunto']));
                echo $processoDAO->createProcesso($processo);
                break;
            case "editarProcesso":
                if(isset($_GET['cod']) && isset($_GET['numero']) && strlen($_GET['numero']) > 0 && isset($_GET['assunto']) && strlen($_GET['assunto']) > 0)
                {
                    // Cria um objeto do tipo processo
                    $processo = new \patrimonio_webservice\model\Processo();
                    $processo->setCod(urlencode($_GET['cod']));
                    $processo->setNumero(urlencode($_GET['numero']));
                    $processo->setAssunto(urlencode($_GET['assunto']));
                    echo $processoDAO->updateProcesso($processo);
                }
                else
                    return "{'erro': 'Dados inválidos para editar um processo'}";
                break;
        }
    }
else
    echo "null";