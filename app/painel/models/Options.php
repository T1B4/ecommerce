<?php

class Options extends Model {

    public function getName($id) {
        $sql = "SELECT name FROM options WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            return $sql['name'];
        }
    }

    public function setOption($name) {
        $sql = $this->db->prepare("INSERT INTO options (name) VALUES (:name)");
        $sql->bindValue(':name', $name);
        $sql->execute();
    }

    public function getAllOptions() {
        $data = [];

        $sql = $this->db->prepare("SELECT * FROM options");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();

        }

        return $data;
    }

}
