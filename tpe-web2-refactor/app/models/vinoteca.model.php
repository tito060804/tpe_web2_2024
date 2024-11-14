<?php

require_once 'app/models/models.php';

class VinotecaModel extends Model {


    public function getVinos() {
        $query = $this->db->prepare('SELECT nombre_vino, tipo FROM `db_vinos`');
        $query->execute();
        $vinos = $query->fetchAll(PDO::FETCH_OBJ);

        return $vinos;
    }

    public function getVino($id) {
        $query= $this->db->prepare('SELECT *  FROM `db_vinos` a INNER JOIN `cepa` b ON a.id_cepa = b.id_cepa  WHERE `id_vino` = ?');
        $query->execute([$id]);
        $vino= $query->fetch(PDO::FETCH_OBJ);

        return $vino;
    }


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
//aca deberia juntar ambas tablas para buscar los id del vino con la cepa correspondiente
    public function getVinosPorCepa($id) {
        $query= $this->db->prepare('SELECT a.*, FROM `vino`  WHERE a.id_cepa = ?');
        $query->execute([$id]);
        $vinos= $query->fetchAll(PDO::FETCH_OBJ);

        return $vinos;
    }

    public function updateVino($Nombre, $Tipo, $Azucar, $id_cepa, $id) {    
        $query = $this->db->prepare('UPDATE `vino` SET Nombre=?, Tipo=?, Azucar=?, id_cepa=? WHERE ID_vino = ?');
        $query->execute([$Nombre, $Tipo, $Azucar, $id_cepa, $id]);
    }

    public function updateCepa($Nombre_cepa, $Aroma, $Maridaje, $Textura, $id) {    
        $query = $this->db->prepare('UPDATE `cepa` SET Nombre_cepa=?, Aroma=?, Maridaje=?, Textura=? WHERE id_cepa = ?');
        $query->execute([$Nombre_cepa, $Aroma, $Maridaje, $Textura, $id]);
    }

    public function deleteVino($id){
        $query = $this->db->prepare('DELETE FROM `vino` WHERE ID_vino = ?');
        $query->execute([$id]);
    }

    public function deleteCepa($id){
        $query = $this->db->prepare('DELETE FROM `cepa` WHERE id_cepa = ?');
        $query->execute([$id]);
    }

    public function insertVino($Nombre, $Tipo, $Azucar, $id_cepa){
        $query = $this->db->prepare('INSERT INTO `vino` (Nombre, Tipo, Azucar, id_cepa) VALUES(?,?,?,?)');
        $query->execute([$Nombre, $Tipo, $Azucar, $id_cepa]);

        return $this->db->lastInsertId();
    }

    public function insertCepa($Nombre_cepa, $Aroma, $Maridaje, $Textura){
        $query = $this->db->prepare('INSERT INTO `cepa` (Nombre_cepa, Aroma, Maridaje, Textura) VALUES(?,?,?,?)');
        $query->execute([$Nombre_cepa, $Aroma, $Maridaje, $Textura]);

        return $this->db->lastInsertId();
    }
}