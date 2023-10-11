<?php
require_once("app/views/home.view.php");
class HomeController{
    //atributo
    private $view;

    //constructor
    public function __construct() {
        $this->view = new HomeView;
    }

    //metodos

    //funcion para mostrar el home
    public function mostrarHome(){
        $this->view->mostrarHome();
    }

    //funcion para atajar una url que no existe (error 404)
    public function mostrar404($error){
        $this->view->mostrar404($error);
    }
}