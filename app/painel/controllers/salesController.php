<?php

class salesController extends Controller
{

	public function __construct()
	{
		parent::__construct();

		if (!isset($_SESSION['admin']) && empty($_SESSION['admin'])) {
			header("Location: " . BASE_PAINEL . "admin/login");
			exit;
		}
	}

	public function see_all()
	{
		$data = [];

		$pp = new Purchases();

		$currentPage = 1;
		$offset = 0;
		$limit = 10;

		if (!empty($_GET['p'])) {
			$currentPage = $_GET['p'];
		}

		$offset = ($currentPage * $limit) - $limit;

		$data['sales'] = $pp->getPurchases($offset, $limit);
		$data['totalItems'] = $pp->getTotal();
		$data['numberOfPages'] = ceil($data['totalItems'] / $limit);
		$data['currentPage'] = $currentPage;

		$this->loadTemplate('sales_list', $data);
	}

	public function see_sale($id)
	{
		$data = [];

		$pp = new Purchases();
		$data['sales'] = $pp->getPurchase($id);

		$this->loadTemplate('sales_detail', $data);
	}

	public function last()
	{

		$data = [];

		$pp = new Purchases();
		$data['sales'] = $pp->getLastPurchases();

		$this->loadTemplate('sales_last', $data);

	}

	public function approved()
	{
		$data = [];

		$pp = new Purchases();
		$data['sales'] = $pp->getApprovedPurchases();

		$this->loadTemplate('sales_approved', $data);
	}

	public function repproved()
	{
		$data = [];

		$pp = new Purchases();
		$data['sales'] = $pp->getRepprovedPurchases();

		$this->loadTemplate('sales_repproved', $data);
	}

	public function setShipping()
	{

		$ship = new Purchases();

		if (isset($_POST['shipping_code']) && !empty($_POST['shipping_code'])) {

			$code = addslashes($_POST['shipping_code']);
			$id = intval($_POST['purchase_id']);

			$ship->setShippingCode($id, $code);

			header("Location: " . BASE_PAINEL . "sales/see_all");

		}

		header("Location: " . BASE_PAINEL . "sales/see_all");
	}

}