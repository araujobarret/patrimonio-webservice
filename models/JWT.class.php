<?php
/**
 * Classe de token de acesso no formato JWT
 * O header é composto do ALG e TYPE
 * O payload é composto da alguns campos:
 *  1 - login
 *  2 - senha
 *  3 - dataRequisicao - horário que o token foi gerado
 *  4 - dataExpira - horario que o token expirará, que está definido por padrão em 1hora
 */

namespace patrimonio_webservice\model;

use patrimonio_webservice\model\Usuario;

class JWT
{
    const TOKEN = "patrimonio_do_além";
    CONST ALG = "SHA256";
    CONST TYPE = "JWT";

    private $header;
    private $payload;
    private $secret;

    // Função que valida se o token ainda está válido
    public function validaJWT($jwt)
    {
        // Decodifica o JSON e depois decodifica em base64 e depois novamente em JSON para pegar os objetos
        $json = json_decode($jwt);
        $jsonPayload = json_decode(base64_decode($json->payload));

        // Obtém o segredo e faz a validação
        $secret = $json->secret;
        $this->setSecret();
        if($secret == $this->secret)
        {
            // Pega as datas do payload
            $dataRequisicao = new \DateTime($jsonPayload->dataRequisicao);
            $dataExpira = new \DateTime($jsonPayload->dataExpira);

            // Verifica se o tempo já expirou
            if (!strtotime($dataExpira->format('d-m-Y H:i:s')) <= strtotime($dataRequisicao->format('d-m-Y H:i:s')))
                return "{'status': true}";
            else
                return "{'erro': 'Token expirou'}";
        }
        else
            return "{'erro': 'Segredo inválido'}";
    }

    // Função que gera o token
    public function setJWT($usuario, $jsonTipo)
    {
        $this->setHeader();
        $this->setSecret();
        $this->setPayload($usuario, $jsonTipo);
    }

    // Define o header com as constantes
    public function setHeader()
    {
        $this->header = base64_encode(json_encode(array("alg" => self::ALG, "type" => self::TYPE)));
    }

    // Passa os dados de autenticação para gerar o payload do JWT
    private function setPayload($usuario, $jsonTipo)
    {
        $temp = new \DateTime();
        //$temp2 =
        $data = new \DateTime(date('d-m-Y H:i:s'));
        $dataExpira = new \DateTime(date('d-m-Y H:i:s'));
        $dataExpira->add(new \DateInterval('PT1H'));

        $payload = array(
            "login" => $usuario->getLogin(),
            "senha" => $usuario->getSenha(),
            "dataRequisicao" => $data->format('d/m/Y/H/i/s'),
            "dataExpira" => $dataExpira->format('d/m/Y/H/i/s')
        );

        if(isset($jsonTipo))
        {
            $payload["tipo"] = $jsonTipo->tipo;
            $payload["sigla_setor"] = $jsonTipo->sigla_setor;
        }

        $this->payload = base64_encode(json_encode($payload));
    }

    public function setSecret()
    {
        $this->secret = hash("sha256", self::TOKEN);
    }

    function __toString()
    {
        // TODO: Implement __toString() method.
        return $this->header . "." . $this->payload . "." . $this->secret;
    }

    // Retorna o JWT em formato Json codificado
    function __toJson()
    {
        return json_encode(array(
            "header" => $this->header,
            "payload" => $this->payload,
            "secret" => $this->secret
        ));
    }

}