<?php
class cartController extends Controller
{

    private $user;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $store = new Store();
        $products = new Products();
        $cart = new Cart();
        $cep = '';
        $shipping = array();

        $data = $store->getTemplateData();
        $data['list'] = $cart->getList();

        foreach ($data['list'] as $item) {
            if (array_key_exists($item['id'], $_SESSION['cart'])) {
                if ($item['stock'] < $_SESSION['cart'][$item['id']]) {
                    if ($item['stock'] <= 0) {
                        // unset($_SESSION['cart'][$item['id']]);
                        // unset($data['list'][$item['id']]);
                    } else {
                        $_SESSION['cart'][$item['id']] = $item['stock'];
                        $data['list'][$item['id']]['qt'] = $item['stock'];
                        $data['list'][$item['id']]['mensagem'] = "Este produto possui estoque menor que a quantia desejada, a quantia no carrinho de compras foi ajustada para o máximo disponivel em nosso estoque, caso deseje mais itens entre em contato pelos canais de atendimento para encomenda.";
                    }
                }
            }
        }

        if (!empty($_SESSION['cep']) && !empty($_SESSION['cart'])) {
            $shipping = $cart->shippingCalculate($_SESSION['cep']);
            $_SESSION['shipping'] = $shipping;
        } elseif (!empty($_POST['cep']) && !empty($_SESSION['cart'])) {
            $cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);
            $_SESSION['cep'] = $cep;
            $shipping = $cart->shippingCalculate($cep);
            $_SESSION['shipping'] = $shipping;

        }

        $data['shipping'] = $shipping;

        $data['stock'] = [];

        $data['searchTerm'] = '';
        $data['category'] = '';

        $filters = [];

        $relacionados = $products->getList(0, 8, $filters, true);

        foreach ($relacionados as $key => $value) {
            $data['relacionados'][$value['id']] = $value;
        }

        foreach ($data['list'] as $item) {
            if (in_array($item['id'], array_keys($data['relacionados']))) {
                unset($data['relacionados'][$item['id']]);
            }
        }

        $data['social_items'] = [
            'url' => 'http://www.lustresecia.com.br/',
            'title' => 'Lustres e Cia - A melhor Loja Online de Iluminação do Brasil',
            'description' => 'Lustres e Cia -  A melhor Loja Online de Iluminação do Brasil. Lustres, pendentes, plafons, arandelas, spots, lampadas e muito mais.',
            'image' => BASE_URL . 'assets/img/facebook-perfil.png',
        ];

        $this->loadTemplate('cart', $data);
    }

    public function del($id)
    {

        $cart = new Cart();

        if (!empty($id)) {
            unset($_SESSION['cart'][$id]);
            unset($_SESSION['shipping']);
            unset($_SESSION['date']);
        }

        header("Location: " . ROOT_URL . "cart");
        exit;
    }

    public function add()
    {
        $cart = new Cart();

        if (!empty($_POST['id_product'])) {
            $id = intval($_POST['id_product']);
            $qt = intval($_POST['qt_product']);
            unset($_SESSION['shipping']);

            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = array();
            }

            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id] += $qt;
            } else {
                $_SESSION['cart'][$id] = $qt;
            }
        }

        header("Location: " . ROOT_URL . "cart");

    }

    public function update()
    {

        $cart = new Cart();

        if (!empty($_POST['id_product'])) {
            $id = intval($_POST['id_product']);
            $qt = intval($_POST['qt_product']);
            unset($_SESSION['shipping']);

            if (isset($_SESSION['cart'][$id])) {
                $_SESSION['cart'][$id] = $qt;
            }
        }

        header("Location: " . ROOT_URL . "cart");

    }

    public function recalculate_shipping()
    {
        unset($_SESSION['shipping']);
        unset($_SESSION['type']);
        unset($_SESSION['cep']);

        header("Location: " . ROOT_URL . "cart");
    }

    public function payment_redirect()
    {

        if (!empty($_POST['payment_type'])) {
            $payment_type = filter_input(INPUT_POST, 'payment_type', FILTER_SANITIZE_STRING);
            $shipping_type = filter_input(INPUT_POST, 'shipping_type', FILTER_SANITIZE_STRING);
            $_SESSION['shipping_type'] = $shipping_type;

            switch ($payment_type) {
                case 'pagseguro':
                    header("Location: " . ROOT_URL . "psckttransparente");
                    exit;
                    break;
                case 'mercado_pago':
                    header("Location: " . ROOT_URL . "mp");
                    exit;
                    break;

            }

        }

        header("Location: " . ROOT_URL . "cart");
    }

}
