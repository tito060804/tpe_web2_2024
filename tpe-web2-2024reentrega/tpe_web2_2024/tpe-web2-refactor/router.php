<?php

require_once 'config.php';
require_once './app/controllers/vino.controller.php';
require_once './app/controllers/cepa.controller.php';
require_once './app/controllers/auth.controller.php';

// Definir la URL base
// define('BASE_URL', BASE_URL);

// Acción por defecto
$action = 'home';

if (!empty($_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

// Crear instancia del controlador

// Router para las diferentes acciones
switch ($params[0]) { 
    case 'home':
        $controller= new VinoController();
        $controller->showHome();
        break;
    case 'listar':
        $controller= new VinoController();
        $controller->showVinos(); 
        break;
    case 'mostrarVino':
        $controller= new VinoController();
        $controller->showVino($params[1]); 
        break;
    case 'mostrarCepa':
        $controller= new CepaController();
        $controller->showCepa($params[1]); 
        break;
    case 'mostrarCepas':
        $controller= new CepaController();
        $controller->showCepas(); 
        break;
    case 'buscarVinosPorCepa':
        $controller= new CepaController();
        $controller->showBuscarPorCepa(); 
        break;
    case 'mostrarVinosPorCepa':
        $controller= new VinoController();
        $controller->showVinosPorCepa($params[1]); 
        break;
    case 'eliminarVino':
        $controller= new VinoController();
        $controller->eliminarVino($params[1]); 
        break;
    case 'modificarVino':
        $controller= new VinoController();
        $controller->showModificarVino($params[1]); 
        break;
    case 'enviarModificarVino':
        $controller= new VinoController();
        $controller->modificarVino($params[1]); 
        break;
    case 'agregarVino':
        $controller= new VinoController();
        $controller->showAgregarVino(); 
        break;
    case 'enviarAgregarVino':
        $controller= new VinoController();
        $controller->agregarVino(); 
        break;
    case 'eliminarCepa':
        $controller= new CepaController();
        $controller->eliminarCepa($params[1]); 
        break;
    case 'modificarCepa':
        $controller= new CepaController();
        $controller->showModificarCepa($params[1]); 
        break;
    case 'enviarModificarCepa':
        $controller= new CepaController();
        $controller->modificarCepa($params[1]); 
        break;
    case 'agregarCepa':
        $controller= new CepaController();
        $controller->showAgregarCepa(); 
        break;
    case 'enviarAgregarCepa':
        $controller= new CepaController();
        $controller->agregarCepa(); 
        break;
    case 'login':
        $controller = new AuthController();
        $controller->showLogin(); 
        break;
    case 'auth':
        $controller = new AuthController();
        $controller->auth();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    default: 
        $controller= new VinoController();
        $controller->showHome();
        break;

}