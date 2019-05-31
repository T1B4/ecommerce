<?php
class brandsController extends Controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        header("Location: ".ROOT_URL);
    }

    public function enter($slug) {
        $store = new Store();
        $products = new Products();
        $categories = new Categories();
        $f = new Filters();
        $brand = new Brands();

        $data = $store->getTemplateData();

        $data['brand'] = $brand->getBrand($slug);

        $data['brand_name'] = $data['brand']['name'];

        $data['page_title'] = $data['brand']['name'];

        if(!empty($data['brand_name'])) {
            $currentPage = 1;
            $offset = 0;
            $limit = 16;

            if(!empty($_GET['p'])) {
                $currentPage = $_GET['p'];
            }

            $offset = ($currentPage * $limit) - $limit;

            $filters = array('brands'=>$data['brand']['id']);

            $data['list'] = $products->getList($offset, $limit, $filters);
            $data['totalItems'] = $products->getTotal($filters);
            $data['numberOfPages'] = ceil($data['totalItems'] / $limit);
            $data['currentPage'] = $currentPage;

            $data['filters'] = $f->getFilters($filters);
            $data['filters_selected'] = $filters;

            $data['searchTerm'] = '';
            $data['category'] = '';

            $data['categories'] = $categories->getList();

            $data['sidebar'] = false;

            $data['social_items'] = [
                                    'url' => ROOT_URL.'marcas/'.$data['brand']['slug'],
                                    'title' => $data['brand']['name'],
                                    'description' => '',
                                    'image' => ''
                                    ];

            $this->loadTemplate('brands', $data);

        } else {

            header("Location: ".ROOT_URL);

        }
    }

}