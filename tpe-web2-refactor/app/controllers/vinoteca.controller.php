<?php

require_once __DIR__ . '/../models/vinoteca.model.php';
require_once __DIR__ . '/../views/vinoteca.view.php';
require_once __DIR__ . '/../helpers/auth.helper.php'; 

class VinotecaController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new VinotecaModel();
        $this->view = new VinotecaView();
        AuthHelper::init();
    }

    public function showHome(){
        $this->view->showHome();      
    }

    public function showVinos(){
        $vinos = $this->model->getVinos();
        $this->view->showVinos($vinos);
    }

    public function showVino($id){
        $vino = $this->model->getVino($id);
        $this->view->showVino($vino);
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

    public function showVinosPorCepa($id){
        $vinos = $this->model->getvinosporcepa($id);
        $cepa = $this->model->getcepa($id);
        $this->view->showvinosporcepa($vinos, $cepa);
    }

    public function showModificarVino($id){
        AuthHelper::verify();
        $vino = $this->model->getVino($id);
        $cepas = $this->model->getCepas();
        $this->view->showFormularioModificarVino($id,$vino, $cepas);
    }

    public function modificarVino($id){
        AuthHelper::verify();
        $Nombre = $_POST['Nombre'];
        $Tipo = $_POST['Tipo'];
        $Azucar = $_POST['Azucar'];
        $id_cepa = $_POST['id_cepa'];

        if (empty($Nombre) || empty($Tipo) || empty($Azucar) || empty($id_cepa)) {
            $this->view->showError("Debe completar todos los campos");
        }
        else{
            $this->model->updateVino($Nombre, $Tipo, $Azucar, $id_cepa, $id);
            $this->showVinos();
        }
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

    public function eliminarVino($id){
        AuthHelper::verify();
        $this->model->deleteVino($id);
        $this->showVinos();
    }

    public function eliminarCepa($id){
        AuthHelper::verify();
        $vinos = $this->model->getVinosPorCepa($id);
        if (empty($vinos)){
            $this->model->deleteCepa($id);
            $this->showCepas();
        }else{
            $this->view->showError("No se puede eliminar, ya que esta cepa contiene los siguientes vinos: ");
            $cepa = $this->model->getCepa($id);
            $this->view->showVinosPorCepa($vinos, $cepa);
        }
    }

    public function showAgregarVino(){
        AuthHelper::verify();
        $cepas = $this->model->getCepas();
        $this->view->showFormularioAgregarVino($cepas);
    }

    public function agregarVino(){
        AuthHelper::verify();
        $Nombre = $_POST['Nombre'];
        $Tipo = $_POST['Tipo'];
        $Azucar = $_POST['Azucar'];
        $id_cepa = $_POST['id_cepa'];

        if (empty($Nombre) || empty($Tipo) || empty($Azucar) || empty($id_cepa)) {
            $this->view->showError("Debe completar todos los campos");
            return;
        }

        $id = $this->model->insertVino($Nombre, $Tipo, $Azucar, $id_cepa );
        if ($id) {
            $this->showVinos();
        } else {
            $this->view->showError("Error al insertar el vino");
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