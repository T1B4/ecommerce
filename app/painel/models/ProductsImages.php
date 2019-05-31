<?php

class ProductsImages extends Model {

    public function insertImages($id_product, $url) {

        $sql = $this->db->prepare("INSERT INTO products_images (id_product, url) VALUES (:id_product, :url)");
        $sql->bindValue(':id_product', $id_product);
        $sql->bindValue(':url', $url);
        $sql->execute();
    }

    public function getFolder($url)
    {
    	$data = [];

    	$sql = $this->db->prepare("SELECT id_product FROM products_images WHERE url = :url");
    	$sql->setFetchMode(PDO::FETCH_ASSOC);
    	$sql->bindValue(':url', $url);
    	$sql->execute();

    	if ($sql->rowCount() > 0) {
    		$end = $sql->fetch();
    		$data = $end;
    	}

    	return $data;
    }

    public function delimgbd($url)
    {
    	$sql = $this->db->prepare("DELETE FROM products_images WHERE url = :url");
    	$sql->bindValue(':url', $url);
    	$sql->execute();
    }

    public function getLastItem($id)
    {
        $data = [];

        $sql = $this->db->prepare("SELECT url FROM products_images WHERE id_product = :id ORDER BY url DESC");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetch();
        }

        return $data;
    }

}
