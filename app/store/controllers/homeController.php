<?php

class homeController extends Controller
{

	private $user;

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $store = new Store();
        $products = new Products();
        $categories = new Categories();
        $f = new Filters();
        $brands = new Brands();

        $data = $store->getTemplateData();

        $filters = array();
        if(!empty($_GET['filter']) && is_array($_GET['filter'])) {
            $filters = $_GET['filter'];
        }

        $currentPage = 1;
        $offset = 0;
        $limit = 20;

        if(!empty($_GET['p'])) {
            $currentPage = $_GET['p'];
        }

        $offset = ($currentPage * $limit) - $limit;

        $data['destaques'] = $products->getList(0, 8, array('featured'=>'1'), true);
        $data['promocao'] = $products->getList(0, 16, array('sale'=>'1'), true);
        $data['maisvendidos'] = $products->getList(0, 16, array('bestseller'=>'1'), true);
        $data['lancamentos'] = $products->getList(0, 16, array('new_product'=>'1'), true);
        $data['totalItems'] = $products->getTotal($filters);
        $data['numberOfPages'] = ceil($data['totalItems'] / $limit);
        $data['currentPage'] = $currentPage;
        $data['brands'] = $brands->getList();

        $data['filters'] = $f->getFilters($filters);
        $data['filters_selected'] = $filters;

        $data['searchTerm'] = '';
        $data['category'] = '';


        $data['social_items'] = [
            'url' => 'http://www.lustresecia.com.br/',
            'title' => 'Lustres e Cia',
            'description' => 'Lustres e Cia -  A melhor Loja de Iluminação do Brasil. Lustres, pendentes, plafons, arandelas, spots, lampadas e muito mais.',
            'image' => BASE_URL.'assets/img/facebook-perfil.png'
        ];

        $this->loadTemplate('home', $data);
    }

}
