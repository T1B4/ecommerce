<?php

class Users extends Model {

    public function emailExists($email) {

        $sql = "SELECT * FROM users WHERE email = :email";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function validate($email, $pass) {
        $uid = '';

        $sql = "SELECT * FROM users WHERE email = :email AND password = :pass";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":pass", $pass);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            $uid = $sql['id'];
        }

        return $uid;
    }

    public function createUser($email, $pass) {

        $sql = "INSERT INTO users (email, password) VALUES (:email, :pass)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":email", $email);
        $sql->bindValue(":pass", $pass);
        $sql->execute();

        return $this->db->lastInsertId();
    }

    public function getuser($id)
    {

        $data = [];

        $sql = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->bindValue(':id', $id);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $data = $sql->fetch();
        }

        return $data;
    }

    public function getList()
    {

        $data = [];

        $sql = $this->db->prepare("SELECT * FROM users");
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
        FROM users";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        $sql = $sql->fetch();

        return $sql['c'];
    }

}
