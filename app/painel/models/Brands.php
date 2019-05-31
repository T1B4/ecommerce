<?php

class Brands extends Model {

    public function getList() {
        $array = array();

        $sql = "SELECT * FROM brands";
        $sql = $this->db->query($sql);

        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll();
        }

        return $array;
    }

    public function getNameById($id) {

        $sql = "SELECT name FROM brands WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetch();

            return $data['name'];
        } else {
            return '';
        }
    }

    public function getBrand($id) {

        $sql = "SELECT * FROM brands WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetch();
        }

        return $data;
    }

    public function insert($name, $telefone, $celular, $email, $address, $slug)
    {

        $sql = $this->db->prepare("INSERT INTO brands (name, telefone, celular, email, address, slug) VALUES (:name, :telefone, :celular, :email, :address, :slug)");
        $sql->bindValue(':name', $name);
        $sql->bindValue(':telefone', $telefone);
        $sql->bindValue(':celular', $celular);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':address', $address);
        $sql->bindValue(':slug', $slug);
        $sql->execute();
    }

    public function update($name, $telefone, $celular, $email, $address, $id, $slug)
    {

        $sql = $this->db->prepare("UPDATE brands SET name = :name, telefone = :telefone, celular = :celular, email = :email, address = :address, slug = :slug WHERE id = :id");
        $sql->bindValue(':name', $name);
        $sql->bindValue(':telefone', $telefone);
        $sql->bindValue(':celular', $celular);
        $sql->bindValue(':email', $email);
        $sql->bindValue(':address', $address);
        $sql->bindValue(':slug', $slug);
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

}
