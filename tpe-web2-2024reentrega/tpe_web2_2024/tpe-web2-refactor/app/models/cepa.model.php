<?php

require_once 'app/models/models.php';

class CepaModel extends Model {

    //funciona
    public function getCepa($id) {
        $query= $this->db->prepare('SELECT * FROM `cepa`  WHERE `id_cepa` = ?');
        $query->execute([$id]);
        $cepa= $query->fetch(PDO::FETCH_OBJ);

        return $cepa;
    }

    public function getCepas() {
        $query= $this->db->prepare('SELECT id_cepa, Nombre_cepa FROM `cepa`');
        $query->execute();
        $cepas= $query->fetchAll(PDO::FETCH_OBJ);

        return $cepas;
    }

    public function updateCepa($Nombre_cepa, $Aroma, $Maridaje, $Textura, $id) {    
        $query = $this->db->prepare('UPDATE `cepa` SET Nombre_cepa=?, Aroma=?, Maridaje=?, Textura=? WHERE id_cepa = ?');
        $query->execute([$Nombre_cepa, $Aroma, $Maridaje, $Textura, $id]);
    }

    public function deleteCepa($id){
        $query = $this->db->prepare('DELETE FROM `cepa` WHERE id_cepa = ?');
        $query->execute([$id]);
    }

    public function insertCepa($Nombre_cepa, $Aroma, $Maridaje, $Textura){
        $query = $this->db->prepare('INSERT INTO `cepa` (Nombre_cepa, Aroma, Maridaje, Textura) VALUES(?,?,?,?)');
        $query->execute([$Nombre_cepa, $Aroma, $Maridaje, $Textura]);

        return $this->db->lastInsertId();
    }
}