<?php

require_once 'app/models/models.php';

class VinoModel extends Model {


    public function getVinos() {
        $query = $this->db->prepare('SELECT * FROM `db_vinos`');
        $query->execute();
        $vinos = $query->fetchAll(PDO::FETCH_OBJ);

        return $vinos;
    }

    public function getVino($id) {
        $query= $this->db->prepare('SELECT *  FROM `db_vinos` a INNER JOIN `cepa` b ON a.cepa = b.id_cepa  WHERE `id_vino` = ?');
        $query->execute([$id]);
        $vino= $query->fetch(PDO::FETCH_OBJ);

        return $vino;
    }
    
//aca deberia juntar ambas tablas para buscar los id del vino con la cepa correspondiente
    public function getVinosPorCepa($id) {
        $query= $this->db->prepare('SELECT * FROM `db_vinos` WHERE cepa = ?');
        $query->execute([$id]);
        $vinos= $query->fetchAll(PDO::FETCH_OBJ);

        return $vinos;
    }

    public function updateVino($Nombre, $Tipo, $id_cepa, $id) {    
        $query = $this->db->prepare('UPDATE `db_vinos` SET nombre_vino=?, tipo=?, cepa=? WHERE id_vino = ?');
        $query->execute([$Nombre, $Tipo,  $id_cepa, $id]);
    }

    public function deleteVino($id){
        $query = $this->db->prepare('DELETE FROM `db_vinos` WHERE ID_vino = ?');
        $query->execute([$id]);
    }

    public function insertVino($Nombre, $Tipo,  $id_cepa){
        $query = $this->db->prepare('INSERT INTO `db_vinos` (nombre_vino, tipo, cepa) VALUES(?,?,?)');
        $query->execute([$Nombre, $Tipo,  $id_cepa]);

        return $this->db->lastInsertId();
    }

}