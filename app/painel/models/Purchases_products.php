<?php

class Purchases_products extends Model {

	public function __construct()
	{
		parent::__construct();
	}

	public function getSalesProds($id)
	{
		$data = [];
		$sql = $this->db->prepare("SELECT * FROM purchases_products WHERE id_purchase = :id");
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		$sql->bindValue(':id', $id);
		$sql->execute();
		if ($sql->rowCount() > 0) {
			$data = $sql->fetchAll();
			$item = new Products();
			foreach ($data as $key => $value) {
				$data[$key]['prod_details'] = $item->getInfo($value['id_product']);
			}
		}
		return $data;
	}

}