<?php

class userController extends Controller {

    public function __construct() {
        parent::__construct();

        if (!isset($_SESSION['admin']) && empty($_SESSION['admin'])) {
            header("Location: " . BASE_PAINEL . "admin/login");
            exit;
        }
    }

    public function index() {
        $data = [];

        $users = new Users();

        $currentPage = 1;
        $offset = 0;
        $limit = 15;

        if (!empty($_GET['p'])) {
            $currentPage = $_GET['p'];
        }

        $offset = ($currentPage * $limit) - $limit;

        $data['users'] = $users->getList();

        $data['totalItems'] = $users->getTotal();
        $data['numberOfPages'] = ceil($data['totalItems'] / $limit);
        $data['currentPage'] = $currentPage;

        $this->loadTemplate('users', $data);
    }

}
