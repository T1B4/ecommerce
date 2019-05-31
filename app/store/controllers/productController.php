<?php
class productController extends Controller
{

    private $_user;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        header("Location: " . ROOT_URL);
    }

    public function open($slug)
    {
        $store = new Store();
        $products = new Products();
        $categories = new Categories();
        $cart = new Cart();

        $data = $store->getTemplateData();

        $info = $products->getProductInfo($slug);

        if (count($info) > 0) {

            $data['product_info'] = $info;
            $data['product_images'] = $products->getImagesByProductId($info['id']);
            $data['product_options'] = $products->getOptionsByProductId($info['id']);
            $data['product_rates'] = $products->getRates($info['id'], 5);

            $data['page_title'] = $data['product_info']['name'];
            $data['category'] = '';

            ($data['product_info']['id'] < 10) ? $cc = 0 : $cc = '';

            $mc = $categories->getCategoryTree($info['id_category']);

            $relacionados = $products->getList(0, 8, array('categories' => $mc[0]['id']), true);

            foreach ($relacionados as $item) {
                if ($item['id'] != $data['product_info']['id']) {
                    $data['relacionados'][] = $item;
                } else {
                    unset($item);
                }
            }

            if (!isset($data['relacionados'])) {
                $filters = [];
                $relacionados = $products->getList(0, 8, $filters, true);

                foreach ($relacionados as $item) {
                    if ($item['id'] != $data['product_info']['id']) {
                        $data['relacionados'][] = $item;
                    } else {
                        unset($item);
                    }
                }
            }

            if (isset($_POST['cep']) && !empty($_POST['cep'])) {
                $cep = str_replace('-', '', filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING));
                $qtde = filter_input(INPUT_POST, 'qt_product', FILTER_SANITIZE_NUMBER_INT);

                $_SESSION['cep'] = $cep;
                $data['frete'] = $cart->shippingCalculate($cep, $info['id']);
            }

            $data['social_items'] = [
                'url' => ROOT_URL . 'produtos/' . $slug,
                'title' => $data['product_info']['name'],
                'description' => $data['product_info']['description'],
                'image' => BASE_URL . 'media/products/' . $cc . $data['product_info']['id'] . '/' . $data['product_images'][0]['url'],
            ];

            $this->loadTemplate('product', $data);
        } else {
            header("Location: " . ROOT_URL);
        }

    }

    public function shippingCalculate($cep, $qtde, $info)
    {

        global $config;

        $nVlPeso = 0;
        $nVlComprimento = 0;
        $nVlAltura = 0;
        $nVlLargura = 0;
        $nVlDiametro = 0;
        $nVlValorDeclarado = 0;
        $frete = 0;
        $servico = '40010, 41106';
        $qtde = 1;

        if ($qtde > 1) {

            $nVlPeso += floatval($info['weight'] * $qtde);
            $nVlComprimento += floatval($info['length']);

            if ($nVlAltura < $info['height']) {
                $nVlAltura = floatval($info['height']);
            }

            $nVlLargura += floatval($info['width'] * $qtde);

            if ($nVlDiametro < $info['diameter']) {
                $nVlDiametro = floatval($info['diameter']);
            }

            $nVlValorDeclarado += floatval($info['price'] * $qtde);

        } else {

            $nVlPeso += floatval($info['weight']);
            $nVlComprimento += floatval($info['length']);

            if ($nVlAltura < $info['height']) {
                $nVlAltura = floatval($info['height']);
            }

            $nVlLargura += floatval($info['width']);

            if ($nVlDiametro < $info['diameter']) {
                $nVlDiametro = floatval($info['diameter']);
            }

            $nVlValorDeclarado += floatval($info['price'] * $qtde);

        }

        if ($nVlComprimento < 16) {
            $nVlComprimento = 16;
        }

        if ($nVlLargura < 11) {
            $nVlLargura = 11;
        }

        if ($nVlAltura < 3) {
            $nVlAltura = 3;
        }

        if ($nVlDiametro > 90) {
            $nVlDiametro = 90;
        }

        if ($nVlPeso > 30) {
            $nVlPeso = 30;
        }

        $data = array(
            'nCdServico' => $servico,
            'sCepOrigem' => $config['cep_origin'],
            'sCepDestino' => $cep,
            'nVlPeso' => $nVlPeso,
            'nCdFormato' => '1',
            'nVlComprimento' => $nVlComprimento,
            'nVlAltura' => $nVlAltura,
            'nVlLargura' => $nVlLargura,
            'nVlDiametro' => $nVlDiametro,
            'sCdMaoPropria' => 'N',
            'nVlValorDeclarado' => $nVlValorDeclarado,
            'sCdAvisoRecebimento' => 'N',
            'StrRetorno' => 'xml',
        );

        $url = 'http://ws.correios.com.br/calculador/CalcPrecoprazo.aspx';
        $data = http_build_query($data);

        $ch = curl_init($url . '?' . $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $r = curl_exec($ch);
        $r = simplexml_load_string($r);

        $srv = current($r->cServico->Codigo);

        foreach ($r->cServico as $result) {

            $cod = $result->Codigo;

            if ($cod == '40010') {
                $type = 'SEDEX';
            } else {
                $type = 'PAC';
            }

            $erro = '';
            $erro = current($result->MsgErro);

            if ($erro !== false) {
                $array[$type]['mensagem'] = $erro;
            }

            $array[$type]['price'] = current($result->Valor);
            $array[$type]['date'] = current($result->PrazoEntrega);
            $array[$type]['type'] = $type;

        }

        return $array;

    }

    public function JamefFrete($cep_dest, $info, $qtde)
    {

        global $config;

        $width = $info['width'] / 100;
        $height = $info['height'] / 100;
        $length = $info['length'] / 100;

        $cubagem = $width * $height * $length * $qtde;

        $data['TIPTRA'] = 1;
        $data['CNPJCPF'] = $config['cnpj_illuminart'];
        $data['MUNORI'] = $config['cidade'];
        $data['ESTORI'] = $config['estado'];
        $data['SEGPROD'] = 000004;
        $data['PESO'] = $info['weight'] * $qtde;
        $data['VALMER'] = $info['price'] * $qtde;
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

        var_dump($r);
        exit;

        if (!empty($r)) {
            $array['j_price'] = number_format($r->valor, 2, ',', '.');
            $array['j_date'] = $r->previsao_entrega;
            return $array;
        }

        return false;

    }

}
