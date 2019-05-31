<?php

class newsletterController extends Controller
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

		$store = new Store();
		$data = $store->getTemplateData();

		if (isset($_POST['email'])) {
			$email = addslashes($_POST['email']);

			$news = new Newsletter();
			$news->setUser($email);

			$data['searchTerm'] = '';
			$data['category'] = '';

			$data['social_items'] = [
				'url' => 'http://www.lustresecia.com.br/',
				'title' => 'Lustres e Cia',
				'description' => 'Lustres e Cia -  A melhor Loja Online de Iluminação do Brasil. Lustres, pendentes, plafons, arandelas, spots, lampadas e muito mais.',
				'image' => BASE_URL.'assets/img/logo.jpg'
			];

			$this->loadTemplate('newsletter', $data);
		}
	}
}