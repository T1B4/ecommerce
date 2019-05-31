<?php

class Newsletter extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function setUser($email, $nome) {
        $data = [];

        $sql = $this->db->prepare("INSERT INTO newsletter (news_email, news_nome) VALUES(:email, :nome)");
        $sql->bindValue(':email', $email);
        $sql->bindValue(':nome', $nome);
        $sql->execute();
    }

    public function getUsers() {
        $data = [];

        $sql = $this->db->prepare("SELECT * FROM newsletter LIMIT 5");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
        }

        return $data;
    }

    public function getAllUsers() {
        $data = [];

        $sql = $this->db->prepare("SELECT * FROM newsletter");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
        }

        return $data;
    }

    public function getTotal() {

        $sql = "SELECT
        COUNT(*) as c
        FROM newsletter";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        $sql = $sql->fetch();

        return $sql['c'];
    }

}
