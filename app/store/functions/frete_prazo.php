<?php

$qtde = 1;

if (isset($_POST['qt_product'])) {
    $qtde = filter_input(INPUT_POST, 'qt_product', FILTER_VALIDATE_INT);
}

$data['nCdEmpresa'] = '';
$data['sDsSenha'] = '';
$data['sCepOrigem'] = '15900000';
$data['sCepDestino'] = $_POST['cep'];
$data['nVlPeso'] = $_POST['peso'];
$data['nCdFormato'] = '1';
$data['nVlComprimento'] = $_POST['comp'];
$data['nVlAltura'] = $_POST['alt'];
$data['nVlLargura'] = $_POST['larg'];
$data['nVlDiametro'] = $_POST['diametro'];
$data['sCdMaoPropria'] = 'N';
$data['nVlValorDeclarado'] = $_POST['preco'];
$data['StrRetorno'] = 'xml';
$data['nCdServico'] = '04510, 04014';

if ($data['nVlComprimento'] < 16) {
    $data['nVlComprimento'] = 16;
}

$query = http_build_query($data);

$url = 'http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx';

$curl = curl_init($url . '?' . $query);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($curl);
$result = simplexml_load_string($result);
echo "<h3>Fretes Disponíveis</h3>";
foreach ($result->cServico as $row) {
    //Os dados de cada serviço estará aqui
    $frete = $row->Codigo;
    if ($frete == '04510') {
        $tipo = "PAC";
    } else {
        $tipo = "SEDEX";
    }
    if ($row->Erro == 0) {
        $valor = strval($row->Valor);
        $valor = str_replace(',', '.', $valor);
        echo 'Tipo : ' . $tipo . ' <br>';
        echo 'Valor : R$ ' . floatval($valor) * $qtde . '<br>';
        echo 'Entrega : aprox. ' . $row->PrazoEntrega . ' dias úteis.';
        echo '<hr">';
        echo '<br>';

    } else {
        echo $row->MsgErro;
        echo '<br>';
    }

}

echo '<br>';
echo '<div class="card bg-danger text-white">';
echo '<small>Importante! Observar a disponibilidade do produto acima, se não for imediata deve-se somar o prazo de entrega ao da disponibilidade do produto.</small>';
echo '</div>';
