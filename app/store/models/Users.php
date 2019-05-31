<?php
class Users extends Model {

	public function emailExists($email) {

		$sql = "SELECT * FROM users WHERE email = :email";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":email", $email);
		$sql->execute();

		if($sql->rowCount() > 0) {
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

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			$uid = $sql['id'];

		}

		return $uid;
	}

	public function validatePass($id, $pass) {

		$sql = "SELECT * FROM users WHERE id = :id AND password = :pass";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":id", $id);
		$sql->bindValue(":pass", $pass);
		$sql->execute();

		if($sql->rowCount() > 0) {
			$sql = $sql->fetch();
			$uid = $sql['id'];
			return $uid;
		} else {
			return false;
		}

	}

	public function createUser($email, $pass, $name, $street, $num, $complement, $cep, $district, $city, $state, $telephone, $cpf) {

		$sql = "INSERT INTO users (email, password, name, street, num, complement, cep, district, city, state, telephone, cpf) VALUES (:email, :pass, :name, :street, :num, :complement, :cep, :district, :city, :state, :telephone, :cpf)";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(":email", $email);
		$sql->bindValue(":pass", $pass);
		$sql->bindValue(":name", $name);
		$sql->bindValue(":street", $street);
		$sql->bindValue(":num", $num);
		$sql->bindValue(":complement", $complement);
		$sql->bindValue(":cep", $cep);
		$sql->bindValue(":district", $district);
		$sql->bindValue(":city", $city);
		$sql->bindValue(":state", $state);
		$sql->bindValue(":telephone", $telephone);
		$sql->bindValue(":cpf", $cpf);
		$sql->execute();

		return $this->db->lastInsertId();

	}

	public function getUserData($id)

	{

		$data = [];
		$sql = $this->db->prepare("SELECT * FROM users WHERE id = :id");
		$sql->setFetchMode(PDO::FETCH_ASSOC);
		$sql->bindValue(':id', $id);
		$sql->execute();

		if ($sql->rowCount() > 0) {
			$data = $sql->fetchAll();
		}

		return $data;
	}

	public function updateUser($rua, $numero, $bairro, $cidade, $estado, $telefone, $celular, $id)

	{

		$sql = $this->db->prepare("UPDATE users SET street = :street, num = :num, district = :district, city = :city, state = :state, telephone = :telephone, celular = :celular WHERE id = :id");
		$sql->bindValue(':street', $rua);
		$sql->bindValue(':num', $numero);
		$sql->bindValue(':district', $bairro);
		$sql->bindValue(':city', $cidade);
		$sql->bindValue(':state', $estado);
		$sql->bindValue(':telephone', $telefone);
		$sql->bindValue(':celular', $celular);
		$sql->bindValue(':id', $id);

		$sql->execute();

	}

	public function updatePass($pass, $id)

	{

		$sql = $this->db->prepare("UPDATE users SET password = :pass WHERE id = :id");
		$sql->bindValue(':pass', $pass);
		$sql->bindValue(':id', $id);
		$sql->execute();

	}

}