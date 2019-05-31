<?php
class Categories extends Model {

	public function getList() {
		$array = array();

		$sql = "SELECT * FROM categories ORDER BY sub DESC";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0) {
			foreach($sql->fetchAll() as $item) {
				$item['subs'] = array();
				$array[$item['id']] = $item;
			}

			while($this->stillNeed($array)) {
				$this->organizeCategory($array);
			}

		}

		return $array;
	}

	public function getCategory($slug) {

		$data = [];

		$sql = $this->db->prepare("SELECT * FROM categories WHERE slug = :slug");
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		$sql->bindValue(':slug', $slug);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$data = $sql->fetch();
		}

		return $data;

	}

	public function getMasterCategory($id) {
		$data = [];

		$sql = $this->sql->prepare("SELECT * FROM categories WHERE id = :id");
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		$sql->bindValue(':id', $id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$data = $sql->fetch();
		}
	}

	public function getCategoryTree($id) {
		$array = array();

		$haveChild = true;

		while($haveChild) {

			$sql = "SELECT * FROM categories WHERE id = :id";
			$sql = $this->db->prepare($sql);
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			$sql->bindValue(":id", $id);
			$sql->execute();
			if($sql->rowCount() > 0) {
				$sql = $sql->fetch();
				$array[] = $sql;

				if(!empty($sql['sub'])) {
					$id = $sql['sub'];
				} else {
					$haveChild = false;
				}
			}

		}

		$array = array_reverse($array);

		return $array;
	}

	public function getCategoryRelationship($id)
	{

		$data = [];
		$result = [];

		$sql = $this->db->prepare("SELECT id FROM categories WHERE sub = :sub");
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		$sql->bindValue(':sub', $id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$result = $sql->fetchAll();

			foreach ($result as $item) {
				$data[] = $item['id'];
			}
		} else {

			$sql = $this->db->prepare("SELECT * FROM categories WHERE id = :id");
			$sql->setFetchMode(PDO::FETCH_ASSOC);
			$sql->bindValue(':id', $id);
			$sql->execute();

			if ($sql->rowCount() > 0) {
				$data = $sql->fetch();
			}
		}

		return $data;
	}

	public function getCategoryName($slug) {
		$sql = "SELECT name FROM categories WHERE slug = :slug";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":slug", $slug);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			return $sql['name'];
		}
	}

	private function organizeCategory(&$array) {
		foreach($array as $id => $item) {
			if(isset($item['sub'])) {
				$array[$item['sub']]['subs'][$item['id']] = $item;
				unset($array[$id]);
				break;
			}
		}
	}

	private function stillNeed($array) {
		foreach($array as $item) {
			if(!empty($item['sub'])) {
				return true;
			}
		}

		return false;
	}















}