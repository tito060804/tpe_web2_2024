<?php

class VinotecaView{
    public function showHome() {
        require 'templates/home.phtml';}

    public function showVinos($vinos){
     
        require 'templates/mostrar_vino.phtml';
    }


    public function showVinosPorCepa($vinos, $cepa){
        require 'templates/mostrar_vinos_por_cepa.phtml';
    }
    
    public function showVino($vino){
        require 'templates/mostrar_vino.phtml';
    }


    public function showCepas($cepas){
        require 'templates/mostrar_cepas_modificar.phtml';
    }

    public function showCepa($cepa){
        require 'templates/mostrar_cepa.phtml';
    }

    public function showBuscarPorCepa($cepas){
        require 'templates/buscar_por_cepa.phtml';
    }
    
    public function showFormularioModificarVino($id, $vino, $cepas){
        require 'templates/formulario_modificacion_vino.phtml';}


    public function showFormularioModificarCepa($id, $cepa){
        require 'templates/formulario_modificacion_cepa.phtml';
    }

    public function showFormularioAgregarVino( $cepas){
        require 'templates/formulario_agregar_vino.phtml';
    }

    public function showFormularioAgregarCepa(){
        require 'templates/formulario_agregar_cepa.phtml';
    }

    public function showError($error) {
        require 'templates/error.phtml';
    }
}

?>