<?php
class mpController extends Controller {

	private $user;

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$store = new Store();
		$users = new Users();
		$cart = new Cart();
		$purchases = new Purchases();
		$prods = new Products();

		$dados = $store->getTemplateData();
		$dados['error'] = '';

		if(!empty($_POST['name'])) {

			$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
			$pass = md5(filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING));
			$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
			$street = filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_STRING);
			$num = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING);
			$complement = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING);
			$cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);
			$district = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
			$city = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
			$state = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_STRING);
			$telephone = filter_input(INPUT_POST, 'telefone', FILTER_SANITIZE_STRING);
			$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);

			$end = $street . ", " . $num . " - " . $complement . " - CEP : " . $cep ." - Bairro: " .  $district . " - " . $city . " - " . $state;

			if($users->emailExists($email)) {
				$uid = $users->validate($email, $pass);

				if(empty($uid)) {
					$array = array('error'=>true, 'msg'=>'E-mail e/ou senha não conferem.');
					echo json_encode($array);
					exit;
				}
			} else {
				$uid = $users->createUser($email, $pass, $name, $street, $num, $complement, $cep, $district, $city, $state, $telephone);
			}

			if(!empty($uid)) {

				$list = $cart->getList();
				$frete = 0;
				$total = 0;

				foreach($list as $item) {
					$total += (floatval($item['price']) * intval($item['qt']));
				}

				if(!empty($_SESSION['shipping'])) {
					$shipping = $_SESSION['shipping'];

					if(isset($shipping['price'])) {
						$frete = floatval(str_replace(',', '.', $shipping['price']));
					} else {
						$frete = 0;
					}

					$total += $frete;
				}

				$id_purchase = $purchases->createPurchase($uid, $total, 'MercadoPago', $end, $_SESSION['type']);

				foreach($list as $item) {
					$purchases->addItem($id_purchase, $item['id'], $item['qt'], $item['price']);
					$prods->updateStock($item['id'], $item['qt']);
				}

				unset($_SESSION['cart']);
				unset($_SESSION['shipping']);

				global $config;

				$mp = new MP($config['mp_appid'], $config['mp_key']);

				$data = array(
					'items' => array(),
					'shipments' => array(
						'mode' => 'custom',
						'cost' => $frete,
						'receiver_address' => array(
							'zip_code' => $cep
						)
					),
					'back_urls' => array(
						'success' => ROOT_URL.'mp/obrigadoaprovado',
						'pending' => ROOT_URL.'mp/obrigadoanalise',
						'failure' => ROOT_URL.'mp/obrigadocancelado'
					),
					'notification_url' => ROOT_URL.'mp/notificacao',
					'auto_return' => 'all',
					'external_reference' => $id_purchase
				);

				foreach($list as $item) {
					$data['items'][] = array(
						'title' => $item['name'],
						'quantity' => $item['qt'],
						'currency_id' => 'BRL',
						'unit_price' => floatval($item['price'])
					);
				}

				$link = $mp->create_preference($data);

				if($link['status'] == '201') {
					$link = $link['response']['init_point'];
					header("Location: ".$link);
					exit;
				} else {
					$dados['error'] = 'Tente novamente mais tarde';
				}


			}


		}

		$this->loadTemplate('cart_mp', $dados);
	}

	public function notificacao() {
		$purchases = new Purchases();

		global $config;
		$mp = new MP($config['mp_appid'], $config['mp_key']);
		$mp->sandbox_mode(false);

		$info = $mp->get_payment_info($_GET['id']);

		if($info['status'] == '200') {

			$array = $info['response'];
			$ref = $array['collection']['external_reference'];
			$status = $array['collection']['status'];
			/*
			pending = Em análise
			approved = Aprovado
			in_procress = Em revisão
			in_mediation = Em processo de disputa
			rejected = Foi rejeitado
			cancelled = Foi cancelado
			refunded = Reembolsado
			charged_back = Chargeback
			*/

			if($status == 'approved') {
				$purchases->setPaid($ref);
			}
			elseif($status == 'cancelled') {
				$purchases->setCancelled($ref);
			}


		}

	}












}