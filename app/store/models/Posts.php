<?php
/**
 * Created by PhpStorm.
 * User: tiburcio
 * Date: 09/10/17
 * Time: 09:37
 */

class Posts extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function addPost($titulo, $subtitulo, $cat, $texto, $url)
    {

        $sql = $this->db->prepare("INSERT INTO posts (post_titulo, post_subtitulo, post_cat, post_texto, post_url) VALUES (:titulo, :subtitulo, :cat, :texto, :url)");
        $sql->bindValue(':titulo', $titulo);
        $sql->bindValue(':subtitulo', $subtitulo);
        $sql->bindValue(':cat', $cat);
        $sql->bindValue(':texto', $texto);
        $sql->bindValue(':url', $url);
        $sql->execute();
        return $this->db->lastInsertId();

    }


    public function getPosts()
    {
        $data = [];

        $sql = $this->db->prepare("SELECT * FROM posts");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
            $img = new Posts_img();
            foreach ($data as $post => $item) {
                $data[$post]['imgs'] = $img->getImgs($item['post_id']);
            }
        }

        return $data;
    }

    public function getPost($url)
    {
        $data = [];

        $sql = $this->db->prepare("SELECT * FROM posts WHERE post_url = :url");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->bindValue(':url', $url);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetch();
            $img = new Posts_img();
            $data['imgs'] = $img->getImgs($data['post_id']);

        }

        return $data;
    }

    public function getPostByCat($id)
    {
        $data = [];

        $sql = $this->db->prepare("SELECT posts.*, posts_cat.post_cat_nome FROM posts INNER JOIN posts_cat ON (posts.post_cat = posts_cat.post_cat_id) WHERE post_cat_id = :id");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
            $img = new Posts_img();
            foreach ($data as $post => $item) {
                $data[$post]['imgs'] = $img->getImgs($item['post_id']);
            }
        }

        return $data;
    }

    public function getPostCatName($id)
    {

        $data = [];

        $sql = $this->db->prepare("SELECT post_cat_nome FROM posts_cat WHERE post_cat_id = :id");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->bindValue(':id', $id);
        $sql->execute();
        $data = $sql->fetch();

        return $data;
    }

    public function getLastPosts()
    {
        $data = [];

        $sql = $this->db->prepare("SELECT * FROM posts ORDER BY post_data DESC LIMIT 10");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
            $img = new Posts_img();
            foreach ($data as $post => $item) {
                $data[$post]['imgs'] = $img->getImgs($item['post_id']);
            }
        }

        return $data;
    }

    public function getLastPost()
    {
        $data = [];

        $sql = $this->db->prepare("SELECT * FROM posts ORDER BY post_data DESC LIMIT 1");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
            $img = new Posts_img();
            foreach ($data as $post => $item) {
                $data[$post]['imgs'] = $img->getImgs($item['post_id']);
            }
        }

        return $data;
    }

    public function getMostVisitedPosts()
    {
        $data = [];

        $sql = $this->db->prepare("SELECT * FROM posts WHERE post_visitas > 0 ORDER BY post_visitas DESC LIMIT 10");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
            $img = new Posts_img();
            foreach ($data as $post => $item) {
                $data[$post]['imgs'] = $img->getImgs($item['post_id']);
            }
        }

        return $data;
    }

    public function getBusca($termo)
    {
        $data = [];

        $sql = $this->db->prepare("SELECT * FROM posts WHERE post_titulo LIKE '%$termo%' OR post_subtitulo LIKE '%$termo%'");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
            $img = new Posts_img();
            foreach ($data as $post => $item) {
                $data[$post]['imgs'] = $img->getImgs($item['post_id']);
            }
        }

        return $data;
    }

    public function setVisita($id)
    {
        $sql = $this->db->prepare("UPDATE posts SET post_visitas = post_visitas + 1 WHERE post_id = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

}















