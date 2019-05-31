<?php
class psckttransparenteController extends Controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $store = new Store();
        $products = new Products();
        $cart = new Cart();
        $dados = $store->getTemplateData();

        $list = $cart->getList();
        $total = 0;
        $total_cart = 0;

        foreach($list as $item) {
            $total += (floatval($item['price']) * intval($item['qt']));
            $total_cart += (floatval($item['price_from']) * intval($item['qt']));
        }

        if(!empty($_SESSION['shipping'])) {
            $shipping = $_SESSION['shipping'];
            $shipping_type = $_SESSION['shipping_type'];

            foreach ($shipping as $envio) {
                if (in_array($shipping_type, $envio)) {
                    $frete = floatval(str_replace(',', '.', $envio['price']));
                }
            }

            $total += $frete;
            $total_cart += $frete;

        }

        $dados['total'] = floatval($total);
        $dados['total_cart'] = floatval($total_cart);

        $dados['searchTerm'] = '';
        $dados['category'] = '';

        try {
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            $dados['sessionCode'] = $sessionCode->getResult();
        } catch(Exception $e) {
            echo "ERRO: ".$e->getMessage();
            exit;
        }

        $dados['social_items'] = [
            'url' => 'http://www.lustresecia.com.br/',
            'title' => 'Lustres e Cia',
            'description' => 'Lustres e Cia -  A melhor Loja Online de Iluminação do Brasil. Lustres, pendentes, plafons, arandelas, spots, lampadas e muito mais.',
            'image' => BASE_URL.'assets/img/logo.jpg'
        ];

        $this->loadTemplate('cart_psckttransparente', $dados);
    }

    public function checkout() {
        $users = new Users();
        $cart = new Cart();
        $purchases = new Purchases();
        $prods = new Products();

        $data['searchTerm'] = '';
        $data['category'] = '';

        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $pass = md5(filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING));
        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
        $street = filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING);
        $num = filter_input(INPUT_POST, 'num', FILTER_SANITIZE_STRING);
        $complement = filter_input(INPUT_POST, 'complement', FILTER_SANITIZE_STRING);
        $cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);
        $district = filter_input(INPUT_POST, 'district', FILTER_SANITIZE_STRING);
        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING);
        $state = filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING);
        $telephone = filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING);
        $cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
        $id = addslashes($_POST['id']);
        $pgform = filter_input(INPUT_POST, 'pgform', FILTER_SANITIZE_STRING);

        $end = $street . ", " . $num . " - " . $complement . " - CEP : " . $cep ." - Bairro: " .  $district . " - " . $city . " - " . $state;

        if($users->emailExists($email)) {
            $uid = $users->validate($email, $pass);
            $_SESSION['uid'] = $uid;

            if(empty($uid)) {
                $array = array('error'=>true, 'msg'=>'E-mail e/ou senha não conferem.');
                echo json_encode($array);
                exit;
            }
        } else {
            $uid = $users->createUser($email, $pass, $name, $street, $num, $complement, $cep, $district, $city, $state, $telephone, $cpf);
        }

        $_SESSION['uid'] = $uid['id'];

        $list = $cart->getList();
        $total = 0;
        $total_cart = 0;

        foreach($list as $item) {
            $total += (floatval($item['price']) * intval($item['qt']));
            $total_cart += (floatval($item['price_from']) * intval($item['qt']));
        }

        if(!empty($_SESSION['shipping'])) {
            $shipping = $_SESSION['shipping'];
            $ship_type = $_SESSION['shipping_type'];

            if (in_array($ship_type, array_keys($shipping))) {
                $frete = floatval(str_replace(',', '.', $shipping[$ship_type]['price']));
            } else {
                $frete = 0;
            }

            $total += $frete;
            $total_cart += $frete;
        }

        //GRAVA OS DADOS DA COMPRA NO BANDO DE DADOS

        //GRAVA DADOS DA COMPRA QUANDO O PAGAMENTO FOR POR MEIO DE BOLETO
        if ($pgform === 'BOLETO') {

            $id_purchase = $purchases->createPurchase($uid, $total, 'Boleto', $end, $ship_type, $cpf);

            foreach($list as $item) {
                $purchases->addItem($id_purchase, $item['id'], $item['qt'], $item['price']);
                $prods->updateStock($item['id'], $item['qt']);
            }

        //GRAVA OS DADOS DA COMPRA QUANDO O PAGAMENTO FOR POR MEIO DE CARTÃO DE CRÉDITO
        } else {

            $id_purchase = $purchases->createPurchase($uid, $total_cart, 'Cartão de Crédito', $end, $ship_type, $cpf);

            foreach($list as $item) {
                $purchases->addItem($id_purchase, $item['id'], $item['qt'], $item['price_from']);
                $prods->updateStock($item['id'], $item['qt']);
            }
        }

        if ($pgform === 'BOLETO') {

            global $config;

            $boleto = new \PagSeguro\Domains\Requests\DirectPayment\Boleto();
            $boleto->setMode('DEFAULT');
            $boleto->setReceiverEmail($config['pagseguro_seller']);
            $boleto->setCurrency("BRL");

            foreach($list as $item) {
                $boleto->addItems()->withParameters(
                    $item['id'],
                    $item['name'],
                    intval($item['qt']),
                    floatval($item['price'])
                );
            }

            $boleto->setReference($id_purchase);

            $boleto->setSender()->setName($name);
            $boleto->setSender()->setEmail($email);
            $boleto->setSender()->setDocument()->withParameters('CPF', $cpf);

            $ddd = substr($telephone, 0, 2);
            $telefone = substr($telephone, 2);

            $boleto->setSender()->setPhone()->withParameters(
                $ddd,
                $telefone
            );

            $boleto->setSender()->setHash($id);

            $ip = $_SERVER['REMOTE_ADDR'];
            if(strlen($ip) < 9) {
                $ip = '127.0.0.1';
            }

            $boleto->setShipping()->setAddress()->withParameters(
                $street,
                $num,
                $district,
                $cep,
                $city,
                $state,
                'BRA',
                $complement
            );

            $boleto->setShipping()->setCost()->withParameters($frete);

            $boleto->setNotificationUrl(ROOT_URL."psckttransparente/notification");

            try {
                $result = $boleto->register(
                    \PagSeguro\Configuration\Configure::getAccountCredentials()
                );

                $link = $result->getPaymentLink();
                echo json_encode(array('link'=>$link));
                exit;
            } catch (Exception $e) {
                echo json_encode(array('error'=>true, 'msg'=>$e->getMessage()));
                exit;
            }

        } else {

            $cartao_titular = filter_input(INPUT_POST, 'cartao_titular', FILTER_SANITIZE_STRING);
            $cartao_cpf = filter_input(INPUT_POST, 'cartao_cpf', FILTER_SANITIZE_STRING);
            $cartao_numero = filter_input(INPUT_POST, 'cartao_numero', FILTER_SANITIZE_STRING);
            $cvv = filter_input(INPUT_POST, 'cvv', FILTER_SANITIZE_STRING);
            $v_mes = filter_input(INPUT_POST, 'v_mes', FILTER_VALIDATE_INT);
            $v_ano = filter_input(INPUT_POST, 'v_ano', FILTER_VALIDATE_INT);
            $cartao_token = filter_input(INPUT_POST, 'cartao_token', FILTER_SANITIZE_STRING);
            $parc = explode(';', $_POST['parc']);

            global $config;

            $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();
            $creditCard->setReceiverEmail($config['pagseguro_seller']);
            $creditCard->setReference($id_purchase);
            $creditCard->setCurrency("BRL");

            foreach($list as $item) {
                $creditCard->addItems()->withParameters(
                    $item['id'],
                    $item['name'],
                    intval($item['qt']),
                    floatval($item['price'])
                );
            }

            $creditCard->setSender()->setName($name);
            $creditCard->setSender()->setEmail($email);
            $creditCard->setSender()->setDocument()->withParameters('CPF', $cpf);

            $ddd = substr($telephone, 0, 2);
            $telefone = substr($telephone, 2);

            $creditCard->setSender()->setPhone()->withParameters(
                $ddd,
                $telefone
            );

            $creditCard->setSender()->setHash($id);

            $ip = $_SERVER['REMOTE_ADDR'];
            if(strlen($ip) < 9) {
                $ip = '127.0.0.1';
            }
            $creditCard->setSender()->setIp($ip);

            $creditCard->setShipping()->setAddress()->withParameters(
                $street,
                $num,
                $district,
                $cep,
                $city,
                $state,
                'BRA',
                $complement
            );

            $creditCard->setShipping()->setCost()->withParameters($frete);

            $creditCard->setBilling()->setAddress()->withParameters(
                $street,
                $num,
                $district,
                $cep,
                $city,
                $state,
                'BRA',
                $complement
            );

            $creditCard->setToken($cartao_token);
            $creditCard->setInstallment()->withParameters($parc[0], $parc[1]);
            $creditCard->setHolder()->setName($cartao_titular);
            $creditCard->setHolder()->setDocument()->withParameters('CPF', $cartao_cpf);

            $creditCard->setMode('DEFAULT');

            $creditCard->setNotificationUrl(ROOT_URL."psckttransparente/notification");

            try {
                $result = $creditCard->register(
                    \PagSeguro\Configuration\Configure::getAccountCredentials()
                );

                echo json_encode($result);
                exit;
            } catch(Exception $e) {
                echo json_encode(array('error'=>true, 'msg'=>$e->getMessage()));
                exit;
            }
        }

    }

    public function obrigado() {
        unset($_SESSION['cart']);

        $store = new Store();
        $user = new Users();
        $purchase = new Purchases();
        $mail = new Helpers();


        $data = $store->getTemplateData();
        // $data['user'] = $user->getUserData($_SESSION['uid']);
        $data['purchase'] = $purchase->getLastPurchase($_SESSION['uid']);

        $data['searchTerm'] = '';
        $data['category'] = '';

        /*$data['user'] = [
            '0' => [
                'email' => 'fernando.tiburcio@gmail.com',
                'name'  => 'Fernando Tiburcio',
            ]
        ];

        $data['mail'] = $mail->ThanksMail($data['user'][0]['email'], $data['user'][0]['name'], $data['purchase'] );*/

        $data['social_items'] = [
                'url' => 'http://www.lustresecia.com.br/',
                'title' => 'Lustres e Cia - A melhor Loja Online de Iluminação do Brasil',
                'description' => 'Lustres e Cia -  A melhor Loja Online de Iluminação do Brasil. Lustres, pendentes, plafons, arandelas, spots, lampadas e muito mais.',
                'image' => BASE_URL . 'assets/img/facebook-perfil.png',
            ];

        $this->loadTemplate("psckttransparente_obrigado", $data);
    }

    public function notification() {
        $purchases = new Purchases();

        try {

            if(\PagSeguro\Helpers\Xhr::hasPost()) {
                $r = \PagSeguro\Services\Transactions\Notification::check(
                    \PagSeguro\Configuration\Configure::getAccountCredentials()
                );

                $ref = $r->getReference();
                $status = $r->getStatus();
                /*
                1 = Aguardando Pagamento
                2 = Em análise
                3 = Paga
                4 = Disponível
                5 = Em disputa
                6 = Devolvida
                7 = Cancelada
                8 = Debitado
                9 = Retenção Temporária = Chargeback
                */

                $purchases->setPaid($ref);

                if($status == 3) {
                    $purchases->setPaid($ref);
                }
                elseif($status == 7) {
                    $purchases->setCancelled($ref);
                }

            }

        } catch(Exception $e) {

        }

    }

}