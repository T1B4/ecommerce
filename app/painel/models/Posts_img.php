<?php

class Posts_img extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getImgs($id) {
        $data = [];

        $sql = $this->db->prepare("SELECT post_img_url FROM posts_img WHERE post_img_post = :id");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
        }

        return $data;
    }

    public function insertImages($id, $url) {
        $sql = $this->db->prepare("INSERT INTO posts_img (post_img_post, post_img_url) VALUES (:id, :url)");
        $sql->bindValue(':id', $id);
        $sql->bindValue(':url', $url);
        $sql->execute();
    }

    public function delImgs($id)
    {
        $sql = $this->db->prepare("DELETE FROM posts_img WHERE post_img_post = :id");
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

}
