<?php
class AjustesLoja extends Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getLojaInfos()
    {
        $data = [];
        $db = $this->db->prepare("SELECT * FROM ajustes_loja");
        $db->setFetchMode(PDO::FETCH_ASSOC);
        $db->execute();

        if ($db->rowCount() > 0) {
            $data = $db->fetch();
        }
        return $data;
    }

}
