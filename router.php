<?php
require_once("app/controllers/home.controller.php");
require_once("app/controllers/categoria.controller.php");
require_once("app/controllers/producto.controller.php");
require_once("app/controllers/autenticacion.controller.php");

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

// el router va a leer la action desde el paramtro "action"
$action = 'home'; // accion por defecto
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);
//Instancio el homeController
$controladorHome = new HomeController();
//Instancio el CategoriaController
$controladorCategoria = new CategoriaController();
//Instacio el ProductoController
$controladorProducto = new ProductoController();
//Instancio el AutenticacionController
$controladorAutenticador = new AutenticacionController();

switch($params[0]){ //en la primer posicion tengo la accion real
    case "home":
        $controladorHome->mostrarHome();
        break;
    case "categorias":
        $controladorCategoria->mostrarCategorias();
        break;
    case "agregarCategoria":
        $controladorCategoria->agregarCategoria();
        break;
    case "borrarCategoria":
        $controladorCategoria->eliminarCategoria($params[1]);
        break;
    case "formModificarCategoria":
        $controladorCategoria->formModificarCategoria($params[1]);
        break;
    case "modificarCategoria":
        $controladorCategoria->modificarCategoria($params[1]);
        break;
    case "mostrarProducto":
        $controladorProducto->mostrarProductoXCategoria($params[1]);
        break;
    case "mostrarDetalleProducto":
        $controladorProducto->mostrarDetalleProducto($params[1]);
        break;
    case "mostrarProductos":
        $controladorProducto->mostrarProductos();
        break;
    case "agregarProducto":
        $controladorProducto->agregarProducto();
        break;
    case "eliminarProducto":
        $controladorProducto->eliminarProducto($params[1]);
        break;
    case "formModificarProducto":
        $controladorProducto->formModificarProducto($params[1]);
        break;
    case "modificarProducto":
        $controladorProducto->modificarProducto($params[1]);
    case "login":
        $controladorAutenticador-> mostrarLogin();
        break;
    case "autenticacion":
        $controladorAutenticador-> autenticacion();
        break;
    case "logout":
        $controladorAutenticador-> logout();
        break;
    default:
        $controladorHome->mostrar404("error 404");
        break;
}  
