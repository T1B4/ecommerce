<?php

class Posts_cat extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getCategories() {
        $data = [];

        $sql = $this->db->prepare("SELECT * FROM posts_cat ORDER BY post_cat_nome ASC");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
        }

        return $data;
    }

}
