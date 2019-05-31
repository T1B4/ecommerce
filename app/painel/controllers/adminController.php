<?php


class adminController extends Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function login()
	{

		$data = [];

		if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
			header("Location: " . BASE_PAINEL);
			exit;
		}

		if (isset($_POST['user']) && !empty($_POST['user'])) {

			$user = filter_input(INPUT_POST, 'user', FILTER_SANITIZE_STRING);
			$pass = md5(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));

			$users = new Admin();

			if($users->userExists($user)) {

				$uid = $users->validate($user, $pass);

				if (!empty($uid)) {
					$_SESSION['admin'] = $uid;
					header("Location: " . BASE_PAINEL);
				} else {
					$data['mensagem'] = "Nome de Usuário e/ou senha não conferem.";
				}

			} else {
				$data['mensagem'] = "Nome de Usuário não cadastrado.";
			}

		}


		$this->loadView('login', $data);

	}

	public function logout()
	{

		if (isset($_SESSION['admin']) && !empty($_SESSION['admin'])) {
			unset($_SESSION['admin']);
			header("Location: " . BASE_PAINEL );
			exit;
		}

	}

}