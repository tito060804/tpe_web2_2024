<?php

require_once __DIR__ . '/../models/cepa.model.php';
require_once __DIR__ . '/../models/vino.model.php';
require_once __DIR__ . '/../views/cepa.view.php';
require_once __DIR__ . '/../helpers/auth.helper.php'; 

class CepaController {
    private $model;
    private $modelVino;
    private $view;

    public function __construct() {
        $this->model = new CepaModel();
        $this->modelVino = new VinoModel();
        $this->view = new CepaView();
        AuthHelper::init();
    }

    public function showCepa($id){
        $cepa = $this->model->getCepa($id);
        $this->view->showCepa($cepa);
    }

    public function showCepas(){
        $cepas = $this->model->getCepas();
        $this->view->showCepas($cepas);
    }

    public function showBuscarPorCepa(){
        $cepas = $this->model->getCepas();
        $this->view->showBuscarPorCepa($cepas);
    }

    public function showModificarCepa($id){
        AuthHelper::verify();
        $cepa = $this->model->getCepa($id);
        $this->view->showFormularioModificarCepa($id, $cepa);
    }
    
    public function modificarCepa($id){
        AuthHelper::verify();
        $Nombre_cepa = $_POST['Nombre_cepa'];
        $Aroma = $_POST['Aroma'];
        $Maridaje = $_POST['Maridaje'];
        $Textura = $_POST['Textura'];
        
        if (empty($Nombre_cepa) || empty($Aroma) || empty($Maridaje) || empty($Textura)) {
            $this->view->showError("Debe completar todos los campos");
        }
        else{
            $this->model->updateCepa($Nombre_cepa, $Aroma, $Maridaje, $Textura, $id);
            $this->showCepas();
        }
    }

    public function eliminarCepa($id){
        AuthHelper::verify();
        $vinos = $this->modelVino->getVinosPorCepa($id);
        if (empty($vinos)){
            $this->model->deleteCepa($id);
            $this->showCepas();
        }else{
            $this->view->showError("No se puede eliminar, ya que esta cepa contiene los siguientes vinos: ");
            $cepa = $this->model->getCepa($id);
            $this->view->showVinosPorCepa($vinos, $cepa);
        }
    }

    public function showAgregarCepa(){
        AuthHelper::verify();
        $this->view->showFormularioAgregarCepa();
    }

    public function agregarCepa(){
        AuthHelper::verify();
        $Nombre_cepa = $_POST['Nombre_cepa'];
        $Aroma = $_POST['Aroma'];
        $Maridaje = $_POST['Maridaje'];
        $Textura = $_POST['Textura'];
        
        if (empty($Nombre_cepa) || empty($Aroma) || empty($Maridaje) || empty($Textura)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }

        $id = $this->model->insertCepa($Nombre_cepa, $Aroma, $Maridaje, $Textura);
        if ($id) {
            $this->showCepas();
        } else {
            $this->view->showError("Error al insertar la cepa");
        }
    }
}