<?php
class Purchases extends Model {

	public function createPurchase($uid, $total, $payment_type, $address, $shipping_type, $cpf) {

		$sql = "INSERT INTO purchases (id_user, total_amount, payment_type, payment_status, shipping_address, shipping_type, cpf) VALUES (:uid, :total, :type, 1, :address, :shipping_type, :cpf)";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":uid", $uid);
		$sql->bindValue(":total", $total);
		$sql->bindValue(":type", $payment_type);
		$sql->bindValue(":address", $address);
		$sql->bindValue(":shipping_type", $shipping_type);
		$sql->bindValue(":cpf", $cpf);
		$sql->execute();

		// return $this->db->lastInsertId();
		return true;

	}

	public function addItem($id, $id_product, $qt, $price) {

		$sql = "INSERT INTO purchases_products (id_purchase, id_product, quantity, product_price) VALUES (:id, :idp, :qt, :price)";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->bindValue(":idp", $id_product);
		$sql->bindValue(":qt", $qt);
		$sql->bindValue(":price", $price);
		$sql->execute();

		return true;

	}

	public function setPaid($id) {

		$sql = "UPDATE purchases SET payment_status = :status WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":status", '3');
		$sql->bindValue(":id", $id);
		$sql->execute();

	}

	public function setCancelled($id) {

		$sql = "UPDATE purchases SET payment_status = :status WHERE id = :id";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":status", '7');
		$sql->bindValue(":id", $id);
		$sql->execute();

	}

	public function getPurchases($id)
	{
		$purchases = [];
        $sql = $this->db->prepare("SELECT purchases.*, users.name as user_name, users.email as user_email FROM purchases LEFT JOIN users ON (users.id = purchases.id_user) WHERE id_user = :id");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->bindValue(':id', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $purchases = $sql->fetchAll();
            $pp = new Purchases_products();
            foreach ($purchases as $key => $value) {
                $purchases[$key]['sales_prods'] = $pp->getSalesProds($value['id']);
            }
        }
        return $purchases;
	}

	public function getPurchase($id)
	{
		$purchases = [];
        $sql = $this->db->prepare("SELECT purchases.*, users.name as user_name, users.email as user_email FROM purchases LEFT JOIN users ON (users.id = purchases.id_user) WHERE purchases.id = :id");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->bindValue(':id', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $purchases = $sql->fetchAll();
            $pp = new Purchases_products();
            foreach ($purchases as $key => $value) {
                $purchases[$key]['sales_prods'] = $pp->getSalesProds($id);
            }
        }
        return $purchases;
	}

	public function getLastPurchase($id)
	{
		$purchases = [];
        $sql = $this->db->prepare("SELECT * FROM purchases WHERE id_user = :id ORDER BY id DESC");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->bindValue(':id', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $purchases = $sql->fetch();
        }
        return $purchases['id'];
	}

	public function getLastGlobalPuchase()
	{
		$purchases = [];
        $sql = $this->db->prepare("SELECT id FROM purchases ORDER BY id DESC LIMIT 1");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $purchases = $sql->fetch();
		}
        return $purchases['id'];
	}

	public function setPurchaseStatus($id, $flag)
	{
		$sql = $this->db->prepare("UPDATE FROM purchases SET status = :flag WHERE id = :id");
		$sql->bindValue(':id', $id);
		$sql->bindValue(':flag', $flag);
		$sql->execute();
	}

	public function delItens($id)
	{
		$sql = $this->db->prepare("DELETE FROM purchases_products WHERE id_purchase = :id");
		$sql->bindValue(':id', $id);
		$sql->execute();
	}

}