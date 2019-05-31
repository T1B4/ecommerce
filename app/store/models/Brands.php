<?php
class Brands extends Model {

	public function getList() {
		$array = array();

		$sql = "SELECT * FROM brands ORDER BY RAND() LIMIT 4 ";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			$array = $sql->fetchAll();
		}

		return $array;
	}

	public function getNameById($id) {

		$sql = "SELECT name FROM brands WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$data = $sql->fetch();

			return $data['name'];
		} else {
			return '';
		}

	}

	public function getBrand($slug) {

		$sql = "SELECT * FROM brands WHERE slug = :slug";
		$sql = $this->db->prepare($sql);
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		$sql->bindValue(":slug", $slug);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$data = $sql->fetch();

			return $data;
		}
	}

}