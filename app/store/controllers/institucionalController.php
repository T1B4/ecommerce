<?php


class institucionalController extends Controller {


	public function __construct()
	{
		parent::__construct();
	}

	public function sobrenos()
	{

		$data = [];

		$store = new Store();
		$data = $store->getTemplateData();

		$data['searchTerm'] = '';
		$data['category'] = '';

		$this->loadTemplate("sobrenos", $data);

	}

	public function comotrabalhamos()
	{

		$data = [];

		$store = new Store();
		$data = $store->getTemplateData();

		$data['searchTerm'] = '';
		$data['category'] = '';

		$this->loadTemplate("comotrabalhamos", $data);

	}

	public function nossosvalores()
	{

		$data = [];

		$store = new Store();
		$data = $store->getTemplateData();

		$data['searchTerm'] = '';
		$data['category'] = '';

		$this->loadTemplate("nossosvalores", $data);

	}

	public function ondeestamos()
	{

		$data = [];

		$store = new Store();
		$data = $store->getTemplateData();

		$data['searchTerm'] = '';
		$data['category'] = '';

		$this->loadTemplate("localizacao", $data);

	}


}