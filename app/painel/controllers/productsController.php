<?php

class productsController extends Controller {

    public function __construct() {
        parent::__construct();

        if (!isset($_SESSION['admin']) && empty($_SESSION['admin'])) {
            header("Location: " . BASE_PAINEL . "admin/login");
            exit;
        }
    }

    public function insert() {
        $data = [];

        //Instanciando as classes que serão utilizadas no método insert
        $cat = new Categories();
        $brand = new Brands();
        $options = new Options();

        //Seleciona os dados necessários para exibição na página de formulário de inserção
        $data['categories'] = $cat->getList();
        $data['brands'] = $brand->getList();
        $data['options'] = $options->getAllOptions();

        if (isset($_POST['name'])) {

            $products = new Products();
            $prod_op = new Products_options();

            //Recebe os dados enviados pelo formulário via POST e trata todos para utilizar durante o método
            $cat = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_NUMBER_INT);
            $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_NUMBER_INT);
            $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_NUMBER_INT);
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_STRING);
            $desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_STRING);
            $stock = filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_NUMBER_INT);
            $shipping = filter_input(INPUT_POST, 'shipping_days', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_NUMBER_INT);
            $price = floatval(str_replace(',', '.', filter_input(INPUT_POST, 'price', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_STRING)));
            $price_from = floatval(str_replace(',', '.', filter_input(INPUT_POST, 'price_from', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_STRING)));
            $weight = floatval(str_replace(',', '.', filter_input(INPUT_POST, 'weight', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_STRING)));
            $length = floatval(str_replace(',', '.', filter_input(INPUT_POST, 'length', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_NUMBER_INT)));
            $width = floatval(str_replace(',', '.', filter_input(INPUT_POST, 'width', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_NUMBER_INT)));
            $height = floatval(str_replace(',', '.', filter_input(INPUT_POST, 'height', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_NUMBER_INT)));
            $diameter = floatval(str_replace(',', '.', filter_input(INPUT_POST, 'diameter', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_NUMBER_INT)));
            (isset($_POST['featured']))? $featured = $_POST['featured']: $featured = 0;
            (isset($_POST['sale']))? $sale = $_POST['sale']: $sale = 0;
            (isset($_POST['bestseller']))? $bestseller = $_POST['bestseller']: $bestseller = 0;
            (isset($_POST['fretegratis']))? $frete = $_POST['fretegratis']: $frete = 0;

            //Recebe os arquivos de imagens vindos do formulário
            $images = $_FILES;

            //Cria Slug para usar como link e adicionar na base de dados
            $slug = $this->criar_slug($name . '-' . rand(0, 999));

            //Insere o produto na base de dados
            $id = $products->insert($cat, $brand, $code, $name, $desc, $stock, $shipping, $price, $price_from, $rating = 5, $featured, $sale, $bestseller, $new_prod = 0, $weight, $width, $height, $length, $diameter, $slug, $frete);

            //Insere as opções para o produto na tabela products_option
            if (isset($_POST['option']) && !empty($_POST['option'])) {

                foreach ($_POST['option'] as $key => $value) {
                    $id_option = addslashes($key);
                    $p_value = addslashes($value);
                    if (!empty($p_value)) {
                        $prod_op->setProdOption($id, $id_option, $p_value);
                    }
                }

            //Insere as opções para o produto na tabela products
                $f = $prod_op->getProdOptionsCode($id);
                foreach ($f as $op) {
                    $z[] = $op['id_option'];
                }
                $z = implode(',', $z);
                $products->updateOptions($id, $z);
            }

            //Organiza os arquivos enviados pelo formulário.
            for ($i = 0; $i < count($images['images']['name']); $i++) {
                $img[$i] = ['name' => $images['images']['name'][$i], 'type' => $images['images']['type'][$i], 'tmp_name' => $images['images']['tmp_name'][$i], 'error' => $images['images']['error'][$i], 'size' => $images['images']['size'][$i]];
            }

            //Cria o indexador para o nome da pasta caso o produto seja menor que 10
            if ($id < 10) {
                $cc = 0;
            } else {
                $cc = '';
            }

            //Cria a pasta para salvar as imagens do produto no servidos
            $folder = BASE_MEDIA . $cc . $id;

            mkdir($folder, 0777, true);
            mkdir($folder .'/thumbs/', 0777, true);

            chmod($folder, 0777);
            chmod($folder .'/thumbs/', 0777);

            //Configura os dados e insere as imagens na base de dados
            $img_name = $this->criar_slug($name);
            $ref = 1;

            //Percorre o array de imagens, chama o método de redimensionamento e criação e salva no servidor e na base de dados
            foreach ($img as $image) {
                $this->createImages($img_name, $image['type'], $image['tmp_name'], $id, $ref, $folder);
                $ref++;
            }

            $data['mensagem'] = "Produto cadastrado com Sucesso!";
        }

        $this->loadTemplate('prods_insert', $data);
    }

    public function edit($id = '') {

        if (empty($id)) {
            header("Location: " . BASE_PAINEL . "products/see_all");
            exit;
        }

        $data = [];

        $cat = new Categories();
        $brand = new Brands();
        $prods = new Products();
        $foto = new ProductsImages();
        $options = new Options();
        $prod_op = new Products_options();

        $data['categories'] = $cat->getList();
        $data['brands'] = $brand->getList();
        $sys_options = $options->getAllOptions();
        $prod_options = $prod_op->getProdOptions($id);
        $data['prod'] = $prods->getInfo($id);

        foreach ($sys_options as $option) {
            foreach ($prod_options as $op) {
                if ($option['id'] == $op['id_option']) {
                    $data['options'][$option['id']] = ['id'=>$option['id'], 'name'=>$option['name'], 'valor'=>$op['p_value']];
                    break;
                }else{
                    $data['options'][$option['id']] = ['id'=>$option['id'], 'name'=>$option['name']];
                }
            }
        }

        if (isset($_POST['name'])) {

            $cat = new Categories();
            $brand = new Brands();
            $prods = new Products();
            $foto = new ProductsImages();
            $options = new Options();
            $prod_op = new Products_options();

            $data['categories'] = $cat->getList();
            $data['brands'] = $brand->getList();
            $sys_options = $options->getAllOptions();
            $prod_options = $prod_op->getProdOptions($id);
            $data['prod'] = $prods->getInfo($id);

            foreach ($sys_options as $option) {
                foreach ($prod_options as $op) {
                    if ($option['id'] == $op['id_option']) {
                        $data['options'][$option['id']] = ['id'=>$option['id'], 'name'=>$option['name'], 'valor'=>$op['p_value']];
                        break;
                    }else{
                        $data['options'][$option['id']] = ['id'=>$option['id'], 'name'=>$option['name']];
                    }
                }
            }

            $cat = filter_input(INPUT_POST, 'category', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_NUMBER_INT);
            $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_NUMBER_INT);
            $code = filter_input(INPUT_POST, 'code', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_NUMBER_INT);
            $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_STRING);
            $desc = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_STRING);
            $stock = filter_input(INPUT_POST, 'stock', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_NUMBER_INT);
            $shipping = filter_input(INPUT_POST, 'shipping_days', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_NUMBER_INT);
            $price = floatval(str_replace(',', '.', filter_input(INPUT_POST, 'price', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_STRING)));
            $price_from = floatval(str_replace(',', '.', filter_input(INPUT_POST, 'price_from', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_STRING)));
            $weight = floatval(str_replace(',', '.', filter_input(INPUT_POST, 'weight', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_STRING)));
            $length = floatval(str_replace(',', '.', filter_input(INPUT_POST, 'length', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_NUMBER_INT)));
            $width = floatval(str_replace(',', '.', filter_input(INPUT_POST, 'width', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_NUMBER_INT)));
            $height = floatval(str_replace(',', '.', filter_input(INPUT_POST, 'height', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_NUMBER_INT)));
            $diameter = floatval(str_replace(',', '.', filter_input(INPUT_POST, 'diameter', FILTER_SANITIZE_MAGIC_QUOTES, FILTER_SANITIZE_NUMBER_INT)));

            (isset($_POST['featured']))? $featured = $_POST['featured']: $featured = 0;
            (isset($_POST['sale']))? $sale = $_POST['sale']: $sale = 0;
            (isset($_POST['bestseller']))? $bestseller = $_POST['bestseller']: $bestseller = 0;
            (isset($_POST['fretegratis']))? $frete = $_POST['fretegratis']: $frete = 0;

            $prods->update($cat, $brand, $code, $name, $desc, $stock, $shipping, $price, $price_from, $rating = 5, $featured, $sale, $bestseller, $new_prod = 0, $weight, $width, $height, $length, $diameter, $id, $frete);

            //Insere as opções para o produto na tabela products_option
            if (isset($_POST['option']) && !empty($_POST['option'])) {

                $options = $_POST['option'];

                foreach ($options as $key => $value) {
                    $id_option = addslashes($key);
                    $p_value = addslashes($value);

                    $x = $prod_op->getProdOptions($id);
                    $ids = array_column($x, 'id_option');

                    if (!empty($p_value) && isset($p_value)) {
                        if (in_array($id_option, $ids)) {
                            $prod_op->updateProdOption($id, $id_option, $p_value);
                        } else {
                            $prod_op->setProdOption($id, $id_option, $p_value);
                        }
                    } elseif (in_array($id_option, $ids)) {
                        $prod_op->delProdOptions($id, $id_option);
                    }
                }

            //Insere as opções para o produto na tabela products
                $f = $prod_op->getProdOptionsCode($id);
                foreach ($f as $op) {
                    $z[] = implode(',', $op);
                }

                $z = implode(',', $z);
                $prods->updateOptions($id, $z);
            }
            
            if (!empty($_FILES['images']['name'][0])) {
            

            // ENVIA NOVAS IMAGENS AO SISTEMA

                $images = $_FILES;

            //Organiza os arquivos enviados pelo formulário para redimensionamento e salva no banco de dados e na pasta.
                for ($i = 0; $i < count($images['images']['name']); $i++) {
                    $img[$i] = ['name' => $images['images']['name'][$i], 'type' => $images['images']['type'][$i], 'tmp_name' => $images['images']['tmp_name'][$i], 'error' => $images['images']['error'][$i], 'size' => $images['images']['size'][$i]];
                }

            //Cria nome da imagem, executa o método que cria e redimensiona as imagens e salva no banco de dados e na pasta correta.

                if ($id < 10) {
                    $cc = 0;
                } else {
                    $cc = '';
                }

                $li = $foto->getLastItem($id);

                $li = substr($li['url'], -6, 2) + 1;

                if (empty($li)) {
                    $li = 1;
                }


                $folder = BASE_MEDIA . $cc . $id;

                $img_name = $this->criar_slug($name);
                $ref = $li;
                foreach ($img as $image) {
                    $this->createImages($img_name, $image['type'], $image['tmp_name'], $id, $ref, $folder);
                    $ref++;
                }
            }

            $cat = new Categories();
            $brand = new Brands();
            $prods = new Products();
            $foto = new ProductsImages();
            $options = new Options();
            $prod_op = new Products_options();

            $data['categories'] = $cat->getList();
            $data['brands'] = $brand->getList();
            $sys_options = $options->getAllOptions();
            $prod_options = $prod_op->getProdOptions($id);
            $data['prod'] = $prods->getInfo($id);

            foreach ($sys_options as $option) {
                foreach ($prod_options as $op) {
                    if ($option['id'] == $op['id_option']) {
                        $data['options'][$option['id']] = ['id'=>$option['id'], 'name'=>$option['name'], 'valor'=>$op['p_value']];
                        break;
                    }else{
                        $data['options'][$option['id']] = ['id'=>$option['id'], 'name'=>$option['name']];
                    }
                }
            }


            $data['mensagem'] = "Produto {$id} editado com Sucesso!";
        }

        $this->loadTemplate('prods_edit', $data);
    }

    public function del($id) {
        $data = [];

        (intval($id) < 10)? $cc = 0: $cc = '' ;

        if (isset($id) && !empty($id)) {
            $prods = new Products();
            $prods->del($id);
            $dir = BASE_MEDIA . $cc . $id;
            $files = scandir($dir);
            foreach ($files as $file) {
                if ($file == '.' || $file == '..') {
                    continue;
                } else {
                    $x = unlink("$dir/$file");
                }
            }
            rmdir($dir);

            header("Location: " . BASE_PAINEL . "products/see_all");

        }

    }

    public function delimage($url)
    {
        $data = [];

        $img = new ProductsImages();
        $id = $img->getFolder($url);

        (intval($id['id_product']) < 10)? $cc = 0: $cc = '' ;

        if (isset($url) && !empty($url)) {
            $img->delimgbd($url);
            $dir = BASE_MEDIA . $cc . $id['id_product'];
            $files = scandir($dir);
            foreach ($files as $file) {
                if ($file == '.' || $file == '..') {
                    continue;
                } else {
                    if ($file == $url) {
                        $x = unlink("$dir/$file");
                        $img->delimgbd($url);
                    }
                }
            }

            header("Location: " . BASE_PAINEL . "products/edit/" . $id['id_product']);

        }
    }

    public function insert_option() {
        $data = [];
        $op = new Options();

        if (isset($_POST['option']) && !empty($_POST['option'])) {
            $name = filter_input(INPUT_POST, 'option', FILTER_SANITIZE_STRING);

            $op->setOption($name);

            $data['mensagem'] = "Opção cadastrada com sucesso";
        }

        $this->loadTemplate('prods_option', $data);
    }

    public function see_all() {
        $data = [];

        $products = new Products();

        $currentPage = 1;
        $offset = 0;
        $limit = 10;

        if (!empty($_GET['p'])) {
            $currentPage = $_GET['p'];
        }

        $offset = ($currentPage * $limit) - $limit;

        $data['prods'] = $products->getFullList($offset, $limit);
        $data['totalItems'] = $products->getTotal();
        $data['numberOfPages'] = ceil($data['totalItems'] / $limit);
        $data['currentPage'] = $currentPage;

        $this->loadTemplate('prods_list', $data);
    }

    public function list_stock()
    {
        $data = [];

        $products = new Products();

        $data['prods'] = $products->getStockList();

        $this->loadTemplate('relatorio_produtos', $data);
    }

    public function search()
    {

        $data = [];

        $products = new Products();

        $currentPage = 1;
        $offset = 0;
        $limit = 10;

        if (!empty($_GET['p'])) {
            $currentPage = $_GET['p'];
        }

        if(!empty($_GET['s'])) {
            $searchTerm = $_GET['s'];
        }

        $filters['searchTerm'] = $searchTerm;

        $offset = ($currentPage * $limit) - $limit;

        $data['prods'] = $products->getFullList($offset, $limit, $filters);
        $data['totalItems'] = $products->getTotal($filters);
        $data['numberOfPages'] = ceil($data['totalItems'] / $limit);
        $data['currentPage'] = $currentPage;

        $this->loadTemplate('prods_search', $data);
    }

    public function pause($id)
    {

        $data = [];

        $products = new Products();
        $status = $products->getProdStatus($id);

        if ($status['status'] == 0) {
            $products->setProdStatus($id, 1);
        } else  {
            $products->setProdStatus($id, 0);
        }

        header("Location: " . BASE_PAINEL . "products/see_all");

    }

    public function stock() {
        $data = [];

        $products = new Products();

        if (isset($_POST['id'])) {
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT, FILTER_SANITIZE_MAGIC_QUOTES);
            $qtde = filter_input(INPUT_POST, 'qtde', FILTER_SANITIZE_NUMBER_INT, FILTER_SANITIZE_MAGIC_QUOTES);

            $products->updateStock($id, $qtde);
            $data['mensagem'] = "Estoque do produto {$id} atualizado com sucesso!";
        }

        $currentPage = 1;
        $offset = 0;
        $limit = 10;

        if (!empty($_GET['p'])) {
            $currentPage = $_GET['p'];
        }

        $offset = ($currentPage * $limit) - $limit;

        $data['prods'] = $products->getFullList($offset, $limit);
        $data['totalItems'] = $products->getTotal();
        $data['numberOfPages'] = ceil($data['totalItems'] / $limit);
        $data['currentPage'] = $currentPage;

        $this->loadTemplate('prods_stock', $data);
    }

    function criar_slug($text) {

        $replace = [
            '&lt;' => '', '&gt;' => '', '&#039;' => '', '&amp;' => '',
            '&quot;' => '', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'Ae',
            '&Auml;' => 'A', 'Å' => 'A', 'Ā' => 'A', 'Ą' => 'A', 'Ă' => 'A', 'Æ' => 'Ae',
            'Ç' => 'C', 'Ć' => 'C', 'Č' => 'C', 'Ĉ' => 'C', 'Ċ' => 'C', 'Ď' => 'D', 'Đ' => 'D',
            'Ð' => 'D', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ē' => 'E',
            'Ę' => 'E', 'Ě' => 'E', 'Ĕ' => 'E', 'Ė' => 'E', 'Ĝ' => 'G', 'Ğ' => 'G',
            'Ġ' => 'G', 'Ģ' => 'G', 'Ĥ' => 'H', 'Ħ' => 'H', 'Ì' => 'I', 'Í' => 'I',
            'Î' => 'I', 'Ï' => 'I', 'Ī' => 'I', 'Ĩ' => 'I', 'Ĭ' => 'I', 'Į' => 'I',
            'İ' => 'I', 'Ĳ' => 'IJ', 'Ĵ' => 'J', 'Ķ' => 'K', 'Ł' => 'K', 'Ľ' => 'K',
            'Ĺ' => 'K', 'Ļ' => 'K', 'Ŀ' => 'K', 'Ñ' => 'N', 'Ń' => 'N', 'Ň' => 'N',
            'Ņ' => 'N', 'Ŋ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O',
            'Ö' => 'Oe', '&Ouml;' => 'Oe', 'Ø' => 'O', 'Ō' => 'O', 'Ő' => 'O', 'Ŏ' => 'O',
            'Œ' => 'OE', 'Ŕ' => 'R', 'Ř' => 'R', 'Ŗ' => 'R', 'Ś' => 'S', 'Š' => 'S',
            'Ş' => 'S', 'Ŝ' => 'S', 'Ș' => 'S', 'Ť' => 'T', 'Ţ' => 'T', 'Ŧ' => 'T',
            'Ț' => 'T', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'Ue', 'Ū' => 'U',
            '&Uuml;' => 'Ue', 'Ů' => 'U', 'Ű' => 'U', 'Ŭ' => 'U', 'Ũ' => 'U', 'Ų' => 'U',
            'Ŵ' => 'W', 'Ý' => 'Y', 'Ŷ' => 'Y', 'Ÿ' => 'Y', 'Ź' => 'Z', 'Ž' => 'Z',
            'Ż' => 'Z', 'Þ' => 'T', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
            'ä' => 'ae', '&auml;' => 'ae', 'å' => 'a', 'ā' => 'a', 'ą' => 'a', 'ă' => 'a',
            'æ' => 'ae', 'ç' => 'c', 'ć' => 'c', 'č' => 'c', 'ĉ' => 'c', 'ċ' => 'c',
            'ď' => 'd', 'đ' => 'd', 'ð' => 'd', 'è' => 'e', 'é' => 'e', 'ê' => 'e',
            'ë' => 'e', 'ē' => 'e', 'ę' => 'e', 'ě' => 'e', 'ĕ' => 'e', 'ė' => 'e',
            'ƒ' => 'f', 'ĝ' => 'g', 'ğ' => 'g', 'ġ' => 'g', 'ģ' => 'g', 'ĥ' => 'h',
            'ħ' => 'h', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'ī' => 'i',
            'ĩ' => 'i', 'ĭ' => 'i', 'į' => 'i', 'ı' => 'i', 'ĳ' => 'ij', 'ĵ' => 'j',
            'ķ' => 'k', 'ĸ' => 'k', 'ł' => 'l', 'ľ' => 'l', 'ĺ' => 'l', 'ļ' => 'l',
            'ŀ' => 'l', 'ñ' => 'n', 'ń' => 'n', 'ň' => 'n', 'ņ' => 'n', 'ŉ' => 'n',
            'ŋ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'oe',
            '&ouml;' => 'oe', 'ø' => 'o', 'ō' => 'o', 'ő' => 'o', 'ŏ' => 'o', 'œ' => 'oe',
            'ŕ' => 'r', 'ř' => 'r', 'ŗ' => 'r', 'š' => 's', 'ù' => 'u', 'ú' => 'u',
            'û' => 'u', 'ü' => 'ue', 'ū' => 'u', '&uuml;' => 'ue', 'ů' => 'u', 'ű' => 'u',
            'ŭ' => 'u', 'ũ' => 'u', 'ų' => 'u', 'ŵ' => 'w', 'ý' => 'y', 'ÿ' => 'y',
            'ŷ' => 'y', 'ž' => 'z', 'ż' => 'z', 'ź' => 'z', 'þ' => 't', 'ß' => 'ss',
            'ſ' => 'ss', 'ый' => 'iy', 'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G',
            'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Ж' => 'ZH', 'З' => 'Z', 'И' => 'I',
            'Й' => 'Y', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
            'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F',
            'Х' => 'H', 'Ц' => 'C', 'Ч' => 'CH', 'Ш' => 'SH', 'Щ' => 'SCH', 'Ъ' => '',
            'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA', 'а' => 'a',
            'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo',
            'ж' => 'zh', 'з' => 'z', 'и' => 'i', 'й' => 'y', 'к' => 'k', 'л' => 'l',
            'м' => 'm', 'н' => 'n', 'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's',
            'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c', 'ч' => 'ch',
            'ш' => 'sh', 'щ' => 'sch', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e',
            'ю' => 'yu', 'я' => 'ya'
        ];

        $text = strtr($text, $replace);
        $text = preg_replace('~[^\\pL\d.]+~u', '-', $text);
        $text = trim($text, '-');
        $text = preg_replace('~[^-\w.]+~', '', $text);
        $text = strtolower($text);

        return $text;
    }

    public function createImages($name, $type, $tmp_name, $id, $ref, $folder) {
        $larg = 800;
        $thumb_larg = 300;
        $alt = 600;
        $thumb_alt = 200;

        if ($type == 'image/png') {
            $ext = 'png';
        } else {
            $ext = 'jpg';
        }

        if ($ref < 10) {
            $cc = 0;
        } else {
            $cc = '';
        }

        $name = $name . '-foto' . $cc . $ref . "." . $ext;

        move_uploaded_file($tmp_name, $folder . '/' . $name);

        list($larg_orig, $alt_orig) = getimagesize($folder . '/' . $name);

        $ratio = $larg_orig / $alt_orig;

        if ($larg / $alt > $ratio) {
            $larg = $alt * $ratio;
            $thumb_larg = $thumb_alt * $ratio;
        } else {
            $alt = $larg / $ratio;
            $thumb_alt = $thumb_larg / $ratio;
        }

        if ($ext == 'jpg') {
            $old_img = imagecreatefromjpeg($folder . '/' . $name);
        } else {
            $old_img = imagecreatefrompng($folder . '/' . $name);
        }
        $new_img = imagecreatetruecolor($larg, $alt);
        $new_thumb = imagecreatetruecolor($thumb_larg, $thumb_alt);

        imagecopyresampled($new_img, $old_img, 0, 0, 0, 0, $larg, $alt, $larg_orig, $alt_orig);
        imagecopyresampled($new_thumb, $old_img, 0, 0, 0, 0, $thumb_larg, $thumb_alt, $larg_orig, $alt_orig);

        if ($ext == 'jpg') {
            imagejpeg($new_img, $folder . '/' . $name, 80);
            imagejpeg($new_thumb, $folder . '/thumbs/' . $name, 80);
        } else {
            imagepng($new_img, $folder . '/' . $name, 9);
            imagepng($new_thumb, $folder . '/thumbs/' . $name, 9);
        }

        $ins = new ProductsImages();
        $ins->insertImages($id, $name);
    }

}
