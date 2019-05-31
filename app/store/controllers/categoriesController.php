<?php
class categoriesController extends Controller {

	private $user;

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        header("Location: ".ROOT_URL);
    }

    public function categories($slug) {
        $store = new Store();
        $products = new Products();
        $categories = new Categories();
        $f = new Filters();

        $data = $store->getTemplateData();

        $data['category_name'] = $categories->getCategoryName($slug);

        $data['page_title'] = $data['category_name'];

        if(!empty($data['category_name'])) {
            $currentPage = 1;
            $offset = 0;
            $limit = 20;

            if(!empty($_GET['p'])) {
                $currentPage = $_GET['p'];
            }

            $cat = $categories->getCategory($slug);

            $offset = ($currentPage * $limit) - $limit;

            $filters = array('categories'=>$cat['id']);

            $data['category_filter'] = $categories->getCategoryTree($cat['id']);

            $data['list'] = $products->getList($offset, $limit, $filters);
            $data['totalItems'] = $products->getTotal($filters);
            $data['numberOfPages'] = ceil($data['totalItems'] / $limit);
            $data['currentPage'] = $currentPage;

            $data['id_category'] = $cat['id'];
            $data['slug'] = $cat['slug'];

            $data['filters'] = $f->getFilters($filters);
            $data['filters_selected'] = $filters;

            $data['searchTerm'] = '';
            $data['category'] = '';

            $data['categories'] = $categories->getList();


            $data['social_items'] = [
                                    'url' => ROOT_URL.'categorias/'.$slug,
                                    'title' => $cat['name'],
                                    'description' => $cat['description'],
                                    'image' => BASE_URL . 'media/categories/' . $cat['img']
                                    ];

            $this->loadTemplate('categories', $data);

        } else {

            header("Location: ".ROOT_URL);

        }
    }


    public function category($slug) {
        $store = new Store();
        $products = new Products();
        $categories = new Categories();
        $f = new Filters();

        $data = $store->getTemplateData();

        $data['category_name'] = $categories->getCategoryName($slug);

        $data['page_title'] = $data['category_name'];

        if(!empty($data['category_name'])) {
            $currentPage = 1;
            $offset = 0;
            $limit = 20;

            if(!empty($_GET['p'])) {
                $currentPage = $_GET['p'];
            }

            $cat = $categories->getCategory($slug);

            $offset = ($currentPage * $limit) - $limit;

            $filters = array('category'=>$cat['id']);

            $data['category_filter'] = $categories->getCategoryTree($cat['id']);

            $data['list'] = $products->getList($offset, $limit, $filters);
            $data['totalItems'] = $products->getTotal($filters);
            $data['numberOfPages'] = ceil($data['totalItems'] / $limit);
            $data['currentPage'] = $currentPage;

            $data['id_category'] = $cat['id'];
            $data['slug'] = $cat['slug'];

            $data['filters'] = $f->getFilters($filters);
            $data['filters_selected'] = $filters;

            $data['searchTerm'] = '';
            $data['category'] = '';

            $data['categories'] = $categories->getList();


            $data['social_items'] = [
                                    'url' => ROOT_URL.'categorias/'.$slug,
                                    'title' => $cat['name'],
                                    'description' => $cat['description'],
                                    'image' => BASE_URL . 'media/categories/' . $cat['img']
                                    ];

            $this->loadTemplate('categories', $data);

        } else {

            header("Location: ".ROOT_URL);

        }
    }


}