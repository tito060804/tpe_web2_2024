<?php

class VinoView
{
    public function showHome()
    {
        require 'templates/home.phtml';
    }

    public function showVinos($vinos)
    {

        require 'templates/mostrar_vinos_modificar.phtml';
    }

    public function showVinosPorCepa($vinos, $cepa)
    {
        require 'templates/mostrar_vinos_por_cepa.phtml';
    }

    public function showVino($vino)
    {
        require 'templates/mostrar_vino.phtml';
    }

    public function showFormularioModificarVino($vino, $cepas)
    {
        require 'templates/formulario_modificar_vino.phtml';
    }


    public function showFormularioAgregarVino($cepas)
    {
        require 'templates/formulario_agregar_vino.phtml';
    }

    public function showError($error)
    {
        require 'templates/error.phtml';
    }
}
