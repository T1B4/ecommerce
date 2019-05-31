<?php

class Cart extends Model {

    public function getList() {
        $products = new Products();

        $array = array();
        $cart = array();

        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
        }

        foreach ($cart as $id => $qt) {

            $info = $products->getInfo($id);

            $array[] = array(
                'id' => $id,
                'qt' => $qt,
                'price' => $info['price'],
                'name' => $info['name'],
                'image' => $info['image'],
                'weight' => $info['weight'],
                'width' => $info['width'],
                'height' => $info['height'],
                'length' => $info['length'],
                'diameter' => $info['diameter'],
                'slug' => $info['slug']
            );
        }

        return $array;
    }

    public function getSubtotal() {
        $list = $this->getList();

        $subtotal = 0;

        foreach ($list as $item) {
            $subtotal += (floatval($item['price']) * intval($item['qt']));
        }

        return $subtotal;
    }

    public function shippingCalculate($cepDestination, $type) {
        $array = array(
            'price' => 0,
            'date' => '',
        );

        global $config;

        $list = $this->getList();

        $nVlPeso = 0;
        $nVlComprimento = 0;
        $nVlAltura = 0;
        $nVlLargura = 0;
        $nVlDiametro = 0;
        $nVlValorDeclarado = 0;

        foreach ($list as $item) {

            if ($item['qt'] > 1) {

                $nVlPeso += floatval($item['weight'] * $item['qt']);
                $nVlComprimento += floatval($item['length']);

                if ($nVlAltura < $item['height']) {
                    $nVlAltura = floatval($item['height']);
                }

                $nVlLargura += floatval($item['width'] * $item['qt']);

                if ($nVlDiametro < $item['diameter']) {
                    $nVlDiametro = floatval($item['diameter']);
                }

                $nVlValorDeclarado += floatval($item['price'] * $item['qt']);
            } else {

                $nVlPeso += floatval($item['weight']);
                $nVlComprimento += floatval($item['length']);

                if ($nVlAltura < $item['height']) {
                    $nVlAltura = floatval($item['height']);
                }

                $nVlLargura += floatval($item['width']);

                if ($nVlDiametro < $item['diameter']) {
                    $nVlDiametro = floatval($item['diameter']);
                }

                $nVlValorDeclarado += floatval($item['price'] * $item['qt']);
            }
        }

        $soma = $nVlComprimento + $nVlAltura + $nVlLargura;

        if ($soma > 200) {
            $nVlComprimento = 66;
            $nVlAltura = 66;
            $nVlLargura = 66;
        }

        if ($nVlDiametro > 90) {
            $nVlDiametro = 90;
        }

        if ($nVlPeso > 40) {
            $nVlPeso = 40;
        }

        if ($type === 'SEDEX') {
            $servico = 40010;
        } else {
            $servico = 41106;
        }

        $data = array(
            'nCdServico' => $servico,
            'sCepOrigem' => $config['cep_origin'],
            'sCepDestino' => $cepDestination,
            'nVlPeso' => $nVlPeso,
            'nCdFormato' => '1',
            'nVlComprimento' => $nVlComprimento,
            'nVlAltura' => $nVlAltura,
            'nVlLargura' => $nVlLargura,
            'nVlDiametro' => $nVlDiametro,
            'sCdMaoPropria' => 'N',
            'nVlValorDeclarado' => $nVlValorDeclarado,
            'sCdAvisoRecebimento' => 'N',
            'StrRetorno' => 'xml'
        );

        $url = 'http://ws.correios.com.br/calculador/CalcPrecoprazo.aspx';
        $data = http_build_query($data);

        $ch = curl_init($url . '?' . $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $r = curl_exec($ch);
        $r = simplexml_load_string($r);

        $srv = current($r->cServico->Codigo);

        $array['price'] = current($r->cServico->Valor);
        $array['date'] = current($r->cServico->PrazoEntrega);
        if ($srv === 41106) {
            $array['type'] = "PAC";
        } else {
            $array['type'] = "SEDEX";
        }

        return $array;
    }

}
