<?php
class Vitrine extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getItemsExpo()
    {
        $data = [];
        $db = $this->db->prepare("SELECT * FROM vitrine");
        $db->setFetchMode(PDO::FETCH_ASSOC);
        $db->execute();

        if ($db->rowCount() > 0) {
            $data = $db->fetchAll();
        }
        return $data;
    }

}
