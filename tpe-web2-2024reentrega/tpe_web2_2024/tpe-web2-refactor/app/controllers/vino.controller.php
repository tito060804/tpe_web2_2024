<?php

require_once __DIR__ . '/../models/vino.model.php';
require_once __DIR__ . '/../models/cepa.model.php';
require_once __DIR__ . '/../views/vino.view.php';
require_once __DIR__ . '/../helpers/auth.helper.php'; 

class VinoController {
    private $model;
    private $modelCepa;
    private $view;

    public function __construct() {
        $this->model = new VinoModel();
        $this->modelCepa = new CepaModel();
        $this->view = new VinoView();
        AuthHelper::init();
    }

    public function showHome(){
        $this->view->showHome();      
    }

    public function showVinos(){
        $vinosT = $this->model->getVinos();
        foreach ($vinosT as $vino) {
            $vino->cepa = $this->modelCepa->getCepa($vino->cepa)->nombre_cepa;
        }
        $this->view->showVinos($vinosT);
    }

    public function showVino($id){
        $vino = $this->model->getVino($id);
        $this->view->showVino($vino);
    }
    
    public function showVinosPorCepa($id){
        $vinos = $this->model->getvinosporcepa($id);
        $cepa = $this->modelCepa->getcepa($id);

        $this->view->showvinosporcepa($vinos, $cepa);
    }

    public function showModificarVino($id){
        AuthHelper::verify();
        $vino = $this->model->getVino($id);
        $cepas = $this->modelCepa->getCepas();
        $this->view->showFormularioModificarVino($vino, $cepas);
    }

    public function modificarVino($id){
        AuthHelper::verify();
        $Nombre = $_POST['Nombre'];
        $Tipo = $_POST['Tipo'];
        $id_cepa = $_POST['id_cepa'];

        if (empty($Nombre) || empty($Tipo)  || empty($id_cepa)) {
            $this->view->showError("Debe completar todos los campos");
        }
        else{
            $this->model->updateVino($Nombre, $Tipo, $id_cepa, $id);
            $this->showVinos();
        }
    }

    public function eliminarVino($id){
        AuthHelper::verify();
        $this->model->deleteVino($id);
        $this->showVinos();
    }

    public function showAgregarVino(){
        AuthHelper::verify();
        $cepas = $this->modelCepa->getCepas();
        $this->view->showFormularioAgregarVino($cepas);
    }

    public function agregarVino(){
        AuthHelper::verify();
        $Nombre = $_POST['Nombre'];
        $Tipo = $_POST['Tipo'];
        $id_cepa = $_POST['id_cepa'];

        if (empty($Nombre) || empty($Tipo) || empty($id_cepa)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }

        $id = $this->model->insertVino($Nombre, $Tipo, $id_cepa );
        if ($id) {
            $this->showVinos();
        } else {
            $this->view->showError("Error al insertar el vino");
        }
    }
}