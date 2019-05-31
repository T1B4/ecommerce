<?php

class homeController extends Controller {

    public function __construct() {
        parent::__construct();

        if (!isset($_SESSION['admin']) && empty($_SESSION['admin'])) {
            header("Location: " . BASE_PAINEL . "admin/login");
        }
    }

    public function index() {
        $data = [];

        $purchase = new Purchases();

        $data['total_purchases'] = $this->getTotalPurchases();
        $data['total_amount'] = $this->getTotalAmount();
        $data['total_users'] = $this->getAllUsers();
        $data['total_newsletter'] = $this->getAllNewsletter();

        $this->loadTemplate('home', $data);
    }

    private function getTotalPurchases() 
    {
        $sales = new Purchases();
        $data = $sales->getTotal();
        return $data;
    }

    private function getTotalAmount()
    {
        $sales = new Purchases();
        $data = $sales->getTotalAmount();
        return $data;
    }

    private function getAllUsers()
    {
        $users = new Users();
        $data = $users->getTotal();
        return $data;
    }

    private function getAllNewsletter()
    {
        $users = new Newsletter();
        $data = $users->getTotal();
        return $data;
    }

}
