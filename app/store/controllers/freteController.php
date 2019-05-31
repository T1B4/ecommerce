<?php

class freteController extends Controller 
{
    public function __construct()
    {
        parent::__construct();
    }

    public function JamefFrete($comp, $larg, $alt, $peso, $valor, $cep_dest)
    {

        $data['TRANSPORTE'] = 1;
        $data['CPFCNPJ'] = 'cnpj_illuminart';
        $data['MUN_ORIGEM'] = 'Jaú';
        $data['EST_ORIGEM'] = 'SP';
        $data['TIPO_PROD'] = 000004;
        $data['PESO'] = $peso;
        $data['VAL_MERCADORIA'] = $valor;
        $data['CUBAGEM'] = $cubagem;
        $data['CEP_DESTINO'] = $cep_dest;
        $data['FILIAL_COLETA'] = 16; //BAURU - COD 16
        $data['DIA'] = date('d');
        $data['MES'] = date('m');
        $data['ANO'] = date('Y');

        $url = 'http://www.jamef.com.br/frete/rest/v1';
        $data = http_build_query($data);

        $ch = curl_init($url.'?'.$data);
        echo $ch;
        exit;
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $r = curl_exec($ch);
        $r = simplexml_load_string($r);
    }

}
