<?php

class Admin extends Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function validate($user, $pass)
	{
		$uid = '';

        $sql = "SELECT * FROM admin WHERE user = :user AND senha = :pass";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":user", $user);
        $sql->bindValue(":pass", $pass);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            $uid = $sql['id'];
        }

        return $uid;
        
	}

	public function userExists($user) {

        $sql = "SELECT * FROM admin WHERE user = :user";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":user", $user);
        $sql->execute();

        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }
}