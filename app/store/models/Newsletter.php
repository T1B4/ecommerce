<?php

class Newsletter extends Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function setUser($email)
	{
		$data = [];

		$sql = $this->db->prepare("INSERT INTO newsletter (news_email) VALUES(:email)");
		$sql->bindValue(':email', $email);
		$sql->execute();
	}

	public function getUsers()
	{
		$data = [];

		$sql = $this->db->prepare("SELECT * FROM newsletter LIMIT 5");
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$data = $sql->fetchAll();
		}

		return $data;
	}

	public function getAllUsers()
	{
		$data = [];

		$sql = $this->db->prepare("SELECT * FROM newsletter");
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$data = $sql->fetchAll();
		}

		return $data;
	}
}