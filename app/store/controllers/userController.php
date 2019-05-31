<?php

class userController extends Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function login()
	{

		$data = [];
		$store = new Store();
		$data = $store->getTemplateData();

		if (isset($_SESSION['uid']) && !empty($_SESSION['uid'])) {
			header("Location: " . ROOT_URL . "user/controlPanel");
			exit;
		}

		if (isset($_POST['email']) && !empty($_POST['email'])) {

			$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
			$pass = md5(filter_input(INPUT_POST, 'pass', FILTER_SANITIZE_STRING));

			$users = new Users();

			if($users->emailExists($email)) {

				$uid = $users->validate($email, $pass);

				if (isset($uid) && !empty($uid)) {
					$_SESSION['uid'] = $uid;
					header("Location: " . ROOT_URL . "user/controlPanel");
				} else {
					$data['mensagem'] = "E-mail e/ou senha não conferem.";
				}

			} else {
				$data['mensagem'] = "E-mail não cadastrado.";
			}

		}

		$data['searchTerm'] = '';
        $data['category'] = '';

		$data['social_items'] = [
            'url' => 'http://www.lustresecia.com.br/',
            'title' => 'Lustres e Cia',
            'description' => 'Lustres e Cia -  A melhor Loja Online de Iluminação do Brasil. Lustres, pendentes, plafons, arandelas, spots, lampadas e muito mais.',
            'image' => BASE_URL.'assets/img/logo.jpg'
        ];


		$this->loadTemplate('login', $data);

	}

	public function newUser()
	{

		$data = [];
		$store = new Store();
		$data = $store->getTemplateData();

		if (isset($_SESSION['uid']) && !empty($_SESSION['uid'])) {
			header("Location: " . ROOT_URL . "user/controlPanel");
			exit;
		}

		if (isset($_POST['email']) && !empty($_POST['email'])) {

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

			$users = new Users();

			if(!$users->emailExists($email)) {

				$uid = $users->createUser($email, $pass, $name, $street, $num, $complement, $cep, $district, $city, $state, $telephone, $cpf);
				$data['sucesso'] = "Usuário cadastrado com sucesso!";

			} else {

				$data['mensagem'] = "E-mail já existe em nosso cadastro.";

			}

		}

		$data['searchTerm'] = '';
        $data['category'] = '';

		$data['social_items'] = [
            'url' => 'http://www.lustresecia.com.br/',
            'title' => 'Lustres e Cia',
            'description' => 'Lustres e Cia -  A melhor Loja Online de Iluminação do Brasil. Lustres, pendentes, plafons, arandelas, spots, lampadas e muito mais.',
            'image' => BASE_URL.'assets/img/logo.jpg'
        ];

		$this->loadTemplate('new_user', $data);

	}

	public function controlPanel()
	{

		$data = [];
		$store = new Store();
		$usr = new Users();
		$data = $store->getTemplateData();

		if (!isset($_SESSION['uid']) && empty($_SESSION['uid'])) {
			header("Location: " . ROOT_URL . "user/login");
			exit;
		}

		if (isset($_POST) && !empty($_POST)) {

			$rua = trim(filter_input(INPUT_POST, 'street', FILTER_SANITIZE_STRING));
			$numero = trim(filter_input(INPUT_POST, 'number', FILTER_SANITIZE_STRING));
			$bairro = trim(filter_input(INPUT_POST, 'district', FILTER_SANITIZE_STRING));
			$cidade = trim(filter_input(INPUT_POST, 'city', FILTER_SANITIZE_STRING));
			$estado = trim(filter_input(INPUT_POST, 'state', FILTER_SANITIZE_STRING));
			$telefone = trim(filter_input(INPUT_POST, 'telephone', FILTER_SANITIZE_STRING));
			$celular = trim(filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_STRING));

			$usr->updateUser($rua, $numero, $bairro, $cidade, $estado, $telefone, $celular, $_SESSION['uid']);

			$data['mensagem'] = "Dados atualizados com sucesso!";

		}


		$data['user_data'] = $usr->getUserData($_SESSION['uid']);

		$data['searchTerm'] = '';
        $data['category'] = '';

		$data['social_items'] = [
            'url' => 'http://www.lustresecia.com.br/',
            'title' => 'Lustres e Cia',
            'description' => 'Lustres e Cia -  A melhor Loja Online de Iluminação do Brasil. Lustres, pendentes, plafons, arandelas, spots, lampadas e muito mais.',
            'image' => BASE_URL.'assets/img/logo.jpg'
        ];

		$this->loadTemplate('control_panel', $data);

	}

	public function changePass()
	{

		$data = [];
		$store = new Store();
		$usr = new Users();
		$data = $store->getTemplateData();

		if (!isset($_SESSION['uid']) && empty($_SESSION['uid'])) {
			header("Location: " . ROOT_URL );
			exit;
		}

		if (isset($_POST) && !empty($_POST)) {

			$oldpass = trim(md5(filter_input(INPUT_POST, 'oldpass', FILTER_SANITIZE_STRING)));
			$newpass = trim(md5(filter_input(INPUT_POST, 'newpass', FILTER_SANITIZE_STRING)));
			$newpass2 = trim(md5(filter_input(INPUT_POST, 'newpass2', FILTER_SANITIZE_STRING)));

			if ($usr->validatePass($_SESSION['uid'], $oldpass)) {

				if ($newpass === $newpass2) {
					$usr->updatePass($newpass, $_SESSION['uid']);
					$data['mensagem_success'] = "Senha alterada com sucesso!";
				}  else {
					$data['mensagem_error'] = "Senha nova precisa ser igual nos dois campos.";
				}

			} else {
				$data['mensagem_error'] = "Senha antiga não confere...";
			}

		}

		$data['searchTerm'] = '';
        $data['category'] = '';

		$data['social_items'] = [
            'url' => 'http://www.lustresecia.com.br/',
            'title' => 'Lustres e Cia',
            'description' => 'Lustres e Cia -  A melhor Loja Online de Iluminação do Brasil. Lustres, pendentes, plafons, arandelas, spots, lampadas e muito mais.',
            'image' => BASE_URL.'assets/img/logo.jpg'
        ];

		$this->loadTemplate('change_password', $data);

	}

	public function myPurchases()
	{

		$data = [];
		$store = new Store();
		$data = $store->getTemplateData();

		if (!isset($_SESSION['uid']) && empty($_SESSION['uid'])) {
			header("Location: " . ROOT_URL . "user/login" );
			exit;
		}

		$purchases = new Purchases();
		$data['purchases'] = $purchases->getPurchases($_SESSION['uid']);

		$data['searchTerm'] = '';
        $data['category'] = '';

		$data['social_items'] = [
            'url' => 'http://www.lustresecia.com.br/',
            'title' => 'Lustres e Cia',
            'description' => 'Lustres e Cia -  A melhor Loja Online de Iluminação do Brasil. Lustres, pendentes, plafons, arandelas, spots, lampadas e muito mais.',
            'image' => BASE_URL.'assets/img/logo.jpg'
        ];

		$this->loadTemplate('my_purchases', $data);

	}

	public function purchaseDetails($id)
	{

		$data = [];
		$store = new Store();
		$data = $store->getTemplateData();

		if (!isset($_SESSION['uid']) && empty($_SESSION['uid'])) {
			header("Location: " . ROOT_URL );
			exit;
		}

		$purchases = new Purchases();
		$data['purchase'] = $purchases->getPurchase($id);

		$data['searchTerm'] = '';
        $data['category'] = '';

		$data['social_items'] = [
            'url' => 'http://www.lustresecia.com.br/',
            'title' => 'Lustres e Cia',
            'description' => 'Lustres e Cia -  A melhor Loja Online de Iluminação do Brasil. Lustres, pendentes, plafons, arandelas, spots, lampadas e muito mais.',
            'image' => BASE_URL.'assets/img/logo.jpg'
        ];

		$this->loadTemplate('purchase_details', $data);

	}

	public function logout()
	{

		if (isset($_SESSION['uid']) && !empty($_SESSION['uid'])) {
			unset($_SESSION['uid']);
			header("Location: " . ROOT_URL );
			exit;
		}

	}

}