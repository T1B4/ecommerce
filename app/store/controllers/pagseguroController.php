<?php

class pagseguroController extends Controller
{

    private $user;

    public function __construct()
    {
        parent::__construct();
    }

    public function checkout()
    {
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
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        $pgform = filter_input(INPUT_POST, 'pgform', FILTER_SANITIZE_STRING);

        $end = $street . ", " . $num . " - " . $complement . " - CEP : " . $cep . " - Bairro: " . $district . " - " . $city . " - " . $state;

        if ($users->emailExists($email)) {
            $uid = $users->validate($email, $pass);
            $_SESSION['uid'] = $uid;

            if (empty($uid)) {
                $array = array('error' => true, 'msg' => 'E-mail e/ou senha não conferem.');
                echo json_encode($array);
                exit;
            }
        } else {
            $uid = $users->createUser($email, $pass, $name, $street, $num, $complement, $cep, $district, $city, $state, $telephone, $cpf);
        }

        $list = $cart->getList();
        $total = 0;
        $total_cart = 0;

        foreach ($list as $item) {
            $total += (floatval($item['price']) * intval($item['qt']));
            $total_cart += (floatval($item['price_from']) * intval($item['qt']));
        }

        if (!empty($_SESSION['shipping'])) {
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

        $id_purchase = intval($purchases->getLastGlobalPuchase()) + 1;

        if ($pgform === 'BOLETO') {

            global $config;

            $boleto = new \PagSeguro\Domains\Requests\DirectPayment\Boleto();
            $boleto->setMode('DEFAULT');
            $boleto->setReceiverEmail($config['pagseguro_seller']);
            $boleto->setCurrency("BRL");

            foreach ($list as $item) {
                $boleto->addItems()->withParameters(
                    $item['code'],
                    $item['name'],
                    intval($item['qt']),
                    floatval($item['price'])
                );
            }

            $boleto->setReference($id_purchase);

            $boleto->setSender()->setName($name);
            $boleto->setSender()->setEmail($email);
            $boleto->setSender()->setDocument()->withParameters('CPF', $cpf);

            $telephone = str_replace('-', '', $telephone);
            $ddd = substr($telephone, -11, 2);
            $telefone = substr($telephone, -9);

            $boleto->setSender()->setPhone()->withParameters(
                $ddd,
                $telefone
            );

            $boleto->setSender()->setHash($id);

            $ip = $_SERVER['REMOTE_ADDR'];
            if (strlen($ip) < 9) {
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

            if (isset($frete) && !empty($frete)) {
                $boleto->setShipping()->setCost()->withParameters($frete);
            } else {
                $boleto->setShipping()->setCost(0);
            }

            $boleto->setNotificationUrl(ROOT_URL . "psckttransparente/notification");

            try {
                //Get the crendentials and register the boleto payment
                $result = $boleto->register(
                    \PagSeguro\Configuration\Configure::getAccountCredentials()
                );

                if ($result) {
                    $purchases->createPurchase($uid, $total, 'BOLETO', $end, $ship_type, $cpf);
                    foreach ($list as $item) {
                        $purchases->addItem($id_purchase, $item['id'], $item['qt'], $item['price']);
                        $prods->updateStock($item['id'], $item['qt']);
                    }
                    $link = $result->getPaymentLink();    
                    echo json_encode(array('link' => $link));
                    exit;
                }

            } catch (Exception $e) {
                echo json_encode(array('error' => true, 'msg' => $e->getMessage()));
                exit;
            }

        } else {

            $cartao_titular = filter_input(INPUT_POST, 'cartao_titular', FILTER_SANITIZE_STRING);
            $cartao_aniversario = filter_input(INPUT_POST, 'cartao_aniversario', FILTER_SANITIZE_STRING);
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

            foreach ($list as $item) {
                $creditCard->addItems()->withParameters(
                    $item['code'],
                    $item['name'],
                    intval($item['qt']),
                    floatval($item['price_from'])
                );
            }

            $creditCard->setSender()->setName($name);
            $creditCard->setSender()->setEmail($email);
            $creditCard->setSender()->setDocument()->withParameters('CPF', $cpf);

            $telephone = str_replace('-', '', $telephone);
            $ddd = substr($telephone, -11, 2);
            $telefone = substr($telephone, -9);

            $creditCard->setSender()->setPhone()->withParameters(
                $ddd,
                $telefone
            );

            $creditCard->setSender()->setHash($id);

            $ip = $_SERVER['REMOTE_ADDR'];
            if (strlen($ip) < 9) {
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

            if (isset($frete) && !empty($frete)) {
                $creditCard->setShipping()->setCost()->withParameters($frete);
            } else {
                $creditCard->setShipping()->setCost(0);
            }

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
            $creditCard->setInstallment()->withParameters($parc[0], $parc[1], 6);
            $creditCard->setHolder()->setBirthdate($cartao_aniversario);
            $creditCard->setHolder()->setName($cartao_titular);
            $creditCard->setHolder()->setPhone()->withParameters(
                $ddd,
                $telefone
            );
            $creditCard->setHolder()->setDocument()->withParameters('CPF', $cartao_cpf);

            $creditCard->setMode('DEFAULT');

            $creditCard->setNotificationUrl(ROOT_URL . "psckttransparente/notification");

            try {
                $result = $creditCard->register(
                    \PagSeguro\Configuration\Configure::getAccountCredentials()
                );

                if (($purchases->createPurchase($uid, $total_cart, 'CARTÃO DE CRÉDITO', $end, $ship_type, $cpf)) !== true) {
                    echo json_enconde(array('error' => true, 'msg' => 'Erro ao salvar vendas no banco de dados'));
                    exit;
                }

                foreach ($list as $item) {
                    if (($purchases->addItem($id_purchase, $item['id'], $item['qt'], $item['price_from'])) !== true) {
                        echo json_enconde(array('error' => true, 'msg' => 'Erro ao salvar itens no banco de dados'));
                        exit;
                    }

                    if (($prods->updateStock($item['id'], $item['qt'])) !== true) {
                        echo json_enconde(array('error' => true, 'msg' => 'Erro ao atualizar o estoque no banco de dados'));
                        exit;
                    }

                }

                echo json_encode($result);
                exit;

            } catch (Exception $e) {
                echo json_encode(array('error' => true, 'msg' => $e->getMessage()));
                $purchases->setPurchaseStatus($id_purchase, 'R');
                $purchases->delItens($id);
                foreach ($list as $item) {
                    $prods->updateStock($item['id'], -$item['qt']);
                }
                exit;

            }
        }

    }

    public function notification()
    {
        $purchases = new Purchases();

        try {

            if (\PagSeguro\Helpers\Xhr::hasPost()) {
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

                if ($status == 3) {
                    $purchases->setPaid($ref);
                } elseif ($status == 7) {
                    $purchases->setCancelled($ref);
                }

            }

        } catch (Exception $e) {

        }

    }

}
