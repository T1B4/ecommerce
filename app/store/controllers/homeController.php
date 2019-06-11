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
        // $f = new Filters();
        $brands = new Brands();
        $expo = new Vitrine();

        $data = $store->getTemplateData();

        $vitrine = $expo->getItemsExpo();

        $filters = array();
        if (!empty($_GET['filter']) && is_array($_GET['filter'])) {
            $filters = $_GET['filter'];
        }

        $currentPage = 1;
        $offset = 0;
        $limit = 20;

        if (!empty($_GET['p'])) {
            $currentPage = $_GET['p'];
        }

        $offset = ($currentPage * $limit) - $limit;

        foreach ($vitrine as $value) {
            $data[$value['secao_exposta']] = $products->getList(0, $value['itens_expostos'], array($value['expo_name'] => '1'), true);
        }

        $data['totalItems'] = $products->getTotal($filters);
        $data['numberOfPages'] = ceil($data['totalItems'] / $limit);
        $data['currentPage'] = $currentPage;
        $data['brands'] = $brands->getList();

        // $data['filters'] = $f->getFilters($filters);
        // $data['filters_selected'] = $filters;

        $data['searchTerm'] = '';
        $data['category'] = '';

        $this->loadTemplate('home', $data);
    }

}
