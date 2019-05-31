<?php

class Products_options extends Model {

    public function setProdOption($id_prod, $id_option, $value) {
        $sql = $this->db->prepare("INSERT INTO products_options (id_product, id_option, p_value) VALUES (:id_prod, :id_option, :value)");
        $sql->bindValue(':id_prod', $id_prod);
        $sql->bindValue(':id_option', $id_option);
        $sql->bindValue(':value', $value);
        $sql->execute();

    }

    public function updateProdOption($id_prod, $id_option, $value) {
        $sql = $this->db->prepare("UPDATE products_options SET p_value = :value WHERE id_product = :id_prod AND id_option = :id_option");
        $sql->bindValue(':id_prod', $id_prod);
        $sql->bindValue(':id_option', $id_option);
        $sql->bindValue(':value', $value);
        $sql->execute();

    }

    public function getProdOptions($id_prod) {

        $data = [];

        $sql = $this->db->prepare("SELECT id_option, p_value FROM products_options WHERE id_product = :id_prod");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->bindValue(':id_prod', $id_prod);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
        }

        return $data;

    }

    public function delProdOptions($id_product, $id_option) {

        $sql = $this->db->prepare("DELETE FROM products_options WHERE id_product = :id_product AND id_option = :id_option");
        $sql->bindValue(':id_product', $id_product);
        $sql->bindValue(':id_option', $id_option);
        $sql->execute();

    }

    public function getProdOptionsCode($id_prod) {

        $data = [];

        $sql = $this->db->prepare("SELECT id_option FROM products_options WHERE id_product = :id_prod");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->bindValue(':id_prod', $id_prod);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
        }

        return $data;

    }

}
