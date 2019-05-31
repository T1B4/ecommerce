<?php
class Cart extends Model
{

    public function getList()
    {
        $products = new Products();

        $array = array();
        $cart = array();

        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
        }

        foreach ($cart as $id => $qt) {

            $info = $products->getInfo($id);

            $array[$id] = array(
                'id' => $id,
                'qt' => $qt,
                'id_category' => $info['id_category'],
                'code' => $info['code'],
                'price' => $info['price'],
                'price_from' => $info['price_from'],
                'name' => $info['name'],
                'image' => $info['image'],
                'weight' => $info['weight'],
                'width' => $info['width'],
                'height' => $info['height'],
                'length' => $info['length'],
                'diameter' => $info['diameter'],
                'slug' => $info['slug'],
                'category_slug' => $info['category_slug'],
                'frete' => $info['frete'],
                'stock' => $info['stock'],
            );

        }

        return $array;
    }

    private function getProductDetails($id)
    {
        $product = new Products();
        $info = $product->getInfo($id);

        $array[$id] = array(
            'id' => $info['id'],
            'qt' => 1,
            'id_category' => $info['id_category'],
            'code' => $info['code'],
            'price' => $info['price'],
            'price_from' => $info['price_from'],
            'name' => $info['name'],
            'image' => $info['image'],
            'weight' => $info['weight'],
            'width' => $info['width'],
            'height' => $info['height'],
            'length' => $info['length'],
            'diameter' => $info['diameter'],
            'slug' => $info['slug'],
            'category_slug' => $info['category_slug'],
            'frete' => $info['frete'],
            'stock' => $info['stock'],
        );

        return $array;
    }

    public function getSubtotal()
    {
        $list = $this->getList();

        $subtotal = 0;

        foreach ($list as $item) {
            $subtotal += (floatval($item['price']) * intval($item['qt']));
        }

        return $subtotal;
    }

    public function shippingCalculate($cep, $id = null)
    {

        global $config;
        $itens = [];
        $total = 0;
        $data = [];
        $service = [];

        if ($id === null) {

            $list = $this->getList();

            foreach ($list as $item) {
                $total += $item['price'] * $item['qt'];
                $itens[] = (object) [
                    'Weight' => $item['weight'],
                    'Length' => $item['length'],
                    'Height' => $item['height'],
                    'Width' => $item['width'],
                    'Quantity' => $item['qt'],
                    'SKU' => $item['code'],
                    'Category' => $item['id_category'],
                ];

            }
        }

        if (isset($id)) {

            $list = $this->getProductDetails($id);
            foreach ($list as $item) {
                $total += $item['price'] * $item['qt'];
                $itens[] = (object) [
                    'Weight' => $item['weight'],
                    'Length' => $item['length'],
                    'Height' => $item['height'],
                    'Width' => $item['width'],
                    'Quantity' => $item['qt'],
                    'SKU' => $item['code'],
                    'Category' => $item['id_category'],
                ];

            }
        }

        $data = [
            "SellerCEP" => $config['cep_origin'],
            "RecipientCEP" => $cep,
            "ShipmentInvoiceValue" => $total,
            "ShippingItemArray" => $itens,
            "RecipientCountry" => "BR",
        ];

        $data = json_encode($data);
        $token = json_encode($config['token_frenet']);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "http://api.frenet.com.br/shipping/quote");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "token:" . $config['token_frenet'],
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($response);

        $ref = 0;

        foreach ($response->ShippingSevicesArray as $f) {

            if (isset($f->ShippingPrice)) {
                $service['price'] = $f->ShippingPrice;
            }
            if (isset($f->DeliveryTime)) {
                $service['date'] = $f->DeliveryTime;
            }
            if (isset($f->ServiceDescription)) {
                $service['type'] = $f->ServiceDescription;
            }
            if (isset($f->Msg)) {
                $service['mensagem'] = $f->Msg;
            }

            $array[$service['type']] = $service;

            $ref++;
        }

        return $array;
    }

    public function JamefFrete($cep_dest)
    {

        global $config;

        $array = [
            'price' => 0,
            'date' => '',
        ];

        $info = $this->getList();

        foreach ($info as $item) {

            $width = $item['width'] / 100;
            $height = $item['height'] / 100;
            $length = $item['length'] / 100;

            $cubagem = $width * $height * $length * $item['qt'];

            $data['TIPTRA'] = 1;
            $data['CNPJCPF'] = $config['cnpj_illuminart'];
            $data['MUNORI'] = $config['cidade'];
            $data['ESTORI'] = $config['estado'];
            $data['SEGPROD'] = 000004;
            $data['PESO'] = $item['weight'] * $item['qt'];
            $data['VALMER'] = $item['price'] * $item['qt'];
            $data['METRO3'] = $cubagem;
            $data['CEPDES'] = $cep_dest;
            $data['FILCOT'] = 16; //BAURU - COD 16
            $data['DIA'] = date('d');
            $data['MES'] = date('m');
            $data['ANO'] = date('Y');
            $data['USUARIO'] = $config['usuario'];

            $envio = implode('/', $data);

            $url = 'http://www.jamef.com.br/frete/rest/v1/' . $envio;

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $r = curl_exec($ch);
            $r = json_decode($r);

            $valor = $r->valor;
            $valor = number_format($valor, 2);
            $valor = floatval($valor);

            $array['price'] += $valor;
            $array['date'] = $r->previsao_entrega;
            $array['type'] = 'TRANSPORTADORA';

        }

        return $array;
    }

}
