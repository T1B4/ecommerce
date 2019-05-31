<?php

class blogController extends Controller {

    public function __construct() {
        parent::__construct();

        if (!isset($_SESSION['admin']) && empty($_SESSION['admin'])) {
            header("Location: " . BASE_PAINEL . "admin/login");
            exit;
        }
    }

    public function see_all() {
        $data = [];

        $posts = new Posts();
        $data['posts'] = $posts->getPosts();

        $this->loadTemplate('posts_list', $data);
    }

    public function most_viewed() {
        $data = [];

        $posts = new Posts();
        $data['posts'] = $posts->getMostVisitedPosts();

        $this->loadTemplate('posts_most_viewed', $data);
    }

    public function insert() {
        $img = [];

        $data = [];
        $categorias = new Posts_cat();
        $data['categorias'] = $categorias->getCategories();

        if (isset($_POST['titulo'])) {
            $titulo =filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING, FILTER_SANITIZE_MAGIC_QUOTES);
            $subtitulo =filter_input(INPUT_POST, 'subtitulo', FILTER_SANITIZE_STRING, FILTER_SANITIZE_MAGIC_QUOTES);
            $categoria =filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_NUMBER_INT, FILTER_SANITIZE_MAGIC_QUOTES);
            $texto =filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_STRING, FILTER_SANITIZE_MAGIC_QUOTES);
            $imagens = $_FILES;

            $url = $this->criar_slug($titulo);
            $post_url = strtolower($url . "-" . DATE('Ymd-His'));

            $insert = new Posts();
            $id = $insert->addPost($titulo, $subtitulo, $categoria, $texto, $post_url);

            for ($i = 0; $i < count($imagens['images']['name']); $i++) {
                $img[$i] = ['name' => $imagens['images']['name'][$i], 'type' => $imagens['images']['type'][$i], 'tmp_name' => $imagens['images']['tmp_name'][$i], 'error' => $imagens['images']['error'][$i], 'size' => $imagens['images']['size'][$i]];
            }

            $ref = 1;
            foreach ($img as $image) {
                if (in_array($image['type'], array('image/jpeg', 'image/jpg', 'image/png'))) {
                    if ($image['type'] == 'image/png') {
                        $ext = 'png';
                    } else {
                        $ext = 'jpg';
                    }

                    $name = $id . '-foto0' . $ref . "." . $ext;

                    move_uploaded_file($image['tmp_name'], BASE_BLOG . $name);

                    $larg = 800;
                    $alt = 600;


                    list($larg_orig, $alt_orig) = getimagesize(BASE_BLOG . $name);

                    $ratio = $larg_orig / $alt_orig;

                    if ($larg / $alt > $ratio) {
                        $larg = $alt * $ratio;
                    } else {
                        $alt = $larg / $ratio;
                    }


                    if ($ext == 'jpg') {
                        $old_img = imagecreatefromjpeg(BASE_BLOG . $name);
                    } else {
                        $old_img = imagecreatefrompng(BASE_BLOG . $name);
                    }
                    $new_img = imagecreatetruecolor($larg, $alt);

                    imagecopyresampled($new_img, $old_img, 0, 0, 0, 0, $larg, $alt, $larg_orig, $alt_orig);

                    if ($ext == 'jpg') {
                        imagejpeg($new_img, BASE_BLOG . $name, 80);
                    } else {
                        imagepng($new_img, BASE_BLOG . $name, 9);
                    }

                    $photo = new Posts_img();
                    $i = $photo->insertImages($id, $name);

                    ++$ref;
                }
            }
            header("Location: " . BASE_PAINEL . "blog/see_all");
        }

        $this->loadTemplate('posts_insert', $data);
    }

    public function edit($id)
    {
        $data = [];

        if (!isset($id) || empty($id)) {
            header("Location: " . BASE_PAINEL);
            exit;
        }

        if (isset($_POST['titulo'])) {

            $titulo =filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_STRING, FILTER_SANITIZE_MAGIC_QUOTES);
            $subtitulo =filter_input(INPUT_POST, 'subtitulo', FILTER_SANITIZE_STRING, FILTER_SANITIZE_MAGIC_QUOTES);
            $categoria =filter_input(INPUT_POST, 'categoria', FILTER_SANITIZE_NUMBER_INT, FILTER_SANITIZE_MAGIC_QUOTES);
            $texto =filter_input(INPUT_POST, 'texto', FILTER_SANITIZE_STRING, FILTER_SANITIZE_MAGIC_QUOTES);

            $insert = new Posts();
            $insert->editPost($id, $titulo, $subtitulo, $categoria, $texto);

        }

        $categorias = new Posts_cat();
        $data['categorias'] = $categorias->getCategories();

        $posts = new Posts();
        $data['post'] = $posts->getPostById($id);

        $this->loadTemplate('posts_edit', $data);
    }

    public function del($id)
    {
        $data = [];

        if (!isset($id) || empty($id)) {
            header("Location: " . BASE_PAINEL);
            exit;
        }

        if (isset($id)) {

            $post = new Posts();
            $post->delPost($id);

            $dir = BASE_BLOG;
            $files = scandir($dir);
            foreach ($files as $file) {
                if ($file == '.' || $file == '..') {
                    continue;
                } else {
                    if (substr($file, 0, 2) == $id) {
                        $x = unlink("$dir/$file");
                    }
                }
            }

            $data['mensagem'] = "Produto {$id} removido!";

            header("Location: " . BASE_PAINEL . "blog/see_all");
            exit;

        }

        $this->loadTemplate('posts_list', $data);
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

}
