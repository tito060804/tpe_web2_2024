<?php

class CepaView
{

    public function showVinosPorCepa($vinos, $cepa)
    {
        require 'templates/mostrar_vinos_por_cepa.phtml';
    }

    public function showCepas($cepas)
    {
        require 'templates/mostrar_cepas_modificar.phtml';
    }

    public function showCepa($cepa)
    {
        require 'templates/mostrar_cepa.phtml';
    }

    public function showBuscarPorCepa($cepas)
    {
        require 'templates/buscar_por_cepa.phtml';
    }

    public function showFormularioModificarCepa($id, $cepa)
    {
        require 'templates/formulario_modificacion_cepa.phtml';
    }

    public function showFormularioAgregarCepa()
    {
        require 'templates/formulario_agregar_cepa.phtml';
    }

    public function showError($error)
    {
        require 'templates/error.phtml';
    }
}
