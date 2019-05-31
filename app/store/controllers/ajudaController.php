<?php

class ajudaController extends Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function entregas()
	{

		$data = [];

		$store = new Store();
		$data = $store->getTemplateData();

		$data['searchTerm'] = '';
        $data['category'] = '';

		$this->loadTemplate("entregas", $data);

	}

	public function trocas()
	{

		$data = [];

		$store = new Store();
		$data = $store->getTemplateData();

		$data['searchTerm'] = '';
        $data['category'] = '';

		$this->loadTemplate("trocas", $data);

	}

	public function garantia()
	{

		$data = [];

		$store = new Store();
		$data = $store->getTemplateData();

		$data['searchTerm'] = '';
        $data['category'] = '';

		$this->loadTemplate("garantia", $data);

	}

	public function duvidas()
	{

		$data = [];

		$store = new Store();
		$data = $store->getTemplateData();

		$data['searchTerm'] = '';
        $data['category'] = '';

		$this->loadTemplate("duvidas", $data);

	}

	public function pagamentos()
	{

		$data = [];

		$store = new Store();
		$data = $store->getTemplateData();

		$data['searchTerm'] = '';
        $data['category'] = '';

		$this->loadTemplate("pagamentos", $data);

	}

	public function comocomprar()
	{

		$data = [];

		$store = new Store();
		$data = $store->getTemplateData();

		$data['searchTerm'] = '';
        $data['category'] = '';

		$this->loadTemplate("comocomprar", $data);

	}

}