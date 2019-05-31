<?php

class Purchases extends Model {

    public function createPurchase($uid, $total, $payment_type) {

        $sql = "INSERT INTO purchases (id_user, total_amount, payment_type, payment_status) VALUES (:uid, :total, :type, 1)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":uid", $uid);
        $sql->bindValue(":total", $total);
        $sql->bindValue(":type", $payment_type);
        $sql->execute();

        return $this->db->lastInsertId();
    }

    public function addItem($id, $id_product, $qt, $price) {

        $sql = "INSERT INTO purchases_products (id_purchase, id_product, quantity, product_price) VALUES (:id, :idp, :qt, :price)";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":id", $id);
        $sql->bindValue(":idp", $id_product);
        $sql->bindValue(":qt", $qt);
        $sql->bindValue(":price", $price);
        $sql->execute();
    }

    public function setPaid($id) {

        $sql = "UPDATE purchases SET payment_status = :status WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":status", '2');
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function setCancelled($id) {

        $sql = "UPDATE purchases SET payment_status = :status WHERE id = :id";
        $sql = $this->db->prepare($sql);
        $sql->bindValue(":status", '3');
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function setShippingCode($id, $code)
    {
        $sql = $this->db->prepare("UPDATE purchases SET shipping_code = :shipping_code, shipping_date = time() WHERE id = :id");
        $sql->bindValue(':shipping_code', $code);
        $sql->bindValue(':id', $id);
        $sql->execute();
    }

    public function getPurchases($offset = 0, $limit = 20)
    {
        $purchases = [];
        $sql = $this->db->prepare("SELECT * FROM purchases LIMIT $offset, $limit");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
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
        $sql = $this->db->prepare("SELECT * FROM purchases WHERE id = :id");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
        $sql->bindValue(':id', $id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $purchases = $sql->fetchAll();
            $pp = new Purchases_products();
            foreach ($purchases as $key => $value) {
                $purchases[$key]['sales_prods'] = $pp->getSalesProds($value['id']);
            }

            $usr = new Users();
            $purchases['user'] = $usr->getuser($purchases[0]['id_user']);

        }

        return $purchases;
    }

    public function getLastPurchases()
    {
        $purchases = [];
        $sql = $this->db->prepare("SELECT * FROM purchases LIMIT 10");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
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

    public function getApprovedPurchases()
    {
        $purchases = [];
        $sql = $this->db->prepare("SELECT * FROM purchases WHERE payment_status = 3");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
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

    public function getRepprovedPurchases()
    {
        $purchases = [];
        $sql = $this->db->prepare("SELECT * FROM purchases WHERE payment_status = 5");
        $sql->setFetchMode(PDO::FETCH_ASSOC);
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

    public function getTotal() {

        $sql = "SELECT COUNT(*) as c FROM purchases";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        $sql = $sql->fetch();

        return $sql['c'];
    }

    public function getTotalAmount() {
        $sql = "SELECT SUM(total_amount) as total_amount FROM purchases";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        $sql = $sql->fetch();   

        return $sql['total_amount'];
    }
}